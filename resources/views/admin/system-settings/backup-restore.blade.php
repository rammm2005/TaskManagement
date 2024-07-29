@extends('layouts.admin')
@section('title', 'Backup dan Restore Data')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title">Backup dan Restore Data</h4>
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <div class="mb-3">
                            <form action="{{ route('admin.system-settings.backup') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Create Backup</button>
                            </form>
                        </div>
                        <div>
                            <form action="{{ route('admin.system-settings.restore') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="backup_file">Select Backup File</label>
                                    <input type="file" class="form-control" id="backup_file" name="backup_file" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Restore Backup</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
