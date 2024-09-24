<?php

use App\Http\Controllers\VideoController;
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

Route::get('/home', function () {
    return view('welcome');
});
Route::post('/create/upload-video', [VideoController::class, 'uploadVideo']);
Route::post('/search', [VideoController::class, 'search']);
Route::get('/',[VideoController::class,'home']);
Route::get('/create',[VideoController::class,'create']);
