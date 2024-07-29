@extends('layouts.admin')
@section('title', 'User Management - ' . Auth::user()->name)
@section('content')
    <div class="container-fluid py-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="row mb-3">
            <div class="col-lg-12">
                <a href="{{ route('admin.create-user', ['role' => 'magang']) }}" class="btn btn-primary">Create Intern</a>
                <a href="{{ route('admin.create-user', ['role' => 'supervisor']) }}" class="btn btn-primary">Create
                    Supervisor</a>
                <a href="{{ route('admin.create-user', ['role' => 'admin']) }}" class="btn btn-primary">Create Admin</a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <h3>Interns</h3>
                <table class="table table-striped" id="internsTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($interns as $intern)
                            <tr>
                                <td>{{ $intern->id }}</td>
                                <td>{{ $intern->name }}</td>
                                <td>{{ $intern->email }}</td>
                                <td>{{ $intern->department ? $intern->department->name : 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('admin.edit-user', ['role' => 'magang', 'userId' => $intern->id]) }}"
                                        class="btn btn-sm btn-primary">Edit</a>
                                    <button class="btn btn-sm btn-danger delete-user" data-user-id="{{ $intern->id }}"
                                        data-toggle="modal" data-target="#deleteModal"
                                        data-table="internsTable">Delete</button>
                                    <a href="{{ route('admin.show-user', $intern->id) }}"
                                        class="btn btn-secondary">Show</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <h3>Supervisors</h3>
                <table class="table table-striped" id="supervisorsTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($supervisors as $supervisor)
                            <tr>
                                <td>{{ $supervisor->id }}</td>
                                <td>{{ $supervisor->name }}</td>
                                <td>{{ $supervisor->email }}</td>
                                <td>{{ $supervisor->department ? $supervisor->department->name : 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('admin.edit-user', ['role' => 'supervisor', 'userId' => $supervisor->id]) }}"
                                        class="btn btn-sm btn-primary">Edit</a>
                                    <button class="btn btn-sm btn-danger delete-user" data-user-id="{{ $supervisor->id }}"
                                        data-toggle="modal" data-target="#deleteModal"
                                        data-table="supervisorsTable">Delete</button>
                                    <a href="{{ route('admin.show-user', $supervisor->id) }}"
                                        class="btn btn-secondary">Show</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <h3>Admins</h3>
                <table class="table table-striped" id="adminsTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admins as $admin)
                            <tr>
                                <td>{{ $admin->id }}</td>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->email }}</td>
                                <td>{{ $admin->department ? $admin->department->name : 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('admin.edit-user', ['role' => 'admin', 'userId' => $admin->id]) }}"
                                        class="btn btn-sm btn-primary">Edit</a>
                                    <button class="btn btn-sm btn-danger delete-user" data-user-id="{{ $admin->id }}"
                                        data-toggle="modal" data-target="#deleteModal"
                                        data-table="adminsTable">Delete</button>
                                    <a href="{{ route('admin.show-user', $admin->id) }}" class="btn btn-secondary">Show</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this user?
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" action="" method="POST">
                        @method('DELETE')
                        @csrf
                        <input type="hidden" id="deleteUserId" name="userId" value="">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            aria-label="Close">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

    <script>
        $(document).ready(function() {
            $('#internsTable, #supervisorsTable, #adminsTable').DataTable();

            $('.delete-user').click(function() {
                var userId = $(this).data('user-id');
                var tableId = $(this).data('table');
                var actionUrl = '{{ route('admin.delete-user', ['userId' => ':userId']) }}';
                actionUrl = actionUrl.replace(':userId', userId);
                $('#deleteForm').attr('action', actionUrl);
                $('#deleteUserId').val(userId);
                $('#deleteModal').appendTo('body').modal('show');
            });

            $('#deleteModal').on('hidden.bs.modal', function() {
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            });

            $('.close').click(function() {
                $('#deleteModal').modal('hide');
            });

            $('.btn-secondary').click(function() {
                $('#deleteModal').modal('hide');
            });
        });
    </script>
@endsection
