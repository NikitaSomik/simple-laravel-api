<?php

declare(strict_types=1);

namespace Modules\Submission\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\Submission\Models\Submission;

class SubmissionSaved
{
    use Dispatchable;
    use SerializesModels;

    public Submission $submission;

    public function __construct(Submission $submission)
    {
        $this->submission = $submission;
    }
}
