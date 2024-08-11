<?php

declare(strict_types=1);

namespace Modules\Submission\DTOs;

use Illuminate\Contracts\Support\Arrayable;

readonly class SubmissionDto implements Arrayable
{
    public function __construct(
        public string $name,
        public string $email,
        public string $message
    ) {
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'message' => $this->message,
        ];
    }
}
