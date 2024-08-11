<?php

declare(strict_types=1);

namespace Modules\Submission\Events;

use Illuminate\Queue\SerializesModels;
use Modules\Submission\Models\Submission;
use Illuminate\Foundation\Events\Dispatchable;

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
