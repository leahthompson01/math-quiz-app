<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $data)
 */
class Problem extends Model
{
    protected $fillable = [
        'question',
        'answerChoices',
        'correct_answer_id',
    ];

    protected function casts(): array
    {
        return [
            'answerChoices' => 'array',
        ];
    }
}
