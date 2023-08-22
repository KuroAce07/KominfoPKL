@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Task Management</div>

                <div class="card-body">
                    <!-- Task Creation Form -->
                    <form action="{{ url('/tasks') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">Task Title:</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Create Task</button>
                    </form>

                    <hr>

                    <!-- Task List -->
                    <h4>My Tasks:</h4>
                    <ul>
                        @foreach ($tasks as $task)
                        <li>
                            <form action="{{ url("/tasks/{$task->id}") }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <label>
                                    <input type="checkbox" name="completed" {{ $task->completed ? 'checked' : '' }}>
                                    {{ $task->title }}
                                </label>
                                <button type="submit" class="btn btn-success btn-sm">Update</button>
                            </form>
                            <form action="{{ url("/tasks/{$task->id}") }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </li>
                        @endforeach
                    </ul>

                    <!-- Check Across Account Dropdown -->
                    <h4>Check Across Account:</h4>
                    <form action="{{ route('tasks.check-across-account') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="user_id">Select User:</label>
                            <select name="user_id" class="form-control">
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Check Tasks</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
