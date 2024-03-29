<?php

use App\Http\Controllers\AnswersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionsController;

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

Auth::routes();

Route::get('/questions', [QuestionsController::class, 'index']);
Route::get('/questions/{question}', [QuestionsController::class, 'show']);
Route::post('/questions/{question}/answers', [AnswersController::class, 'store']);
