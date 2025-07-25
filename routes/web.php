<?php

use App\Http\Controllers\BacklogController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CheckDevController;
use App\Http\Controllers\DevelopmentController;
use App\Http\Controllers\NotifController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\AuthlogController;
use App\Http\Controllers\CheckBacklogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\NewPasswordPartnerController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SprintController;
use App\Http\Controllers\VisionBoardController;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Auth\GoogleController;


Route::get('/', function () {
    return redirect('dashboard');
});

Route::get('/test-auth', function () {
    if (auth()->check()) {
        return response()->json([
            'authenticated' => true,
            'user' => auth()->user()->only(['id', 'name', 'email', 'role']),
            'session_id' => session()->getId()
        ]);
    }
    return response()->json(['authenticated' => false]);
})->name('test.auth');

Route::get('/test-dashboard', function () {
    return response()->json([
        'message' => 'Dashboard route is accessible',
        'auth_check' => auth()->check(),
        'user' => auth()->user() ? auth()->user()->only(['id', 'name']) : null
    ]);
})->name('test.dashboard');

Route::get('/test-session', function () {
    return response()->json([
        'session_id' => session()->getId(),
        'session_data' => session()->all(),
        'auth_check' => auth()->check(),
        'user' => auth()->user() ? auth()->user()->only(['id', 'name']) : null
    ]);
})->name('test.session');

Route::middleware([
    'banned.ip',
    'auth.twofactor',
    'auth',
    'auth.is_active',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/users/list', [UserController::class, 'list'])->name('users.list');
    Route::post('/users/{user}/resend-email', [UserController::class, 'resendEmailRegister'])->name('users.resend-email');
    Route::resource('users', UserController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

     // Settings routes
    Route::controller(SettingController::class)->name('settings.')->prefix('/settings')->group(function () {
        Route::name('twofactors.')->prefix('twofactors')->group(function () {
            Route::get('/', 'showTwoFactorPage')->name('index');
            Route::patch('/', 'updateTwoFactor')->name('update');
        });

        Route::name('smtps.')->prefix('/smtps')->group(function () {
            Route::get('/', 'showSMTPPage')->name('index');
            Route::patch('/', 'updateSMTP')->name('update');
        });

        Route::name('database-backup.')->prefix('/database-backup')->group(function () {
            Route::get('/', 'databaseBackupPage')->name('index');
            Route::get('/download', 'databaseBackupDownload')->name('download');
        });

    });

    Route::get('/authlog', [AuthlogController::class, 'index'])->name('authlog.index');
    Route::get('/authlog/list', [AuthlogController::class, 'list'])->name('authlog.list');

    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::match(['PUT', 'PATCH'], 'projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');

    Route::get('/vision-boards', [VisionBoardController::class, 'index'])->name('vision-boards.index');
    Route::post('/vision-boards', [VisionBoardController::class, 'store'])->name('vision-boards.store');
    Route::match(['PUT', 'PATCH'], '/vision-boards/{visionBoard}', [VisionBoardController::class, 'update'])->name('vision-boards.update');
    Route::get('/vision-boards/{visionBoard}', [VisionBoardController::class, 'show'])->name('vision-boards.show');
    Route::post('/vision-boards/{visionBoard}/duplicate', [VisionBoardController::class, 'duplicate'])->name('vision-boards.duplicate');
    Route::delete('/vision-boards/{visionBoard}', [VisionBoardController::class, 'destroy'])->name('vision-boards.destroy');

    Route::get('/sprints', [SprintController::class, 'index'])->name('sprints.index');
    Route::post('/sprints', [SprintController::class, 'store'])->name('sprints.store');
    Route::get('sprints/{project}/list', [SprintController::class, 'list'])->name('sprints.list');
    Route::match(['PUT', 'PATCH'], '/sprints/{sprint}', [SprintController::class, 'update'])->name('sprints.update');
    Route::delete('/sprints/{sprint}', [SprintController::class, 'destroy'])->name('sprints.destroy');

    Route::get('/backlogs', [BacklogController::class, 'index'])->name('backlogs.index');
    Route::get('/backlogs/sprint-grouped', [BacklogController::class, 'sprintGrouped'])->name('backlogs.sprint-grouped');
    Route::post('/backlogs', [BacklogController::class, 'store'])->name('backlogs.store');
    Route::match(['PUT', 'PATCH'], '/backlogs/{backlog}', [BacklogController::class, 'update'])->name('backlogs.update');
    Route::post('/backlogs/{id}/duplicate', [BacklogController::class, 'duplicate'])->name('backlogs.duplicate');
    Route::get('/backlogs/{backlog}/download', [BacklogController::class, 'downloadPdf'])->name('backlogs.download');
    Route::delete('/backlogs/{backlog}', [BacklogController::class, 'destroy'])->name('backlogs.destroy');

    Route::post('/check-backlog', [CheckBacklogController::class, 'store'])->name(name: 'check-backlog.store');
    Route::match(['PUT', 'PATCH'], '/checkBacklogs/{checkBacklog}', [CheckBacklogController::class, 'update'])->name('check-backlog.update');
    Route::delete('/checkBacklogs/{checkBacklog}', [CheckBacklogController::class, 'destroy'])->name('check-backlog.destroy');

    Route::get('/developments', [DevelopmentController::class, 'index'])->name('developments.index');
    Route::post('/developments', [DevelopmentController::class, 'store'])->name('developments.store');
    Route::match(['PUT', 'PATCH'],'/developments/{development}', [DevelopmentController::class, 'update'])->name('developments.update');
    Route::post('/developments/{id}/update-status', [DevelopmentController::class, 'updateStatus']);
    Route::delete('/developments/{development}', [DevelopmentController::class, 'destroy'])->name('developments.destroy');
    Route::post('/developments/integrate-trello', [DevelopmentController::class, 'integrateWithTrello'])->name('developments.integrate-trello');

    Route::post('/check-dev', [CheckDevController::class, 'store'])->name(name: 'check-dev.store');
    Route::match(['PUT', 'PATCH'],'/check-dev/{id}', [CheckDevController::class, 'update'])->name('check-dev.update');
    Route::delete('/check-dev/{checkDev}', [CheckDevController::class, 'destroy'])->name('check-dev.destroy');

    Route::get('/calendars', [CalendarController::class, 'index'])->name('calendars.index');

    Route::get('/teams', [TeamController::class, 'index'])->name('teams.index');
    Route::post('/teams', [TeamController::class, 'store'])->name('teams.store');
    Route::get('teams/{project}/list', [TeamController::class, 'list'])->name('teams.list');
    Route::match(['PUT', 'PATCH'], '/teams/{team}', [TeamController::class, 'update'])->name('teams.update');
    Route::delete('/teams/{team}', [TeamController::class, 'destroy'])->name('teams.destroy');

    Route::post('/notif/{project}/read', [NotifController::class, 'read'])->name('notif.read');

    Route::get('/informasi_sistem', [InformationController::class, 'index'])->name('informationSistem.index');
});

Route::get('database-not-found', function () {
    return view('errors.database-not-found');
})->name('database.not.found');

Route::get('http-status/{code}', function ($code) {
    return abort($code);
})->where('code', '401|403|404|405|419|429|500|503|')->name('error.page.preview');

Route::get('/coming-soon', function(){
    return view("errors.coming-soon");
})->name('coming-soon');

Route::get('ip-banned', function () {
    return view('errors.ip-banned');
})->name('ip.banned');

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

require __DIR__.'/auth.php';
