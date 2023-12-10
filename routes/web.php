<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
////////////////////////////////////////////////// Studrnt Controller //////////////////////////////////////////////////    
Route::get('/', [StudentController::class, 'index']);
// join_course
Route::get('/join_course/{id}', [StudentController::class, 'join_course'])->name('student.join_course');
// student.start_quiz
Route::get('/student/start_quiz/{quiz_table_name}', [StudentController::class, 'start_quiz'])->name('student.start_quiz');
// student.running_quiz_result
Route::post('/student/running_quiz_result', [StudentController::class, 'running_quiz_result'])->name('student.running_quiz_result');



// //////////////////////////////////////////////Teacher Controller //////////////////////////////////////////////////
Route::middleware('auth')->group(function () {
    // teacher.profile
    Route::get('/profile/teacher', [TeacherController::class, 'profile'])->name('teacher.profile');
    // add_quiz_server
    Route::post('/add_quiz_server', [TeacherController::class, 'add_quiz_server'])->name('teacher.add_quiz_server');
    // teacher
    Route::get('/teacher', [TeacherController::class, 'index'])->name('teacher.index');
    Route::get('/teacher/create', [TeacherController::class, 'create'])->name('teacher.create');
    Route::post('/teacher', [TeacherController::class, 'store'])->name('teacher.store');
    Route::get('/teacher/{teacher}', [TeacherController::class, 'show'])->name('teacher.show');
    Route::get('/teacher/{teacher}/edit', [TeacherController::class, 'edit'])->name('teacher.edit');
    Route::patch('/teacher/{teacher}', [TeacherController::class, 'update'])->name('teacher.update');
    Route::delete('/teacher/{teacher}', [TeacherController::class, 'destroy'])->name('teacher.destroy');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
