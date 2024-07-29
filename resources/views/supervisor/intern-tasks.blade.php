@extends('layouts.supper')

@section('content')
    <div class="container-fluid py-4">
        <!-- Task List -->
        <div class="row mb-3">
            <div class="col-6">
                <h6 class="mb-1">Daftar Tugas Supervisor</h6>
            </div>
            <div class="col-6 text-end">
                <a href="{{ route('supervisor.dashboard') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-arrow-left me-2"></i>
                    Kembali ke Dashboard
                </a>
                <a href="{{ route('supervisor.tasks-approaching-deadline') }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-clock me-2"></i>
                    Tugas Mendekati Deadline
                </a>
                <a href="{{ route('supervisor.tasks-assigned') }}" class="btn btn-info btn-sm">
                    <i class="fas fa-tasks me-2"></i>
                    Tugas yang Ditugaskan
                </a>
                <a href="{{ route('supervisor.tasks-completed') }}" class="btn btn-success btn-sm">
                    <i class="fas fa-check-circle me-2"></i>
                    Tugas yang Selesai
                </a>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <a href="{{ route('supervisor.create-task') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>
                    Buat Tugas Baru
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table id="tasks-table" class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col"
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                                        </th>
                                        <th scope="col"
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Deskripsi</th>
                                        <th scope="col"
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Deadline</th>
                                        <th scope="col"
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                        <th scope="col"
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tasks as $task)
                                        <tr>
                                            <td>{{ $task->name }}</td>
                                            <td>{{ Str::limit($task->task_description, 50) }}</td>
                                            <td>{{ \Carbon\Carbon::parse($task->duedate)->isoFormat('dddd, D MMMM YYYY') }}
                                            </td>
                                            <td>{{ $task->completed ? 'Selesai' : 'Belum Selesai' }}</td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#taskModal{{ $task->id }}">
                                                    Lihat Detail
                                                </button>
                                                <a href="{{ route('supervisor.task-edit', ['taskId' => $task->id]) }}"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <form
                                                    action="{{ route('supervisor.task-delete', ['taskId' => $task->id]) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Apakah Anda yakin untuk menghapus task ini?')">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>

                                        <!-- Modal -->
                                        <div class="modal fade" id="taskModal{{ $task->id }}" tabindex="-1"
                                            aria-labelledby="taskModalLabel{{ $task->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="taskModalLabel{{ $task->id }}">
                                                            {{ $task->name }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><strong>Deskripsi:</strong> {{ $task->task_description }}</p>
                                                        <p><strong>Deadline:</strong>
                                                            {{ \Carbon\Carbon::parse($task->duedate)->isoFormat('dddd, D MMMM YYYY') }}
                                                        </p>
                                                        <p><strong>Status:</strong>
                                                            {{ $task->completed ? 'Selesai' : 'Belum Selesai' }}</p>
                                                        <p><strong>Anak Magang:</strong>
                                                            <td>{{ $task->user->name ?? 'N/A' }}</td>
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal -->
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tasks-table').DataTable();
        });
    </script>
@endsection
