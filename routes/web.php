<?php

use App\Http\Controllers\TicketController;
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

Route::get('/', [TicketController::class, 'index'])->name('ticket.index');
Route::get('/ticket/festival', [TicketController::class, 'ticket_festival'])->name('ticket.festival');
Route::get('/ticket/vip', [TicketController::class, 'ticket_vip'])->name('ticket.vip');
Route::get('/generate/{id}', [TicketController::class, 'generate'])->name('ticket.generate');
Route::get('/scan/eyJpdiI6IkVqZUQzTlhTN1pRalNUTmdIUkJXeWc9PSIsInZhbHVlIjoiRFRNYUFkdDdIMURaNzQwU0xYTnA5dz09IiwibWFjIjoiY2FkMDNjZWMxZTJjNTBiMTVjZDAwYTYzNjY2NTNlYzIyNzIxOGYyNTQyNjdjZDI4MTJmNjg5YmQwMzUzYjk3NiIsInRhZyI6IiJ9', [TicketController::class, 'scan'])->name('ticket.scan');
Route::get('/', [TicketController::class, 'index'])->name('ticket.index');
Route::post('/checkout/festival', [TicketController::class, 'checkout_festival'])->name('ticket.checkout.festival');
Route::post('/checkout/vip', [TicketController::class, 'checkout_vip'])->name('ticket.checkout.vip');