<?php

declare(strict_types=1);

namespace Modules\Submission\Tests\Unit;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Event;
use Mockery;
use Modules\Submission\DTOs\SubmissionDto;
use Modules\Submission\Events\SubmissionFailed;
use Modules\Submission\Events\SubmissionSaved;
use Modules\Submission\Jobs\ProcessSubmission;
use Modules\Submission\Models\Submission;
use Modules\Submission\Services\SubmissionService;
use Modules\Submission\Services\SubmissionServiceInterface;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ProcessSubmissionTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

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

        // Create and configure the mock service
        $mockSubmissionService = Mockery::mock(SubmissionServiceInterface::class);
        $mockSubmissionService->shouldReceive('createSubmission')
            ->once()
            ->with($submissionDto)
            ->andReturn(
                new Submission([
                    ...$submissionDto->toArray(),
                    'id' => 1,
                ])
            );

        // Bind the mock service to the service container
        App::instance(SubmissionServiceInterface::class, $mockSubmissionService);

        /** @var SubmissionServiceInterface $mockSubmissionService */
        (new ProcessSubmission($submissionDto))->handle($mockSubmissionService);

        $this->assertEquals(0, Submission::count());

        // Assert that the event was dispatched
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

        // Create and configure the mock service
        $mockSubmissionService = Mockery::mock(SubmissionService::class);
        $mockSubmissionService->shouldReceive('createSubmission')
            ->once()
            ->with($submissionDto)
            ->andThrow(new \Exception('Database error'));

        /** @var SubmissionServiceInterface $mockSubmissionService */
        (new ProcessSubmission($submissionDto))->handle($mockSubmissionService);

        // Assert that the SubmissionFailed event was dispatched
        Event::assertDispatched(SubmissionFailed::class, fn ($event) => ($event->submissionDto === $submissionDto &&
            $event->exception instanceof \Exception));
    }
}
