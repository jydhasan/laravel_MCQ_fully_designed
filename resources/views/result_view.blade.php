{{-- <h3>Quiz Results</h3>
<p>Correct Answers: {{ $correct_answers }}</p>
<p>Wrong Answers: {{ $wrong_answers }}</p>
<p>Total Questions: {{ $total_questions }}</p>
<p>Percentage: {{ $percentage }}%</p>

<h4>Question-wise Results:</h4>
@foreach ($question_results as $questionId => $isCorrect)
    <p>
        Question {{ $questionId }}: 
        @if ($isCorrect)
            <span style="color: green;">Correct</span>
        @else
            <span style="color: red;">Incorrect</span>
        @endif
    </p>
@endforeach --}}

{{-- <h3>Quiz Results</h3>
<p>Correct Answers: {{ $correct_answers }}</p>
<p>Wrong Answers: {{ $wrong_answers }}</p>
<p>Total Questions: {{ $total_questions }}</p>
<p>Percentage: {{ $percentage }}%</p> --}}
<h3>Quiz Results</h3>
<p>Correct Answers: {{ $correct_answers }}</p>
<p>Wrong Answers: {{ $wrong_answers }}</p>
<p>Unanswered Questions: {{ $unanswered_questions }}</p>
<p>Total Questions: {{ $total_questions }}</p>
<p>Percentage: {{ $percentage }}%</p>

<h4>Question-wise Results:</h4>
@foreach ($question_results as $questionId => $result)
    <p>
        Question {{ $questionId }}:
        @if ($result === true)
            <span style="color: green;">Correct</span>
        @elseif ($result === false)
            <span style="color: red;">Incorrect</span>
        @else
            <span style="color: orange;">Unanswered</span>
        @endif
    </p>
    <p>
        Question: {{ $questions->where('id', $questionId)->first()->question }}
    </p>
    <p>
        Option A: {{ $questions->where('id', $questionId)->first()->option1 }}
    </p>
    <p>
        Option B: {{ $questions->where('id', $questionId)->first()->option2 }}
    </p>
    <p>
        Option C: {{ $questions->where('id', $questionId)->first()->option3 }}
    </p>
    <p>
        Option D: {{ $questions->where('id', $questionId)->first()->option4 }}
    </p>
    @if ($result !== null)
        <!-- Only display if the question was answered -->
        <p>
            Correct Answer: {{ $questions->where('id', $questionId)->first()->answer }}
        </p>
        <p>
            Your Answer: {{ $request->input('answer' . $questionId) }}
        </p>
    @endif
    <hr>
@endforeach
