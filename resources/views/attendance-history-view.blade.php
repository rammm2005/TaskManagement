@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Riwayat Kehadiran</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Waktu Check-In</th>
                    <th>Waktu Check-Out</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attendanceHistory as $attendance)
                    <tr>
                        <td>{{ $attendance->date }}</td>
                        <td>{{ $attendance->check_in_time }}</td>
                        <td>{{ $attendance->check_out_time }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
