<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\Submission\Http\Controllers\Api\SubmissionController;

Route::post('/submit', [SubmissionController::class, 'submit']);
