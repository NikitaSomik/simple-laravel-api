<?php

declare(strict_types=1);

namespace Modules\Submission\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Submission\Events\SubmissionSaved;
use Modules\Submission\Listeners\LogSubmissionSaved;

class SubmissionServiceProvider extends ServiceProvider
{

    /**
     * @var array<class-string, array<int, class-string>>
     */
    protected array $listen = [
        SubmissionSaved::class => [
            LogSubmissionSaved::class,
        ],
    ];

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        $this->app->register(RouteServiceProvider::class);
    }
}
