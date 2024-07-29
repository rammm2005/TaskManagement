@extends('layouts.supper')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit Daily Report</div>

                    <div class="card-body">
                        <form action="{{ route('daily_reports.update', ['id' => $report->id]) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="id" value="{{$report->id}}">
                            <div class="form-group">
                                <label for="date">Date:</label>
                                <input type="date" name="date" id="date" readonly class="form-control"
                                    value="{{ $report->date }}" required>
                            </div>
                            <div class="form-group">
                                <label for="tasks_completed">Tasks Completed:</label>
                                <textarea name="tasks_completed" readonly id="tasks_completed" class="form-control" required>{{ $report->tasks_completed }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="feedback">Feedback:</label>
                                <textarea name="feedback" id="feedback" class="form-control">{{ $report->feedback }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
