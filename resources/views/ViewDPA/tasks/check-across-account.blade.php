<!-- resources/views/tasks/check.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Check Across Account</h1>
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
@endsection

