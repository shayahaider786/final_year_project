<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ContactController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/register', [FrontendController::class, 'registerUser'])->name('registerUser');
Route::post('/customer-register', [FrontendController::class, 'store'])->name('customer.store');

// Route to handle PayPal payment success
Route::get('/payment/success/{customerId}', [FrontendController::class, 'paymentSuccess'])->name('payment.success');

// Route to handle PayPal payment cancellation
Route::get('/payment/cancel', [FrontendController::class, 'paymentCancel'])->name('payment.cancel');


// Route::get('/backend', [BackendController::class, 'index'])->name('index');
// Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/login', [BackendController::class, 'login'])->name('login');


Route::middleware(['auth', 'user-access:admin'])->group(function () {
  
    Route::get('/adminhome', [HomeController::class, 'index'])->name('home');
    Route::get('/customer-data', [HomeController::class, 'showCustomer'])->name('showCustomer');
    Route::get('/admin/create', [BackendController::class, 'create'])->name('create');
    Route::post('/create-customer', [BackendController::class, 'store'])->name('store');
    Route::get('/customers/{customer}', [BackendController::class, 'show'])->name('show');
    Route::get('/customer/edit/{customer}', [BackendController::class, 'edit'])->name('edit');
    Route::put('/customers/{customer}', [BackendController::class, 'update'])->name('update');
    Route::delete('/customers/{customer}', [BackendController::class, 'destroy'])->name('destroy');
    Route::get('/admin/genrate-qr', [BackendController::class, 'genrateqr'])->name('genrateqr');
    Route::get('/generate-pdf', [HomeController::class, 'generatePDF'])->name('generate.pdf');
});


Route::delete('/delete-image/{imageId}', [BackendController::class, 'deleteImg'])->name('delete.image');
Route::delete('/delete-video/{videoPath}', [BackendController::class, 'deleteVideo'])->name('delete.video');

Route::middleware(['auth', 'user-access:user'])->group(function () {
    // Home route
    // Route::get('/userhome', [HomeController::class, 'userHome'])->name('userHome');
    // Route::get('/profile', [CustomerController::class, 'show'])->name('user.show');
    Route::get('/profile', [CustomerController::class, 'edit'])->name('user.edit');
    Route::put('/profile/update', [CustomerController::class, 'update'])->name('user.update');

    // Route::delete('/delete-image-user/{imageId}', [CustomerController::class, 'deleteImg'])->name('delete.image');

});

    // This route will be called when qr code scanned!
    
    Route::get('/profile/{id}', [CustomerController::class, 'showData'])->name('user.showData');

    // download svg image route
    Route::get('/download-svg/{userId}', function ($userId) {
        $svgContent = Storage::disk('public')->get('qr_codes/' . $userId . '.svg');
        return response($svgContent, 200, [
            'Content-Type' => 'image/svg+xml',
            'Content-Disposition' => 'attachment; filename="image.svg"'
        ]);
    });