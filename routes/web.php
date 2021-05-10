<?php

use Illuminate\Support\Facades\Route;

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
//Route::get('/a', function () {
//   echo date('H:i');
//});

Auth::routes(['register'=>false,'reset' => false]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/edit/{id}',[\App\Http\Controllers\EquipmentController::class, 'showEdit'])->name('equipment.show_edit');
Route::get('/add',[\App\Http\Controllers\EquipmentController::class, 'showAdd'])->name('equipment.show_add');
Route::get('/warehouse',[\App\Http\Controllers\EquipmentController::class, 'showWarehouse'])->name('equipment.show_warehouse');
Route::get('/incoming',[\App\Http\Controllers\EquipmentController::class, 'showIncoming'])->name('equipment.show_incoming');
Route::post('/create',[\App\Http\Controllers\EquipmentController::class, 'create'])->name('equipment.create');
Route::post('/update/{id}',[\App\Http\Controllers\EquipmentController::class, 'update'])->name('equipment.update');
Route::post('/moved',[\App\Http\Controllers\EquipmentController::class, 'moved'])->name('equipment.moved');
Route::post('/equipment-accept',[\App\Http\Controllers\EquipmentController::class, 'equipmentAccept'])->name('equipment.equipment-accept');
