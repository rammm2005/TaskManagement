@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h1 class="mb-4">Laporan Bulanan</h1>
        <a href="{{ route('monthly-reports.create') }}" class="btn btn-primary mb-3">Buat Laporan Bulanan</a>
        <button class="btn btn-success btn-sm" id="exportExcelBtn">Export Laporan</button>
        <table class="table table-striped" id="monReportsTable">
            <thead>
                <tr>
                    <th>Nama Pengguna</th>
                    <th>Bulan</th>
                    <th>Konten</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reports as $report)
                    <tr>
                        <td>{{ $report->user->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($report->month_year)->format('F Y') }}</td>
                        <td>{{ Str::limit($report->content, 50) }}</td>
                        <td>
                            <a href="{{ route('monthly-reports.edit', $report->id) }}"
                                class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('monthly-reports.destroy', $report->id) }}" method="POST"
                                class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
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
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#monReportsTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
                },
                "pagingType": "full_numbers",
                "pageLength": 10,
                "lengthMenu": [10, 25, 50, 75, 100]
            });
        });
    </script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.4/xlsx.full.min.js"></script>
    <script>
        document.getElementById('exportExcelBtn').addEventListener('click', function() {
            var table = document.getElementById('monReportsTable');
            let monthYear = 'report a month';
            let formattedMonthYear = monthYear.toLocaleString('default', {
                month: 'long',
                year: 'numeric'
            });
            var ws = XLSX.utils.table_to_sheet(table);
            var wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, 'Rekap Laporan Bulanan');
            XLSX.writeFile(wb, `rekap-laporan-bulanan-${formattedMonthYear}.xlsx`);
        });
    </script>
@endsection
