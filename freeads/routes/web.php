<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Message;
use App\Http\Controllers\Annonce;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::post('/message', [App\Http\Controllers\Message::class, 'send'])->name('message.send');


Route::post('/broadcast',[App\Http\Controllers\Message::class, 'broadcast'])->name('message.broadcast');
Route::post('/receive', [App\Http\Controllers\Message::class, 'receive'])->name('message.receive');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/message', [App\Http\Controllers\Message::class, 'index'])->name('message.index');

Route::get('/annonce', [App\Http\Controllers\Annonce::class, 'index'])->name('annonce.index');
Route::post('/annonceUpdate/{id}', [App\Http\Controllers\Annonce::class, 'edit'])->name('annonce.edit');
Route::get('/annonce/{id}', [App\Http\Controllers\Annonce::class, 'see'])->name('annonce.see');
Route::get('/annoncesearch', [App\Http\Controllers\Annonce::class, 'search'])->name('annonce.search');
Route::get('/annoncedelete/{id}', [App\Http\Controllers\Annonce::class, 'delete'])->name('annonce.delete');
Route::post('/annonce', [App\Http\Controllers\Annonce::class, 'store'])->name('annonce.store');
});

require __DIR__.'/auth.php';
