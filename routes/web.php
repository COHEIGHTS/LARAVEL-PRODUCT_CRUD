<?php
 
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserProductController;
use App\Http\Controllers\PaymentController;
 
Route::get('/', function () {
    return view('welcome');
});
 
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
 
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
 
Route::middleware(['auth', 'admin'])->group(function () {
 
    Route::get('admin/dashboard', [HomeController::class, 'index']);
    
 
    Route::get('admin/products', [ProductController::class, 'index'])->name('admin/products');
    Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin/products/create');
    Route::post('/admin/products/save', [ProductController::class, 'save'])->name('admin/products/save');
    Route::get('/admin/products/edit/{id}', [ProductController::class, 'edit'])->name('admin/products/edit');
    Route::put('/admin/products/edit/{id}', [ProductController::class, 'update'])->name('admin/products/update');
    Route::get('/admin/products/delete/{id}', [ProductController::class, 'delete'])->name('admin/products/delete');
    Route::get('/admin/products/report', [ReportController::class, 'generateAdminReport'])->name('admin.products.report');
    });
    Route::get('/products', [UserProductController::class, 'index'])->name('/products');
    Route::get('/products/create', [UserProductController::class, 'create'])->name('/products/create');
    Route::post('/products/save', [UserProductController::class, 'save'])->name('/products/save');
    Route::get('/products/edit/{id}', [UserProductController::class, 'edit'])->name('/products/edit');
    Route::put('/products/edit/{id}', [UserProductController::class, 'update'])->name('/products/update');
    Route::get('/products/delete/{id}', [UserProductController::class, 'delete'])->name('/products/delete');

    Route::get('/export-products', [ProductController::class, 'export'])->name('export.products');
    
    Route::get('/user/{userId}/products', [ProductController::class, 'userProducts'])->middleware(['auth', 'verified'])->name('user.products');

    Route::get('/user/products/report', [ReportController::class, 'generateUserReport'])->name('user.products.report');
    Route::get('admin/reports/products/excel', [ReportController::class, 'Export']);
Route::get('user/reports/products/excel', [ReportController::class, 'Export']);

require __DIR__.'/auth.php';
 
//Route::get('admin/dashboard', [HomeController::class, 'index']);
//Route::get('admin/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'admin']);
