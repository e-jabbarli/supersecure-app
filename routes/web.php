<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\FormManagementController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

Route::get('/', function (Request $request) { 
    return view('welcome');
});




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('posts', PostsController::class);
    Route::resource('forms', FormManagementController::class);

    Route::get('/dashboard', function (Request $request) {

        $file = $request->query('file');
        if ($file) {
            $filePath = realpath($file);
            if ($filePath && is_file($filePath)) {
                return response()->file($filePath);
            } else {
                return response('File not found or is not a file.', 404);
            }
        }
        return view('dashboard');
    })->name('dashboard');

    Route::middleware('admin')->group(function () {
    Route::resource('admin', AdminController::class)->middleware('admin');
    Route::get('/users', [UserController::class, 'index'])->name('user.index');});
    Route::get('/user/{user}', [UserController::class, 'show'])->name('user.show');

});

require __DIR__.'/auth.php';
