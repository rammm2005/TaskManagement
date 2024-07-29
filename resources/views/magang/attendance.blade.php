@extends('layouts.magang')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Kehadiran</h6>
                        <div>
                            <form action="{{ route('magang.checkIn') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-primary">Check In</button>
                            </form>
                            <form action="{{ route('magang.checkOut') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger">Check Out</button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body pt-4">
                        <h6>Riwayat Kehadiran Hari Ini</h6>
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Check In</th>
                                        <th>Check Out</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($attendances as $attendance)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($attendance->date)->isoFormat('dddd, D MMMM YYYY') }}
                                            </td>
                                            <td>{{ $attendance->check_in_time }}</td>
                                            <td>{{ $attendance->check_out_time }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <a href="{{ route('magang.attendanceHistory') }}" class="btn btn-secondary mt-3">Riwayat
                            Kehadiran</a>
                    </div>
                </div>
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
    <script>
        $(document).ready(function() {
            $('.datatable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
                }
            });
        });
    </script>
@endsection
