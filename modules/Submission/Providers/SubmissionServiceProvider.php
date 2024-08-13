<?php

declare(strict_types=1);

namespace Modules\Submission\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Submission\Models\Submission;
use Modules\Submission\Services\SubmissionService;
use Modules\Submission\Services\SubmissionServiceInterface;

class SubmissionServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        $this->app->register(RouteServiceProvider::class);
        $this->app->register(EventServiceProvider::class);
    }

    public function register(): void
    {
        $this->app->bind(SubmissionServiceInterface::class, function ($app) {
            return new SubmissionService(new Submission());
        });
    }
}
