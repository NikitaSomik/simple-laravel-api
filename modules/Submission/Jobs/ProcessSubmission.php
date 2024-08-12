<?php

declare(strict_types=1);

namespace Modules\Submission\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Modules\Submission\DTOs\SubmissionDto;
use Modules\Submission\Events\SubmissionFailed;
use Modules\Submission\Events\SubmissionSaved;
use Modules\Submission\Models\Submission;
use Throwable;

class ProcessSubmission implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * The number of times the job may be attempted.
     */
    public int $tries = 3;

    public function __construct(public Submission $submission, public SubmissionDto $submissionDto)
    {
    }

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
    public function handle(): void
    {
        DB::transaction(function (): void {
            try {
                $submission = $this->submission::create($this->submissionDto->toArray());
                event(new SubmissionSaved($submission));
            } catch (Throwable $exception) {
                $this->failed($exception);
            }
        });
    }

    /**
     * Handle a job failure.
     */
    public function failed(?Throwable $exception): void
    {
        event(new SubmissionFailed($this->submissionDto, $exception));
    }
}
