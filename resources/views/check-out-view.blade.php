@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Check-Out</h2>
        <form method="POST" action="{{ route('attendance.check-out') }}">
            @csrf
            <div class="form-group">
                <label for="date">Tanggal</label>
                <input type="date" class="form-control" id="date" name="date" value="{{ date('Y-m-d') }}">
            </div>
            <div class="form-group">
                <label for="check_out_time">Waktu Check-Out</label>
                <input type="time" class="form-control" id="check_out_time" name="check_out_time">
            </div>
            <button type="submit" class="btn btn-primary">Check-Out</button>
        </form>
    </div>
@endsection
