@extends('layout.app')
@section('content')

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-light">Task Management</h1>
        <a href="/maketask" class="btn btn-info">Create Task</a>
    </div>

    <table class="table table-dark table-striped table-hover shadow-lg rounded">
        <thead class="thead-light">
            <tr>
                <th scope="col">Task Name</th>
                <th scope="col">Task Type</th>
                <th scope="col">Task Reason</th>
                <th scope="col">Task Date</th>
                <th scope="col">Task Email</th>
                <th scope="col">Uploaded Image</th>
                <th scope="col" class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
            <tr>
                <td>{{$task->task_name}}</td>
                <td>{{$task->task_type}}</td>
                <td>{{$task->task_reason}}</td>
                <td>{{$task->task_date}}</td>
                <td>{{$task->task_email}}</td>
                <td><img src="{{$task->upload_image}}" alt="Image" style="width: 50px; height: 50px; object-fit: cover;"></td>
                <td class="text-center">
                    <a href="{{route('todo.edit',$task->id)}}" class="btn btn-sm btn-warning me-2">Edit</a>
                    <form action="{{ route('todo.destroy', $task->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
