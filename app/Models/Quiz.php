<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use phpDocumentor\Reflection\Types\Boolean;



/**
 * @method static create(array $data),
 */

class Quiz extends Model
{
    use HasFactory;
    protected $fillable = [
        'problems',
        'is_quiz_submitted',
        'user_id',
//        'selected_answers'
    ];

    protected $casts = [
        'is_quiz_submitted' => 'boolean',
        'problems' => 'array',
//        'selected_answers' => 'array'
    ];
//    protected array $problems;
//    protected Boolean $isQuizSubmitted = false;
//    protected string $quizOperand;
    public static function firstOrCreate(array $array)
    {
    }

    public static function find(mixed $id)
    {
        return Quiz::query()->find($id);
    }



    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

//    public function getProblems(): array
//    {
//        return $this->;
//    }
    public function problem(): BelongsTo
    {
        return $this->belongsTo(Problem::class);
    }
}
