<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CssController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;

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

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {
        return view('home');
    });
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::put('/profile', 'ProfileController@update')->name('profile.update');


    Route::resource('projects', ProjectController::class);
    Route::post('/projects/{project}/updateStatus', [ProjectController::class, 'updateStatus']);
    Route::get('/projects/{project}/tasks', [ProjectController::class, 'getTasks']);
    Route::post('/tasks/{task}/updateStatus', [TaskController::class, 'updateStatus']);
    Route::post('/projects/{project}/comments', [ProjectController::class, 'comments']);
    Route::get('/projects/{project}/comments', [ProjectController::class, 'getComments']);
    Route::get('/comments/{comment}/edit', [ProjectController::class, 'editComment']);

});
Auth::routes();