<?php

declare(strict_types=1);

namespace Modules\Submission\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Submission\Events\SubmissionSaved;
use Modules\Submission\Models\Submission;

class ProcessSubmission implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * @var array<string, string>
     */
    public array $data;

    /**
     * @param  array<string, string>  $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $submission = Submission::create($this->data);
        event(new SubmissionSaved($submission));
    }
}
