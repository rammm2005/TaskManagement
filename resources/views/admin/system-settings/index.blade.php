@extends('layouts.admin')
@section('title', 'System Settings')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title">System Settings</h4>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <a href="{{ route('admin.system-settings.general') }}">Pengaturan Umum Sistem</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('admin.system-settings.backup-restore') }}">Backup dan Restore Data</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
