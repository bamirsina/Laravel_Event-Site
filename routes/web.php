<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\ZoneController;
use BaconQrCode\Encoder\QrCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

//----------------------------Web------------------------//
Route::get('web/events',[WebController::class,'eventsMethod'])->name('web.events');
Route::get('web/show-events/{id}',[WebController::class,'show_events'])->name('web.show_events')->middleware('auth');
Route::post('web/show-events/store',[WebController::class,'store'])->name('web.show_events.store')->middleware('auth');
Route::get('web/user_tickets', [WebController::class, 'ticket'])->name('web.user_tickets');
Route::get('web/show_ticket/{id}', [WebController::class, 'show_ticket'])->name('web.show_ticket');

Route::get('admin/zones/create', [ZoneController::class, 'create'])->name('zones.create');
Route::get('zones', [ZoneController::class, 'index'])->name('admin.zones.index');
Route::post('admin/zones', [ZoneController::class, 'store'])->name('zones.store');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('reservations',ReservationController::class);
Route::resource('users',       UserController::class);
Route::resource('roles',       RoleController::class);
Route::resource('permissions', PermissionController::class);
Route::resource('posts',       PostController::class);

Route::post('approve-ticket', [ReservationController::class, 'approveTicket'])->name('approve.ticket');
Route::get('/check-ticket', [ReservationController::class, 'showTickets'])->name('showTickets');
Route::post('/check-ticket', [ReservationController::class, 'checkTicket'])->name('checkTicket');
