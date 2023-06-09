<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApprovingController;
@include('routeweb.php');
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
    return redirect('/home');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('approving/confirm-delete', [App\Http\Controllers\ApprovingController::class, 'confirmDelete'])->name('approving.confirmDelete');
Route::post('approving/delete', [App\Http\Controllers\ApprovingController::class, 'delete'])->name('approving.delete');
Route::resource('approving', ApprovingController::class);


Auth::routes();
