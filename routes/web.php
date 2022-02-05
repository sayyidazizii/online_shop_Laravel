<?php

use App\Http\Livewire\Home;

use App\Http\Livewire\BelanjaUser;
use App\Http\Livewire\TambahOngkir;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UploadController;

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

Auth::routes();
Route::get('/', \App\Http\Livewire\Home::class);

//Upload Barang
Route::get('/file-upload', [UploadController::class,'index']);
Route::post('/upload/proses', [UploadController::class,'store']);

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Daftar Belanja
Route::get('/BelanjaUser', \App\Http\Livewire\BelanjaUser::class);
//Tambah Ongkir
Route::get('/TambahOngkir/{id}', \App\Http\Livewire\TambahOngkir::class);