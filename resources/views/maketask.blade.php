@extends('layout.app')
@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="text-center mb-4">Create New Task</h3>

            <form action="{{ route('todo.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @if(session()->has('good'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ session('good') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="mb-3">
                    <label for="task_name" class="form-label">Task Name</label>
                    <input type="text" id="task_name" name="task_name" class="form-control" value="{{ old('task_name') }}">
                    @error('task_name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="task_type" class="form-label">Task Type</label>
                    <select id="task_type" name="task_type" class="form-select">
                        <option value="coding" {{ old('task_type') == 'coding' ? 'selected' : '' }}>Coding</option>
                        <option value="cooking" {{ old('task_type') == 'cooking' ? 'selected' : '' }}>Cooking</option>
                        <option value="assignment" {{ old('task_type') == 'assignment' ? 'selected' : '' }}>Assignment</option>
                        <option value="jobs" {{ old('task_type') == 'jobs' ? 'selected' : '' }}>Jobs</option>
                        <option value="other-things" {{ old('task_type') == 'other-things' ? 'selected' : '' }}>Other Things</option>
                    </select>
                    @error('task_type')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="task_date" class="form-label">Task Date</label>
                    <input type="date" id="task_date" name="task_date" class="form-control" value="{{ old('task_date') }}">
                    @error('task_date')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="task_email" class="form-label">Task Email</label>
                    <input type="email" id="task_email" name="task_email" class="form-control" value="{{ old('task_email') }}">
                    @error('task_email')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="upload_image" class="form-label">Upload Image</label>
                    <input type="file" id="upload_image" name="upload_image" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="task_reason" class="form-label">Task Reason</label>
                    <textarea id="task_reason" name="task_reason" class="form-control" rows="4">{{ old('task_reason') }}</textarea>
                    @error('task_reason')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-dark w-100">Submit Task</button>
            </form>

            <div class="text-center mt-3">
                <a href="{{ route('todo.index') }}" class="btn btn-primary">View All Tasks</a>
            </div>
        </div>
    </div>
</div>

@endsection
