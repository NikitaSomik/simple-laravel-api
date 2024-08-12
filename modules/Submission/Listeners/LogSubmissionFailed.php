<?php

declare(strict_types=1);

namespace Modules\Submission\Listeners;

use Illuminate\Support\Facades\Log;
use Modules\Submission\Events\SubmissionFailed;

class LogSubmissionFailed
{
    public function handle(SubmissionFailed $event): void
    {
        Log::error('Submission processing failed: ', [
            'exception' => $event->exception->getMessage(),
            'submission' => $event->submissionDto->toArray(),
        ]);
    }
}
