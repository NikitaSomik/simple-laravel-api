<?php

declare(strict_types=1);

namespace Modules\Submission\Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Modules\Submission\Jobs\ProcessSubmission;
use Modules\Submission\Models\Submission;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class SubmissionControllerTest extends TestCase
{
    #[Test]
    public function it_can_submit_a_submission(): void
    {
        $requestData = Submission::factory()->make();

        Queue::fake();

        $response = $this->postJson('/api/submit', $requestData->toArray());

        $response->assertStatus(Response::HTTP_ACCEPTED);

        $response->assertJson([
            'message' => 'Submission received and is being processed.',
        ]);

        Queue::assertPushed(ProcessSubmission::class, function ($job) use ($requestData) {
            return $job->submissionDto->email === $requestData->email;
        });
    }

    #[Test]
    public function it_fails_with_invalid_data(): void
    {
        $invalidData = [
            'email' => 'invalid-email',
            // other fields with invalid data
        ];

        $response = $this->postJson('/api/submit', $invalidData);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors(['email']);
    }
}
