<?php

declare(strict_types=1);

namespace Modules\Submission\Services;

use Illuminate\Database\DatabaseManager;
use Modules\Submission\DTOs\SubmissionDto;
use Modules\Submission\Models\Submission;

final readonly class SubmissionService implements SubmissionServiceInterface
{
    public function __construct(
        private DatabaseManager $databaseManager,
        private Submission $submission
    ) {}

    public function createSubmission(SubmissionDto $submissionDto): Submission
    {
        return $this->databaseManager->transaction(fn () => $this->submission->create($submissionDto->toArray()));
    }
}
