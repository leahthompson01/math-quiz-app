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
    public function index(Request $request): \Inertia\Response
    {
        $validated = $request->validate([
            'id' => 'required|int',
        ]);

        $request['id'] = (int)$validated['id'];
        return Inertia::render('Problems', [
            'quizzes' => Quiz::all()->where('id',$request['id'])
        ]);
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
//        dd($quiz);
        return Inertia::render('Problems',['problems' => $problemsArr, 'id' => $quiz->id ]);
    }


    public function update(Request $request, Quiz $quiz): \Inertia\Response
    {

        $validated = $request->validate([
            'id' => 'required|int',
        ]);
        $quiz = Quiz::find($validated['id']);
//        dd($quiz);
        $quiz->is_quiz_submitted = true;
        $quiz->save();
//        dd($quiz->attributesToArray());
        return Inertia::render('Problems', ['problems' => $quiz->problems, 'id' => $quiz ]);

    }

//    public function sendHi(){
//        return 'hi';
//    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
    }
}
