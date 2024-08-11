<?php

declare(strict_types=1);

namespace Modules\Submission\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as BaseEventServiceProvider;
use Modules\Submission\Events\SubmissionSaved;
use Modules\Submission\Listeners\LogSubmissionSaved;

class EventServiceProvider extends BaseEventServiceProvider
{
    /**
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        SubmissionSaved::class => [
            LogSubmissionSaved::class,
        ],
    ];
}
