<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Operands;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Problem>
 */
class ProblemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $rand1 = mt_rand(0, 50);
        $rand2 = mt_rand(0, 50);
        $question = "";
        $operandArr = Operands::cases();
        $operand = $operandArr[array_rand(Operands::cases())]->value;
        $answerChoices = [];
        $correctAnswerIndex = 1;
        if($operand == '+') {
            $question = "What is the sum of " . $rand1 . " + " . $rand2 . "?";
            $correctAnswer = $rand1 + $rand2;
            $answerChoice1 = mt_rand(0, $correctAnswer + 10);
            $answerChoice2 = mt_rand(0, $correctAnswer + 10);
            $answerChoice3 = mt_rand(0, $correctAnswer + 10);
            while ($answerChoice1 == $correctAnswer || $answerChoice2 == $correctAnswer || $answerChoice3 == $correctAnswer) {
                $answerChoice1 = mt_rand(0, $correctAnswer + 10);
                $answerChoice2 = mt_rand(0, $correctAnswer + 10);
                $answerChoice3 = mt_rand(0, $correctAnswer + 10);
            }
            $answerChoices = [$answerChoice1, $answerChoice2, $answerChoice3, $correctAnswer];
            shuffle($answerChoices);
            $correctAnswerIndex = array_search($correctAnswer, $answerChoices);
//            return ['question' => $question, 'answer_choices'=> $answerChoices,'correct_answer_id'=> $correctAnswerIndex, 'quiz_operand' => $operand];
        }
        if($operand == '-') {
            $question = "What is the difference of " . $rand1 . " - " . $rand2 . "?";
            $correctAnswer = $rand1 - $rand2;
            $answerChoice1 = mt_rand($correctAnswer-20, $correctAnswer + 10);
            $answerChoice2 = mt_rand($correctAnswer-20, $correctAnswer + 10);
            $answerChoice3 = mt_rand($correctAnswer-20, $correctAnswer + 10);
            while ($answerChoice1 == $correctAnswer || $answerChoice2 == $correctAnswer || $answerChoice3 == $correctAnswer) {
                $answerChoice1 = mt_rand($correctAnswer-20, $correctAnswer + 10);
                $answerChoice2 = mt_rand($correctAnswer-20, $correctAnswer + 10);
                $answerChoice3 = mt_rand($correctAnswer-20, $correctAnswer + 10);
            }
            $answerChoices = [$answerChoice1, $answerChoice2, $answerChoice3, $correctAnswer];
            shuffle($answerChoices);
            $correctAnswerIndex = array_search($correctAnswer, $answerChoices);
//            return ['question' => $question, 'answer_choices'=> $answerChoices,'correct_answer_id'=> $correctAnswerIndex,'quiz_operand' => $operand];
        }
        return [
            "question" => $question,
            "answer_choices" => $answerChoices,
            "correct_answer_id" => $correctAnswerIndex,
            "quiz_operand" => $operand

        ];
    }
}
