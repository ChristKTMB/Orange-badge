<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApprovingController;
use App\Http\Controllers\BadgeRequestController;
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
    return redirect('/historic');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/historic', [BadgeRequestController::class, 'index'])->name('historic');


Route::get('approving/confirm-delete', [App\Http\Controllers\ApprovingController::class, 'confirmDelete'])->name('approving.confirmDelete');
Route::post('approving/delete', [App\Http\Controllers\ApprovingController::class, 'delete'])->name('approving.delete');
Route::resource('approving', ApprovingController::class);
Route::get('/', [BadgeRequestController::class, 'showBadge']);
Route::get('/badgeRequest/pdf', [BadgeRequestController::class, 'createPDF'])->name('badge.showBadge');


Auth::routes();
