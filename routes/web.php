<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\FixturesController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;

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


Route::get('/',[PagesController::class,'index']);
Route::resource('/blog',PostsController::class);
Route::resource('/interviews',InterviewController::class);
Route::resource('/fixtures',FixturesController::class);
Route::get('/login',[AdminAuthController::class,'showLogin'])->name('login');
Route::post('/login', [AdminAuthController::class, 'login']);
Route::get('/blogger/login',[PagesController::class,'showLogin'])->name('login');
Route::post('/blogger/login', [PagesController::class, 'login']);
Route::get('/news',[PagesController::class,'NewsContent']);
Route::get('/atlaslions',[PagesController::class,'AtlasLionsContent']);
Route::get('/atlaslionsses',[PagesController::class,'AtlasLionssesContent']);
Route::get('/youth',[PagesController::class,'YouthContent']);
Route::get('/futsal',[PagesController::class,'FutsalContent']);
Route::get('/dashboard',[AdminAuthController::class,'DashboardPage'])->middleware(['auth','role:admin'])->name('dashboard');
Route::post('/add-user', [AdminAuthController::class, 'addUser'])->middleware(['auth','role:admin'])->name('user.add');
Route::delete('/users/{id}', [AdminAuthController::class, 'destroy'])->middleware(['auth','role:admin'])->name('users.destroy');
Route::get('/about',[PagesController::class,'About']);

//Route::get('/register', [AdminAuthController::class, 'create'])->name('register.create');
//Route::post('/register', [AdminAuthController::class , 'store'])->name('register.store');

Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');




