<?php

use App\Exports\ApprovingExport;
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

Auth::routes();

Route::middleware(['auth', 'checkStatus'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/historic', [BadgeRequestController::class, 'index'])->name('historic');

    Route::get('approving/confirm-delete', [App\Http\Controllers\ApprovingController::class, 'confirmDelete'])->name('approving.confirmDelete');
    Route::post('approving/delete', [App\Http\Controllers\ApprovingController::class, 'delete'])->name('approving.delete');
    Route::resource('approving', ApprovingController::class)->middleware('checkAdmin');

    Route::get('/showBadge', [BadgeRequestController::class, 'showBadge']);

    Route::get('generate-pdf/{badgeRequest}', [BadgeRequestController::class, 'createPDF'])->name('badge.showBadgePDF');

    Route::get('/export-approving', function () {
        return Excel::download(new ApprovingExport, 'approvers.xlsx');
    });
});


