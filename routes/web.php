<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\IncomeCategoryController;
use App\Http\Controllers\ExpenseCategoryController;

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

// Ajax api
Route::middleware('auth')->group(function () {
    // Income Category
    Route::get('/list-income-category', [IncomeCategoryController::class, 'incomeCategoryList'])->name('list.income.Category');
    Route::post('/create-income-category', [IncomeCategoryController::class, 'incomeCategoryCreate'])->name('create.income.Category');
    Route::post('/incomeCategory-by-id', [IncomeCategoryController::class, 'incomeCategoryById'])->name('incomeCategory.by.id');
    Route::post('/update-income-category', [IncomeCategoryController::class, 'incomeCategoryUpdate'])->name('update.income.category');
    Route::post('/delete-income-category', [IncomeCategoryController::class, 'incomeCategoryDelete'])->name('delete.income.category');

    // Expense Category
    Route::get('/list-expense-category', [ExpenseCategoryController::class, 'expenseCategoryList'])->name('list-expense-category');
    Route::post('/create-expense-category', [ExpenseCategoryController::class, 'expenseCategoryCreate'])->name('create-expense-category');
    Route::post('/expenseCategory-by-id', [ExpenseCategoryController::class, 'expenseCategoryBYId'])->name('expenseCategory-by-id');
    Route::post('/update-expense-category', [ExpenseCategoryController::class, 'expenseCategoryUpdate'])->name('update-expense-category');
    Route::post('/delete-expense-category', [ExpenseCategoryController::class, 'expenseCategoryDelete'])->name('delete-expense-category');

    // Income
    Route::get('/list-income', [IncomeController::class, 'IncomeList'])->name('list-income');
    Route::post('/create-income', [IncomeController::class, 'createIncome'])->name('create-income');
    Route::post('/income-by-id', [IncomeController::class, 'incomeById'])->name('income-by-id');
    Route::post('/update-income', [IncomeController::class, 'updateIncome'])->name('update-income');
    Route::post('/delete-income', [IncomeController::class, 'deleteIncome'])->name('delete-income');

    // Expense
    Route::get('/expense-list', [ExpenseController::class, 'ExpenseList'])->name('expense-list');
    Route::post('/create-expense', [ExpenseController::class, 'createExpense'])->name('create-expense');
    Route::post('/expensen-by-id', [ExpenseController::class, 'updateExpense'])->name('expensen-by-id');
    Route::post('/update-expense', [ExpenseController::class, 'updateExpense'])->name('expense-update');
    Route::post('/delete-expense', [ExpenseController::class, 'deleteExpense'])->name('delete-expense');
});

require __DIR__ . '/auth.php';

Route::get('logout',[UserController::class,'UserLogout']);