<?php

declare(strict_types=1);

namespace Modules\Submission\Providers;

use Illuminate\Support\ServiceProvider;

class SubmissionServiceProvider extends ServiceProvider
{

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        $this->app->register(RouteServiceProvider::class);
        $this->app->register(EventServiceProvider::class);
    }
}
