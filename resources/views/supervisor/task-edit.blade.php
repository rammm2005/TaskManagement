@extends('layouts.supper')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Edit Task {{ $task->name }}
                    </div>
                    <div class="card-body">
                        <form action="{{ route('supervisor.task-update', ['taskId' => $task->id]) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $task->name }}" required>
                            </div>

                            <div class="form-group">
                                <label for="task_description">Deskripsi</label>
                                <textarea class="form-control" id="task_description" name="task_description" rows="3" required>{{ $task->task_description }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="duedate">Deadline</label>
                                <input type="datetime-local" class="form-control" id="duedate" name="duedate"
                                    value="{{ $task->duedate }}" required>
                            </div>

                            <div class="form-group">
                                <label for="intern_id">Anak Magang</label>
                                <select class="form-control" id="intern_id" name="intern_id" required>
                                    @foreach ($interns as $intern)
                                        <option value="{{ $intern->id }}"
                                            {{ $task->user_id == $intern->id ? 'selected' : '' }}>{{ $intern->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('supervisor.tasks') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
