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

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route:: group(['middleware' => 'auth:sanctum', 'verified'], function () {
    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');

    Route::get('followup', \App\Http\Livewire\FollowupCustomer::class)->name('followup');

    Route::get('/admin/customers', \App\Http\Livewire\CustomerManagement::class)->name('custman');
    Route::get('/admin/users', \App\Http\Livewire\UserManagement::class)->name('userman')->middleware('role_or_permission:Administrator|Manage Users');
});

