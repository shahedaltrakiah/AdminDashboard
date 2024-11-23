<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        //Tasks
        Route::put('/manageTasks/{id}/status', [AdminController::class, 'updateStatus'])->name('manageTasks.updateStatus');
        Route::post('/manageTasks/store', [AdminController::class, 'storeTask'])->name('manageTasks.store');
        Route::delete('/manageTasks/destroy/{id}', [AdminController::class, 'destroyTask'])->name('manageTasks.destroy');
        Route::put('/manageTasks/update/{id}', [AdminController::class, 'updateTask'])->name('manageTasks.update');


        // Admin Profile
        Route::get('/adminProfile', [AdminController::class, 'adminProfile'])->name('adminProfile');
        Route::get('/adminProfile', [AdminController::class, 'adminProfile'])->name('adminProfile');
        Route::put('/adminProfile/update', [AdminController::class, 'updateAdminProfile'])->name('adminProfile.update');


        // User Management
        Route::get('/manageUser', [AdminController::class, 'manageUser'])->name('manageUser');
        Route::post('/manageUser/store', [AdminController::class, 'storeUser'])->name('manageUser.store');
        Route::put('/manageUser/update/{id}', [AdminController::class, 'update'])->name('manageUser.update');
        Route::delete('/manageUser/destroy/{id}', [AdminController::class, 'destroyUser'])->name('manageUser.destroy');


        // Categories
        Route::get('/manageCategory', [AdminController::class, 'manageCategory'])->name('manageCategory');
        Route::post('/manageCategory/store', [AdminController::class, 'storeCategory'])->name('manageCategory.store');
        Route::put('/manageCategory/update/{id}', [AdminController::class, 'updateCategory'])->name('manageCategory.update');
        Route::delete('/manageCategory/destroy/{id}', [AdminController::class, 'destroyCategory'])->name('manageCategory.destroy');
        Route::put('/manageCategory/toggle-status/{id}', [AdminController::class, 'toggleStatus'])->name('manageCategory.toggleStatus');

        // Recipes
        Route::get('/manageRecipes', [AdminController::class, 'manageRecipes'])->name('manageRecipes');
        Route::post('/manageRecipes/store', [AdminController::class, 'storeRecipe'])->name('manageRecipes.store');
        Route::get('/manageRecipes/view/{id}', [AdminController::class, 'viewRecipe'])->name('manageRecipes.view');
        Route::put('/manageRecipes/update/{id}', [AdminController::class, 'updateRecipe'])->name('manageRecipes.update');
        Route::delete('/manageRecipes/destroy/{id}', [AdminController::class, 'destroyRecipe'])->name('manageRecipes.destroy');
        Route::put('/manageRecipes/toggle-status/{id}', [AdminController::class, 'toggleRecipeStatus'])->name('manageRecipes.toggleRecipeStatus');

        // Orders
        Route::get('/manageOrders', [AdminController::class, 'manageOrders'])->name('manageOrders');
        Route::put('/manageOrders/update/{id}', [AdminController::class, 'updateOrder'])->name('manageOrders.update');

        // Comments
        Route::get('/manageComments', [AdminController::class, 'manageComments'])->name('manageComments');
        Route::put('/manageComments/update/{id}', [AdminController::class, 'updateComments'])->name('manageComments.update');

        //Messages
        Route::get('/manageMessages', [AdminController::class, 'manageMessages'])->name('manageMessages');
        Route::put('/manageMessages/{id}/status', [AdminController::class, 'messagesStatus'])->name('manageMessages.messagesStatus');
        Route::post('/manageMessages/reply', [AdminController::class, 'replyMessage'])->name('manageMessages.replyMessage');


        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    });
});



// User Routes
Route::get('/', [UserController::class, 'index'])->name('user.index');


// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authentication Routes
require __DIR__.'/auth.php';
