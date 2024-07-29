@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Intern Dashboard</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Kehadiran Hari Ini</div>
                    <div class="card-body">
                        @if ($todayAttendance)
                            <p>Check-In: {{ $todayAttendance->check_in_time }}</p>
                            <p>Check-Out: {{ $todayAttendance->check_out_time }}</p>
                        @else
                            <p>Belum Check-In</p>
                        @endif
                        <a href="{{ route('attendance.check-in') }}" class="btn btn-primary">Check-In</a>
                        <a href="{{ route('attendance.check-out') }}" class="btn btn-primary">Check-Out</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Tugas yang Mendekati Deadline</div>
                    <div class="card-body">
                        @foreach ($upcomingTasks as $task)
                            <div class="task-item">
                                <h4>{{ $task->task_description }}</h4>
                                <p>Deadline: {{ $task->due_date }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Laporan Harian Terbaru</div>
                    <div class="card-body">
                        @if ($latestReport)
                            <p>Tanggal: {{ $latestReport->date }}</p>
                            <p>Tugas yang Dikerjakan: {{ $latestReport->tasks_completed }}</p>
                            <a href="{{ route('daily-reports.show', $latestReport->report_id) }}" class="btn btn-primary">Lihat Laporan</a>
                        @else
                            <p>Belum Ada Laporan</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
