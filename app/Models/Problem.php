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
    private static function generateAnswerChoices(int $correctAnswer, int $lowerRange, int $upperRange): array{

        $answerChoice1 = random_int($lowerRange, $upperRange);
        $answerChoice2 = random_int($lowerRange, $upperRange);
        $answerChoice3 = random_int($lowerRange, $upperRange);
        $answerChoices = [$answerChoice1, $answerChoice2, $answerChoice3];
        $uniqueArr = array_unique($answerChoices);
        while (count($uniqueArr) < 4) {
            $answerChoice1 = random_int($lowerRange, $upperRange);
            $answerChoice2 = random_int($lowerRange, $upperRange);
            $answerChoice3 = random_int($lowerRange, $upperRange);
            $uniqueArr =  array_unique([$correctAnswer, $answerChoice1, $answerChoice2, $answerChoice3]);
        }
        $answerChoices = [$answerChoice1, $answerChoice2, $answerChoice3, $correctAnswer];
        shuffle($answerChoices);
        return $answerChoices;
    }
    /**
     * @throws RandomException
     */
    public static function addition(int $rand1, int $rand2, string $operand): array
    {
        $question = "What is " . $rand1 . " + " . $rand2 . "?";
        $correctAnswer = $rand1 + $rand2;
        $answerChoices = self::generateAnswerChoices($correctAnswer, 0, $correctAnswer + 10);
        $correctAnswerIndex = array_search($correctAnswer, $answerChoices);
        return ['question' => $question, 'answer_choices'=> $answerChoices,'correct_answer_id'=> $correctAnswerIndex, 'quiz_operand' => $operand];
    }

    /**
     * @throws RandomException
     */
    public static function subtraction(int $rand1, int $rand2, string $operand): array
    {
        $question = "What is " . $rand1 . " - " . $rand2 . "?";
        $correctAnswer = $rand1 - $rand2;
        $answerChoices = self::generateAnswerChoices($correctAnswer, $correctAnswer-20, $correctAnswer + 10);
        $correctAnswerIndex = array_search($correctAnswer, $answerChoices);
        return ['question' => $question, 'answer_choices'=> $answerChoices,'correct_answer_id'=> $correctAnswerIndex,'quiz_operand' => $operand];
    }


}
