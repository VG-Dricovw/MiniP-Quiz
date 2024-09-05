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
        // dd($request->all());

        $quiz = new Question();
        $quiz->chapter = $request->chapter;
        $quiz->question = $request->question;
        $quiz->answer = $request->answer;
        $quiz->save();
        return redirect('/')->with('success', "question created");
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
        if (Question::where('id', $id)->exists()) {
            $question = Question::find($id);
            $question->delete();

            return redirect('/quiz/display/display')->with('success', "question deleted");
        } else {
            return redirect('/quiz/display/display')->with('warning', "could not find the question");

        }

    }

    public function grade(Request $request)
    {
        $quizz = Question::all();
        $data = [];
        // $request = $request->orderBy();
        $amountCorrect = 0;
        // dump($request->get(5));
        // dump($quizz[5]);
        if (count($quizz) === count($request->all()) - 1) {
            for ($i = 1; $i < count($request->all()); $i++) {
                // dump(strtolower($request->get($i)));
                // dump(strtolower($quizz[$i - 1]['answer']));
                if (strtolower($quizz[$i - 1]['answer']) == strtolower($quizz[$i - 1]['answer'])) {
                    $amountCorrect++;
                }
                array_push($data, ["question" => strtolower($quizz[$i - 1]['answer']), "answer" => strtolower($quizz[$i - 1]['answer'])]);
            }
            $data += ["correct" => $amountCorrect];
            // dd($data);
            return view("/quiz/result", compact("data"));
        } else {
            return redirect("/quiz/display/take")->with("warning", "fill in all the fields");
        }
    }
}
//$data += ["question" => $quizz[$i - 1]['answer'], "answer" => $request->get($i)];
