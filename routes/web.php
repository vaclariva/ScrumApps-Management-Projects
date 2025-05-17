<?php

use App\Http\Controllers\BacklogController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\DevelopmentController;
use App\Http\Controllers\NotifController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\AuthlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckBacklogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MinimumStockController;
use App\Http\Controllers\NewPasswordPartnerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SprintController;
use App\Http\Controllers\StockHistoryController;
use App\Http\Controllers\VisionBoardController;
use App\Http\Controllers\WarehouseController;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\DataTables;


Route::get('/', function () {
    return redirect('dashboard');
});

Route::middleware(['middleware' => 'banned.ip',
    'auth.twofactor',
    'auth',
    'web',
    'auth.is_active',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/district/{id}', [LocationController::class, 'getDistrict'])->name('location.getDistrict');
    Route::get('/regency/{id}', [LocationController::class, 'getRegency'])->name('location.getRegency');

    Route::get('/users/list', [UserController::class, 'list'])->name('users.list');
    Route::post('/users/{user}/resend-email', [UserController::class, 'resendEmailRegister'])->name('users.resend-email');
    Route::resource('users', UserController::class);

    Route::get('/inventories/{type}/create', [InventoryController::class, 'create'])->name('inventories.create');
    Route::get('/inventories/check-stock/{productVariant}', [InventoryController::class, 'checkStockProductVariant'])->name('inventories.check_stock');
    Route::get('/inventories/list', [InventoryController::class, 'list'])->name('inventories.list');
    Route::get('/inventories', [InventoryController::class, 'index'])->name('inventories.index');
    Route::post('/inventories', [InventoryController::class, 'store'])->name('inventories.store');
    Route::get('/inventories/history/list', [StockHistoryController::class, 'list'])->name('inventories-history.list');
    Route::get('/inventories/history', [StockHistoryController::class, 'index'])->name('inventories-history.index');

    Route::get('/inventories/minimum-stock/list', [MinimumStockController::class, 'list'])->name('inventories.minimumStock.list');
    Route::get('/inventories/minimum-stock', [MinimumStockController::class, 'index'])->name('inventories.minimumStock.index');
    Route::post('/inventories/minimum-stock/{productVariant}/{warehouse}', [MinimumStockController::class, 'update'])->name('inventories.minimumStock.update');


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

    Route::get('/units/list', [UnitController::class, 'list'])->name('units.list');
    Route::resource('units', UnitController::class);

    Route::get('/authlog', [AuthlogController::class, 'index'])->name('authlog.index');
    Route::get('/authlog/list', [AuthlogController::class, 'list'])->name('authlog.list');

    Route::get('/categories/list', [CategoryController::class, 'list'])->name('categories.list');
    Route::resource('categories', CategoryController::class);

    Route::get('/products/list', [ProductController::class, 'list'])->name('products.list');
    Route::resource('products', ProductController::class);

    Route::get('/products/{product}/b2b', [ProductController::class, 'indexB2b'])->name('products.indexB2b');
    Route::post('/products/{product}/b2b', [ProductController::class, 'storeB2b'])->name('products.storeB2b');

    Route::get('/products/{product}/b2c', [ProductController::class, 'indexB2c'])->name('products.indexB2c');
    Route::post('/products/{product}/b2c', [ProductController::class, 'storeB2c'])->name('products.storeB2c');

    Route::get('/products/{product}/variants', [ProductController::class, 'indexVariant'])->name('products.indexVariant');
    Route::post('/products/{product}/variants', [ProductController::class, 'storeVariant'])->name('products.storeVariant');
    Route::delete('/products/{product}/variants/{productVariant}', [ProductController::class, 'destroyVariant'])->name('products.destroyVariant');
    Route::delete('/products/{product}/variants/{productVariant}/delete-image', [ProductController::class, 'deleteImageVariant'])->name('products.deleteImageVariant');
    Route::post('/products/{product}/variants/check', [ProductController::class, 'checkVariant'])->name('products.checkVariant');
    Route::post('/products/{product}/b2b/visibility', [ProductController::class, 'storeB2bVisibility'])->name('products.storeB2bVisibility');
    Route::post('/products/{product}/b2c/visibility', [ProductController::class, 'storeB2cVisibility'])->name('products.storeB2cVisibility');

    Route::get('/warehouses/list', [WarehouseController::class, 'list'])->name('warehouses.list');
    Route::resource('warehouses', WarehouseController::class);

    Route::get('/partners/list', [PartnerController::class, 'list'])->name('partners.list');
    Route::resource('/partners', PartnerController::class);
    Route::post('partners/reset-password/{partner}/resend', [NewPasswordPartnerController::class, 'resend'])
        ->name('password.partner.resend');

    Route::get('/orders/list', [OrderController::class, 'list'])->name('orders.list');
    Route::get('/orders/widget', [OrderController::class, 'widget'])->name('orders.widget');
    Route::get('/orders/product/list', [OrderController::class, 'getProductList'])->name('orders.getProductList');
    Route::get('/orders/product', [OrderController::class, 'getOrderProduct'])->name('orders.getOrderProduct');
    Route::post('/orders/product', [OrderController::class, 'addProduct'])->name('orders.addProduct');
    Route::delete('/orders/product/{orderItem}', [OrderController::class, 'deleteProduct'])->name('orders.deleteProduct');
    Route::put('/orders/product/{orderItem}', [OrderController::class, 'updateProduct'])->name('orders.updateProduct');
    Route::put('/orders/{order}/partial',[OrderController::class, 'updatePartial'])->name('orders.updatePartial');
    Route::delete('/orders/{order}/type',[OrderController::class, 'changeProductType'])->name('orders.changeProductType');
    Route::resource('orders', OrderController::class);

    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::match(['PUT', 'PATCH'], 'projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');

    Route::get('/vision-boards', [VisionBoardController::class, 'index'])->name('vision-boards.index');
    Route::post('/vision-boards', [VisionBoardController::class, 'store'])->name('vision-boards.store');
    Route::match(['PUT', 'PATCH'], '/vision-boards/{visionBoard}', [VisionBoardController::class, 'update'])->name('vision-boards.update');
    Route::get('/vision-boards/{visionBoard}', [VisionBoardController::class, 'show'])->name('vision-boards.show');
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
    Route::post('/backlogs/duplicate', [BacklogController::class, 'duplicate'])->name('backlogs.duplicate');
    Route::delete('/backlogs/{backlog}', [BacklogController::class, 'destroy'])->name('backlogs.destroy');

    Route::post('/check-backlog', [CheckBacklogController::class, 'store'])->name(name: 'check-backlog.store');
    Route::match(['PUT', 'PATCH'], '/checkBacklogs/{checkBacklog}', [CheckBacklogController::class, 'update'])->name('check-backlog.update');

    Route::get('/developments', [DevelopmentController::class, 'index'])->name('developments.index');

    Route::get('/calendars', [CalendarController::class, 'index'])->name('calendars.index');

    Route::get('/teams', [TeamController::class, 'index'])->name('teams.index');
    Route::post('/teams', [TeamController::class, 'store'])->name('teams.store');
    Route::get('teams/{project}/list', [TeamController::class, 'list'])->name('teams.list');
    Route::match(['PUT', 'PATCH'], '/teams/{team}', [TeamController::class, 'update'])->name('teams.update');
    Route::delete('/teams/{team}', [TeamController::class, 'destroy'])->name('teams.destroy');

    Route::post('/notif/{project}/read', [NotifController::class, 'read'])->name('notif.read');

    Route::get('/informasi_sistem', [InformationController::class, 'index'])->name('informationSistem.index');
});

Route::middleware('guest')->group(function () {
    Route::get('partners/reset-password/{token}', [NewPasswordPartnerController::class, 'create'])
        ->name('password.partner.reset');

    Route::post('partners/reset-password', [NewPasswordPartnerController::class, 'store'])
        ->name('password.partner.store');
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

require __DIR__.'/auth.php';
