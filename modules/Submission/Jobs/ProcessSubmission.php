<?php

declare(strict_types=1);

namespace Modules\Submission\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Submission\DTOs\SubmissionDto;
use Modules\Submission\Events\SubmissionSaved;
use Modules\Submission\Models\Submission;

class ProcessSubmission implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * @param SubmissionDto $submissionDto
     */
    public function __construct(protected SubmissionDto $submissionDto)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $submission = Submission::create($this->submissionDto->toArray());
        event(new SubmissionSaved($submission));
    }
}
