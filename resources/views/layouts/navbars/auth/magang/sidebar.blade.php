<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="align-items-center d-flex m-0 navbar-brand text-wrap" href="{{ route('magang.dashboard') }}">
            <img src="../assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="...">
            <span class="ms-3 font-weight-bold">Halo {{ Auth::user()->name ?? '' }}, Login Role
                {{ Auth::user()->role ?? '' }}</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('intern/dashboard') ? 'active' : '' }}"
                    href="{{ route('magang.dashboard') }}">
                    <i class="fas fa-tachometer-alt me-2"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Auth Pages</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('intern/profile') ? 'active' : '' }}"
                    href="{{ route('magang.profile') }}">
                    <i class="fas fa-user me-2"></i>
                    Profile Page
                </a>
            </li>
            <li class="nav-item">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Core Pages</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('intern/tasks') ? 'active' : '' }}"
                    href="{{ route('magang.tasks') }}">
                    <i class="fas fa-tasks me-2"></i>
                    Halaman Task
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('intern/attendance') ? 'active' : '' }}"
                    href="{{ route('magang.attendance') }}">
                    <i class="fas fa-calendar-alt me-2"></i>
                    Kehadiran
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::route()->named('daily_reports.index') ? 'active' : '' }}"
                    href="{{ route('daily_reports.index') }}">
                    <i class="fas fa-file-alt me-2"></i>
                    Daily Report
                </a>
            </li>
        </ul>
    </div>
</aside>
