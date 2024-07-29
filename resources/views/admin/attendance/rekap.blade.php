@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Rekap Kehadiran</h1>
        <div class="mb-3">
            <button id="exportPdfBtn" class="btn btn-primary">Export to PDF</button>
            <button id="exportExcelBtn" class="btn btn-success">Export to Excel</button>
        </div>
        <table id="rekapTable" class="table table-striped">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Waktu Masuk</th>
                    <th>Waktu Keluar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attendances as $attendance)
                    <tr>
                        <td>{{ $attendance->user->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d-m-Y') }}</td>
                        <td>{{ $attendance->check_in_time }}</td>
                        <td>{{ $attendance->check_out_time ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.4/xlsx.full.min.js"></script>
    <script>
        document.getElementById('exportPdfBtn').addEventListener('click', function() {
            var doc = new jsPDF();
            doc.autoTable({
                html: '#rekapTable'
            });
            doc.save('rekap-kehadiran.pdf');
        });

        document.getElementById('exportExcelBtn').addEventListener('click', function() {
            var table = document.getElementById('rekapTable');
            var ws = XLSX.utils.table_to_sheet(table);
            var wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, 'Rekap Kehadiran');
            XLSX.writeFile(wb, 'rekap-kehadiran.xlsx');
        });
    </script>
@endsection
