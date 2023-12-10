@extends('layouts.home')
@section('title', 'Running Quiz')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3  bg-light p-3 shadow">
                <h1>Quiz</h1>
                <form action="{{ route('student.running_quiz_result') }}" method="POST">
                    @csrf
                    @foreach ($questions as $item)
                        <div class="question">
                            <p><span>{{ $item->id }}.</span>&nbsp;{{ $item->question }}</p>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answer{{ $item->id }}" value="a" id="q{{ $item->id }}a">
                                <label class="form-check-label" for="q{{ $item->id }}a">{{ $item->option1 }}</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answer{{ $item->id }}" value="b" id="q{{ $item->id }}b">
                                <label class="form-check-label" for="q{{ $item->id }}b">{{ $item->option2 }}</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answer{{ $item->id }}" value="c" id="q{{ $item->id }}c">
                                <label class="form-check-label" for="q{{ $item->id }}c">{{ $item->option3 }}</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answer{{ $item->id }}" value="d" id="q{{ $item->id }}d">
                                <label class="form-check-label" for="q{{ $item->id }}d">{{ $item->option4 }}</label>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                    <button type="submit" class="btn btn-primary">Submit Quiz</button>
                </form>
                
            </div>
        </div>
    </div>
@endsection
