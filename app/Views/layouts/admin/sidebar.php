<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a class="nav-link <?= (current_url(true)->getSegment(2) == 'dashboard') ? 'text-white' : '' ?>" href="/admin/dashboard">
                    <div class="sb-nav-link-icon <?= (current_url(true)->getSegment(2) == 'dashboard') ? 'text-white' : '' ?>"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <a class="nav-link <?= (current_url(true)->getSegment(2) == 'patient') ? 'text-white' : '' ?>" href="/admin/patient">
                    <div class="sb-nav-link-icon <?= (current_url(true)->getSegment(2) == 'patient') ? 'text-white' : '' ?>"><i class="fas fa-user-injured"></i></div>
                    Pasien
                </a>
                <a class="nav-link <?= (current_url(true)->getSegment(2) == 'cases') ? 'text-white' : '' ?>" href="/admin/cases">
                    <div class="sb-nav-link-icon <?= (current_url(true)->getSegment(2) == 'cases') ? 'text-white' : '' ?>"><i class="fas fa-briefcase-medical"></i></div>
                    Kasus
                </a>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                <?= session()->get('name') ?>
            </div>
    </nav>
</div>