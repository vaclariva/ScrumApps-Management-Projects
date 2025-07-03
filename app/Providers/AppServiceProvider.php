<?php

namespace App\Providers;

use App\Listeners\LogFailedLogin;
use App\Listeners\LogSuccessLogin;
use App\Listeners\LogSuccessLogout;
use App\Listeners\DeleteStatusLogin;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::setLocale('id');
        Schema::defaultStringLength(191);

        // Re-enabled with better error handling
        try {
            $setting = $this->getSettingData();

            config([
                'mail.mailers.smtp.host'       => $setting->smtp_host ?? env('MAIL_HOST', 'smtp.mailgun.org'),
                'mail.mailers.smtp.encryption' => $setting->type_of_encryption ?? env('MAIL_ENCRYPTION', 'tls'),
                'mail.mailers.smtp.port'       => $setting->smtp_port ?? env('MAIL_PORT', 587),
                'mail.mailers.smtp.username'   => $setting->smtp_username ?? env('MAIL_USERNAME'),
                'mail.mailers.smtp.password'   => $setting->smtp_password ?? env('MAIL_PASSWORD'),
                'mail.from.address'            => $setting->mail_from_address ?? env('MAIL_FROM_ADDRESS'),
                'mail.from.name'               => $setting->from_name ?? env('MAIL_FROM_NAME')
            ]);
        } catch (\Throwable $th) {
            // If database is not available, use env values
            info('AppServiceProvider: Could not load settings from database, using env values');
        }

        // Optimized view composer with caching
        // Re-enabled with better error handling
        view()->composer('*', function ($view) {
            try {
                $user = auth()->user();

                if (!$user) {
                    $view->with('filteredProjects', []);
                    $view->with('unreadCount', 0);
                    return;
                }

                // Cache key based on user
                $cacheKey = "user_projects_{$user->id}";
                $cacheDuration = 300; // 5 minutes

                $projectData = Cache::remember($cacheKey, $cacheDuration, function () use ($user) {
                    // Optimized query with eager loading
                    $projects = Project::with(['user', 'sprints', 'readers'])
                        ->when($user->role !== 'Superadmin', function ($query) use ($user) {
                            $query->where(function ($q) use ($user) {
                                $q->where('user_id', $user->id)
                                ->orWhereIn('id', function ($subQuery) use ($user) {
                                    $subQuery->select('project_id')
                                        ->from('teams')
                                        ->where('user_id', $user->id);
                                });
                            });
                        })
                        ->latest()
                        ->get();

                    $projectsToUpdate = [];
                    $unreadCount = 0;
                    $filteredProjects = [];

                    foreach ($projects as $project) {
                        $startDate = Carbon::parse($project->start_date);
                        $endDate = Carbon::parse($project->end_date);
                        $today = Carbon::today();

                        $totalSprints = $project->sprints->count();
                        $completedSprints = $project->sprints->where('status', 'active')->count();

                        $status = 'UNKNOWN';

                        if ($totalSprints === 0) {
                            $status = 'HOLD';
                        } elseif ($today->greaterThan($endDate)) {
                            $status = $completedSprints < $totalSprints ? 'LATE' : 'DONE';
                        } else {
                            $status = $completedSprints < $totalSprints ? 'IN PROGRESS' : 'DONE';
                        }

                        if ($project->status !== $status) {
                            $projectsToUpdate[] = [
                                'id' => $project->id,
                                'status' => $status
                            ];
                        }

                        if (in_array($status, ['DONE', 'LATE'])) {
                            $filteredProjects[] = $project;

                            // Check if project is read using relationship
                            $isRead = $project->readers()
                                ->where('user_id', $user->id)
                                ->where('read', true)
                                ->exists();

                            if (!$isRead) {
                                $unreadCount++;

                                // Insert read record if not exists
                                $project->readers()->updateOrCreate(
                                    ['user_id' => $user->id],
                                    ['read' => false, 'created_at' => now(), 'updated_at' => now()]
                                );
                            }
                        }
                    }

                    // Update project statuses in batch
                    if (!empty($projectsToUpdate)) {
                        foreach ($projectsToUpdate as $projectData) {
                            Project::where('id', $projectData['id'])->update(['status' => $projectData['status']]);
                        }
                    }

                    return [
                        'filteredProjects' => $filteredProjects,
                        'unreadCount' => $unreadCount
                    ];
                });

                $view->with('filteredProjects', $projectData['filteredProjects']);
                $view->with('unreadCount', $projectData['unreadCount']);

            } catch (\Throwable $th) {
                // If there's any error, set default values
                info('AppServiceProvider Error:', [$th]);
                $view->with('filteredProjects', []);
                $view->with('unreadCount', 0);
            }
        });
    }

    /**
     * Mengambil data dynamic setting dari DB
     *
     * @return \Illuminate\Support\Collection
     */
    protected function getSettingData()
    {
        try {
            $setting = \App\Models\Setting::first();

            if ($setting) {
                return $setting;
            }
        } catch (\Throwable $th) {
            info('Setting Error:', [$th]);
        }

        // Return default setting object
        return new \App\Models\Setting();
    }
}
