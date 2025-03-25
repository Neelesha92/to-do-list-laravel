<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TO DO LIST</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container">
        <h1>TO DO LIST</h1>

        <a href="{{ route('tasks.create') }}" class="btn-create">Create New Task</a>

        <div class="task-list">
            @foreach($tasks as $task)
                <div class="task-card">
                    <div class="task-header">
                        <strong>{{ $task->title }}</strong>
                        <span class="status {{ $task->completed ? 'completed' : 'incomplete' }}">
                            {{ $task->completed ? 'Completed' : 'Incomplete' }}
                        </span>
                    </div>
                    <div class="task-body">
                        <p>{{ $task->description }}</p>
                        <div class="task-meta">
                            <span>Priority: {{ $task->priority }}</span>
                            <span>Deadline: {{ $task->deadline }}</span>
                        </div>
                    </div>
                    <div class="task-actions">
                        @if(!$task->completed)
                            <form action="{{ route('tasks.complete', $task->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-complete">Mark as Completed</button>
                            </form>
                        @else
                            <form action="{{ route('tasks.incomplete', $task->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-incomplete">Mark as Incomplete</button>
                            </form>
                        @endif
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn-edit">Edit</a>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>