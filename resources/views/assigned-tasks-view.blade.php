@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tugas yang Diberikan</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Deskripsi Tugas</th>
                    <th>Deadline</th>
                    <th>Pengingat</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($assignedTasks as $task)
                    <tr>
                        <td>{{ $task->task_description }}</td>
                        <td>{{ $task->due_date }}</td>
                        <td>{{ $task->reminder }}</td>
                        <td>{{ $task->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
