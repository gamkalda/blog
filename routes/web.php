<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Main\IndexController;
use App\Http\Controllers\Category\IndexController as Category_IndexController;
use App\Http\Controllers\Category\Post\IndexController as CategoryPostIndexController;
use App\Http\Controllers\Post\Comment\StoreController as CommentStoreController;
use App\Http\Controllers\Post\Like\StoreController as LikeStoreController;
use App\Http\Controllers\Post\IndexController as Post_IndexController;
use App\Http\Controllers\Post\ShowController as Post_ShowController;
use App\Http\Controllers\Admin\Main\IndexController as Admin_Main_IndexController;
use App\Http\Controllers\Personal\Main\IndexController as Personal_Main_IndexController;
use App\Http\Controllers\Personal\Liked\IndexController as Personal_Liked_IndexController;
use App\Http\Controllers\Personal\Liked\DeleteController as Personal_Liked_DeleteController;
use App\Http\Controllers\Personal\Comment\IndexController as Personal_Comment_IndexController;
use App\Http\Controllers\Personal\Comment\EditController as Personal_Comment_EditController;
use App\Http\Controllers\Personal\Comment\UpdateController as Personal_Comment_UpdateController;
use App\Http\Controllers\Personal\Comment\DeleteController as Personal_Comment_DeleteController;
use App\Http\Controllers\Admin\Category\IndexController as CategoryIndexController;
use App\Http\Controllers\Admin\Category\CreateController as CategoryCreateController;
use App\Http\Controllers\Admin\Category\StoreController as CategoryStoreController;
use App\Http\Controllers\Admin\Category\ShowController as CategoryShowController;
use App\Http\Controllers\Admin\Category\EditController as CategoryEditController;
use App\Http\Controllers\Admin\Category\UpdateController as CategoryUpdateController;
use App\Http\Controllers\Admin\Category\DeleteController as CategoryDeleteController;
use App\Http\Controllers\Admin\Tag\IndexController as TagIndexController;
use App\Http\Controllers\Admin\Tag\CreateController as TagCreateController;
use App\Http\Controllers\Admin\Tag\StoreController as TagStoreController;
use App\Http\Controllers\Admin\Tag\ShowController as TagShowController;
use App\Http\Controllers\Admin\Tag\EditController as TagEditController;
use App\Http\Controllers\Admin\Tag\UpdateController as TagUpdateController;
use App\Http\Controllers\Admin\Tag\DeleteController as TagDeleteController;
use App\Http\Controllers\Admin\Post\IndexController as PostIndexController;
use App\Http\Controllers\Admin\Post\CreateController as PostCreateController;
use App\Http\Controllers\Admin\Post\StoreController as PostStoreController;
use App\Http\Controllers\Admin\Post\ShowController as PostShowController;
use App\Http\Controllers\Admin\Post\EditController as PostEditController;
use App\Http\Controllers\Admin\Post\DeleteController as PostDeleteController;
use App\Http\Controllers\Admin\Post\UpdateController as PostUpdateController;
use App\Http\Controllers\Admin\User\IndexController as UserIndexController;
use App\Http\Controllers\Admin\User\CreateController as UserCreateController;
use App\Http\Controllers\Admin\User\StoreController as UserStoreController;
use App\Http\Controllers\Admin\User\ShowController as UserShowController;
use App\Http\Controllers\Admin\User\EditController as UserEditController;
use App\Http\Controllers\Admin\User\DeleteController as UserDeleteController;
use App\Http\Controllers\Admin\User\UpdateController as UserUpdateController;





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

Route::group(['namespace' => 'Main'], function() {
    Route::get('/', [IndexController::class, '__invoke'])->name('main.index');
});

Route::group(['namespace' => 'Category', 'prefix' => 'categories'], function() {
    Route::get('/', [Category_IndexController::class, '__invoke'])->name('category.index');

    Route::group(['namespace' => 'Post', 'prefix' => '{category}/posts'], function() {
        Route::get('/', [CategoryPostIndexController::class, '__invoke'])->name('category.post.index');
    });
});

Route::group(['namespace' => 'Post', 'prefix' => 'posts'], function() {
    Route::get('/', [Post_IndexController::class, '__invoke'])->name('post.index');
    Route::get('/{post}', [Post_ShowController::class, '__invoke'])->name('post.show');
    //post/1/comments
    Route::group(['namespace' => 'Comment', 'prefix' => '{post}/comments'], function() {
        Route::post('/', [CommentStoreController::class, '__invoke'])->name('post.comment.store');
    });
    Route::group(['namespace' => 'Like', 'prefix' => '{post}/likes'], function() {
        Route::post('/', [LikeStoreController::class, '__invoke'])->name('post.like.store');
    });
});

