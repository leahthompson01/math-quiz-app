<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @method static create(array $data)
 */
class Problem extends Model
{
    use HasFactory;
    protected $fillable = [
        'question',
        'answer_choices',
        'correct_answer_id',
        'quiz_operand'
    ];

    protected function casts(): array
    {
        return [
            'answer_choices' => 'array',
        ];
    }
}
