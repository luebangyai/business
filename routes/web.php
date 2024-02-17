<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\BlogController;
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
Route::get('/blogs', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{id}', [BlogController::class, 'show'])->name('blog.show');

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

    // Route::get('/our-product', [HomeController::class, 'ourProduct'])->name('backend.our.product');

    Route::middleware(['auth','role:admin|superadmin'])->group(function () {

        Route::get('/booking/destroy/{token}/{status}', [RecordController::class, 'destroy'])->name('booking.destroy');
        // ourProduct
        Route::get('/our-product', [HomeController::class, 'index'])->name('backend.our.product.index');
        Route::get('/our-product/create', [HomeController::class, 'create'])->name('backend.our.product.create');
        Route::post('/our-product/store', [HomeController::class, 'store'])->name('backend.our.product.store');
        Route::get('/our-product/edit/{id}', [HomeController::class, 'edit'])->name('backend.our.product.edit');
        Route::post('/our-product/update/{id}', [HomeController::class, 'update'])->name('backend.our.product.update');
        Route::get('/our-product/destroy/{id}', [HomeController::class, 'destroy'])->name('backend.our.product.destroy');

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
