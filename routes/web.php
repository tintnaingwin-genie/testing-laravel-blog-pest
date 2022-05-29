<?php

use App\Http\Controllers\BlogPostAdminController;
use App\Http\Controllers\ExternalPostAdminController;
use App\Http\Controllers\ExternalPostSuggestionController;
use App\Http\Controllers\RedirectAdminController;
use App\Http\Controllers\UpdatePostSlugController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\DeletePostController;
use App\Http\Controllers\UploadController;
use App\Http\Middleware\FormErrorMiddleware;
use App\Models\BlogPost;
use Illuminate\Support\Facades\Route;

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

Route::feeds();

Route::get('/', [BlogPostController::class, 'index']);
Route::get('/blog/{post}', [BlogPostController::class, 'show']);

Route::post('/suggest', ExternalPostSuggestionController::class);

Route::post('/upload', UploadController::class);

Route::redirect('/dashboard', '/admin');

Route::middleware(['auth:sanctum', 'verified', FormErrorMiddleware::class])
    ->prefix('/admin')
    ->group(function () {
        Route::get('/', function () {
            return view('dashboard');
        })->name('dashboard');

        Route::prefix('/blog')->group(function () {
            Route::middleware("can:manage," . BlogPost::class)->group(function () {
                Route::get('/', [BlogPostAdminController::class, 'index']);
                Route::get('/new', [BlogPostAdminController::class, 'create']);
                Route::post('/new', [BlogPostAdminController::class, 'store']);
            });

            Route::middleware("can:manage,post")->group(function () {
                Route::get('/{post}/edit', [BlogPostAdminController::class, 'edit']);
                Route::post('/{post}/edit', [BlogPostAdminController::class, 'update']);
                Route::post('/{post}/publish', [BlogPostAdminController::class, 'publish']);
                Route::post('/{post}/delete', DeletePostController::class);
                Route::post('/{post}/update-slug', UpdatePostSlugController::class);
            });
        });

        Route::get('/redirects', [RedirectAdminController::class, 'index']);

        Route::get('/externals', [ExternalPostAdminController::class, 'index']);
        Route::get('/externals/{externalPost}/approve', [ExternalPostAdminController::class, 'approve']);
        Route::get('/externals/{externalPost}/remove', [ExternalPostAdminController::class, 'remove']);

    });
