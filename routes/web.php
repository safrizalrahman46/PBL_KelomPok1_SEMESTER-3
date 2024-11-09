<?php

use App\Http\Controllers\Admin\AdditionalServicesController;
use App\Http\Controllers\Admin\AuthController;
// use App\Http\Controllers\Admin\DashboardController;

// use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BookingDepositController;
use App\Http\Controllers\Admin\BookingsController;
use App\Http\Controllers\Admin\BookingServiceController;
use App\Http\Controllers\Admin\CarbrandController;
use App\Http\Controllers\Admin\CarsController;
use App\Http\Controllers\Admin\ChargesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DeliveryPickupChargesController;
use App\Http\Controllers\Admin\DriverControllerr;
use App\Http\Controllers\Admin\ManageBookingController;
use App\Http\Controllers\Admin\PromotionsController;
use App\Http\Controllers\Admin\RentalRatesController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\TourPackagesController;
use App\Http\Controllers\Admin\UsersController;
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

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::any('/backoffice/proses_login', [AuthController::class, 'prosesLogin'])->name('form.post.login');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/logout', [AuthController::class, 'signout'])->name('signout');
    Route::post('/logout', action: [AuthController::class, 'signout'])->name('signout');
    // ////Masyer Jenis Transaksi

    Route::prefix('backoffice')->group(function () {
        Route::get('/Rental-Rates', [RentalRatesController::class, 'index'])->name('admin.Rental-Rates.index');
        Route::get('/Rental-Rates/create', [RentalRatesController::class, 'create'])->name('admin.Rental-Rates.create');
        Route::post('/Rental-Rates', [RentalRatesController::class, 'store'])->name('admin.Rental-Rates.store');
        Route::get('/Rental-Rates/{id}/edit', [RentalRatesController::class, 'edit'])->name('admin.Rental-Rates.edit');
        Route::put('/Rental-Rates/{id}', [RentalRatesController::class, 'update'])->name('admin.Rental-Rates.update');
        Route::delete('/Rental-Rates/{id}', [RentalRatesController::class, 'destroy'])->name('admin.Rental-Rates.destroy');

    });

    Route::prefix('backoffice')->group(function () {
        Route::get('/Bookings', [BookingsController::class, 'index'])->name('admin.Bookings.index');
        Route::get('/Bookings/create', [BookingsController::class, 'create'])->name('admin.Bookings.create');
        Route::post('/Bookings', [BookingsController::class, 'store'])->name('admin.Bookings.store');
        Route::get('/Bookings/{id}/edit', [BookingsController::class, 'edit'])->name('admin.Bookings.edit');
        Route::put('/Bookings/{id}', [BookingsController::class, 'update'])->name('admin.Bookings.update');
        Route::delete('/Bookings/{id}', [BookingsController::class, 'destroy'])->name('admin.Bookings.destroy');

    });

    Route::prefix('backoffice')->group(function () {
        Route::get('/Manage-Booking', [ManageBookingController::class, 'index'])->name('admin.Manage-Booking.index');
        Route::get('/Manage-Booking/create', [ManageBookingController::class, 'create'])->name('admin.Manage-Booking.create');
        Route::post('/Manage-Booking', [ManageBookingController::class, 'store'])->name('admin.Manage-Booking.store');
        Route::get('/Manage-Booking/{id}/edit', [ManageBookingController::class, 'edit'])->name('admin.Manage-Booking.edit');
        Route::put('/Manage-Booking/{id}', [ManageBookingController::class, 'update'])->name('admin.Manage-Booking.update');
        Route::delete('/Manage-Booking/{id}', [ManageBookingController::class, 'destroy'])->name('admin.Manage-Booking.destroy');

    });

    Route::prefix('backoffice')->group(function () {
        Route::get('/Service', [ServicesController::class, 'index'])->name('admin.Service.index');
        Route::get('/Service/create', [ServicesController::class, 'create'])->name('admin.Service.create');
        Route::post('/Service', [ServicesController::class, 'store'])->name('admin.Service.store');
        Route::get('/Service/{id}/edit', [ServicesController::class, 'edit'])->name('admin.Service.edit');
        Route::put('/Service/{id}', [ServicesController::class, 'update'])->name('admin.Service.update');
        Route::delete('/Service/{id}', [ServicesController::class, 'destroy'])->name('admin.Service.destroy');

    });

    Route::prefix('backoffice')->group(function () {
        Route::get('/Charges', [ChargesController::class, 'index'])->name('admin.Charges.index');
        Route::get('/Charges/create', [ChargesController::class, 'create'])->name('admin.Charges.create');
        Route::post('/Charges', [ChargesController::class, 'store'])->name('admin.Charges.store');
        Route::get('/Charges/{id}/edit', [ChargesController::class, 'edit'])->name('admin.Charges.edit');
        Route::put('/Charges/{id}', [ChargesController::class, 'update'])->name('admin.Charges.update');
        Route::delete('/Charges/{id}', [ChargesController::class, 'destroy'])->name('admin.Charges.destroy');

    });

    Route::prefix('backoffice')->group(function () {
        Route::get('/Users', [UsersController::class, 'index'])->name('admin.Users.index');
        Route::get('/Users/create', [UsersController::class, 'create'])->name('admin.Users.create');
        Route::post('/Users', [UsersController::class, 'store'])->name('admin.Users.store');
        Route::get('/Users/{id}/edit', [UsersController::class, 'edit'])->name('admin.Users.edit');
        Route::put('/Users/{id}', [UsersController::class, 'update'])->name('admin.Users.update');
        Route::delete('/Users/{id}', [UsersController::class, 'destroy'])->name('admin.Users.destroy');

    });

    Route::prefix('backoffice')->group(function () {
        Route::get('/Bookings-Deposit', [BookingDepositController::class, 'index'])->name('admin.Bookings-Deposit.index');
        Route::get('/Bookings-Deposit/create', [BookingDepositController::class, 'create'])->name('admin.Bookings-Deposit.create');
        Route::post('/Bookings-Deposit', [BookingDepositController::class, 'store'])->name('admin.Bookings-Deposit.store');
        Route::get('/Bookings-Deposit/{id}/edit', [BookingDepositController::class, 'edit'])->name('admin.Bookings-Deposit.edit');
        Route::put('/Bookings-Deposit/{id}', [BookingDepositController::class, 'update'])->name('admin.Bookings-Deposit.update');
        Route::delete('/Bookings-Deposit/{id}', [BookingDepositController::class, 'destroy'])->name('admin.Bookings-Deposit.destroy');

    });

    Route::prefix('backoffice')->group(function () {
        Route::get('/Bookings-Service', [BookingServiceController::class, 'index'])->name('admin.Bookings-Service.index');
        Route::get('/Bookings-Service/create', [BookingServiceController::class, 'create'])->name('admin.Bookings-Service.create');
        Route::post('/Bookings-Service', [BookingServiceController::class, 'store'])->name('admin.Bookings-Service.store');
        Route::get('/Bookings-Service/{id}/edit', [BookingServiceController::class, 'edit'])->name('admin.Bookings-Service.edit');
        Route::put('/Bookings-Service/{id}', [BookingServiceController::class, 'update'])->name('admin.Bookings-Service.update');
        Route::delete('/Bookings-Service/{id}', [BookingServiceController::class, 'destroy'])->name('admin.Bookings-Service.destroy');

    });

    Route::prefix('backoffice')->group(function () {
        Route::get('/Driver', [DriverControllerr::class, 'index'])->name('admin.Driver.index');
        Route::get('/Driver/create', [DriverControllerr::class, 'create'])->name('admin.Driver.create');
        Route::post('/Driver', [DriverControllerr::class, 'store'])->name('admin.Driver.store');
        Route::get('/Driver/{id}/edit', [DriverControllerr::class, 'edit'])->name('admin.Driver.edit');
        Route::put('/Driver/{id}', [DriverControllerr::class, 'update'])->name('admin.Driver.update');
        Route::delete('/Driver/{id}', [DriverControllerr::class, 'destroy'])->name('admin.Driver.destroy');

    });

    Route::prefix('backoffice')->group(function () {
        Route::get('/Delivery-pickup-charges', [DeliveryPickupChargesController::class, 'index'])->name('admin.Delivery-pickup-charges.index');
        Route::get('/Delivery-pickup-charges/create', [DeliveryPickupChargesController::class, 'create'])->name('admin.Delivery-pickup-charges.create');
        Route::post('/Delivery-pickup-charges', [DeliveryPickupChargesController::class, 'store'])->name('admin.Delivery-pickup-charges.store');
        Route::get('/Delivery-pickup-charges/{id}/edit', [DeliveryPickupChargesController::class, 'edit'])->name('admin.Delivery-pickup-charges.edit');
        Route::put('/Delivery-pickup-charges/{id}', [DeliveryPickupChargesController::class, 'update'])->name('admin.Delivery-pickup-charges.update');
        Route::delete('/Delivery-pickup-charges/{id}', [DeliveryPickupChargesController::class, 'destroy'])->name('admin.Delivery-pickup-charges.destroy');

    });

    Route::prefix('backoffice')->group(function () {

        Route::resource('cars', CarsController::class);
        Route::resource('car_brand', CarbrandController::class);
        Route::resource('additional_servicess', AdditionalServicesController::class);
        Route::resource('promotions', PromotionsController::class);
        Route::resource('tour_packages', TourPackagesController::class);

    });
});
