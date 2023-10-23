<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApproveController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DirectionController;
use App\Http\Controllers\FormulaireController;
use App\Http\Controllers\BadgeRequestController;


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
Route::resource('badge',BadgeRequestController::class);
Route::resource('profile',ProfileController::class);
Route::resource('direction',DirectionController::class);
Route::resource('formulaire',FormulaireController::class);
Route::get('/badge-request/approve/{approval}', [ApproveController::class, 'approve'])->name('badge-request.approve');
Route::put('/badge-request/rejete/{approval}', [ApproveController::class, 'rejete'])->name('badge-request.rejete');
Route::resource('approbation',ApproveController::class);