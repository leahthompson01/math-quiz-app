<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use phpDocumentor\Reflection\Types\Boolean;

class Quiz extends Model
{
    use HasFactory;
    protected array $problems;
    protected Boolean $isQuizSubmitted = false;
    protected string $quizOperand;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getProblems(): array
    {
        return $this->problems;
    }
    public function problem(): BelongsTo
    {
        return $this->belongsTo(Problem::class);
    }
}
