<?php

declare(strict_types=1);

namespace Modules\Submission\Listeners;

use Modules\Submission\Events\SubmissionSaved;
use Psr\Log\LoggerInterface;

class LogSubmissionSaved
{
    public function __construct(private LoggerInterface $logger) {}

    public function handle(SubmissionSaved $event): void
    {
        $submission = $event->submission;
        $this->logger->info('Submission saved', ['name' => $submission->name, 'email' => $submission->email]);
    }
}
