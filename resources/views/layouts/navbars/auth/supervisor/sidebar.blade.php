<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="align-items-center d-flex m-0 navbar-brand text-wrap" href="{{ route('supervisor.dashboard') }}">
            <img src="../assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="...">
            <span class="ms-3 font-weight-bold">Halo {{ Auth::user()->name ?? '' }}, Login Role
                {{ Auth::user()->role ?? '' }}</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('supervisor/dashboard') ? 'active' : '' }}"
                    href="{{ route('supervisor.dashboard') }}">
                    <i class="fas fa-tachometer-alt me-2"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Intern Management</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('supervisor/interns*') ? 'active' : '' }}"
                    href="{{ route('supervisor.interns') }}">
                    <i class="fas fa-users me-2"></i>
                    Daftar Anak Magang
                </a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link {{ Request::route()->named('supervisor.show-intern') ? 'active' : '' }}"
                    href="{{ route('supervisor.interns') }}">
                    <i class="fas fa-user me-2"></i>
                    Lihat Profil Anak Magang
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::route()->named('supervisor.intern-attendance') ? 'active' : '' }}"
                    href="{{ route('supervisor.interns') }}">
                    <i class="fas fa-calendar-alt me-2"></i>
                    Lihat Kehadiran Harian Anak Magang
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::route()->named('supervisor.intern-daily-reports') ? 'active' : '' }}"
                    href="{{ route('supervisor.interns') }}">
                    <i class="fas fa-file-alt me-2"></i>
                    Lihat Laporan Harian Anak Magang
                </a>
            </li> --}}

            <li class="nav-item">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Task Management</h6>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::route()->named('supervisor.intern-tasks') ? 'active' : '' }}"
                    href="{{ route('supervisor.tasks') }}">
                    <i class="fas fa-tasks me-2"></i>
                    Kelola Tugas Anak Magang
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::route()->named('daily_reports.indexSup') ? 'active' : '' }}"
                    href="{{ route('daily_reports.indexSup') }}">
                    <i class="fas fa-file-alt me-2"></i>
                    Daily Report
                </a>
            </li>

            {{-- <li class="nav-item">
                <a class="nav-link {{ Request::is('supervisor/tasks*') ? 'active' : '' }}"
                    href="{{ route('supervisor.tasks-assigned') }}">
                    <i class="fas fa-tasks me-2"></i>
                    Kelola Tugas
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::route()->named('supervisor.tasks-assigned') ? 'active' : '' }}"
                    href="{{ route('supervisor.tasks-assigned') }}">
                    <i class="fas fa-tasks me-2"></i>
                    Tugas yang Diberikan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::route()->named('supervisor.tasks-completed') ? 'active' : '' }}"
                    href="{{ route('supervisor.tasks-completed') }}">
                    <i class="fas fa-check-circle me-2"></i>
                    Tugas yang Selesai
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::route()->named('supervisor.tasks-approaching-deadline') ? 'active' : '' }}"
                    href="{{ route('supervisor.tasks-approaching-deadline') }}">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    Tugas Mendekati Deadline
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::route()->named('supervisor.create-task') ? 'active' : '' }}"
                    href="{{ route('supervisor.create-task') }}">
                    <i class="fas fa-plus me-2"></i>
                    Buat Tugas Baru
                </a>
            </li> --}}
        </ul>
    </div>
</aside>
