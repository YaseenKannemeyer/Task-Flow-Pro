<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\DashboardControllerAMY;
use App\Http\Controllers\TaskControllerAMY;
use App\Http\Controllers\CategoryControllerAMY;
use App\Http\Controllers\TaskCommentControllerAMY;
use App\Http\Controllers\AdminControllerAMY;
use App\Http\Controllers\ProfileControllerAMY;

// -----------------------------------------------------------------------
// PUBLIC ROUTE
// -----------------------------------------------------------------------
Route::get('/', function () {
    return view('welcome');
});

// -----------------------------------------------------------------------
// AUTH ROUTES
// -----------------------------------------------------------------------
require __DIR__.'/auth.php';

// -----------------------------------------------------------------------
// AUTHENTICATED ROUTES
// -----------------------------------------------------------------------
Route::middleware(['auth'])->group(function () {

    // ---------------- DASHBOARD ----------------
    Route::get('/dashboard', [DashboardControllerAMY::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');
    // ---------------- PROFILE ----------------
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/',    [ProfileControllerAMY::class, 'edit'])->name('edit');
        Route::patch('/',  [ProfileControllerAMY::class, 'update'])->name('update');
        Route::delete('/', [ProfileControllerAMY::class, 'destroy'])->name('destroy');
    });

    // ---------------- TASKS ----------------
    Route::prefix('tasks')->name('tasks.')->group(function () {

        Route::get('/', [TaskControllerAMY::class, 'index'])->name('index');
        Route::get('/create', [TaskControllerAMY::class, 'create'])->name('create');
        Route::post('/', [TaskControllerAMY::class, 'store'])->name('store');
        Route::get('/assigned', [TaskControllerAMY::class, 'assigned'])
    ->name('assigned');
    

        Route::get('/{task}', [TaskControllerAMY::class, 'show'])->name('show');
        Route::get('/{task}/edit', [TaskControllerAMY::class, 'edit'])->name('edit');
        Route::put('/{task}', [TaskControllerAMY::class, 'update'])->name('update');
        Route::delete('/{task}', [TaskControllerAMY::class, 'destroy'])->name('destroy');

        Route::patch('{task}/status',  [TaskControllerAMY::class, 'updateStatus'])->name('status');
        Route::patch('{task}/assign',  [TaskControllerAMY::class, 'assign'])->name('assign');
        Route::patch('{task}/archive', [TaskControllerAMY::class, 'archive'])->name('archive');

        // COMMENTS
        Route::prefix('{task}/comments')->name('comments.')->group(function () {
            Route::post('/', [TaskCommentControllerAMY::class, 'store'])->name('store');
            Route::delete('{comment}', [TaskCommentControllerAMY::class, 'destroy'])->name('destroy');
        });
    });

    // ---------------- CATEGORIES ----------------
    Route::resource('categories', CategoryControllerAMY::class)
        ->middleware(['role:admin,team_member']);

    // -------------------------------------------------------------------
    // ADMIN (CLEAN SINGLE GROUP - FIXED)
    // -------------------------------------------------------------------
    Route::prefix('admin')
        ->name('admin.')
        ->middleware(['auth', 'role:admin'])
        ->group(function () {

            Route::get('/', [AdminControllerAMY::class, 'index'])
                ->name('index');

            Route::get('/users', [AdminControllerAMY::class, 'users'])
                ->name('users');

            Route::patch('/users/{user}/role', [AdminControllerAMY::class, 'updateRole'])
                ->name('users.role');

            Route::patch('/users/{user}/toggle', [AdminControllerAMY::class, 'toggleActive'])
                ->name('users.toggle');

            Route::get('/reports', [AdminControllerAMY::class, 'reports'])
                ->name('reports');

            Route::get('/activity-log', [AdminControllerAMY::class, 'activityLog'])
                ->name('activity');
        });
});

// -----------------------------------------------------------------------
// FALLBACK
// -----------------------------------------------------------------------
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});