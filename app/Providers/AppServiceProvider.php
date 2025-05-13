<?php

namespace App\Providers;

use App\Listeners\LogFailedLogin;
use App\Listeners\LogSuccessLogin;
use App\Listeners\LogSuccessLogout;
use App\Listeners\DeleteStatusLogin;
use App\Models\Project;
use Carbon\Carbon;
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

        $projectsToUpdate = [];
        $projects = Project::with(['user', 'sprints'])->latest()->get();
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

                if (!$project->read) {
                    $unreadCount++;
                }
            }
        }

        if (!empty($projectsToUpdate)) {
            foreach ($projectsToUpdate as $projectData) {
                Project::where('id', $projectData['id'])->update(['status' => $projectData['status']]);
            }
        }

        View::share('filteredProjects', $filteredProjects);
        View::share('unreadCount', $unreadCount);
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
            return new \App\Models\Setting();
        }
    }
}
