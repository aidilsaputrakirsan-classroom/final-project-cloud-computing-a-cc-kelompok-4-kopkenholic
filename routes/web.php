<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\Dashboard\CategoryController as DashboardCategoryController;
use App\Http\Controllers\Dashboard\CommentController as DashboardCommentController;
use App\Http\Controllers\Dashboard\HomeController as DashboardHomeController;
use App\Http\Controllers\Dashboard\MediaController;
use App\Http\Controllers\Dashboard\MenuController;
use App\Http\Controllers\Dashboard\PageController as DashboardPageController;
use App\Http\Controllers\Dashboard\PostController as DashboardPostController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\SiteSettingController;
use App\Http\Controllers\Dashboard\SocialMediaController;
use App\Http\Controllers\Dashboard\TagController as DashboardTagController;
use App\Http\Controllers\Dashboard\UserController as DashboardUserController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\TagController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Dashboard\ContactMessageController;
use Illuminate\Support\Facades\Route;

Route::name('frontend.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/search', [SearchController::class, 'index'])->name('search');
    Route::get('/post/{slug}', [PostController::class, 'index'])->name('post');
    Route::post('/comment/{id}', [CommentController::class, 'index'])->name('comment');
    Route::post('/comment-reply', [CommentController::class, 'reply'])->name('comment.reply');
    Route::get('/category/{slug}', [CategoryController::class, 'index'])->name('category');
    Route::get('/user/{username}', [UserController::class, 'index'])->name('user');
    Route::get('/tag/{name}', [TagController::class, 'index'])->name('tag');
    Route::get('/page/{slug}', [PageController::class, 'index'])->name('page');
    Route::get('/contact-us', [ContactController::class, 'index'])->name('contact');
    Route::post('/contact-us', [ContactController::class, 'store'])->name('contact.store');
});

Route::name('auth.')->group(function () {
    Route::get('/signup', [SignupController::class, 'index'])->name('signup');
    Route::post('/signup', [SignupController::class, 'signup'])->name('signup.submit');
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
    Route::post('/logout', [LogoutController::class, 'index'])->name('logout');
});

