<?php

use App\Http\Controllers\KomentarController;
use App\Http\Controllers\PostingController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/register', [UsersController::class, 'register']);
Route::post('/login', [UsersController::class, 'login']);
Route::get('/logout', [UsersController::class, 'logout']);
Route::get('/getuserall', [UsersController::class, 'readall']);
Route::delete('delete/{id}', [UsersController::class, 'delete']);
Route::get('edituser/{id}', [UsersController::class, 'readbyid']);
Route::post('/updateuser', [UsersController::class, 'update']);
Route::post('/updatepassword', [UsersController::class, 'updatepassword']);
Route::get('jumlahusers', [UsersController::class, 'jumlahusers']);


//USER
Route::post('/posting', [PostingController::class, 'posting']);
Route::get('/getposting/{id}', [PostingController::class, 'readposting']);
Route::get('/postingdetail/{id}', [PostingController::class, 'postingdetail']);


//POSTING
Route::post('updateposting', [PostingController::class, 'updateposting']);
Route::get('readpostingall', [PostingController::class, 'readpostingall']);
Route::get('jumlahposting', [PostingController::class, 'jumlahposting']);
Route::delete('hapusposting/{id}', [PostingController::class, 'hapusposting']);

//KOMENTAR
Route::post('/tambahkomentar', [KomentarController::class, 'tambahkomentar']);
Route::get('/getkomentar/{posting_id}', [KomentarController::class, 'getkomentar']);
Route::get('/getkomentarall', [KomentarController::class, 'getkomentarall']);
Route::delete('hapuskomentar/{id}', [KomentarController::class, 'hapuskomentar']);
Route::get('jumlahkomentar', [KomentarController::class, 'jumlahkomentar']);


