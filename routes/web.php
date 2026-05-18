<?php

// =============================================================================
// FILE: routes/web.php
// =============================================================================

use Illuminate\Support\Facades\Route;

// Controllers - Breeze default
use App\Http\Controllers\ProfileController;

// Controllers - Project specific
use App\Http\Controllers\DashboardControllerAMY;
use App\Http\Controllers\TaskControllerAMY;
use App\Http\Controllers\CategoryControllerAMY;
use App\Http\Controllers\TaskCommentControllerAMY;
use App\Http\Controllers\AdminControllerAMY;
use App\Http\Controllers\ProfileControllerAMY;

// -----------------------------------------------------------------------
// PUBLIC ROUTES
// Welcome page (no auth needed)
// -----------------------------------------------------------------------
Route::get('/', function () {
    return view('welcome');
});

// -----------------------------------------------------------------------
// AUTHENTICATED + VERIFIED ROUTES
// -----------------------------------------------------------------------
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardControllerAMY::class, 'index'])->name('dashboard');

    // ------------------------------------------------------------------
    // PROFILE ROUTES
    // Uses your AMY profile controller (replaces the Breeze default below)
    // ------------------------------------------------------------------
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/',    [ProfileControllerAMY::class, 'edit'])->name('edit');
        Route::patch('/',  [ProfileControllerAMY::class, 'update'])->name('update');
        Route::delete('/', [ProfileControllerAMY::class, 'destroy'])->name('destroy');
    });

    // ------------------------------------------------------------------
    // TASK ROUTES
    // ------------------------------------------------------------------
    Route::prefix('tasks')->name('tasks.')->group(function () {

        // Standard REST routes (create, store, show, edit, update, destroy)
        Route::resource('/', TaskControllerAMY::class)
             ->parameters(['' => 'task'])
             ->except(['index']);

        // Index handled separately so we can add filtering logic
        Route::get('/', [TaskControllerAMY::class, 'index'])->name('index');

        // Extra task actions
        Route::patch('{task}/status',  [TaskControllerAMY::class, 'updateStatus'])->name('status');
        Route::patch('{task}/assign',  [TaskControllerAMY::class, 'assign'])->name('assign');
        Route::patch('{task}/archive', [TaskControllerAMY::class, 'archive'])->name('archive');

        // Nested comments under a task
        Route::prefix('{task}/comments')->name('comments.')->group(function () {
            Route::post('/',           [TaskCommentControllerAMY::class, 'store'])->name('store');
            Route::delete('{comment}', [TaskCommentControllerAMY::class, 'destroy'])->name('destroy');
        });
    });

    // ------------------------------------------------------------------
    // CATEGORY ROUTES (admin + team_member only)
    // ------------------------------------------------------------------
    Route::resource('categories', CategoryControllerAMY::class)
         ->middleware('role:admin,team_member')
         ->names([
             'index'   => 'categories.index',
             'create'  => 'categories.create',
             'store'   => 'categories.store',
             'show'    => 'categories.show',
             'edit'    => 'categories.edit',
             'update'  => 'categories.update',
             'destroy' => 'categories.destroy',
         ]);

    // ------------------------------------------------------------------
    // ADMIN ROUTES (admin only)
    // ------------------------------------------------------------------
    Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {
        Route::get('/',                   [AdminControllerAMY::class, 'index'])->name('index');
        Route::get('users',               [AdminControllerAMY::class, 'users'])->name('users');
        Route::patch('users/{user}/role', [AdminControllerAMY::class, 'updateRole'])->name('users.role');
        Route::patch('users/{user}/toggle', [AdminControllerAMY::class, 'toggleActive'])->name('users.toggle');
        Route::get('reports',             [AdminControllerAMY::class, 'reports'])->name('reports');
        Route::get('activity-log',        [AdminControllerAMY::class, 'activityLog'])->name('activity-log');
    });
});

// -----------------------------------------------------------------------
// FALLBACK — catches any URL that doesn't match a route
// -----------------------------------------------------------------------
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

// -----------------------------------------------------------------------
// Breeze auth routes (login, register, password reset, etc.)
// -----------------------------------------------------------------------
require __DIR__.'/auth.php';