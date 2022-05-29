<?php

namespace App\Providers;

use App\Models\BlogPost;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/dashboard';

    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });

        $this->setUpRouteBinding();
    }

    private function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }

    private function setUpRouteBinding(): void
    {
        Route::bind('post', function (string|int $slug) {
            if (is_int($slug)) {
                return BlogPost::find($slug);
            }

            return BlogPost::where('slug', $slug)->first();
        });

        Route::bind('postId', function (int $id) {
            return BlogPost::findOrFail($id);
        });
    }
}
