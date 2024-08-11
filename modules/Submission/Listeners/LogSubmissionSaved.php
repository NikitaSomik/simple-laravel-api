<?php

declare(strict_types=1);

namespace Modules\Submission\Listeners;

use Illuminate\Support\Facades\Log;
use Modules\Submission\Events\SubmissionSaved;

class LogSubmissionSaved
{
    public function handle(SubmissionSaved $event): void
    {
        $submission = $event->submission;
        Log::info('Submission saved', ['name' => $submission->name, 'email' => $submission->email]);
    }
}
