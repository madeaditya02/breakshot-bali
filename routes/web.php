<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Middleware\EnsureTokenIsValid;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\MenuController as AdminMenuController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\ReservationController as AdminReservationController;
use App\Http\Controllers\Admin\WeeklyEventController as AdminWeeklyEventController;

Route::controller(MainController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/events', 'events')->name('events');
    Route::get('/reservation', 'reservation')->name('reservation');
    Route::post('/reservation', 'reserve')->name('reserve');
    Route::get('/menu', 'menu')->name('menu');
    Route::get('/gallery', 'gallery')->name('gallery');
    Route::get('/test', 'test')->name('test');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [AdminHomeController::class, 'index'])->name('dashboard');
    Route::resource('menu', AdminMenuController::class)->except(['show']);
    Route::put('menu/{menu}/toggle', [AdminMenuController::class, 'toggle'])->name('menu.toggle');
    Route::resource('reservations', AdminReservationController::class)->except(['show']);
    Route::post('reservations/{reservation}/confirm', [AdminReservationController::class, 'confirm'])->name('menu.confirm');
    Route::resource('events', AdminEventController::class)->except(['show']);
    Route::prefix('events')->name('events.')->group(function () {
        Route::put('{event}/toggle', [AdminEventController::class, 'toggle'])->name('toggle');
        Route::prefix('weekly')->name('weekly.')->group(function () {
            Route::get('', [AdminWeeklyEventController::class, 'index'])->name('index');
            Route::get('create', [AdminWeeklyEventController::class, 'create'])->name('create');
            Route::post('', [AdminWeeklyEventController::class, 'store'])->name('store');
            Route::get('{event}/edit', [AdminWeeklyEventController::class, 'edit'])->name('edit');
            Route::put('{event}', [AdminWeeklyEventController::class, 'update'])->name('update');
            Route::delete('{event}', [AdminWeeklyEventController::class, 'destroy'])->name('destroy');
        });
        // Route::get('create/weekly', [AdminEventController::class, 'createWeekly'])->name('create-weekly');
        // Route::post('create/weekly', [AdminEventController::class, 'storeWeekly'])->name('store-weekly');
    });
    Route::get('close-sheet', [AdminHomeController::class, 'closeSheetConfirmation'])->name('close-sheet');
    Route::post('set-sheet', [AdminHomeController::class, 'setSheet'])->name('set-sheet');
});
Route::post('admin/reservations/{reservation}/status', [AdminReservationController::class, 'confirmStatus'])->middleware([EnsureTokenIsValid::class])->name('menu.confirm-status');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
