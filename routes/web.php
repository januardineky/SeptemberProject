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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[VideoController::class,'landing']);
Route::get('/register',[VideoController::class,'register']);
Route::post('/createuser',[VideoController::class,'createuser']);
Route::post('/cari', [VideoController::class, 'cari']);
Route::post('/login/auth',[VideoController::class,'auth']);
Route::get('/login',[VideoController::class,'login']);
Route::get('/logout',[VideoController::class,'logout']);

Route::middleware(['\App\Http\Middleware\Statuslogin::class'])->group(function () {
    Route::get('/home',[VideoController::class,'home']);
    Route::get('/edit/{id}',[VideoController::class,'edit']);
    Route::post('/edit/{id}',[VideoController::class,'update']);
    Route::get('/delete/{id}',[VideoController::class,'delete']);
    Route::post('/create/upload-video', [VideoController::class, 'uploadVideo']);
    Route::post('/search', [VideoController::class, 'search']);
    Route::get('/create',[VideoController::class,'create']);
});
