<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use Inertia\Inertia;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Quiz/Index', [
            'quizzes' => Quiz::with('user:id,name')->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        $validated = $request->validate([
//            'problems' => 'required|array<Problem>|max:4',
//        ]);
        $request->user()->quizzes()->create([]);
        return redirect()->route('quiz.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(Quiz $quiz)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quiz $quiz)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quiz $quiz)
    {
        $quiz->update([]);
        return redirect()->route('quiz.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
    }
    public function generateProblems(string $quizOperand)
    {
        $answerChoices = [];
        $questions = [];
        if ($quizOperand == "+") {
            $rand1 = mt_rand(0, 50);
            $rand2 = mt_rand(0, 50);
            $question = "What is the sum of" . $rand1 . " + " . $rand2 . " ?";
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
//                $problem = ["question" => $question, "correctAnswerId" => $correctAnswerIndex, "answerChoices" => $answerChoices];
            return ["questions" => $questions, "isQuizSubmitted" => false, 'operand' => $quizOperand];
        }

        if ($quizOperand == "-") {
            $problemArr = [];
            $questions = [];
            if ($quizOperand == "+") {
                for ($i = 1; $i <= 4; $i++) {
                    $rand1 = mt_rand(0, 50);
                    $rand2 = mt_rand(0, 50);
                    $question = "What is the difference of" . $rand1 . " - " . $rand2 . " ?";
                    $correctAnswer = $rand1 - $rand2;
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
                    $questions[$i] = ["question" => $question, "correctAnswerId" => $correctAnswerIndex, "answerChoices" => $answerChoices];
                }
                return ["questions" => $questions, "isQuizSubmitted" => false, 'operand' => $quizOperand];
            }

            return array(array(
                "question" => "",
                "answers" => array(),
                "correctAnswerIndex" => 3
            ));


        }
    }}
