<?php

use App\Livewire\HomePage;
use App\Livewire\QuizPage;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', HomePage::class)->name('home-page');
Route::get('/{quiz:slug}', QuizPage::class)->name('quiz-page');
