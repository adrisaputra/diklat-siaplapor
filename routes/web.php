<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\HarmonizationController;
use App\Http\Controllers\RecapController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\UserController;

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

Route::get('/clear-cache-all', function() {
    Artisan::call('cache:clear');
    dd("Cache Clear All");
});

Route::get('/buat_storage', function () {
    Artisan::call('storage:link');
    dd("Storage Berhasil Di Buat");
});

// Route::get('/', function () {
//     return view('auth.login');
// });

Route::get('/', [LoginController::class, 'index']);

Route::post('/login_w', [LoginController::class, 'authenticate']);
Route::get('/dashboard', [HomeController::class, 'index']);

Route::get('/count/all', [HomeController::class, 'count_data']);
Route::get('/count/request', [HomeController::class, 'count_data']);
Route::get('/count/fixing', [HomeController::class, 'count_data']);
Route::get('/count/process', [HomeController::class, 'count_data']);
Route::get('/count/done', [HomeController::class, 'count_data']);

Route::get('/count2/1', [HomeController::class, 'count_data2']);
Route::get('/count2/2', [HomeController::class, 'count_data2']);
Route::get('/count2/3', [HomeController::class, 'count_data2']);
Route::get('/count2/4', [HomeController::class, 'count_data2']);
Route::get('/count2/5', [HomeController::class, 'count_data2']);
Route::get('/count2/6', [HomeController::class, 'count_data2']);
Route::get('/count2/7', [HomeController::class, 'count_data2']);

## Agenda
Route::get('/agenda', [AgendaController::class, 'index']);
Route::get('/agenda/search', [AgendaController::class, 'search']);
Route::get('/agenda/create', [AgendaController::class, 'create']);
Route::post('/agenda', [AgendaController::class, 'store']);
Route::get('/agenda/edit/{agenda}', [AgendaController::class, 'edit']);
Route::put('/agenda/edit/{agenda}', [AgendaController::class, 'update']);
Route::get('/agenda/hapus/{agenda}',[AgendaController::class, 'delete']);
Route::post('/agenda/import_excel', [AgendaController::class, 'import_excel']);
Route::get('/agenda/download_cv/{agenda}',[AgendaController::class, 'download_cv']);

## Usulan
Route::get('/proposal_income', [ProposalController::class, 'index']);
Route::get('/proposal_income/search', [ProposalController::class, 'search']);
Route::get('/proposal_income/control_sheet/{proposal}', [ProposalController::class, 'control_sheet']);
Route::put('/proposal_income/verification/{proposal}', [ProposalController::class, 'verification']);
Route::get('/proposal_income/detail/{proposal}', [ProposalController::class, 'detail']);

Route::get('/proposal_revision', [ProposalController::class, 'index']);
Route::get('/proposal_revision/search', [ProposalController::class, 'search']);
Route::get('/proposal_revision/edit/{proposal}', [ProposalController::class, 'edit']);
Route::put('/proposal_revision/edit/{proposal}', [ProposalController::class, 'update']);
Route::get('/proposal_revision/detail/{proposal}', [ProposalController::class, 'detail']);

Route::get('/proposal_process', [ProposalController::class, 'index']);
Route::get('/proposal_process/search', [ProposalController::class, 'search']);
Route::get('/proposal_process/disposition/{proposal}', [ProposalController::class, 'disposition']);
Route::put('/proposal_process/edit/{proposal}', [ProposalController::class, 'disposition_update']);
Route::get('/proposal_process/disposition_sheet/{proposal}', [ProposalController::class, 'disposition_sheet']);
Route::get('/proposal_process/detail/{proposal}', [ProposalController::class, 'detail']);

Route::get('/proposal_done', [ProposalController::class, 'index']);
Route::get('/proposal_done/search', [ProposalController::class, 'search']);
Route::get('/proposal_done/detail/{proposal}', [ProposalController::class, 'detail']);

Route::get('/proposal/create', [ProposalController::class, 'create']);
Route::post('/proposal', [ProposalController::class, 'store']);
Route::get('/proposal/hapus/{proposal}',[ProposalController::class, 'delete']);

## Harmonisasi

Route::get('/harmonizations', [HarmonizationController::class, 'index']);
Route::get('/harmonizations/search', [HarmonizationController::class, 'search']);
Route::get('/harmonizations/detail/{harmonization}', [HarmonizationController::class, 'detail']);
Route::get('/harmonizations/print/{proposal}', [HarmonizationController::class, 'print']);
Route::put('/harmonizations/upload_file_fix/{harmonization}', [HarmonizationController::class, 'upload_file_fix']);

