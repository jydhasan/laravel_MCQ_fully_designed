@extends('layouts.home')
@section('title', 'welcome')
@section('content')
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>quiz_title</th>
                <th>quiz_subject</th>
                <th>quiz_time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($boxes as $box)
                <tr>
                    <td>{{ $box->id }}</td>
                    <td>{{ $box->quiz_title }}</td>
                    <td>{{ $box->quiz_subject }}</td>
                    <td>{{ $box->quiz_time }}</td>
                    <td>
                        <a href="{{ route('student.start_quiz', $box->quiz_table_name) }}" class="btn btn-primary">Start</a>
                    </td>
                </tr>
            @endforeach
            @if ($boxes->isEmpty())
                <tr>
                    <td colspan="5">No data found</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>


@endsection