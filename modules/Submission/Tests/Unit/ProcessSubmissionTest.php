<?php

declare(strict_types=1);

namespace Modules\Submission\Tests\Unit;

use Illuminate\Support\Facades\Event;
use Mockery;
use Modules\Submission\DTOs\SubmissionDto;
use Modules\Submission\Events\SubmissionFailed;
use Modules\Submission\Events\SubmissionSaved;
use Modules\Submission\Jobs\ProcessSubmission;
use Modules\Submission\Models\Submission;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ProcessSubmissionTest extends TestCase
{
    /**
     * @throws \Throwable
     */
    #[Test]
    public function test_it_handle_job_creates_submission_and_dispatches_event_successfully(): void
    {
        Event::fake();

        $submissionDto = new SubmissionDto(...[
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'message' => 'This is a test message.',
        ]);

        $submissionMock = Mockery::mock(Submission::class);
        $submissionMock->shouldReceive('create')
            ->once()
            ->with($submissionDto->toArray())
            ->andReturn(Submission::make([
                ...$submissionDto->toArray(),
                'id' => 1,
            ]));

        $job = new ProcessSubmission($submissionMock, $submissionDto);
        $job->handle();

        $this->assertEquals(0, Submission::count());

        Event::assertDispatched(SubmissionSaved::class, function ($event) use ($submissionDto) {
            return $event->submission instanceof Submission &&
                $event->submission->name === $submissionDto->name &&
                $event->submission->email === $submissionDto->email &&
                $event->submission->message === $submissionDto->message;
        });
    }

    /**
     * @throws \Throwable
     */
    #[Test]
    public function test_it_fails_to_handle_job_and_triggers_submission_failed_event(): void
    {
        Event::fake();

        $submissionDto = new SubmissionDto(...[
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'message' => 'This is a test message.',
        ]);

        $submissionMock = Mockery::mock(Submission::class);
        $submissionMock->shouldReceive('create')
            ->once()
            ->with($submissionDto->toArray())
            ->andThrow(new \Exception('Database error'));

        $job = new ProcessSubmission($submissionMock, $submissionDto);
        $job->handle();

        Event::assertDispatched(SubmissionFailed::class, function ($event) use ($submissionDto) {
            return $event->submissionDto === $submissionDto &&
                $event->exception instanceof \Exception;
        });
    }
}
