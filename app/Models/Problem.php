<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Random\RandomException;

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

    /**
     * @throws RandomException
     */
    public static function addition(int $rand1, int $rand2, string $operand): array
    {
        $question = "What is the sum of " . $rand1 . " + " . $rand2 . "?";
        $correctAnswer = $rand1 + $rand2;
        $answerChoice1 = random_int(0, $correctAnswer + 10);
        $answerChoice2 = random_int(0, $correctAnswer + 10);
        $answerChoice3 = random_int(0, $correctAnswer + 10);
        while ($answerChoice1 == $correctAnswer || $answerChoice2 == $correctAnswer || $answerChoice3 == $correctAnswer) {
            $answerChoice1 = random_int(0, $correctAnswer + 10);
            $answerChoice2 = random_int(0, $correctAnswer + 10);
            $answerChoice3 = random_int(0, $correctAnswer + 10);
        }
        $answerChoices = [$answerChoice1, $answerChoice2, $answerChoice3, $correctAnswer];
        shuffle($answerChoices);
        $correctAnswerIndex = array_search($correctAnswer, $answerChoices);
        return ['question' => $question, 'answer_choices'=> $answerChoices,'correct_answer_id'=> $correctAnswerIndex, 'quiz_operand' => $operand];
    }

    /**
     * @throws RandomException
     */
    public static function subtraction(int $rand1, int $rand2, string $operand): array
    {
        $question = "What is the difference of " . $rand1 . " - " . $rand2 . "?";
        $correctAnswer = $rand1 - $rand2;
        $answerChoice1 = random_int($correctAnswer-20, $correctAnswer + 10);
        $answerChoice2 = random_int($correctAnswer-20, $correctAnswer + 10);
        $answerChoice3 = random_int($correctAnswer-20, $correctAnswer + 10);
        while ($answerChoice1 == $correctAnswer || $answerChoice2 == $correctAnswer || $answerChoice3 == $correctAnswer) {
            $answerChoice1 = random_int($correctAnswer-20, $correctAnswer + 10);
            $answerChoice2 = random_int($correctAnswer-20, $correctAnswer + 10);
            $answerChoice3 = random_int($correctAnswer-20, $correctAnswer + 10);
        }
        $answerChoices = [$answerChoice1, $answerChoice2, $answerChoice3, $correctAnswer];
        shuffle($answerChoices);
        $correctAnswerIndex = array_search($correctAnswer, $answerChoices);
        return ['question' => $question, 'answer_choices'=> $answerChoices,'correct_answer_id'=> $correctAnswerIndex,'quiz_operand' => $operand];
    }
}
