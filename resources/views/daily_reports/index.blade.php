@extends('layouts.magang')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Daily Reports</div>

                    <div class="card-body">
                        @if (Auth::user()->role == 'magang')
                            <a href="{{ route('daily_reports.create') }}" class="btn btn-primary mb-3">Create Daily Report</a>
                        @endif
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Tasks Completed</th>
                                    <th>Feedback</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reports as $report)
                                    <tr>
                                        <td>{{ $report->date }}</td>
                                        <td>{{ $report->tasks_completed }}</td>
                                        <td>{{ $report->feedback }}</td>
                                        <td>
                                            @if (Auth::user()->role == 'supervisor')
                                                <a href="{{ route('daily_reports.edit', ['id' => $report->id]) }}"
                                                    class="btn btn-sm btn-primary">Tanggapi</a>
                                            @endif
                                            @if (Auth::user()->role == 'magang')
                                                <form action="{{ route('daily_reports.destroy', ['id' => $report->id]) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
