<?php

use App\Http\Controllers\BerandaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/{any}', function () {
//     return view('layouts.vue');
// })->where('any','.*');



// Route::get('/', function () {
//     return view('welcome');
// });


// route blog
// Route::get('/',  [BerandaController::class, 'home']);
// Route::get('/beranda/about',  [BerandaController::class, 'about']);

// Route::middleware(['auth:sanctum', 'verified'])->get('/home', function () {
//     return view('layouts.vue');
// })->where('any','.*');


// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');


Route::get('/{any}', function () {
    return view('layouts.vue');
})->where('any','.*');

