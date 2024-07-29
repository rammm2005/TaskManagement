@extends('layouts.magang')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Create Daily Report</div>

                    <div class="card-body">
                        <form action="{{ route('daily_reports.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="date">Date:</label>
                                <input type="date" name="date" id="date" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="tasks_completed">Tasks Completed:</label>
                                <textarea name="tasks_completed" id="tasks_completed" class="form-control" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
