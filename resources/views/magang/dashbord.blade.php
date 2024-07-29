@extends('layouts.magang')

@section('content')
    <div class="container mt-4">
        <h1>Dashboard {{ Auth::user()->name }}</h1>
        <span class="mb-4" style="margin-bottom: 2rem;">Halo <b>{{ Auth::user()->name }}</b> Selamat datang di dashboard
            kamu. Ayo Selesaikan Task kamu dan Buat Kejutan 🚀</span>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card border-primary">
                    <div class="card-header bg-primary text-white">
                        Kehadiran
                    </div>
                    <div class="card-body">
                        <p><strong>Total Hadir:</strong> {{ $attendanceSummary['total_present'] ?? 'Data tidak tersedia' }}
                        </p>
                        <p><strong>Rata-rata Waktu Check-in:</strong>
                            {{ $attendanceSummary['average_check_in_time'] ?? 'Data tidak tersedia' }}</p>
                        <p><strong>Rata-rata Waktu Check-out:</strong>
                            {{ $attendanceSummary['average_check_out_time'] ?? 'Data tidak tersedia' }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card border-success">
                    <div class="card-header bg-success text-white">
                        Tugas
                    </div>
                    <div class="card-body">
                        <p><strong>Total Tugas:</strong> {{ $tasksSummary['total_tasks'] ?? 'Data tidak tersedia' }}</p>
                        <p><strong>Tugas Selesai:</strong> {{ $tasksSummary['completed_tasks'] ?? 'Data tidak tersedia' }}
                        </p>
                        <p><strong>Tugas Mendekati Deadline:</strong>
                            {{ $tasksSummary['approaching_deadline_tasks'] ?? 'Data tidak tersedia' }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card border-warning">
                    <div class="card-header bg-warning text-white">
                        Laporan Harian
                    </div>
                    <div class="card-body">
                        <p><strong>Total Laporan:</strong>
                            {{ $dailyReportsSummary['total_reports'] ?? 'Data tidak tersedia' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
