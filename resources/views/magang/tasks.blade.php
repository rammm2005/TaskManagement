@extends('layouts.magang')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Tugas</h1>
        <div class="card">
            <div class="card-header bg-primary text-white">
                Daftar Tugas
            </div>
            <div class="card-body">
                <table id="tasksTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Tugas</th>
                            <th>Deskripsi</th>
                            <th>Deadline</th>
                            <th>Status</th>
                            <th>Trigger</th>
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
                                    <form action="{{ route('magang.tasks.complete', ['id' => $task->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success btn-sm">Selesai</button>
                                    </form>
                                </td>
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
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tasksTable').DataTable({
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
