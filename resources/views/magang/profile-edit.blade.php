@extends('layouts.magang')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Edit Profil</h1>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('magang.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ $user->email }}" required>
                    </div>


                    <div class="mb-3">
                        <label for="email" class="form-label">Lokasi</label>
                        <input type="text" class="form-control" id="email" name="location"
                            value="{{ $user->location }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">No Hp</label>
                        <input type="tel" class="form-control" id="email" name="phone"
                            value="{{ $user->phone }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="about_me" class="form-label">Tentang Saya</label>
                        <textarea class="form-control" id="about_me" name="about_me" rows="3">{{ $user->about_me }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('magang.profile') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
