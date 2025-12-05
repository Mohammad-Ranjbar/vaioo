<?php

use App\Http\Controllers\Main\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'main'])->name('main');

require __DIR__ . '/admin.php';
