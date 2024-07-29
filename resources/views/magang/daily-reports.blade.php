@extends('layouts.magang')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Laporan Harian</h1>
        <a href="{{ route('magang.daily-reports.create') }}" class="btn btn-primary mb-3">Buat Laporan Harian</a>
        <div class="card">
            <div class="card-header bg-primary text-white">
                Riwayat Laporan Harian
            </div>
            <div class="card-body">
                <table id="dailyReportsTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Tugas Selesai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dailyReports as $report)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($report->date)->format('d F Y') }}</td>
                                <td>{{ $report->tasks_completed }}</td>
                                <td>
                                    <a href="{{ route('magang.daily-reports.show', $report->id) }}"
                                        class="btn btn-info btn-sm">Lihat</a>
                                    <a href="{{ route('magang.daily-reports.edit', $report->id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dailyReportsTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
                },
                "pagingType": "full_numbers",
                "pageLength": 10,
                "lengthMenu": [10, 25, 50, 75, 100]
            });
        });
    </script>
@endsection
