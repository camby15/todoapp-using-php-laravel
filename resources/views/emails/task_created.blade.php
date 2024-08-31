@extends('layout.app')
@section('content')

<body>
<h1>A new task has been created</h1>
    <p><strong>Task Name:</strong> {{ $task['task_name'] }}</p>
    <p><strong>Task Type:</strong> {{ $task['task_type'] }}</p>
    <p><strong>Task Email:</strong> {{ $task['task_email'] }}</p>
    <p><strong>Task Reason:</strong> {{ $task['task_reason'] }}</p>
    <p><strong>Upload Image:</strong> {{ $task['upload_image'] }}</p>
</body>


@endsection