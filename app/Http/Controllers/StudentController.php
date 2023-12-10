<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Box;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class StudentController extends Controller
{
    // index
    public function index()
    {
        $boxes = User::Where('teacher_status', 'active')->get();
        return view('welcome', compact('boxes'));
        // return view('welcome');
    }
    public function join_course(Request $request, $id)
    {
        // Fetch all boxes where teacher_id = $id
        $boxes = Box::where('teacher_id', $id)->get();
    
        return view('student.join_course', compact('boxes'));
    }
    // start_quiz
    public function start_quiz(Request $request, $quiz_table_name)
    {
        // store $quiz_table_name in the session
        $request->session()->put('quiz_table_name', $quiz_table_name);

        // fetch all questions from $quiz_table_name
        $questions = DB::table($quiz_table_name)->get();
        
        // pass the questions to the view
        return view('student.running_quiz', compact('questions'));
    }
    // running_quiz_result
    // public function running_quiz_result(Request $request)
    // {
    //     // retrieve $quiz_table_name from the session
    //     $quiz_table_name = $request->session()->get('quiz_table_name');
    //     // fetch questions and answers from $quiz_table_name
    //     $questions = DB::table($quiz_table_name)->get();
    //     // calculate the total number of questions
    //     $total_questions = count($questions);
    //     // initialize counters
    //     $correct_answers = 0;
    //     $wrong_answers = 0;
    //     // iterate through each question
    //     foreach ($questions as $index => $question) {
    //         // retrieve the submitted answer for the current question
    //         $submitted_answer = $request->input('answer' . $index);
    //         // compare the submitted answer with the correct answer
    //         if ($submitted_answer == $question->answer) {
    //             $correct_answers++;
    //         } else {
    //             $wrong_answers++;
    //         }
    //     }
    //     // calculate the percentage
    //     $percentage = ($correct_answers / $total_questions) * 100;
    //     // show the result
    //     echo 'Correct Answers: ' . $correct_answers . '<br>';
    //     echo 'Wrong Answers: ' . $wrong_answers . '<br>';
    //     echo 'Total Questions: ' . $total_questions . '<br>';
    //     echo 'Percentage: ' . $percentage . '<br>';
    // }
//     public function running_quiz_result(Request $request)
// {
//     // Retrieve $quiz_table_name from the session
//     $quiz_table_name = $request->session()->get('quiz_table_name');
//     // Fetch questions and answers from $quiz_table_name
//     $questions = DB::table($quiz_table_name)->get();
//     // Calculate the total number of questions
//     $total_questions = count($questions);
//     // Initialize counters
//     $correct_answers = 0;
//     $wrong_answers = 0;
//     // Initialize an array to store question-wise correctness
//     $question_results = [];

//     // Iterate through each question
//     foreach ($questions as $index => $question) {
//         // Retrieve the submitted answer for the current question
//         $submitted_answer = $request->input('answer' . $question->id);

//         // Compare the submitted answer with the correct answer
//         if ($submitted_answer == $question->answer) {
//             $correct_answers++;
//             $question_results[$question->id] = true; // Mark the question as correct
//         } else {
//             $wrong_answers++;
//             $question_results[$question->id] = false; // Mark the question as incorrect
//         }
//     }
//     // Calculate the percentage
//     $percentage = ($correct_answers / $total_questions) * 100;
//     // fetch all questions from $quiz_table_name
//     $questions = DB::table($quiz_table_name)->get();
//     // Show the result along with question-wise correctness
//     return view('result_view', compact('correct_answers', 'wrong_answers', 'total_questions', 'percentage', 'question_results', 'questions'));
// }
// public function running_quiz_result(Request $request)
// {
//     // Retrieve $quiz_table_name from the session
//     $quiz_table_name = $request->session()->get('quiz_table_name');
//     // Fetch questions and answers from $quiz_table_name
//     $questions = DB::table($quiz_table_name)->get();
//     // Calculate the total number of questions
//     $total_questions = count($questions);
//     // Initialize counters
//     $correct_answers = 0;
//     $wrong_answers = 0;
//     // Initialize an array to store question-wise correctness
//     $question_results = [];

//     // Iterate through each question
//     foreach ($questions as $index => $question) {
//         // Retrieve the submitted answer for the current question
//         $submitted_answer = $request->input('answer' . $question->id);

//         // Compare the submitted answer with the correct answer
//         if ($submitted_answer == $question->answer) {
//             $correct_answers++;
//             $question_results[$question->id] = true; // Mark the question as correct
//         } else {
//             $wrong_answers++;
//             $question_results[$question->id] = false; // Mark the question as incorrect
//         }
//     }

//     // Calculate the percentage
//     $percentage = ($correct_answers / $total_questions) * 100;

//     // Show the result along with question-wise correctness and questions
//     // return view('result_view', compact('correct_answers', 'wrong_answers', 'total_questions', 'percentage', 'question_results', 'questions'));
//     return view('result_view', compact('correct_answers', 'wrong_answers', 'total_questions', 'percentage', 'question_results', 'questions', 'request'));
// }
public function running_quiz_result(Request $request)
{
    // Retrieve $quiz_table_name from the session
    $quiz_table_name = $request->session()->get('quiz_table_name');
    // Fetch questions and answers from $quiz_table_name
    $questions = DB::table($quiz_table_name)->get();
    // Calculate the total number of questions
    $total_questions = count($questions);
    // Initialize counters
    $correct_answers = 0;
    $wrong_answers = 0;
    $unanswered_questions = 0; // New counter for unanswered questions
    // Initialize an array to store question-wise correctness
    $question_results = [];

    // Iterate through each question
    foreach ($questions as $index => $question) {
        // Retrieve the submitted answer for the current question
        $submitted_answer = $request->input('answer' . $question->id);

        // Check if an answer has been submitted for the current question
        if ($submitted_answer !== null) {
            // Compare the submitted answer with the correct answer
            if ($submitted_answer == $question->answer) {
                $correct_answers++;
                $question_results[$question->id] = true; // Mark the question as correct
            } else {
                $wrong_answers++;
                $question_results[$question->id] = false; // Mark the question as incorrect
            }
        } else {
            $unanswered_questions++;
            $question_results[$question->id] = null; // Mark the question as unanswered
        }
    }

    // Calculate the percentage
    $percentage = ($correct_answers / $total_questions) * 100;

    // Show the result along with question-wise correctness and questions
    return view('result_view', compact('correct_answers', 'wrong_answers', 'unanswered_questions', 'total_questions', 'percentage', 'question_results', 'questions', 'request'));
}



}
