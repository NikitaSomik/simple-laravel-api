<?php

declare(strict_types=1);

namespace Modules\Submission\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Modules\Submission\Jobs\ProcessSubmission;
use Modules\Submission\Http\Requests\SubmissionRequest;

class SubmissionController extends Controller
{
    public function submit(SubmissionRequest $request): JsonResponse
    {
        $validated = $request->validated();

        ProcessSubmission::dispatch($validated);

        return response()->json(['message' => 'Submission received and is being processed.'], 202);
    }
}
