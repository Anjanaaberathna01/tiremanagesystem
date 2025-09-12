<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MasterdataController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\TireRequestController;
use App\Http\Controllers\OfficerAuthController;
use App\Http\Controllers\MechanicAuthController;
use App\Http\Controllers\TransportController;
use App\Http\Controllers\TransportAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TireOrderController;



Route::get('/', function () {
    return view('home');
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
});


Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

// Admin routes
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
Route::get('/user/login', [UserAuthController::class, 'showLoginForm'])->name('user.login');
Route::post('/user/login', [UserAuthController::class, 'login'])->name('user.login.submit');
Route::get('/officer/login', [OfficerAuthController::class, 'showLoginForm'])->name('officer.login');
Route::post('/officer/login', [OfficerAuthController::class, 'login'])->name('officer.login.submit');
Route::get('/mechanic/login', [MechanicAuthController::class, 'showLoginForm'])->name('mechanic.login');
Route::post('/mechanic/login', [MechanicAuthController::class, 'login'])->name('mechanic.login.submit');
Route::get('/transport/login', [TransportAuthController::class, 'showLoginForm'])->name('transport.login');
Route::post('/transport/login', [TransportAuthController::class, 'login'])->name('transport.login.submit');

// Masterdata routes
Route::middleware(['auth', 'admin'])->group(function () {
    //tire management routes
    Route::get('/tiredashboard', [MasterdataController::class, 'showTireDashboard'])->name('tiredashboard');
    Route::post('/tiredashboard', [MasterdataController::class, 'storeTire'])->name('tire.store');
    Route::post('/ajax/brands', [MasterdataController::class, 'getBrandsBySize'])->name('ajax.getBrandsBySize');
    Route::post('/ajax/supplier', [MasterdataController::class, 'getSupplierBySizeBrand'])->name('ajax.getSupplierBySizeBrand');

    // Vehicle management routes
    Route::get('/vehicledashboard', [MasterdataController::class, 'showVehicleData'])->name('vehicledashboard');
    Route::post('/vehicledashboard', [MasterdataController::class, 'storeVehicle'])->name('vehicle.store');
    Route::delete('/vehicledashboard/{id}', [MasterdataController::class, 'destroyVehicle'])->name('vehicle.destroy');

    // Supplier management routes
    Route::get('/supplierdashboard', [MasterdataController::class, 'showSupplierData'])->name('supplierdashboard');
    Route::post('/supplierdashboard', [MasterdataController::class, 'storeSupplier'])->name('supplier.store');
    Route::delete('/supplierdashboard/{id}', [MasterdataController::class, 'destroySupplier'])->name('supplier.destroy');
});


// Middleware for driver or user access
Route::middleware(['driver_or_user'])->group(function () {
    Route::get('/tirerequest', [TireRequestController::class, 'create'])->name('tirerequest.new');
    Route::post('/tirerequest', [TireRequestController::class, 'store'])->name('tirerequest.store');
    Route::post('/tirerequest/vehicle-details', [TireRequestController::class, 'getVehicleDetails'])->name('tirerequest.vehicle-details');
    Route::post('/tirerequest/department-users', [TireRequestController::class, 'getDepartmentUsers'])->name('tirerequest.department-users');
    Route::post('/tirerequest/tire-brands', [TireRequestController::class, 'getTireBrands'])->name('tirerequest.tire-brands');
    Route::post('/tirerequest/tire-prices', [TireRequestController::class, 'getTirePrices'])->name('tirerequest.tire-prices');
    Route::post('/tirerequest/tire-details', [TireRequestController::class, 'getTireDetails'])->name('tirerequest.tire-details');
    Route::get('/tirerequest/view', [TireRequestController::class, 'viewMyRequests'])->name('tirerequest.view');
});

// Approval page (protected)
Route::middleware(['supervisor_or_manager'])->group(function () {
    Route::get('/tirerequest/approval', [TireRequestController::class, 'approvalPage'])->name('tirerequest.approval');
    Route::get('/tirerequest/approval/{id}', [TireRequestController::class, 'approvalView'])->name('tirerequest.approvalview');
    Route::post('/tirerequest/approval/{id}', [TireRequestController::class, 'sectionApprove'])->name('tirerequest.sectionapprove');
    Route::get('/tirerequest/preapproval', [TireRequestController::class, 'preApprovalList'])->name('tirerequest.preapproval');
});

// Mechanic routes
Route::middleware(['mechanic'])->group(function () {
    Route::get('/transport/evaluation', [TransportController::class, 'viewEvaluation'])->name('transport.evaluation');
    Route::get('/transport/evaluation/{id}', [TransportController::class, 'evaluationView'])->name('transport.evaluationview');
    Route::post('/transport/evaluation/{id}', [TransportController::class, 'evaluationSubmit'])->name('transport.evaluation.submit');
    Route::get('/transport/after-evaluation', [TransportController::class, 'afterEvaluation'])->name('transport.afterevaluation');
});


// Transport officer routes
Route::middleware(['transport_officer'])->group(function () {
    Route::get('/transport/viewtransport', [TransportController::class, 'viewTransport'])->name('transport.viewtransport');
    Route::get('/transport/approval/{id}', [TransportController::class, 'transportApprovalView'])->name('transport.transportapprovalview');
    Route::post('/transport/approval/{id}', [TransportController::class, 'transportApprovalSubmit'])->name('transport.transportapprovalsubmit');
    Route::get('/transport/after-approval', [TransportController::class, 'afterApproval'])->name('transport.afterapproval');
    Route::get('/orders', [TireOrderController::class, 'index'])->name('order.list');
    Route::get('/orders/create/{request_id}', [TireOrderController::class, 'create'])->name('order.create');
    Route::post('/orders/store/{request_id}', [TireOrderController::class, 'store'])->name('order.store');
    Route::post('/orders/arrived/{order_id}', [TireOrderController::class, 'markArrived'])->name('order.arrived');
});




