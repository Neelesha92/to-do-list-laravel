<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container">
        <h1>Edit Task</h1>

        <!-- Success and Error Messages -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any()))
            <div class="alert alert-error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Edit Task Form -->
        <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="task-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" value="{{ old('title', $task->title) }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description">{{ old('description', $task->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="priority">Priority:</label>
                <select name="priority" id="priority">
                    <option value="low" {{ $task->priority === 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ $task->priority === 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="high" {{ $task->priority === 'high' ? 'selected' : '' }}>High</option>
                </select>
            </div>

            <div class="form-group">
                <label for="deadline">Deadline:</label>
                <input type="date" name="deadline" id="deadline" value="{{ old('deadline', $task->deadline) }}">
            </div>

            <button type="submit" class="btn-submit">Update Task</button>
        </form>

        <br>
        <a href="{{ route('tasks.index') }}" class="btn-back">Back to Task List</a>
    </div>
</body>
</html>