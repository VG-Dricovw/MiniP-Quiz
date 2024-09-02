<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class QuizAPIController extends Controller
{

    public function index()
    {
        $quiz = Question::all();
        if ($quiz->count() > 0) {
            return response()->json($quiz);
        } else {
            return redirect()->back()->with("error", "no quiz found");
        }

    }

    public function store(Request $request)
    {
        $quiz = new Question();
        $quiz->chapter = $request->chapter;
        $quiz->question = $request->question;
        $quiz->answer = $request->answer;
        $quiz->save();
        return response()->json([
            "message" => "question added",
            "id"=> $quiz->id
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

    public function update(Request $request, $id)
    {
        if (Question::where('id', $id)->exists()) {
            $question = Question::find($id);
            $question->chapter = is_null($request->chapter) ? $question->chapter : $request->chapter;
            $question->question = is_null($request->question) ? $question->question : $request->question;
            $question->answer = is_null($request->answer) ? $question->answer : $request->answer;
            $question->save();
            return response()->json([
                'message' => 'question updated'
            ], 200);
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

            return response()->json([
                "message" => "deleted question"
            ], 202);
        } else {
            return response()->json([
                "message" => "question no found"
            ], 404);

        }

    }
}