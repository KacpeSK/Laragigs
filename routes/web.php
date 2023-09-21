<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

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
//  All listings
Route::get('/', [ListingController::class, 'index']);

// Show create form
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

// Store Listing Data
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

// Show Edit Form
Route::get('/listings/{listing}/edit' , [ListingController::class, 'edit'])->middleware('auth');

// Update Listing
Route::put('listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

// Delete Listing
Route::delete('listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

// Just one listing depending on search query // has to be below other /listings routes because otherwise it will trigger before the other listing/ routes and may couse 404
Route::get('/listings/{listing}', [ListingController::class, 'show'])->middleware('guest');

// Show Register/Create Form
Route::get('/register', [UserController::class, 'create'])->middleware('auth');

// Create New User
Route::post('/users', [UserController::class, 'store'])->middleware('auth');

// Log Out User
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Show Login Form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('auth');

// Log In User
Route::post('/users/authenticate', [UserController::class, 'authenticate']);


