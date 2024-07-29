@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Lihat Semua Laporan Harian</h1>
        <div class="mb-3">
            <a href="{{ route('monthly-reports.create') }}" class="btn btn-primary mb-3">Buat Laporan Bulanan</a>
            <a href="{{ route('monthly-reports.index') }}" class="btn btn-primary">Lihat Laporan Bulanan</a>
        </div>
        <table id="dailyReportsTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Nama Pengguna</th>
                    <th>User ID</th>
                    <th>Tanggal</th>
                    <th>Isi Laporan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reports as $report)
                    <tr>
                        <td>{{ $report->user->name }}</td>
                        <td>{{ $report->user_id }}</td>
                        <td>{{ \Carbon\Carbon::parse($report->date)->format('d-m-Y') }}</td>
                        <td>{{ Str::limit($report->tasks_completed, 50) }}</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm showReportBtn"
                                data-report-id="{{ $report->id }}" data-bs-toggle="modal"
                                data-bs-target="#reportModal{{ $report->id }}">
                                Show
                            </button>
                        </td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="reportModal{{ $report->id }}" tabindex="-1"
                        aria-labelledby="reportModalLabel{{ $report->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="reportModalLabel{{ $report->id }}">Detail Laporan Harian
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h5>Nama Pengguna: {{ $report->user->name }}</h5>
                                    <p>User ID: {{ $report->user_id }}</p>
                                    <p>Tanggal: {{ \Carbon\Carbon::parse($report->date)->format('d-m-Y') }}</p>
                                    <p>Isi Laporan: {{ $report->tasks_completed }}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/plug-ins/1.11.5/i18n/Indonesian.json"></script>
    <script>
        $(document).ready(function() {
            $('#dailyReportsTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/Indonesian.json"
                },
                "pagingType": "full_numbers",
                "pageLength": 10,
                "lengthMenu": [10, 25, 50, 75, 100]
            });

            // Handle click on "Show" button to display modal
            $('#dailyReportsTable').on('click', '.showReportBtn', function() {
                var reportId = $(this).data('report-id');
                $('#reportModal' + reportId).modal('show');
            });
        });
    </script>
@endsection
