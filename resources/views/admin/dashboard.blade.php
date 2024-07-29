@extends('layouts.admin')
@section('title', 'Dashboard Admin ' . Auth::user()->name)
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-xl-4 mb-xl-0 mb-4">
                        <div class="card bg-transparent shadow-xl">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-user-graduate fa-2x text-primary mr-4"></i>
                                    <div class="m-4">
                                        <h6 class="mb-0">Total Interns</h6>
                                        <h5 class="font-weight-bold">{{ $internsCount }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 mb-xl-0 mb-4">
                        <div class="card bg-transparent shadow-xl">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-user-tie fa-2x text-primary mr-4"></i>
                                    <div class="m-4">
                                        <h6 class="mb-0">Total Supervisors</h6>
                                        <h5 class="font-weight-bold">{{ $supervisorsCount }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 mb-xl-0 mb-4">
                        <div class="card bg-transparent shadow-xl">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-user-shield fa-2x text-primary mr-4"></i>
                                    <div class="m-4">
                                        <h6 class="mb-0">Total Admins</h6>
                                        <h5 class="font-weight-bold">{{ $adminsCount }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 mb-xl-0 mb-4">
                        <div class="card bg-transparent shadow-xl">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-calendar-check fa-2x text-primary mr-4"></i>
                                    <div class="m-4">
                                        <h6 class="mb-0">Total Attendances</h6>
                                        <h5 class="font-weight-bold">{{ $attendancesCount }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 mb-xl-0 mb-4">
                        <div class="card bg-transparent shadow-xl">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-file-alt fa-2x text-primary mr-4"></i>
                                    <div class="m-4">
                                        <h6 class="mb-0">Total Daily Reports</h6>
                                        <h5 class="font-weight-bold">{{ $dailyReportsCount }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 mb-xl-0 mb-4">
                        <div class="card bg-transparent shadow-xl">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-tasks fa-2x text-primary mr-4"></i>
                                    <div class="m-4">
                                        <h6 class="mb-0">Total Tasks</h6>
                                        <h5 class="font-weight-bold">{{ $tasksCount }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 mb-xl-0 mb-4">
                        <div class="card bg-transparent shadow-xl">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-building fa-2x text-primary mr-4"></i>
                                    <div class="m-4">
                                        <h6 class="mb-0">Total Departments</h6>
                                        <h5 class="font-weight-bold">{{ $departmentsCount }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
