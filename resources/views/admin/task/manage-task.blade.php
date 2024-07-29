@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Kelola Tugas</h1>
        <div class="mb-3">
            <button id="exportExcelBtn" class="btn btn-success">Export to Excel</button>
        </div>
        <table id="tasksTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Nama Tugas</th>
                    <th>Deskripsi</th>
                    <th>Deadline</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->name }}</td>
                        <td>{{ Str::limit($task->task_description, 50) }}</td>
                        <td>{{ \Carbon\Carbon::parse($task->due_date)->format('d-m-Y') }}</td>
                        <td>{{ $task->completed ? 'Selesai' : 'Belum Selesai' }}</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#taskModal{{ $task->id }}">
                                Detail
                            </button>
                        </td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="taskModal{{ $task->id }}" tabindex="-1"
                        aria-labelledby="taskModalLabel{{ $task->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="taskModalLabel{{ $task->id }}">Detail Tugas</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h5>Nama Tugas: {{ $task->name }}</h5>
                                    <p>Deskripsi: {{ $task->task_description }}</p>
                                    <p>Deadline: {{ \Carbon\Carbon::parse($task->due_date)->format('d-m-Y') }}</p>
                                    <p>Status: {{ $task->completed ? 'Selesai' : 'Belum Selesai' }}</p>
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

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.4/xlsx.full.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#tasksTable').DataTable();
        });



        document.getElementById('exportExcelBtn').addEventListener('click', function() {
            var table = document.getElementById('tasksTable');
            var ws = XLSX.utils.table_to_sheet(table);
            var wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, 'Rekap Tugas');
            XLSX.writeFile(wb, 'rekap-tugas.xlsx');
        });
    </script>
@endsection
