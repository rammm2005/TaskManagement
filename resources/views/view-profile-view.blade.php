@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Profil</h2>
        <div class="card">
            <div class="card-header">
                {{ auth()->user()->name }}
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p>Email: {{ auth()->user()->email }}</p>
                        <p>Nomor Telepon: {{ auth()->user()->phone_number }}</p>
                        <p>Alamat: {{ auth()->user()->address }}</p>
                    </div>
                    <div class="col-md-6">
                        <p>Departemen: {{ auth()->user()->department->name }}</p>
                        <p>Supervisor: {{ auth()->user()->supervisor->name ?? '-' }}</p>
                    </div>
                </div>

                <a href="{{ route('profile.edit') }}" class="btn btn-primary mt-3">Edit Profil</a>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Script untuk menampilkan modal edit profil
            $('#editProfileModal').on('show.bs.modal', function() {
                $('#nameInput').val('{{ auth()->user()->name }}');
                $('#emailInput').val('{{ auth()->user()->email }}');
                $('#phoneNumberInput').val('{{ auth()->user()->phone_number }}');
                $('#addressInput').val('{{ auth()->user()->address }}');
            });

            // Script untuk submit form edit profil
            $('#editProfileForm').submit(function(e) {
                e.preventDefault();
                var formData = {
                    name: $('#nameInput').val(),
                    email: $('#emailInput').val(),
                    phoneNumber: $('#phoneNumberInput').val(),
                    address: $('#addressInput').val()
                };

                $.ajax({
                    type: 'POST',
                    url: '{{ route('profile.update') }}',
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            $('#editProfileModal').modal('hide');
                            location.reload(); // Reload halaman untuk memperbarui tampilan profil
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(error) {
                        alert('Terjadi kesalahan. Coba lagi.');
                    }
                });
            });
        });
    </script>
@endsection
