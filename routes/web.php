<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoaController;
use App\Http\Controllers\DataTableController;
use App\Http\Controllers\HomeController;
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


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/', [CoaController::class ,'list'])->name('home');
Route::get('download/{id}', [CoaController::class,'download_regular'])->name('download');


Route::get('/coas', [CoaController::class,'index'])->name('coas');

Route::get('go-home', [CoaController::class,'index'])->name('go-home');
Route::get('/get-simple-datatables-data', [DataTableController::class,'getSimpleDatatablesData'])->name('simple_datatables_users_data');
Route::get('/get-custom-column-datatables-data', [DataTableController::class, 'getCustomColumnDatatablesData'])->name('custom_column_datatables_users_data');
Route::get('/get-relationship-column-datatables-data', [DataTableController::class,'getRelationshipColumnDatatablesData'])->name('relationship_column_datatables_users_data');
Route::get('/get-extra-data-datatables-attributes-data', [DataTableController::class, 'getExtraDataDatatablesAttributesData'])->name('get_extra_data_datatables_attributes_data');

Route::resource('coas', CoaController::class);
Route::post('store', [CoaController::class,'store'])->name('file.store');
Route::any('delete/{id}', [CoaController::class,'destroy'])->name('file.delete');

//Auth::routes();

//Route::get('/home', [CoaController::class, 'list'])->name('home');
