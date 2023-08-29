<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;

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
Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
Route::get('/dashboard', function () {
    $page_title = '';
    
    return view('admin.index', compact('page_title'));
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

// Book Routes
Route::get('/add_book', [BookController::class, 'AddBook'])->name('add.book');
Route::post('/save_book', [BookController::class, 'SaveBook'])->name('save.book');
Route::get('/view_books', [BookController::class, 'ViewBook'])->name('view.book');
Route::get('/edit_books/{id}', [BookController::class, 'EditBook'])->name('edit.book');
Route::post('/update_book', [BookController::class, 'UpdateBook'])->name('update.book');
Route::get('/delete_book/{id}', [BookController::class, 'DeleteBook'])->name('delete.book');

Route::get('/sell_book', [BookController::class, 'SellBook'])->name('sell.book');
Route::get('/sell', [BookController::class, 'bookSell'])->name('book.sell');
Route::get('/book_stock', [BookController::class, 'BookStock'])->name('book.stock');
Route::get('/view_stock/{id}', [BookController::class, 'ViewBookStock'])->name('view.stock');
Route::get('/delete_book_stock/{id}', [BookController::class, 'DeleteBookstock'])->name('delete.book_stock');


// User Routes
Route::get('/add_user', [UserController::class, 'AddUser'])->name('add.user');
Route::post('/save_user', [UserController::class, 'SaveUser'])->name('save.user');
Route::get('/view_users', [UserController::class, 'ViewUser'])->name('view.user');
Route::get('/edit_user/{id}', [UserController::class, 'EditUser'])->name('edit.user');
Route::post('/update_user', [UserController::class, 'UpdateUser'])->name('update.user');
Route::get('/delete_user/{id}', [UserController::class, 'DeleteUser'])->name('delete.user');

