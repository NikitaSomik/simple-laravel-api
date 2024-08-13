<?php

declare(strict_types=1);

namespace Modules\Submission\Services;

use Modules\Submission\DTOs\SubmissionDto;
use Modules\Submission\Models\Submission;

interface SubmissionServiceInterface
{
    public function createSubmission(SubmissionDto $submissionDto): Submission;
}
