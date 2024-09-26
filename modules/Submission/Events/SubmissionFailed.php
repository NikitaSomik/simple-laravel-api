<?php

declare(strict_types=1);

namespace Modules\Submission\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\Submission\DTOs\SubmissionDto;
use Throwable;

final readonly class SubmissionFailed
{
    use Dispatchable;
    use SerializesModels;

    public function __construct(public SubmissionDto $submissionDto, public Throwable $exception) {}
}
