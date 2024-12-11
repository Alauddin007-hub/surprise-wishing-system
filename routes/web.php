<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurpriseController;

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

Route::get('/', function () {
    return view('welcome');
});


Route::post('/schedule-surprise', [SurpriseController::class, 'store']);
Route::get('/view-surprise/{id}', [SurpriseController::class, 'show']);
