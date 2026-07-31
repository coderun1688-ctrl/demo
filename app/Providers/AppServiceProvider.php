<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\SupportStream\Facades\View;
use Illuminate\Pagination\Paginator;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {


        Paginator::defaultView('vendor.pagination.bootstrap-5');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void{

        //防非法刷新速率限制


        RateLimiter::for('FrontendGlobal', function (Request $request) {
            return Limit::perSecond(1)->response(function (Request $request, array $headers) {
                return response()->view('Access');
            });
        });


        RateLimiter::for('BackendGlobal', function (Request $request) {

            // 每1秒只能訪問1次
            //return Limit::perSecond(1)->by($request->ip())->response(function (Request $request, array $headers) {
            return Limit::perSecond(1)->response(function (Request $request, array $headers) {
                //http_response_code(429);
                //echo 'Too many attempts to access.';
                //exit;
                return response()->view('dashboard.Access');
                /*
                return response()->json([
                    'error' => 'Too many attempts to access.',
                    'retry_after_seconds' => $headers['Retry-After']
                ], 429, $headers);*/
            });

        });
        //停用雙重編碼
        //Blade::withoutDoubleEncoding();

    }
}
