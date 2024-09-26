<?php

declare(strict_types=1);

namespace Modules\Submission\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Bus\Dispatcher;
use Illuminate\Http\JsonResponse;
use Modules\Submission\DTOs\SubmissionDto;
use Illuminate\Contracts\Routing\ResponseFactory;
use Modules\Submission\Http\Requests\SubmissionRequest;
use Modules\Submission\Jobs\ProcessSubmission;
use Symfony\Component\HttpFoundation\Response;

final class SubmissionController extends Controller
{
    public function __construct(
        private readonly Dispatcher $dispatcher,
        private readonly ResponseFactory $responseFactory
    ) {}

    public function submit(SubmissionRequest $request): JsonResponse
    {
        $submissionDto = new SubmissionDto(...$request->validated());

        $this->dispatcher->dispatch(new ProcessSubmission($submissionDto));

        return $this->responseFactory->json(['message' => 'Submission received and is being processed.'], Response::HTTP_ACCEPTED);
    }
}
