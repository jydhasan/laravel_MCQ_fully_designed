<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Box;
use App\Models\User;
// Use DB;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;


class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    // show teacher profile
    public function profile()
    {
        if (auth()->user()->teacher_status == 'inactive') {
            return redirect()->back()->with('error', 'You are not a teacher');
        }else{
            // get box data where teacher_id=auth()->user()->id
            $boxes = Box::where('teacher_id', auth()->user()->id)->get();
            return view('teacher.profile', compact('boxes'));
        }
        // get auth user id
        // $user_id = auth()->user()->id;
        // get user
        // $user = User::find($user_id);
        // compact user
        // return view('teacher.profile', compact('user'));
        // get quizzes
        // return view('teacher.profile');
    }
    // add_quiz_server
    public function add_quiz_server(Request $request)
    {
        // get auth user id
        $user_id = auth()->user()->id;
        // receive data from form quiz_title,quiz_subject,quiz_time,csvfile
        $quiz_title = $request->quiz_title;
        $quiz_subject = $request->quiz_subject;
        $quiz_time = $request->quiz_time;
        $csvfile = $request->csvfile;
        // quiz_table_name=quiz_title+random number
        $quiz_table_name = $user_id.'quiz_table_name'. time();
        $quiz_result_table_name =$quiz_table_name.'_result';
        // check if the file is a csv file
        $file_ext = strtolower($csvfile->getClientOriginalExtension());
        if ($file_ext != 'csv') {
            return redirect()->back()->with('error', 'Please upload a csv file');
        }
        // check if the file is empty
        $file_size = $csvfile->getSize();
        if ($file_size == 0) {
            return redirect()->back()->with('error', 'Please upload a non-empty csv file');
        }
        // check if the file is valid
        $file = fopen($csvfile, 'r');
        $row = fgetcsv($file);
        if ($row[0] != 'question' || $row[1] != 'option1' || $row[2] != 'option2' || $row[3] != 'option3' || $row[4] != 'option4' || $row[5] != 'answer') {
            return redirect()->back()->with('error', 'Please upload a valid csv file');
        }
        // check if the quiz_title is unique
        // $quiz_title_check = \App\Models\Quiz::where('quiz_title', $quiz_title)->first();
        // if ($quiz_title_check) {
        //     return redirect()->back()->with('error', 'Please enter a unique quiz title');
        // }
        // check if the quiz_time is valid
        if ($quiz_time < 1) {
            return redirect()->back()->with('error', 'Please enter a valid quiz time');
        }
        // create quiz
        // $quiz = new \App\Models\Quiz;
        // Model is Box
        $quiz = new Box;
        $quiz->quiz_title = $quiz_title;
        $quiz->teacher_id = $user_id;
        $quiz->quiz_subject = $quiz_subject;
        $quiz->quiz_time = $quiz_time;
        $quiz->quiz_table_name=$quiz_table_name;
        $quiz->quiz_result_table_name=$quiz_result_table_name;
        $quiz->save();
        // create quiz table
        Schema::create($quiz_table_name, function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('option1');
            $table->string('option2');
            $table->string('option3');
            $table->string('option4');
            $table->string('answer');
            // $table->timestamps();
        });
        // create quiz result table
        Schema::create($quiz_result_table_name, function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('quiz_id');
            $table->integer('score');
            $table->timestamps();
        });

        // create questions
        while (!feof($file)) {
            $row = fgetcsv($file);
        
            // Check if $row is not false (indicating end of file or an error)
            if ($row !== false) {
        
                // Check if all required fields are not null
                if (
                    isset($row[0]) && $row[0] !== null &&
                    isset($row[1]) && $row[1] !== null &&
                    isset($row[2]) && $row[2] !== null &&
                    isset($row[3]) && $row[3] !== null &&
                    isset($row[4]) && $row[4] !== null &&
                    isset($row[5]) && $row[5] !== null
                ) {
                    DB::table($quiz_table_name)->insert([
                        'question' => $row[0],
                        'option1' => $row[1],
                        'option2' => $row[2],
                        'option3' => $row[3],
                        'option4' => $row[4],
                        'answer' => $row[5],
                    ]);
                }
            }
        }
        
        fclose($file);
        return redirect()->back()->with('success', 'Quiz added successfully');


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
