<?php

declare(strict_types=1);

namespace Modules\Submission\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Events\Dispatcher;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Submission\DTOs\SubmissionDto;
use Modules\Submission\Events\SubmissionFailed;
use Modules\Submission\Events\SubmissionSaved;
use Modules\Submission\Services\SubmissionServiceInterface;
use Throwable;

final class ProcessSubmission implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * The number of times the job may be attempted.
     */
    public int $tries = 3;

    public function __construct(private readonly SubmissionDto $submissionDto) {}

    /**
     * Calculate the number of seconds to wait before retrying the job.
     *
     * @return array<int, int>
     */
    public function backoff(): array
    {
        return [1, 5, 7];
    }

    /**
     * Execute the job.
     *
     * @throws Throwable
     */
    public function handle(Dispatcher $dispatcher, SubmissionServiceInterface $submissionService): void
    {
        try {
            $submission = $submissionService->createSubmission($this->submissionDto);

            $dispatcher->dispatch(new SubmissionSaved($submission));
        } catch (Throwable $exception) {
            $dispatcher->dispatch(new SubmissionFailed($this->submissionDto, $exception));

            throw $exception;
        }
    }
}
