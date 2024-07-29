@extends('layouts.supper')

@section('content')
    <div class="container">
        <h1>Kehadiran Harian Anak Magang - {{ $intern->name }}</h1>
        <a href="{{ route('supervisor.show-intern', ['internId' => $intern->id]) }}" class="btn btn-sm btn-info">Kembali</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attendances as $attendance)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($attendance->date)->isoFormat('dddd, D MMMM YYYY') }}</td>
                        <td>{{ \Carbon\Carbon::parse($attendance->check_in)->isoFormat('HH:mm:ss') }}</td>
                        <td>{{ \Carbon\Carbon::parse($attendance->check_out)->isoFormat('HH:mm:ss') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
