@extends('layouts.supper')

@section('content')
    <div class="container-fluid py-4">
        <!-- Intern Daily Reports -->
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-6">
                                <h6 class="mb-1">Laporan Harian Anak Magang</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tanggal</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Laporan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dailyReports as $report)
                                        <tr>
                                            <td>{{ $report->date }}</td>
                                            <td>{{ $report->content }}</td>
                                        </tr>
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
