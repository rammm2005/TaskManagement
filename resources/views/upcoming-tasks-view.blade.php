@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tugas yang Mendekati Deadline</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Deskripsi Tugas</th>
                    <th>Deadline</th>
                    <th>Waktu Tersisa</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($upcomingTasks as $task)
                    <tr>
                        <td>{{ $task->task_description }}</td>
                        <td>{{ $task->due_date }}</td>
                        <td>{{ $task->due_date->diffForHumans() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
