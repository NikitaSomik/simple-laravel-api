<?php

declare(strict_types=1);

namespace Modules\Submission\Providers;

use Modules\Submission\Events\SubmissionSaved;
use Modules\Submission\Listeners\LogSubmissionSaved;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as BaseEventServiceProvider;

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
