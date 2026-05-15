<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntryController;

// 1. Redirect the homepage straight to your dashboard
Route::get('/', function () {
    return redirect('/entries');
});

Route::get('/entries/trash', [EntryController::class, 'trash'])->name('entries.trash');
Route::post('/entries/{id}/restore', [EntryController::class, 'restore'])->name('entries.restore');
Route::delete('/entries/{id}/force-delete', [EntryController::class, 'forceDelete'])->name('entries.forceDelete');

// This generates the standard index, create, store, edit, update, and destroy routes.
Route::resource('entries', EntryController::class)->except('show');
