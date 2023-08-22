<!-- resources/views/tasks/assign.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Assign Task</h1>
        <form action="{{ route('tasks.assign') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="user_id">Select User:</label>
                <select name="user_id" class="form-control">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="title">Task Title:</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Assign Task</button>
        </form>
    </div>
@endsection
