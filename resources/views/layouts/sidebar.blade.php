<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i style="font-size: 1.5rem" class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('dashboard') }}">
            <i style="font-size: 1.5rem" class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard Admin</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('akun-petugas') }}">
            <i style="font-size: 1.5rem" class="fas fa-fw fa-users-cog"></i>
            <span>Akun Petugas</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('jadwal') }}">
            <i style="font-size: 1.5rem" class="fas fa-fw fa-clock"></i>
            <span>Jadwal Kerja</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('izin') }}">
            <i style="font-size: 1.5rem" class="fas fa-fw fa-folder"></i>
            <span>Izin/Cuti</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('presensi') }}">
            <i style="font-size: 1.5rem" class="fas fa-fw fa-clipboard"></i>
            <span>Presensi</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('gaji') }}">
            <i style="font-size: 1.5rem" class="fas fa-fw fa-file-invoice-dollar"></i>
            <span>Penggajian</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('pengaduan') }}">
            <i style="font-size: 1.5rem" class="fas fa-fw fa-exclamation-triangle"></i>
            <span>Pengaduan</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->
