@extends('layouts.magang')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6>Profil {{ Auth::user()->name }}</h6>
                    </div>
                    <div class="card-body pt-4">
                        <div class="row mb-4">
                            <div class="col-md-2 mb-3">
                                <img src="https://api.dicebear.com/9.x/micah/svg?seed={{ urlencode(Auth::user()->name) }}"
                                    alt="avatar" class="img-fluid rounded-circle" style="width: 100px;">
                            </div>
                            <div class="col-lg-3">
                                <h6 class="text-uppercase text-muted mb-0">Nama</h6>
                                <p class="mb-3">{{ Auth::user()->name }}</p>
                            </div>
                            <div class="col-lg-3">
                                <h6 class="text-uppercase text-muted mb-0">Email</h6>
                                <p class="mb-3">{{ Auth::user()->email }}</p>
                            </div>
                            <div class="col-lg-3">
                                <h6 class="text-uppercase text-muted mb-0">Role</h6>
                                <p class="mb-3">
                                    @foreach (Auth::user()->getRoleNames() as $role)
                                        <button class="btn btn-primary btn-sm">
                                            {{ $role }}
                                        </button>
                                    @endforeach
                                </p>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-3">
                                <h6 class="text-uppercase text-muted mb-0">Alamat</h6>
                                <p class="mb-3">{{ Auth::user()->location }}</p>
                            </div>
                            <div class="col-lg-3">
                                <h6 class="text-uppercase text-muted mb-0">Telepon</h6>
                                <p class="mb-3">0{{ Auth::user()->phone }}</p>
                            </div>
                            <div class="col-lg-3">
                                <h6 class="text-uppercase text-muted mb-0">Tanggal Bergabung</h6>
                                <p class="mb-3">{{ Auth::user()->created_at->format('d F Y H:i:s') }}</p>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-3">
                                <h6 class="text-uppercase text-muted mb-0">Departemen</h6>
                                <p class="mb-3">
                                    @if ($intern->department)
                                        <button class="btn btn-success">{{ $intern->department->name }}</button>
                                    @else
                                        N/A
                                    @endif
                                </p>
                            </div>
                            <div class="col-lg-5">
                                <h6 class="text-uppercase text-muted mb-0">About Me</h6>
                                <p class="mb-3">{{ $intern->about_me ?: '-' }}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <a href="{{ route('magang.editProfile') }}" class="btn btn-primary">Edit Profil</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