Route::get('/harmonization_opd', [HarmonizationController::class, 'index']);
Route::get('/harmonization_opd/search', [HarmonizationController::class, 'search']);
Route::get('/harmonization_opd/detail/{harmonization}', [HarmonizationController::class, 'detail']);
Route::get('/harmonization_opd/print/{proposal}', [HarmonizationController::class, 'print']);
Route::put('/harmonization_opd/get_document/{harmonization}', [HarmonizationController::class, 'get_document']);

Route::get('/harmonization_get_document', [HarmonizationController::class, 'index']);
Route::get('/harmonization_get_document/search', [HarmonizationController::class, 'search']);
Route::get('/harmonization_get_document/detail/{harmonization}', [HarmonizationController::class, 'detail']);
Route::get('/harmonization_get_document/print/{proposal}', [HarmonizationController::class, 'print']);

Route::get('/harmonization_get_hardcopy', [HarmonizationController::class, 'index']);
Route::get('/harmonization_get_hardcopy/search', [HarmonizationController::class, 'search']);
Route::get('/harmonization_get_hardcopy/detail/{harmonization}', [HarmonizationController::class, 'detail']);
Route::get('/harmonization_get_hardcopy/print/{proposal}', [HarmonizationController::class, 'print']);
Route::put('/harmonization_get_hardcopy/send_document/{harmonization}', [HarmonizationController::class, 'send_document']);

Route::get('/harmonization_send_document', [HarmonizationController::class, 'index']);
Route::get('/harmonization_send_document/search', [HarmonizationController::class, 'search']);
Route::get('/harmonization_send_document/detail/{harmonization}', [HarmonizationController::class, 'detail']);
Route::get('/harmonization_send_document/print/{proposal}', [HarmonizationController::class, 'print']);
Route::put('/harmonization_send_document/deposit_document/{harmonization}', [HarmonizationController::class, 'deposit_document']);

Route::get('/harmonization_verification', [HarmonizationController::class, 'index']);
Route::get('/harmonization_verification/search', [HarmonizationController::class, 'search']);
Route::get('/harmonization_verification/detail/{harmonization}', [HarmonizationController::class, 'detail']);
Route::get('/harmonization_verification/print/{proposal}', [HarmonizationController::class, 'print']);
Route::put('/harmonization_verification/verification/{harmonization}', [HarmonizationController::class, 'verification']);
Route::get('/harmonization_verification/fix_again/{harmonization}', [HarmonizationController::class, 'fix_again']);
Route::put('/harmonization_verification/done/{harmonization}', [HarmonizationController::class, 'done']);

Route::get('/harmonization_done', [HarmonizationController::class, 'index']);
Route::get('/harmonization_done/search', [HarmonizationController::class, 'search']);
Route::get('/harmonization_done/detail/{harmonization}', [HarmonizationController::class, 'detail']);
Route::get('/harmonization_done/print/{proposal}', [HarmonizationController::class, 'print']);

Route::get('/recap', [RecapController::class, 'index']);
Route::get('/recap/search', [RecapController::class, 'search']);
Route::get('/recap/print', [RecapController::class, 'print']);
## OPD
Route::get('/office', [OfficeController::class, 'index']);
Route::get('/office/search', [OfficeController::class, 'search']);
Route::get('/office/create', [OfficeController::class, 'create']);
Route::post('/office', [OfficeController::class, 'store']);
Route::get('/office/edit/{office}', [OfficeController::class, 'edit']);
Route::put('/office/edit/{office}', [OfficeController::class, 'update']);
Route::get('/office/hapus/{office}',[OfficeController::class, 'delete']);

## User
Route::get('/user', [UserController::class, 'index']);
Route::get('/user/search', [UserController::class, 'search']);
Route::get('/user/create', [UserController::class, 'create']);
Route::post('/user', [UserController::class, 'store']);
Route::get('/user/edit/{user}', [UserController::class, 'edit']);
Route::put('/user/edit/{user}', [UserController::class, 'update']);
Route::get('/user/edit_profil/{user}', [UserController::class, 'edit_profil']);
Route::put('/user/edit_profil/{user}', [UserController::class, 'update_profil']);
Route::get('/user/hapus/{user}',[UserController::class, 'delete']);