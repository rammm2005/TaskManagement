@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Laporan Harian</h2>

        <div class="row">
            <div class="col-md-6">
                <a href="{{ route('daily-reports.create') }}" class="btn btn-primary">Buat Laporan Baru</a>
            </div>
            <div class="col-md-6">
                <form method="GET" action="{{ route('daily-reports.index') }}">
                    <div class="input-group mb-3">
                        <input type="date" name="date" class="form-control" value="{{ request()->get('date') ?? date('Y-m-d') }}">
                        <button class="input-group-append" type="submit">
                            <span class="input-group-text">Filter</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Tugas yang Dikerjakan</th>
                    <th>Umpan Balik</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dailyReports as $report)
                    <tr>
                        <td>{{ $report->date }}</td>
                        <td>{{ $report->tasks_completed }}</td>
                        <td>{{ $report->feedback }}</td>
                        <td>
                            <a href="{{ route('daily-reports.show', $report->report_id) }}" class="btn btn-sm btn-info">Lihat Detail</a>
                            @if (auth()->user()->can('delete-daily-report', $report))
                                <a href="{{ route('daily-reports.destroy', $report->report_id) }}" class="btn btn-sm btn-danger" data-confirm="Apakah Anda yakin ingin menghapus laporan ini?">Hapus</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Script untuk konfirmasi hapus laporan
            $('[data-confirm]').click(function (e) {
                if (!confirm($(this).data('confirm'))) {
                    e.preventDefault();
                }
            });
        });
    </script>
@endsection
