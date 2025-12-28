<?php

use App\Http\Controllers\Main\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'main'])->name('main');

require __DIR__ . '/admin.php';
require __DIR__ . '/representative.php';
require __DIR__ . '/user.php';

Route::get('/test',function (){
    \App\Models\Message::query()->create([
        'sender_type' => \App\Models\User::class,
        'sender_id' => 10,

        'receiver_type' => \App\Models\User::class,
        'receiver_id' => 11,

        'subject' => 'reply for',
        'message' => 'message for',
        'parent_id' => 1

    ]);

    return true;
});
