<?php

declare(strict_types=1);

namespace Modules\Submission\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as BaseRouteServiceProvider;

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
