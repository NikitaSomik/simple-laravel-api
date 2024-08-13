<?php

declare(strict_types=1);

namespace Modules\Submission\Services;

use Modules\Submission\DTOs\SubmissionDto;
use Modules\Submission\Models\Submission;

final readonly class SubmissionService implements SubmissionServiceInterface
{
    public function __construct(public Submission $submission)
    {
    }

    public function createSubmission(SubmissionDto $submissionDto): Submission
    {
        return $this->submission->create($submissionDto->toArray());
    }
}