Route::group(['namespace' => 'Personal', 'prefix' => 'personal', 'middleware' => ['auth', 'verified']], function() {
    Route::group(['namespace' => 'Main', 'prefix' => 'main'], function() {
        Route::get('/', [Personal_Main_IndexController::class, '__invoke'])->name('personal.main.index');
    });
    Route::group(['namespace' => 'Liked', 'prefix' => 'liked'], function() {
        Route::get('/', [Personal_Liked_IndexController::class, '__invoke'])->name('personal.liked.index');
        Route::delete('/{post}', [Personal_Liked_DeleteController::class, '__invoke'])->name('personal.liked.delete');
    });
    Route::group(['namespace' => 'Comment', 'prefix' => 'comment'], function() {
        Route::get('/', [Personal_Comment_IndexController::class, '__invoke'])->name('personal.comment.index');
        Route::get('/{comment}/edit', [Personal_Comment_EditController::class, '__invoke'])->name('personal.comment.edit');
        Route::patch('/{comment}', [Personal_Comment_UpdateController::class, '__invoke'])->name('personal.comment.update');
        Route::delete('/{comment}', [Personal_Comment_DeleteController::class, '__invoke'])->name('personal.comment.delete');
    });
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'admin', 'verified']], function() {
    Route::group(['namespace' => 'Main'], function() {
        Route::get('/', [Admin_Main_IndexController::class, '__invoke'])->name('admin.main.index');
    });
    
    Route::group(['namespace' => 'Category', 'prefix' => 'categories'], function() {
        Route::get('/', [CategoryIndexController::class, '__invoke'])->name('admin.category.index');
        Route::get('/create', [CategoryCreateController::class, '__invoke'])->name('admin.category.create');
        Route::post('/', [CategoryStoreController::class, '__invoke'])->name('admin.category.store');
        Route::get('/{category}', [CategoryShowController::class, '__invoke'])->name('admin.category.show');
        Route::get('/{category}/edit', [CategoryEditController::class, '__invoke'])->name('admin.category.edit');
        Route::patch('/{category}', [CategoryUpdateController::class, '__invoke'])->name('admin.category.update');
        Route::delete('/{category}', [CategoryDeleteController::class, '__invoke'])->name('admin.category.delete');

    });

    Route::group(['namespace' => 'Tag', 'prefix' => 'tags'], function() {
        Route::get('/', [TagIndexController::class, '__invoke'])->name('admin.tag.index');
        Route::get('/create', [TagCreateController::class, '__invoke'])->name('admin.tag.create');
        Route::post('/', [TagStoreController::class, '__invoke'])->name('admin.tag.store');
        Route::get('/{tag}', [TagShowController::class, '__invoke'])->name('admin.tag.show');
        Route::get('/{tag}/edit', [TagEditController::class, '__invoke'])->name('admin.tag.edit');
        Route::patch('/{tag}', [TagUpdateController::class, '__invoke'])->name('admin.tag.update');
        Route::delete('/{tag}', [TagDeleteController::class, '__invoke'])->name('admin.tag.delete');

    });

    Route::group(['namespace' => 'Post', 'prefix' => 'posts'], function() {
        Route::get('/', [PostIndexController::class, '__invoke'])->name('admin.post.index');
        Route::get('/create', [PostCreateController::class, '__invoke'])->name('admin.post.create');
        Route::post('/', [PostStoreController::class, '__invoke'])->name('admin.post.store');
        Route::get('/{post}', [PostShowController::class, '__invoke'])->name('admin.post.show');
        Route::get('/{post}/edit', [PostEditController::class, '__invoke'])->name('admin.post.edit');
        Route::patch('/{post}', [PostUpdateController::class, '__invoke'])->name('admin.post.update');
        Route::delete('/{post}', [PostDeleteController::class, '__invoke'])->name('admin.post.delete');

    });

    Route::group(['namespace' => 'User', 'prefix' => 'users'], function() {
        Route::get('/', [UserIndexController::class, '__invoke'])->name('admin.user.index');
        Route::get('/create', [UserCreateController::class, '__invoke'])->name('admin.user.create');
        Route::post('/', [UserStoreController::class, '__invoke'])->name('admin.user.store');
        Route::get('/{user}', [UserShowController::class, '__invoke'])->name('admin.user.show');
        Route::get('/{user}/edit', [UserEditController::class, '__invoke'])->name('admin.user.edit');
        Route::patch('/{user}', [UserUpdateController::class, '__invoke'])->name('admin.user.update');
        Route::delete('/{user}', [UserDeleteController::class, '__invoke'])->name('admin.user.delete');

    });
});

Auth::routes(['verify' => true]);



