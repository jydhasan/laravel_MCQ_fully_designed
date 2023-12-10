@extends('layouts.home')
@section('title', 'profile')
@section('content')
{{-- navbar --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    {{-- Upload quiz --}}
    <div class="container">
        <form action="{{ route('teacher.add_quiz_server') }}" class="  p-5" method="post"
            enctype="multipart/form-data">
            {{-- success message --}}
            @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                    @php
                        Session::forget('success');
                    @endphp
                </div>
            @endif
            {{-- error message --}}
            @if (Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                    @php
                        Session::forget('error');
                    @endphp
                </div>
            @endif

            @csrf
            <div class="mb-3">
                <label for="quiz_title">quiz_title</label>
                <input type="text" name="quiz_title" id="quiz_title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="quiz_subject">quiz_subject</label>
                <input type="text" name="quiz_subject" id="quiz_subject" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="quiz_time">quiz_time</label>
                <input type="text" name="quiz_time" id="quiz_time" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Default file input example</label>
                <input class="form-control" type="file" id="formFile" name="csvfile" accept=".csv" required>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    {{-- quiz list --}}
    <div class="container">
        <table class="table">
            <thead>
                <tr class="bg-light">
                    <th>quiz_title</th>
                    <th>quiz_subject</th>
                    <th>quiz_time</th>
                    <th>quiz_status</th>
                    {{-- <th>quiz_result</th> --}}
                    <th>quiz_action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($boxes as $item)
                    <tr>
                        <td>{{ $item->quiz_title }}</td>
                        <td>{{ $item->quiz_subject }}</td>
                        <td>{{ $item->quiz_time }}</td>
                        {{-- if quiz_live_status is live then show red background else primary --}}
                        @if ($item->quiz_live_status == 'live')
                            <td class="bg-primary">{{ $item->quiz_live_status }}</td>
                        @else
                        <td>{{ $item->quiz_live_status }}</td>
                        @endif

                        {{-- <td>{{ $item->created_at }}</td> --}}
                        <td>
                            {{-- dropdown menu with active ,inactive, delete   --}}
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Action
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="#">Active</a></li>
                                    <li><a class="dropdown-item" href="#">Inactive</a></li>
                                    <li><a class="dropdown-item" href="#">Delete</a></li>
                                </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>
@endsection
