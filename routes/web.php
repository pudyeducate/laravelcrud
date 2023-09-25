<?php

use App\Http\Controllers\MateriController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/materi',function ()  {
    return view('materi');
});


Route::group([ 'prefix' => '/materi'], function () {
    Route::get('', [MateriController::class, 'index']);
    Route::post('post', [MateriController::class, 'store'])->name('materi.post');
    Route::post('hapus/{slug}', [MateriController::class, 'hapus'])->name('materi.destroy');
    Route::get('edit/{slug}', [MateriController::class, 'edit']);
    Route::post('edit/post', [MateriController::class, 'update'])->name('materi.update');
});