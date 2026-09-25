@extends('layouts.app')

@section('content')
    <h1>Edit Task</h1>

    <form action="{{ route('tasks.update', $task) }}" method="POST" class="task-form">
        @csrf
        @method('PUT')

        <label for="task_name">Task Name *</label>
        <input type="text" name="task_name" id="task_name" value="{{ old('task_name', $task->task_name) }}">

        <label for="description">Description</label>
        <textarea name="description" id="description" rows="4">{{ old('description', $task->description) }}</textarea>

        <label for="status">Status</label>
        <select name="status" id="status">
            <option value="Pending" @selected(old('status', $task->status) === 'Pending')>Pending</option>
            <option value="Completed" @selected(old('status', $task->status) === 'Completed')>Completed</option>
        </select>

        <label for="due_date">Due Date</label>
        <input type="date" name="due_date" id="due_date" value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}">

        <div>
            <button type="submit" class="btn btn-primary">Update Task</button>
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection