<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuizController extends Controller
{

    public function index()
    {
        $quiz = Question::all();
        return response()->json($quiz);

    }

    public function display($where)
    {
        $questions = Question::all();
        return view("/quiz/$where", compact("questions"));

    }

    public function create()
    {
        return view("/quiz/create");
    }


    public function store(Request $request)
    {
        dd($request->all());

        $quiz = new Question();
        $quiz->chapter = $request->chapter;
        $quiz->question = $request->question;
        $quiz->answer = $request->answer;
        $quiz->save();
        return response()->json([
            "message" => "question added"
        ], 201);
    }

    public function show($id)
    {
        $question = Question::find($id);
        if (!empty($question)) {
            return response()->json($question);
        } else {
            return response()->json([
                "message" => "question not found"
            ], 404);
        }
    }

    public function edit($id)
    {
        $question = Question::find($id);
        return view("/quiz/edit", compact("question"));
    }

    public function update(Request $request, $id)
    {

        if (Question::where('id', $id)->exists()) {
            $question = Question::find($id);
            $question->chapter = is_null($request->chapter) ? $question->chapter : $request->chapter;
            $question->question = is_null($request->question) ? $question->question : $request->question;
            $question->answer = is_null($request->answer) ? $question->answer : $request->answer;
            $question->save();
            return redirect('quiz/display/display')->with('success', 'updated question');
        } else {
            return response()->json([
                'message' => 'question not found'
            ], 404);
        }
    }

    public function destroy($id)
    {
        dd("destoryryry");
        if (Question::where('id', $id)->exists()) {
            $question = Question::find($id);
            $question->delete();

            return response()->json([
                "message" => "deleted question"
            ], 202);
        } else {
            return response()->json([
                "message" => "question no found"
            ], 404);

        }

    }

    public function grade(Request $request)
    {
        // dd($request->all());
        $quizz = Question::all();

        $amountCorrect = 0;
        if (count($quizz) === count($request->all()) - 1) {
            for ($i = 1; $i < count($quizz); $i++) {
                if ($request->get($i) == $quizz[$i - 1]['answer']) {
                    $amountCorrect++;
                }
            }

            return redirect('/')->with('success',$amountCorrect);
        } else {
            return redirect("/quiz/display/take")->with("warning", "fill in all the fields");
        }
    }
}