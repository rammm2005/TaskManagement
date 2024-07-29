@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Supervisor Dashboard</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Kehadiran Anak Magang Hari Ini</div>
                    <div class="card-body">
                        @foreach ($interns as $intern)
                            <div class="intern-item">
                                <h4>{{ $intern->name }}</h4>
                                @if ($intern->todayAttendance)
                                    <p>Check-In: {{ $intern->todayAttendance->check_in_time }}</p>
                                    <p>Check-Out: {{ $intern->todayAttendance->check_out_time }}</p>
                                @else
                                    <p>Belum Check-In</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Laporan Harian Terbaru</div>
                    <div class="card-body">
                        @foreach ($interns as $intern)
                            @foreach ($intern->dailyReports as $report)
                                <div class="report-item">
                                    <h4>{{ $intern->name }} ({{ $report->date }})</h4>
                                    <p>Tugas yang Dikerjakan: {{ $report->tasks_completed }}</p>
                                    <a href="{{ route('daily-reports.show', $report->report_id) }}" class="btn btn-primary">Lihat Laporan</a>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Tugas yang Mendekati
