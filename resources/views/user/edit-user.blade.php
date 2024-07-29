@extends('layouts.admin')

@section('title', 'Edit ' . ucfirst($role))

@section('content')
    <div class="container-fluid py-4">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-12">
                <h3>Edit {{ ucfirst($role) }} || {{ $user->name }}</h3>
                <form action="{{ route('admin.update-user', ['role' => $role, 'userId' => $user->id]) }}" method="POST">
                    @csrf

                    <input type="hidden" name="role" value="{{ $role }}">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            value="{{ $user->phone }}">
                    </div>
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" class="form-control" id="location" name="location"
                            value="{{ $user->location }}">
                    </div>
                    <div class="form-group">
                        <label for="department_id">Department</label>
                        <select class="form-control" id="department_id" name="department_id">
                            <option value="">Select Department</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}"
                                    {{ $user->department_id == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="active" {{ (old('status') ?? $user->status) == 'active' ? 'selected' : '' }}>
                                Active</option>
                            <option value="inactive"
                                {{ (old('status') ?? $user->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="blocked" {{ (old('status') ?? $user->status) == 'blocked' ? 'selected' : '' }}>
                                Blocked</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="about_me">About Me</label>
                        <textarea class="form-control" id="about_me" name="about_me" rows="3">{{ $user->about_me }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
