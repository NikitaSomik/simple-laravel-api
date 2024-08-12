<?php

declare(strict_types=1);

namespace Modules\Submission\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Submission\DTOs\SubmissionDto;
use Modules\Submission\Http\Requests\SubmissionRequest;
use Modules\Submission\Jobs\ProcessSubmission;
use Modules\Submission\Models\Submission;
use Symfony\Component\HttpFoundation\Response;

class SubmissionController extends Controller
{
    public function submit(SubmissionRequest $request, Submission $submission): JsonResponse
    {
        $submissionDto = new SubmissionDto(...$request->validated());

        ProcessSubmission::dispatch($submission, $submissionDto);

        return response()->json(['message' => 'Submission received and is being processed.'], Response::HTTP_ACCEPTED);
    }
}
