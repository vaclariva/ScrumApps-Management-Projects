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
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::setLocale('id');
        Schema::defaultStringLength(191);

        try {
            $setting = $this->getSettingData();

            // Cek apakah email host sudah dikonfigurasi
            if ($setting && $setting->smtp_host && $setting->smtp_username && $setting->smtp_password) {
                config([
                    'mail.mailers.smtp.host'       => $setting->smtp_host,
                    'mail.mailers.smtp.encryption' => $setting->type_of_encryption ?? 'tls',
                    'mail.mailers.smtp.port'       => $setting->smtp_port ?? ($setting->type_of_encryption == 'ssl' ? 465 : 587),
                    'mail.mailers.smtp.username'   => $setting->smtp_username,
                    'mail.mailers.smtp.password'   => $setting->smtp_password,
                    'mail.from.address'            => $setting->mail_from_address,
                    'mail.from.name'               => $setting->from_name
                ]);
            } else {
                // Jika email host belum dikonfigurasi, gunakan log driver
                config([
                    'mail.default' => 'log',
                    'mail.from.address' => 'noreply@example.com',
                    'mail.from.name' => 'System'
                ]);
            }
        } catch (\Throwable $th) {
            info('AppServiceProvider: Could not load settings from database, using log driver');
            config([
                'mail.default' => 'log',
                'mail.from.address' => 'noreply@example.com',
                'mail.from.name' => 'System'
            ]);
        }

        view()->composer('*', function ($view) {
            try {
                $user = auth()->user();

                if (!$user) {
                    $view->with('filteredProjects', []);
                    $view->with('unreadCount', 0);
                    return;
                }

                // Hapus cache untuk real-time notifications
                $projectData = (function () use ($user) {
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

                        $status = strtoupper($status);

                        if ($project->status !== $status) {
                            $projectsToUpdate[] = [
                                'id' => $project->id,
                                'status' => $status
                            ];
                        }

                        if (in_array($status, ['DONE', 'LATE'])) {
                            // Cek apakah user sudah membaca notifikasi ini
                            $existingRead = DB::table('project_user_reads')
                                ->where('project_id', $project->id)
                                ->where('user_id', $user->id)
                                ->first();

                            if (!$existingRead || !$existingRead->read) {
                                $unreadCount++;

                                // Pastikan record ada di tabel project_user_reads
                                DB::table('project_user_reads')->updateOrInsert(
                                    [
                                        'project_id' => $project->id,
                                        'user_id' => $user->id
                                    ],
                                    [
                                        'read' => false,
                                        'created_at' => now(),
                                        'updated_at' => now()
                                    ]
                                );

                                // Set read status ke project object
                                $project->read = false;

                                // Debug log
                                info("Created/Updated notification record for user {$user->id} on project {$project->id} (status: {$status})");
                            } else {
                                // Set read status ke project object
                                $project->read = true;
                            }

                            $filteredProjects[] = $project;
                        }
                    }

                    if (!empty($projectsToUpdate)) {
                        foreach ($projectsToUpdate as $projectData) {
                            Project::where('id', $projectData['id'])->update(['status' => $projectData['status']]);
                        }
                    }

                    return [
                        'filteredProjects' => $filteredProjects,
                        'unreadCount' => $unreadCount
                    ];
                })();

                $view->with('filteredProjects', $projectData['filteredProjects']);
                $view->with('unreadCount', $projectData['unreadCount']);

            } catch (\Throwable $th) {
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

        return new \App\Models\Setting();
    }
}