Route::name('dashboard.')->prefix('/dashboard')->middleware(['auth'])->group(function () {
    // dashboard home
    Route::get('/', [DashboardHomeController::class, 'index'])->name('home');

    // posts
    Route::prefix('/posts')->name('posts.')->controller(DashboardPostController::class)->group(function () {
        Route::get('/{id}/status', 'status')->name('status');
        Route::get('/{id}/featured', 'featured')->name('featured');
        Route::get('/{id}/comment', 'comment')->name('comment');
        Route::get('/trashed', 'trashed')->name('trashed');
        Route::patch('/{id}/restore', 'restore')->name('restore');
        Route::delete('/{id}/force', 'delete')->name('force-delete');
    });
    Route::resource('/posts', DashboardPostController::class)->except(['show']);

    // media
    Route::resource('/media', MediaController::class)->except(['show', 'edit', 'update']);

    // comments
    Route::prefix('/comments')->name('comments.')->controller(DashboardCommentController::class)->group(function () {
        Route::get('/{id}/status', 'status')->name('status');
        Route::get('/trashed', 'trashed')->name('trashed');
        Route::get('/{id}/restore', 'restore')->name('restore');
        Route::delete('/{id}/delete', 'delete')->name('delete');
    });
    Route::resource('/comments', DashboardCommentController::class)->only(['index', 'show', 'destroy']);

    // categories (ADMIN)
    Route::prefix('/categories')
        ->name('categories.')
        ->controller(DashboardCategoryController::class)
        ->middleware([\App\Http\Middleware\AdminMiddleware::class])
        ->group(function () {
            Route::get('/{id}/status', 'status')->name('status');
            Route::get('/trashed', 'trashed')->name('trashed');
            Route::get('/{id}/restore', 'restore')->name('restore');
            Route::delete('/{id}/delete', 'delete')->name('delete');
        });
    Route::resource('/categories', DashboardCategoryController::class)
        ->middleware([\App\Http\Middleware\AdminMiddleware::class]);

    // tags (ADMIN)
    Route::prefix('/tags')
        ->name('tags.')
        ->controller(DashboardTagController::class)
        ->middleware([\App\Http\Middleware\AdminMiddleware::class])
        ->group(function () {
            Route::get('/index', 'index')->name('index');
            Route::delete('/{id}/destroy', 'destroy')->name('destroy');
        });

    // users (ADMIN)
    Route::prefix('/users')
        ->name('users.')
        ->controller(DashboardUserController::class)
        ->middleware([\App\Http\Middleware\AdminMiddleware::class])
        ->group(function () {
            Route::get('/{id}/status', 'status')->name('status');
        });
    Route::resource('/users', DashboardUserController::class)
        ->middleware([\App\Http\Middleware\AdminMiddleware::class]);

    // pages (ADMIN)
    Route::prefix('/pages')
        ->name('pages.')
        ->controller(DashboardPageController::class)
        ->middleware([\App\Http\Middleware\AdminMiddleware::class])
        ->group(function () {
            Route::get('/{id}/status', 'status')->name('status');
            Route::get('/trashed', 'trashed')->name('trashed');
            Route::get('/{id}/restore', 'restore')->name('restore');
            Route::delete('/{id}/delete', 'delete')->name('delete');
        });
    Route::resource('/pages', DashboardPageController::class)
        ->except(['show'])
        ->middleware([\App\Http\Middleware\AdminMiddleware::class]);

    // settings (ADMIN, beberapa tanpa admin)
    Route::prefix('/settings')
        ->name('settings.')
        ->middleware([\App\Http\Middleware\AdminMiddleware::class])
        ->group(function () {
            // site settings
            Route::get('/site-settings', [SiteSettingController::class, 'index'])->name('site');
            Route::post('/site-settings', [SiteSettingController::class, 'update'])->name('site.update');

            // profile update (tanpa admin)
            Route::get('/profile', [ProfileController::class, 'index'])->withoutMiddleware([\App\Http\Middleware\AdminMiddleware::class])->name('profile');
            Route::post('/profile', [ProfileController::class, 'update'])->withoutMiddleware([\App\Http\Middleware\AdminMiddleware::class])->name('profile.update');

            // password change (tanpa admin)
            Route::get('/change-password', [ProfileController::class, 'password'])->withoutMiddleware([\App\Http\Middleware\AdminMiddleware::class])->name('password');
            Route::post('/change-password', [ProfileController::class, 'passwordUpdate'])->withoutMiddleware([\App\Http\Middleware\AdminMiddleware::class])->name('password.update');

            // social media
            Route::get('/social-media', [SocialMediaController::class, 'index'])->name('social.media');
            Route::post('/social-media', [SocialMediaController::class, 'add'])->name('social.media.add');
            Route::get('/social-media/{id}/status', [SocialMediaController::class, 'status'])->name('social.media.status');
            Route::delete('/social-media/{id}/delete', [SocialMediaController::class, 'delete'])->name('social.media.delete');

            // site menu
            Route::get('/menus/header', [MenuController::class, 'header'])->name('menus.header');
            Route::post('/menus/header', [MenuController::class, 'headerUpdate'])->name('menus.header.update');
            Route::get('/menus/footer', [MenuController::class, 'footer'])->name('menus.footer');
            Route::post('/menus/footer', [MenuController::class, 'footerUpdate'])->name('menus.footer.update');
        });

    // contact messages (ADMIN)  // <-- TAMBAHAN
    Route::prefix('/contact-messages')
        ->name('contact.')
        ->controller(ContactMessageController::class)
        ->middleware([\App\Http\Middleware\AdminMiddleware::class])
        ->group(function () {
            Route::get('/', 'index')->name('index');          // daftar pesan masuk
            Route::delete('/{id}', 'destroy')->name('destroy'); // hapus pesan
        });

});
