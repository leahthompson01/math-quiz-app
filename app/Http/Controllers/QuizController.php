<?php

namespace App\Http\Controllers;

use App\Models\Problem;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Inertia\Inertia;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('Problems', [
            'quizzes' => Quiz::where('user_id',)->latest()->get()
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
        $problemsArr = Problem::all()->toArray();
        shuffle($problemsArr);
        $problemsArr = array_slice($problemsArr, 0, 10);
        Quiz::create(["problems" => $problemsArr, "is_quiz_submitted" => false]);
        $quiz = Quiz::all()->last();
        return Inertia::render('Problems',['problems' => $problemsArr, 'id' => $quiz->id ]);
    }


    public function update(Request $request, Quiz $quiz)
    {

        $validated = $request->validate([
            'id' => 'required|int',
        ]);
        $quiz = Quiz::find($validated['id']);
        $quiz->is_quiz_submitted = true;
        $quiz->save();
//        dd($quiz->attributesToArray());
        return Inertia::render('Problems', ['problems' => $quiz->problems, 'id' => 6969 ]);

    }

    public function sendHi(){
        return 'hi';
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
