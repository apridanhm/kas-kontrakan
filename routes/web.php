<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProfileController,
    CategoryController,
    MemberPaymentController,
    MemberDashboardController,
    AdminDashboardController,
    AdminPaymentController,
    AdminExpenseController,
    MemberNonCashController,
    AdminNonCashController,
    PublicDashboardController,
    AdminInstallmentController,
    AdminUserController
};

/*
|--------------------------------------------------------------------------
| PUBLIC (TANPA LOGIN)
|--------------------------------------------------------------------------
*/
Route::get('/', [PublicDashboardController::class, 'index'])
    ->name('public.dashboard');

Route::get('/kas', [PublicDashboardController::class, 'index']);

/*
|--------------------------------------------------------------------------
| AUTH (LOGIN SAJA)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // profile selalu boleh (meski belum aktif)
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    // submit cicilan
    Route::post(
        '/payments/{payment}/installment',
        [MemberPaymentController::class, 'storeInstallment']
    )->name('payments.installment.store');

    // non-cash
    Route::get('/member/non-cash', [MemberNonCashController::class,'create'])
        ->name('member.non-cash.create');

    Route::post('/member/non-cash', [MemberNonCashController::class,'store'])
        ->name('member.non-cash.store');
});

/*
|--------------------------------------------------------------------------
| MEMBER (LOGIN + ACTIVE)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','active'])->group(function () {

    Route::get('/member', [MemberDashboardController::class, 'index'])
        ->name('member.dashboard');
});

/*
|--------------------------------------------------------------------------
| ADMIN ONLY
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','admin'])->group(function () {

    // admin dashboard
    Route::get('/admin', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');

    // approve user
    Route::get('/admin/users', [AdminUserController::class, 'index'])
        ->name('admin.users.index');

    Route::patch('/admin/users/{user}/approve',
        [AdminUserController::class, 'approve'])
        ->name('admin.users.approve');

    // kategori
    Route::resource('categories', CategoryController::class)
        ->only(['index','create','store']);

    // pembayaran kas
    Route::get('/admin/payments', [AdminPaymentController::class, 'index'])
        ->name('admin.payments.index');

    Route::post('/admin/payments/{payment}/approve',
        [AdminPaymentController::class, 'approve'])
        ->name('admin.payments.approve');

    Route::delete('/admin/payments/{installment}',
        [AdminPaymentController::class, 'reject'])
        ->name('admin.payments.reject');

    // cicilan
    Route::get('/admin/installments', [AdminInstallmentController::class,'index'])
        ->name('admin.installments.index');

    Route::post('/admin/installments/{installment}/approve',
        [AdminInstallmentController::class,'approve'])
        ->name('admin.installments.approve');

    Route::delete('/admin/installments/{installment}',
        [AdminInstallmentController::class,'reject'])
        ->name('admin.installments.reject');

    // pengeluaran
    Route::get('/admin/expenses', [AdminExpenseController::class, 'index'])
        ->name('admin.expenses.index');

    Route::get('/admin/expenses/create', [AdminExpenseController::class, 'create'])
        ->name('admin.expenses.create');

    Route::post('/admin/expenses', [AdminExpenseController::class, 'store'])
        ->name('admin.expenses.store');

    // non kas
    Route::get('/admin/non-cash', [AdminNonCashController::class,'index'])
        ->name('admin.non-cash.index');

    Route::patch('/admin/non-cash/{item}/approve',
        [AdminNonCashController::class,'approve'])
        ->name('admin.non-cash.approve');
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (LOGIN / REGISTER)
|--------------------------------------------------------------------------
*/

// hapus user
Route::middleware(['auth','admin'])->group(function () {

    Route::get('/admin/users', [App\Http\Controllers\AdminUserController::class, 'index'])
        ->name('admin.users.index');

    Route::patch('/admin/users/{user}/approve', [App\Http\Controllers\AdminUserController::class, 'approve'])
        ->name('admin.users.approve');

    Route::patch('/admin/users/{user}/disable', [App\Http\Controllers\AdminUserController::class, 'disable'])
        ->name('admin.users.disable');

    Route::delete('/admin/users/{user}', [App\Http\Controllers\AdminUserController::class, 'destroy'])
        ->name('admin.users.destroy');
});

require __DIR__.'/auth.php';
