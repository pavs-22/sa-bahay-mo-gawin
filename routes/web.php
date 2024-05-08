<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\ScholarController;
use  App\Http\Controllers\UnitController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect()->route('scholar.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('/scholar/disbursementYear',[ScholarController::class,'disbursementYear'])->name('scholar.disbursementYear');
    Route::get('/scholar/disbursementMonth',[ScholarController::class,'disbursementMonth'])->name('scholar.disbursementMonth');
    Route::get('/scholar/list',[ScholarController::class,'list'])->name('scholar.list');
    Route::get('fetch-disbursement', [ScholarController::class, 'fetchDisbursement'])->name('fetch-disbursement');
    Route::get('fetch-DisbursementYear', [ScholarController::class, 'fetchDisbursementYear'])->name('fetch-DisbursementYear');
    Route::get('fetch-DisbursementMonth', [ScholarController::class, 'fetchDisbursementMonth'])->name('fetch-DisbursementMonth');
    Route::post('/scholar/save-disbursement', [ScholarController::class,'storeDisbursement'])->name('scholar.save-disbursement');
    Route::post('/scholar/add-month-year',[ScholarController::class,'addMonthYear'])->name('scholar.add-month-year');
    Route::get('/scholar',[ScholarController::class,'index'])->name('scholar.index');
    Route::get('/scholar',[ScholarController::class,'dashboard'])->name('scholar.index');
    Route::get('/scholar/list',[ScholarController::class,'list'])->name('scholar.list');
    Route::post('/scholar/list',[ScholarController::class,'list'])->name('scholar.list');
    Route::get('/scholar/disbursement',[ScholarController::class,'disbursement'])->name('scholar.disbursement');
    Route::get('/scholar/college',[ScholarController::class,'college'])->name('scholar.college');
    Route::get('/scholar/highschool',[ScholarController::class,'highSchool'])->name('scholar.highschool');
    Route::get('/scholar/seniorhigh',[ScholarController::class,'seniorHigh'])->name('scholar.seniorhigh');
    Route::get('/scholar.{id}/info', [ScholarController::class, 'show'])->name('scholar.info');
    Route::get('/scholar/fetch-paginate', [ScholarController::class, 'fetchPaginate'])->name('scholar.fetch-paginate');
    Route::get('/scholar/fetch-high-school', [ScholarController::class, 'fetchHighSchool'])->name('scholar.fetch-high-school');
    Route::get('/scholar/fetch-senior-high', [ScholarController::class, 'fetchSeniorHigh'])->name('scholar.fetch-senior-high');
    Route::get('/scholar/fetch-college', [ScholarController::class, 'fetchCollege'])->name('scholar.fetch-college');    
    Route::post('/scholar',[ScholarController::class,'store'])->name('scholar.store');
    Route::get('/scholar/{id}/edit',[ScholarController::class,'edit'])->name('scholar.edit');
    Route::put('/scholar/{id}/', [ScholarController::class, 'update'])->name('scholar.update');
    Route::put('/scholar/soft-delete/{id}', [ScholarController::class, 'softDelete'])->name('scholar.softdelete');
    Route::put('/scholar/Delete/{id}', [ScholarController::class, 'Delete'])->name('scholar.Delete');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
