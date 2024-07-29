@extends('layouts.admin')
@section('title', 'User Details' . $user->name)

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-12">
                <h3>User Details</h3>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2 mb-3">
                                <img src="https://api.dicebear.com/9.x/micah/svg?seed={{ urlencode($user->name) }}"
                                    alt="avatar" class="img-fluid rounded-circle" style="width: 100px;">
                            </div>
                            <div class="col-md-10">
                                <h5 class="card-title">{{ $user->name }}</h5>
                                <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
                                <p class="card-text"><strong>Role:</strong> <button
                                        class="btn btn-primary btn-sm ">{{ ucfirst($user->role) }}</button> </p>
                                <p class="card-text"><strong>Status:</strong> {{ ucfirst($user->status) }}</p>
                                <p class="card-text"><strong>Phone:</strong> {{ $user->phone ?: 'N/A' }}</p>
                                <p class="card-text"><strong>Location:</strong> {{ $user->location ?: 'N/A' }}</p>
                                <p class="card-text"><strong>About Me:</strong> {{ $user->about_me ?: 'N/A' }}</p>
                                <p class="card-text"><strong>Department:</strong>
                                    {{ $user->department ? $user->department->name : 'N/A' }}</p>
                                <a href="{{ route('admin.edit-user', ['role' => $user->role, 'userId' => $user->id]) }}"
                                    class="btn btn-primary">Edit User</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
