@extends('layouts.supper')

@section('content')
    <div class="container-fluid py-4">
        <!-- Intern Details -->
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-8">
                                <h6 class="mb-1">Detail Anak Magang</h6>
                            </div>
                            <div class="col-4 text-end">
                                <a href="{{ route('supervisor.intern-attendance', ['internId' => $intern->id]) }}"
                                    class="btn btn-primary btn-sm">
                                    <i class="fas fa-calendar-alt me-2"></i>
                                    Kehadiran Harian
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        @if ($intern)
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <tbody>
                                        <div class="col-md-2 mb-3">
                                            <img src="https://api.dicebear.com/9.x/micah/svg?seed={{ $intern->name}}"
                                                alt="avatar" class="img-fluid rounded-circle" style="width: 100px;">
                                        </div>
                                        <tr>
                                            <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Nama</td>
                                            <td class="ps-2">{{ $intern->name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Email</td>
                                            <td class="ps-2">{{ $intern->email }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Tanggal Gabung</td>
                                            <td class="ps-2">{{ $intern->created_at }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p>Anak magang tidak ditemukan.</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <!-- Other Details -->
            </div>
        </div>
    </div>
@endsection
