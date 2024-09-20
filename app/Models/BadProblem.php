<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BadProblem extends Model
{
    use HasFactory;

    protected string $question;

    protected int $correctAnswerIndex;

    protected array $answerChoices;

    public static function create()
    {
    }
}
