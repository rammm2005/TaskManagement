@extends('layouts.supper')

@section('content')
    <div class="container">
        <h1>Dashboard</h1>
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Total Interns</h5>
                        <p class="card-text" id="totalInterns">Loading...</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Attendance Today</h5>
                        <p class="card-text" id="attendanceToday">Loading...</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Tasks Completed</h5>
                        <p class="card-text" id="tasksCompleted">Loading...</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <canvas id="attendanceChart"></canvas>
            </div>
            <div class="col-lg-6">
                <canvas id="tasksChart"></canvas>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Pastikan jQuery dimuat sebelum script Anda -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Fetch data dari controller
            var totalInterns = {{ $interns->count() }};
            var attendanceToday = {{ $attendanceSummary['today'] ?? 0 }};
            var tasksCompleted = {{ $tasksSummary['completed'] ?? 0 }};

            // Update nilai pada kartu informasi
            $('#totalInterns').text(totalInterns);
            $('#attendanceToday').text(attendanceToday);
            $('#tasksCompleted').text(tasksCompleted);

            // Data untuk grafik kehadiran
            var attendanceData = {!! json_encode($attendanceSummary['daily'] ?? []) !!};
            var attendanceLabels = Object.keys(attendanceData);
            var attendanceValues = Object.values(attendanceData);

            // Inisialisasi grafik kehadiran
            var ctx = document.getElementById('attendanceChart').getContext('2d');
            var attendanceChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: attendanceLabels,
                    datasets: [{
                        label: 'Attendance',
                        data: attendanceValues,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Data untuk grafik tugas selesai
            var tasksData = {!! json_encode($tasksSummary['weekly'] ?? []) !!};
            var tasksLabels = Object.keys(tasksData);
            var tasksValues = Object.values(tasksData);

            // Inisialisasi grafik tugas selesai
            var ctx2 = document.getElementById('tasksChart').getContext('2d');
            var tasksChart = new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: tasksLabels,
                    datasets: [{
                        label: 'Tasks Completed',
                        data: tasksValues,
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endsection
