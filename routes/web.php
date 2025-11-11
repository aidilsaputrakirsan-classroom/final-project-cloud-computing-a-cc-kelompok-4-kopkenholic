<?php

use Illuminate\Support\Facades\Route;

// ===== Frontend =====
use App\Http\Controllers\Frontend\{
    HomeController, SearchController, PostController, CommentController,
    CategoryController, UserController, TagController, PageController, ContactController
};

// ===== Auth =====
use App\Http\Controllers\Auth\{
    SignupController, LoginController, LogoutController
};

// ===== Dashboard =====
use App\Http\Controllers\Dashboard\{
    HomeController as DashboardHomeController,
    PostController as DashboardPostController,
    CategoryController as DashboardCategoryController,
    CommentController as DashboardCommentController,
    UserController as DashboardUserController,
    PageController as DashboardPageController,
    MediaController, MenuController, ProfileController,
    SiteSettingController, SocialMediaController, TagController as DashboardTagController,
    ContactMessageController
};

// ================= Frontend =================
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

// ================= Auth =================
Route::name('auth.')->group(function () {
    Route::get('/signup', [SignupController::class, 'index'])->name('signup');
    Route::post('/signup', [SignupController::class, 'signup'])->name('signup.submit');

    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

    Route::post('/logout', [LogoutController::class, 'index'])->name('logout');
});

// ================= Dashboard (Auth) =================
Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {

    // Home
    Route::get('/', [DashboardHomeController::class, 'index'])->name('home');

    // -------- Posts --------
    // Resource dulu biar path standar (index, create, store, edit, update, destroy)
    Route::resource('posts', DashboardPostController::class)->except(['show']);

    // Aksi tambahan (gunakan PATCH untuk toggle, GET untuk list trash/restore)
    Route::prefix('posts')->name('posts.')->controller(DashboardPostController::class)->group(function () {
        Route::patch('{id}/status',   'status')->name('status');
        Route::patch('{id}/featured', 'featured')->name('featured');
        Route::patch('{id}/comment',  'comment')->name('comment');

        Route::get('trashed',         'trashed')->name('trashed');
        Route::patch('{id}/restore',  'restore')->name('restore');
        // Untuk hapus permanen (bukan soft delete)
        Route::delete('{id}/force',   'forceDelete')->name('force');
    });

    // -------- Media --------
    Route::resource('media', MediaController::class)->except(['show', 'edit', 'update']);

    // -------- Comments --------
    Route::resource('comments', DashboardCommentController::class)->only(['index','show','destroy']);
    Route::prefix('comments')->name('comments.')->controller(DashboardCommentController::class)->group(function () {
        Route::patch('{id}/status',  'status')->name('status');
        Route::get('trashed',        'trashed')->name('trashed');
        Route::patch('{id}/restore', 'restore')->name('restore');
        Route::delete('{id}/force',  'forceDelete')->name('force');
    });

    // -------- Categories (ADMIN) --------
    Route::middleware([\App\Http\Middleware\AdminMiddleware::class])->group(function () {
        Route::resource('categories', DashboardCategoryController::class);
        Route::prefix('categories')->name('categories.')->controller(DashboardCategoryController::class)->group(function () {
            Route::patch('{id}/status',  'status')->name('status');
            Route::get('trashed',        'trashed')->name('trashed');
            Route::patch('{id}/restore', 'restore')->name('restore');
            Route::delete('{id}/force',  'forceDelete')->name('force');
        });
    });

    // -------- Tags (ADMIN) --------
    Route::middleware([\App\Http\Middleware\AdminMiddleware::class])->group(function () {
        Route::get('tags', [DashboardTagController::class, 'index'])->name('tags.index');
        Route::delete('tags/{id}', [DashboardTagController::class, 'destroy'])->name('tags.destroy');
    });

    // -------- Users (ADMIN) --------
    Route::middleware([\App\Http\Middleware\AdminMiddleware::class])->group(function () {
        Route::resource('users', DashboardUserController::class);
        Route::patch('users/{id}/status', [DashboardUserController::class, 'status'])->name('users.status');
    });

    // -------- Pages (ADMIN) --------
    Route::middleware([\App\Http\Middleware\AdminMiddleware::class])->group(function () {
        Route::resource('pages', DashboardPageController::class)->except(['show']);
        Route::prefix('pages')->name('pages.')->controller(DashboardPageController::class)->group(function () {
            Route::patch('{id}/status',  'status')->name('status');
            Route::get('trashed',        'trashed')->name('trashed');
            Route::patch('{id}/restore', 'restore')->name('restore');
            Route::delete('{id}/force',  'forceDelete')->name('force');
        });
    });

    // -------- Settings (ADMIN sebagian) --------
    Route::prefix('settings')->name('settings.')->group(function () {
        // (ADMIN) Site
        Route::middleware([\App\Http\Middleware\AdminMiddleware::class])->group(function () {
            Route::get('site-settings',  [SiteSettingController::class, 'index'])->name('site');
            Route::post('site-settings', [SiteSettingController::class, 'update'])->name('site.update');

            Route::get('social-media',               [SocialMediaController::class, 'index'])->name('social.media');
            Route::post('social-media',              [SocialMediaController::class, 'add'])->name('social.media.add');
            Route::patch('social-media/{id}/status', [SocialMediaController::class, 'status'])->name('social.media.status');
            Route::delete('social-media/{id}',       [SocialMediaController::class, 'delete'])->name('social.media.delete');

            Route::get('menus/header',  [MenuController::class, 'header'])->name('menus.header');
            Route::post('menus/header', [MenuController::class, 'headerUpdate'])->name('menus.header.update');
            Route::get('menus/footer',  [MenuController::class, 'footer'])->name('menus.footer');
            Route::post('menus/footer', [MenuController::class, 'footerUpdate'])->name('menus.footer.update');
        });

        // (NON-ADMIN) Profile & Password
        Route::get('profile',          [ProfileController::class, 'index'])->name('profile');
        Route::post('profile',         [ProfileController::class, 'update'])->name('profile.update');
        Route::get('change-password',  [ProfileController::class, 'password'])->name('password');
        Route::post('change-password', [ProfileController::class, 'passwordUpdate'])->name('password.update');
    });

    // -------- Contact Messages (ADMIN) --------
    Route::middleware([\App\Http\Middleware\AdminMiddleware::class])->group(function () {
        Route::get('contact-messages',        [ContactMessageController::class, 'index'])->name('contact.index');
        Route::delete('contact-messages/{id}',[ContactMessageController::class, 'destroy'])->name('contact.destroy');
    });

});
