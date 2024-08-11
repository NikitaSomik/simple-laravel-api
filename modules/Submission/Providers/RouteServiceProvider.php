<?php

declare(strict_types=1);

namespace Modules\Submission\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as BaseRouteServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends BaseRouteServiceProvider
{
    public function boot(): void
    {
        $this->routes(function (): void {
            Route::prefix('api')->middleware('api')
                ->group(__DIR__ . '/../routes/api.php');
        });
    }
}
