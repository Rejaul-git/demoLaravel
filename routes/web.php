<?php

use App\Http\Controllers\MyController;
use App\Http\Middleware\ChackAge;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Expr\FuncCall;
use App\Http\Controllers\RegisterController;

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
Route::get("/about", function () {
    return view("About");
})->name("about");
Route::get("/contact", function () {
    return view("Contact");
})->name("contact");

Route::get('/register', [RegisterController::class, 'create'])->name('home');
Route::post('/registers', [RegisterController::class, 'store'])->name('registers');
Route::get('/users', [RegisterController::class, 'index'])->name('users');
//edit users
Route::get('/users/{user}/edit', [RegisterController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [RegisterController::class, 'update'])->name('users.update');
Route::get('/users/{user}/delete', [RegisterController::class, 'destroy'])->name('users.destroy');

