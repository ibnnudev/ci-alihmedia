<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu bg-green">
            <div class="nav">
                <div class="sb-sidenav-menu-heading text-light">Menu Utama</div>
                <a class="nav-link <?= (current_url(true)->getSegment(2) == 'dashboard') ? 'text-white active' : 'text-light' ?>" href="/admin/dashboard">
                    <div class="sb-nav-link-icon <?= (current_url(true)->getSegment(2) == 'dashboard') ? 'text-white' : '' ?>"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading text-light">Master</div>
                <a class="nav-link <?= (current_url(true)->getSegment(2) == 'user') ? 'text-white active' : 'text-light' ?>" href="/admin/user">
                    <div class="sb-nav-link-icon <?= (current_url(true)->getSegment(2) == 'user') ? 'text-white' : '' ?>"><i class="fas fa-users"></i></div> Pengguna
                </a>
                <a class="nav-link <?= (current_url(true)->getSegment(2) == 'patient') ? 'text-white active' : 'text-light' ?>" href="/admin/patient">
                    <div class="sb-nav-link-icon <?= (current_url(true)->getSegment(2) == 'patient') ? 'text-white' : '' ?>"><i class="fas fa-user-injured"></i></div>
                    Pasien
                </a>
                <!-- <a class="nav-link <?= (current_url(true)->getSegment(2) == 'cases') ? 'text-white active' : 'text-light' ?>" href="/admin/cases">
                    <div class="sb-nav-link-icon <?= (current_url(true)->getSegment(2) == 'cases') ? 'text-white' : '' ?>"><i class="fas fa-briefcase-medical"></i></div>
                    Kasus
                </a> -->
                <a class="nav-link <?= (current_url(true)->getSegment(2) == 'retention-schedule') ? 'text-white active' : 'text-light' ?>" href="/admin/retention-schedule">
                    <div class="sb-nav-link-icon <?= (current_url(true)->getSegment(2) == 'retention-schedule') ? 'text-white' : '' ?>"><i class="fas fa-calendar-alt"></i></div>
                    Jadwal Retensi
                </a>

                <div class="sb-sidenav-menu-heading text-light">Transaksi Retensi</div>
                <a class="nav-link <?= (current_url(true)->getSegment(2) == 'retention') ? 'text-white active' : 'text-light' ?>" href="/admin/retention">
                    <div class="sb-nav-link-icon <?= (current_url(true)->getSegment(2) == 'retention') ? 'text-white' : '' ?>"><i class="fas fa-archive"></i></div>
                    Retensi
                </a>
                <a class="nav-link <?= (current_url(true)->getSegment(2) == 'preservation' && current_url(true)->getSegment(3) != 'scan') ? 'text-white active' : 'text-light' ?>" href="/admin/preservation">
                    <div class="sb-nav-link-icon <?= (current_url(true)->getSegment(2) == 'preservation'  && current_url(true)->getSegment(3) != 'scan') ? 'text-white' : '' ?>"><i class="fas fa-archive"></i></div>
                    Pelestarian
                </a>
                <a class="nav-link <?= (current_url(true)->getSegment(2) == 'culling' && current_url(true)->getSegment(3) != 'scan') ? 'text-white active' : 'text-light' ?>" href="/admin/culling">
                    <div class="sb-nav-link-icon <?= (current_url(true)->getSegment(2) == 'culling'  && current_url(true)->getSegment(3) != 'scan') ? 'text-white' : '' ?>"><i class="fas fa-archive"></i></div>
                    Pemusnahan
                </a>
                <a class="nav-link disabled <?= (current_url(true)->getSegment(3) == 'scan') ? 'text-white active' : 'text-light' ?>" href="/admin/preservation/scan">
                    <div class="sb-nav-link-icon <?= (current_url(true)->getSegment(2) == 'scan') ? 'text-white' : '' ?>"><i class="fas fa-archive"></i></div>
                    Alih Media
                </a>
            </div>
            <!-- <div class="sb-sidenav-footer bg-success">
                <div class="small">Logged in as:</div>
                <?= session()->get('name') ?>
            </div> -->
    </nav>
</div>