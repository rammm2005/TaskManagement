@extends('layouts.supper')

@section('content')
    <div class="container-fluid py-4">
        <!-- Create Task Form -->
        <div class="row">
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-6">
                                <h6 class="mb-1">Buat Tugas Baru</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <form action="{{ route('supervisor.store-task') }}" method="POST">
                            @csrf
                            <div class="form-group mb-4">
                                <label for="name">Nama Tugas</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group mb-4">
                                <label for="description">Deskripsi Tugas</label>
                                <textarea class="form-control" id="description" name="task_description" rows="3" required></textarea>
                            </div>
                            <div class="form-group mb-4">
                                <label for="due_date">Deadline</label>
                                <input type="datetime-local" class="form-control" id="due_date" name="duedate" required>
                            </div>
                            <div class="form-group mb-4">
                                <label for="intern_id">Anak Magang</label>
                                <select class="form-control" id="intern_id" name="intern_id" required>
                                    @foreach ($interns as $intern)
                                        <option value="{{ $intern->id }}">{{ $intern->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Buat Tugas</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
