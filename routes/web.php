<?php
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminAccess;

Route::get('/', [BlogController::class, 'index'])->name('home');
Route::get('/article/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/category/{category}', [BlogController::class, 'category'])->name('blog.category');
Route::get('/about', [BlogController::class, 'about'])->name('blog.about');


Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/articles', [ArticleController::class, 'index'])->name('admin.articles.index');
    Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('admin.articles.show');
    Route::get('/articles/{id}/edit', [ArticleController::class, 'edit'])->name('admin.articles.edit');
    Route::put('/admin/articles/{id}', [ArticleController::class, 'update'])
        ->name('admin.articles.update');
});

Route::fallback(function () {
    return view('errors.404');
});