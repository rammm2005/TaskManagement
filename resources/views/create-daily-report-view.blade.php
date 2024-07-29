@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Buat Laporan Harian</h2>
        <form method="POST" action="{{ route('daily-reports.store') }}">
            @csrf
            <div class="form-group">
                <label for="date">Tanggal</label>
                <input type="date" class="form-control" id="date" name="date" value="{{ date('Y-m-d') }}">
            </div>
            <div class="form-group">
                <label for="tasks_completed">Tugas yang Dikerjakan</label>
                <textarea class="form-control" id="tasks_completed" name="tasks_completed" rows="5"></textarea>
            </div>
            <div class="form-group">
                <label for="feedback">Umpan Balik</label>
                <textarea class="form-control" id="feedback" name="feedback" rows="5"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Buat Laporan</button>
        </form>
    </div>
@endsection
