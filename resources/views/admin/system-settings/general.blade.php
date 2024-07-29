@extends('layouts.admin')
@section('title', 'Pengaturan Umum Sistem')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title">Pengaturan Umum Sistem</h4>
                        <form action="{{ route('admin.system-settings.update', $siteSettings->id) }}" method="POST">
                            @csrf
                            @method('POST')

                            <div class="mb-3">
                                <label for="site_name" class="form-label">Nama Situs</label>
                                <input type="text" class="form-control" id="site_name" name="site_name"
                                    value="{{ $siteSettings->site_name ?? old('site_name') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="site_description" class="form-label">Deskripsi Situs</label>
                                <textarea class="form-control" id="site_description" name="site_description" rows="3">{{ $siteSettings->site_description ?? old('site_description') }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="instagram" class="form-label">Instagram</label>
                                <input type="text" class="form-control" id="instagram" name="instagram"
                                    value="{{ $siteSettings->instagram ?? old('instagram') }}">
                            </div>

                            <div class="mb-3">
                                <label for="twitter" class="form-label">Twitter</label>
                                <input type="text" class="form-control" id="twitter" name="twitter"
                                    value="{{ $siteSettings->twitter ?? old('twitter') }}">
                            </div>

                            <div class="mb-3">
                                <label for="facebook" class="form-label">Facebook</label>
                                <input type="text" class="form-control" id="facebook" name="facebook"
                                    value="{{ $siteSettings->facebook ?? old('facebook') }}">
                            </div>

                            <div class="mb-3">
                                <label for="linkedin" class="form-label">LinkedIn</label>
                                <input type="text" class="form-control" id="linkedin" name="linkedin"
                                    value="{{ $siteSettings->linkedin ?? old('linkedin') }}">
                            </div>


                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
