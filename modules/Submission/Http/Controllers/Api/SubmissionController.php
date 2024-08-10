<?php

declare(strict_types=1);

namespace Modules\Submission\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Modules\Submission\Http\Requests\SubmissionRequest;

class SubmissionController extends Controller
{
    public function submit(SubmissionRequest $request): void {}
}
