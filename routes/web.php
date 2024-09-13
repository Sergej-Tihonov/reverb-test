<?php

use App\Http\Controllers\ProfileController;
use App\Models\Order;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/orders/{order}', function (Order $order) {
    return view('order', [
        'order' => $order,
    ]);
});

Route::get('/broadcast', function () {
    sleep(2);
    broadcast(new \App\Events\OrderDispatched(Order::firstOrFail()));
    sleep(3);
    broadcast(new \App\Events\OrderDelivered(Order::firstOrFail()));

    return 'example broadcast send';
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
