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

    Route::get('/scholar/Disbursement.{id}/addDisbursement',[ScholarController::class,'addDisbursement'])->name('scholar.addDisbursement');
    Route::get('/scholar/Disbursement/editDisbursement',[ScholarController::class,'editDisbursement'])->name('scholar.editDisbursement');
    Route::get('/scholar/list',[ScholarController::class,'list'])->name('scholar.list');
    Route::post('/scholar/DisbursementAdd', [ScholarController::class,'DisbursementAdd'])->name('scholar.DisbursementAdd');
    Route::get('/scholar/fetch-disbursement', [ScholarController::class, 'fetchDisbursements'])->name('scholar.fetch-disbursement');
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

    Route::get('/scholar/special',[ScholarController::class,'special'])->name('scholar.special');
    Route::get('/scholar/behighschool',[ScholarController::class,'behighschool'])->name('scholar.behighschool');
    Route::get('/scholar/becollege',[ScholarController::class,'becollege'])->name('scholar.becollege');
    Route::get('/scholar/dshpcollege',[ScholarController::class,'dshpcollege'])->name('scholar.dshpcollege');
    Route::get('/scholar/csp2',[ScholarController::class,'csp2'])->name('scholar.csp2');

    Route::get('/scholar.{id}/info', [ScholarController::class, 'show'])->name('scholar.info');
    Route::get('/scholar/status', [ScholarController::class, 'status'])->name('scholar.status');
    Route::get('/scholar/fetch-paginate', [ScholarController::class, 'fetchPaginate'])->name('scholar.fetch-paginate');
    Route::get('/scholar/fetch-high-school', [ScholarController::class, 'fetchHighSchool'])->name('scholar.fetch-high-school');
    Route::get('/scholar/fetch-senior-high', [ScholarController::class, 'fetchSeniorHigh'])->name('scholar.fetch-senior-high');
    Route::get('/scholar/fetch-college', [ScholarController::class, 'fetchCollege'])->name('scholar.fetch-college');  
    
    Route::get('/scholar/fetch-special', [ScholarController::class, 'fetchSpecial'])->name('scholar.fetch-special');
    Route::get('/scholar/fetch-behighschool', [ScholarController::class, 'fetchBEHighSchool'])->name('scholar.fetch-behighschool');
    Route::get('/scholar/fetch-becollege', [ScholarController::class, 'fetchBECollege'])->name('scholar.fetch-becollege');
    Route::get('/scholar/fetch-dshpcollege', [ScholarController::class, 'fetchDSHPCollege'])->name('scholar.fetch-dshpcollege');
    Route::get('/scholar/fetch-csp2', [ScholarController::class, 'fetchCSP2'])->name('scholar.fetch-csp2');
    Route::get('/scholar/{id}/image', [ScholarController::class, 'generateScholarTableImage'])->name('scholar.generateReport');
    Route::post('/scholar',[ScholarController::class,'store'])->name('scholar.store');
    Route::get('/scholar/{id}/edit',[ScholarController::class,'edit'])->name('scholar.edit');
    Route::get('/scholar/{id}/disbursementEdit',[ScholarController::class,'disbursementEdit'])->name('scholar.disbursementEdit');
    Route::get('/scholar/{id}/disbursementEdit_info',[ScholarController::class,'disbursementEdit_info'])->name('scholar.disbursementEdit_info');
    Route::put('/scholar/{id}/update', [ScholarController::class, 'update'])->name('scholar.update');
    Route::put('/scholar/{id}/Updatedisbursement', [ScholarController::class, 'Updatedisbursement'])->name('scholar.Updatedisbursement');
    Route::put('/scholar/{id}/', [ScholarController::class, 'disbursementUpdate_info'])->name('scholar.disbursementUpdate_info');
    Route::put('/scholar/soft-delete/{id}', [ScholarController::class, 'softDelete'])->name('scholar.softdelete');
    Route::put('/scholar/disbursement-soft-delete/{id}', [ScholarController::class, 'disbursementsoftDelete'])->name('scholar.disbursementsoftDelete');
    Route::put('/scholar/disbursement-delete/{id}', [ScholarController::class, 'disbursementdelete'])->name('scholar.disbursementdelete');
    Route::put('/scholar/Delete/{id}', [ScholarController::class, 'Delete'])->name('scholar.Delete');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
