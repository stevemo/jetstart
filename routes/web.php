<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Cpanel\Users\UserList;

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
    return view('welcome');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
});

// Control Panel Routes
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->prefix('cpanel')->name('cpanel.')->group(function () {
    Route::get('/users', UserList::class)->name('users.index');
});
