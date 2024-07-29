@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Check-In</h2>
        <form method="POST" action="{{ route('attendance.check-in') }}">
            @csrf
            <div class="form-group">
                <label for="date">Tanggal</label>
                <input type="date" class="form-control" id="date" name="date" value="{{ date('Y-m-d') }}">
            </div>
            <div class="form-group">
                <label for="check_in_time">Waktu Check-In</label>
                <input type="time" class="form-control" id="check_in_time" name="check_in_time">
            </div>
            <button type="submit" class="btn btn-primary">Check-In</button>
        </form>
    </div>
@endsection
