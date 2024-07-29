@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tugas yang Selesai</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Deskripsi Tugas</th>
                    <th>Deadline</th>
                    <th>Tanggal Selesai</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($completedTasks as $task)
                    <tr>
                        <td>{{ $task->task_description }}</td>
                        <td>{{ $task->due_date }}</td>
                        <td>{{ $task->completion_date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
