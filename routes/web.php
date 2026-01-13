<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminUserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
});

Route::get('/tickets/{ticket}', [TicketController::class, 'show'])
     ->name('tickets.show')
     ->middleware('auth');

Route::post('/tickets/{ticket}/comments', [CommentController::class, 'store'])
    ->name('comments.store')
    ->middleware('auth');

Route::middleware('auth')->group(function () {

    Route::post('/tickets/{ticket}/take', [TicketController::class, 'take'])
        ->name('tickets.take');

    Route::post('/tickets/{ticket}/status', [TicketController::class, 'updateStatus'])
        ->name('tickets.status');

    Route::post('/tickets/{ticket}/close', [TicketController::class, 'close'])
        ->name('tickets.close');

});
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');


Route::post('/tickets/{ticket}/assign-agent', [TicketController::class, 'assignAgent'])
    ->name('tickets.assignAgent')
    ->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users');
    Route::post('/admin/users/{user}/role', [AdminUserController::class, 'updateRole'])->name('admin.users.role');
});



require __DIR__.'/auth.php';


