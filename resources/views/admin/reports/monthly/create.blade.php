@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Buat Laporan Bulanan</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('monthly.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="month">Bulan:</label>
                <input type="date" name="month_year" id="month" placeholder="Eg: 2024-07" class="form-control" required>
                @error('month_year')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

            </div>
            <div class="form-group">
                <label for="content">Isi Laporan:</label>
                <textarea name="content" id="content" class="form-control" required></textarea>
                @error('content')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('monthly-reports.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
