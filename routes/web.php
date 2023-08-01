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
Route::get('/scan/eyJpdiI6IkVqZUQzTlhTN1pRalNUTmdIUkJXeWc9PSIsInZhbHVlIjoiRFRNYUFkdDdIMURaNzQwU0xYTnA5dz09IiwibWFjIjoiY2FkMDNjZWMxZTJjNTBiMTVjZDAwYTYzNjY2NTNlYzIyNzIxOGYyNTQyNjdjZDI4MTJmNjg5YmQwMzUzYjk3NiIsInRhZyI6IiJ9', [TicketController::class, 'scan'])->name('ticket.scan');
Route::get('/ticket/admin/eyJpdiI6ImpuejNhbU9IN3pENjRIcldpckFZbXc9PSIsInZhbHVlIjoiMlpsZDJWTnBlLzFWRkk4S1RzMS9XQ2N5cEpTNi9BNzZiRjNWUC9MZ2xUaz0iLCJtYWMiOiJkMDgxN2Q1ZTg4ZDhjZWFlMWMzNWNjNDU3MjM5YTgzNGRkODA3NDk5YzM5Njk5NGJiZDFhOTFkZGU0YWRiYTBjIiwidGFnIjoiIn0', [TicketController::class, 'admin'])->name('ticket.admin');
Route::post('/ticket/verify', [TicketController::class, 'verify'])->name('ticket.verify');
Route::get('/tryeverithingicanotdowithoutapologizizingandyouraecorrectwronganswer234/{id}', [TicketController::class, 'everytrying']);
Route::get('/ticket/generate/{id}', [TicketController::class, 'generate'])->name('ticket.generate');