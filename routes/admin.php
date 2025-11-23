<?php

use App\Http\Controllers\Admin\AirportController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PolicyController;
use App\Http\Controllers\Admin\RepresentativeController;
use App\Http\Controllers\Admin\RepresentativeDocumentController;
use App\Http\Controllers\Admin\ShipmentController;
use App\Http\Controllers\Admin\TripController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->as('admin.')->group(function () {
    Route::middleware('')->group(function () {
        Route::get('login', [AuthController::class, 'loginPage'])->name('login.page');
        Route::post('login', [AuthController::class, 'login'])->name('login');
    });

    Route::middleware(AdminMiddleware::class)->group(function () {
        Route::prefix('representatives/{representative}')->group(function () {
            Route::get('/documents', [RepresentativeDocumentController::class, 'create'])
                ->name('representatives.documents.create');

            Route::post('/documents', [RepresentativeDocumentController::class, 'store'])
                ->name('representatives.documents.store');

            Route::delete('/documents/{collectionName}', [RepresentativeDocumentController::class, 'destroy'])
                ->name('representatives.documents.destroy');

            Route::delete('/documents', [RepresentativeDocumentController::class, 'destroyAll'])
                ->name('representatives.documents.destroyAll');
        });


        Route::get('/', [AuthController::class, 'check'])->name('check');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('dashboard', DashboardController::class)->name('dashboard');
        Route::resources([
            'policies' => PolicyController::class,
            'users' => UserController::class,
            'representatives' => RepresentativeController::class,
            'airports' => AirportController::class,
            'trips' => TripController::class,
            'shipments' => ShipmentController::class,
        ]);
    });

});

