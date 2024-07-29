@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Edit Laporan Bulanan</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('monthly-reports.update', $report->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="month">Bulan:</label>
                <input type="date" name="month_year" id="month" class="form-control"
                    value="{{ old('month_year', $report->month_year) }}" required>
                @error('month_year')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="content">Isi Laporan:</label>
                <textarea name="content" id="content" class="form-control" required>{{ old('content', $report->content) }}</textarea>
                @error('content')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Perbarui</button>
            <a href="{{ route('monthly-reports.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
