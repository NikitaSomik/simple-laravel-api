<?php

declare(strict_types=1);

namespace Modules\Submission\Listeners;

use Modules\Submission\Events\SubmissionFailed;
use Psr\Log\LoggerInterface;

final readonly class LogSubmissionFailed
{
    public function __construct(private LoggerInterface $logger) {}

    public function handle(SubmissionFailed $event): void
    {
        $this->logger->error('Submission processing failed: ', [
            'exception' => $event->exception->getMessage(),
            'submission' => $event->submissionDto->toArray(),
        ]);
    }
}
