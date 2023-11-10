<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\GraphicRapportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApproveController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RapportController;
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

Route::middleware('auth')->group(function () {
    Route::resource('badge', BadgeRequestController::class);
    Route::resource('rapport', RapportController::class)->middleware('checkAdmin');
    Route::resource('user', UserController::class);
    Route::resource('profile', ProfileController::class);
    Route::resource('direction', DirectionController::class)->middleware('checkAdmin');
    Route::resource('categorie', CategorieController::class)->middleware('checkAdmin');
    Route::resource('formulaire', FormulaireController::class);
    Route::get('/badge-request/approve/{approval}', [ApproveController::class, 'approve'])->name('badge-request.approve');
    Route::put('/badge-request/rejete/{approval}', [ApproveController::class, 'rejete'])->name('badge-request.rejete');
    Route::get('/interim', [UserController::class,'interim'])->name('interim');
    Route::put('/status/interim/{userId}/{delegue}', [UserController::class,'edit_status'])->name('edit_status');
    Route::post('/interim', [UserController::class,'add_interim'])->name('add_interim');
    Route::get('/interimaires', [ApproveController::class,'approbationInterim'])->name('approbationInterim')->middleware('checkApprover');
    Route::get('/approbation/interim/{id}', [ApproveController::class,'single'])->name('approbation.single')->middleware('checkApprover');
    Route::resource('approbation', ApproveController::class)->middleware('checkApprover');
    Route::get('/graphique', [GraphicRapportController::class, 'index'])->name('graphique.index')->middleware('checkAdmin');
});