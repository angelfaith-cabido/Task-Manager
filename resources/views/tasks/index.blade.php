@extends('layouts.app')

@section('content')
    <div class="tasks-header">
        <h1>My Tasks</h1>

        <a href="{{ route('tasks.create') }}" class="btn btn-primary">
            + Add Task
        </a>
    </div>

    @if($tasks->isEmpty())
        <p class="empty">
            No tasks yet.
            <a href="{{ route('tasks.create') }}">Add your first task!</a>
        </p>
    @else
        <table class="task-table">
            <thead>
                <tr>
                    <th>Task Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Due Date</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($tasks as $task)
                    <tr class="{{ $task->status === 'Completed' ? 'completed' : '' }}">

                        <td>{{ $task->task_name }}</td>

                        <td>{{ $task->description }}</td>

                        <td>
                            <span class="badge {{ $task->status === 'Completed' ? 'badge-completed' : 'badge-pending' }}">
                                {{ $task->status }}
                            </span>
                        </td>

                        <td>
                            {{ $task->due_date ? $task->due_date->format('M d, Y') : '—' }}
                        </td>

                        <td class="actions">

                            <form action="{{ route('tasks.updateStatus', $task) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')

                                <button type="submit" class="btn btn-small btn-status">
                                    {{ $task->status === 'Pending' ? '✓ Complete' : '↺ Undo' }}
                                </button>
                            </form>

                            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-small btn-edit">
                                Edit
                            </a>

                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Delete this task?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-small btn-delete">
                                    Delete
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection