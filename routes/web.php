<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\OurProductsController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\ContactUsController;




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

Route::get('/', [BookingController::class, 'index'])->name('booking');

// Route::get('/', function () {
//     return view('booking');
// });



Route::get('/ourproducts', [OurProductsController::class, 'index'])->name('ourproducts.index');
Route::get('/download', [DownloadController::class, 'index'])->name('download.index');
Route::get('/contactus', [ContactUsController::class, 'index'])->name('contactus.index');

Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/tacking', [BookingController::class, 'tacking'])->name('booking.tacking');

//history calendar json query
Route::get('/calendar/json', [OurProductsController::class, 'get_calendar'])->name('calendar.data');

Route::middleware('auth')->group(function () {

    Route::get('/record', [RecordController::class, 'record'])->name('backend.record');
    Route::get('/booking/action/{token}/{status}', [RecordController::class, 'action'])->name('booking.action');
    Route::get('/edit', [RecordController::class, 'edit'])->name('booking.edit');
    Route::post('/booking/update', [RecordController::class, 'update'])->name('booking.update');



    // Route::delete('/booking/destroy', [RecordController::class, 'destroy'])->name('booking.destroy');

    Route::get('/schedule', [CalendarController::class, 'calendar'])->name('backend.calendar');

    Route::middleware(['auth','role:management|superadmin'])->group(function () {

        Route::get('/booking/destroy/{token}/{status}', [RecordController::class, 'destroy'])->name('booking.destroy');
        // history
        Route::get('/history', [HistoryController::class, 'history'])->name('backend.history');
        //excel json query
        Route::post('/history/excel-json', [HistoryController::class, 'get_data'])->name('backend.history.excel');

        // Room
        Route::get('/room', [RoomController::class, 'index'])->name('backend.room.index');
        Route::get('/room/create', [RoomController::class, 'create'])->name('backend.room.create');
        Route::post('/room/store', [RoomController::class, 'store'])->name('backend.room.store');
        Route::get('/room/edit/{id}', [RoomController::class, 'edit'])->name('backend.room.edit');
        Route::post('/room/update/{id}', [RoomController::class, 'update'])->name('backend.room.update');
        Route::get('/room/destroy/{id}', [RoomController::class, 'destroy'])->name('backend.room.destroy');

        // Content
        Route::get('/content', [ContentController::class, 'index'])->name('backend.content.index');
        Route::post('/content/store', [ContentController::class, 'store'])->name('backend.content.store');
        // Route::get('/content/edit', [ContentController::class, 'edit'])->name('backend.content.edit');
        Route::post('/content/update/{id}', [ContentController::class, 'update'])->name('backend.content.update');

        // map
        Route::post('/content/map', [ContentController::class, 'map'])->name('backend.content.map');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
