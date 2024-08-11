<?php

declare(strict_types=1);

namespace Modules\Submission\Models;

use Faker\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Submission\Database\Factories\SubmissionFactory;

/**
 * @mixin IdeHelperSubmission
 */
class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'message',
    ];

    protected static function newFactory(): SubmissionFactory|Factory
    {
        return new SubmissionFactory();
    }
}
