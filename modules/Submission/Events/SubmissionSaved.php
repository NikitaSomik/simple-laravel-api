<?php

declare(strict_types=1);

namespace Modules\Submission\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\Submission\Models\Submission;

final readonly class SubmissionSaved
{
    use Dispatchable;
    use SerializesModels;

    public function __construct(public Submission $submission)
    {
    }
}
