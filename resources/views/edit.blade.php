@extends('layout.app')
@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center mb-4">Edit Task</h2>

            <form action="{{ route('todo.update', $todo->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <div class="mb-3">
                    <label for="task_name" class="form-label">Task Name</label>
                    <input type="text" id="task_name" name="task_name" class="form-control" value="{{ old('task_name', $todo->task_name) }}" required>
                    @error('task_name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="task_date" class="form-label">Task Date</label>
                    <input type="date" id="task_date" name="task_date" class="form-control" value="{{ old('task_date', $todo->task_date) }}" required>
                    @error('task_date')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="task_reason" class="form-label">Task Reason</label>
                    <input type="text" id="task_reason" name="task_reason" class="form-control" value="{{ old('task_reason', $todo->task_reason) }}" required>
                    @error('task_reason')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="task_type" class="form-label">Task Type</label>
                    <input type="text" id="task_type" name="task_type" class="form-control" value="{{ old('task_type', $todo->task_type) }}" required>
                    @error('task_type')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="task_email" class="form-label">Task Email</label>
                    <input type="email" id="task_email" name="task_email" class="form-control" value="{{ old('task_email', $todo->task_email) }}" required>
                    @error('task_email')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="upload_image" class="form-label">Upload Image URL</label>
                    <input type="text" id="upload_image" name="upload_image" class="form-control" value="{{ old('upload_image', $todo->upload_image) }}">
                    @error('upload_image')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-dark w-100">Update Task</button>
            </form>

            <div class="text-center mt-3">
                <a href="{{ route('todo.index') }}" class="btn btn-secondary">Back to Tasks</a>
            </div>
        </div>
    </div>
</div>

@endsection
