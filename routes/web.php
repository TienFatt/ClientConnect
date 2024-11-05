<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InteractionController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\PermissionController;



// Route group for authenticated users
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
	Route::middleware(['auth', 'role:admin'])->group(function () {
		Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
		// Route::post('/permissions/assign', [PermissionController::class, 'assign'])->name('permissions.assign');
	});

	// Route::group(['middleware' => ['role:admin']], function () {
		
	// });

	// Route::group(['middleware' => ['permission:manage users']], function () {
		// Routes that require manage users permission
	// });
    // Dashboard route using the DashboardController
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Resource routes for customers
    Route::resource('customers', CustomerController::class);

	Route::resource('interactions', InteractionController::class);

    // Resource routes for tickets
    Route::resource('tickets', TicketController::class);

    // Report routes
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::post('/reports/generate', [ReportController::class, 'generate'])->name('reports.generate');
});

// Redirect root to the dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});
