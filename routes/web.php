<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\SubmissionsController;
use App\Http\Controllers\DashboardController;

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
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', function() {
        return redirect('/dashboard');
    });

    Route::get('/dashboard', DashboardController::class)->name('dashboard');
});

Route::get('submissions', [SubmissionsController::class, 'index'])
    ->middleware('auth')
    ->name('submissions.index');
    
Route::get('submission', [SubmissionsController::class, 'create']);
Route::post('submission', [SubmissionsController::class, 'store']);
