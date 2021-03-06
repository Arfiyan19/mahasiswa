<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ArticleController;
use Illuminate\Http\Request; 

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

Route::get('/', function () {
    return view('welcome');
});
Route::resource('mahasiswas', MahasiswaController::class);
Route::get('/search', [MahasiswaController::class, 'search'])->name('search');
Route::get('mahasiswas/nilai/{Nim}', [App\Http\Controllers\MahasiswaController::class, 'nilai'])->name('mahasiswas.nilai');
Route::get('mahasiswas/cetak_pdf/{Nim}', [App\Http\Controllers\MahasiswaController::class, 'cetak_pdf'])->name('mahasiswas.cetak_pdf');

Route::resource('articles', ArticleController::class);

