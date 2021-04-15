<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h4 class="h4 mb-0" style="font-weight: bold">DAFTAR REKANAN</h4>
    </div>

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-3 col-md-6 mb-4">
            <a href="<?= base_url('asuransi_jiwa/index') ?>">
                <div class="card border-bottom-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h7 mb-0 font-weight-bold text-primary">
                                    <?php
                                    foreach ($Aj as $a) {
                                        echo $a['count(*)'] . " ASURANSI JIWA";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-shield fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <a href="<?= base_url('asuransi_kerugian/index') ?>">
                <div class="card border-bottom-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h7 mb-0 font-weight-bold text-danger">
                                    <?php
                                    foreach ($Ak as $a) {
                                        echo $a['count(*)'] . " ASURANSI KERUGIAN";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-house-damage fa-2x text-danger"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <a href="<?= base_url('bls/index') ?>">
                <div class="card border-bottom-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h6 mb-0 font-weight-bold text-secondary">
                                    <?php
                                    foreach ($blsPerusahaan as $kA) {
                                        echo $kA['count(*)'] . " BALAI LELANG SWASTA";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-gavel fa-2x text-secondary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="<?= base_url('manager_investasi/index') ?>">
                <div class="card border-bottom-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h7 mb-0 font-weight-bold text-success">
                                    <?php
                                    foreach ($Mi as $a) {
                                        echo $a['count(*)'] . " MANAGER INVESTASI";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-leaf fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

    </div>

    <div class="row">

        <div class="col-xl-3 col-md-6 mb-4">
            <a href="<?= base_url('kap/index') ?>">
                <div class="card border-bottom-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h6 mb-0 font-weight-bold text-warning">
                                    <?php
                                    foreach ($kapPerusahaan as $kA) {
                                        echo $kA['count(*)'] . " KANTOR AKUNTAN PUBLIK";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calculator fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <a href="<?= base_url('MoneyBroker/index') ?>">
                <div class="card border-bottom-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h7 mb-0 font-weight-bold text-success">
                                    <?php
                                    foreach ($Mb as $a) {
                                        echo $a['count(*)'] . " MONEY BROKER";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-coins fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <a href="<?= base_url('kjpp/index') ?>">
                <div class="card border-bottom-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h6 mb-0 font-weight-bold text-info">
                                    <?php
                                    foreach ($kjppPerusahaan as $kA) {
                                        echo $kA['count(*)'] . " KANTOR JASA PENILAI PUBLIK";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-landmark fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <a href="<?= base_url('notaris/index') ?>">
                <div class="card border-bottom-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h7 mb-0 font-weight-bold text-primary">
                                    <?php
                                    foreach ($Notaris as $N) {
                                        echo $N['count(*)'] . " NOTARIS";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-flag fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

    </div>

    <div class="row">

        <div class="col-xl-3 col-md-6 mb-4">
            <a href="<?= base_url('pialang_asuransi/index') ?>">
                <div class="card border-bottom-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h7 mb-0 font-weight-bold text-danger">
                                    <?php
                                    foreach ($Ps as $kA) {
                                        echo $kA['count(*)'] . " PIALANG ASURANSI";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fab fa-accessible-icon fa-2x text-danger"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <a href="<?= base_url('Konsultan/index') ?>">
                <div class="card border-bottom-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h7 mb-0 font-weight-bold text-primary">
                                    <?php
                                    foreach ($Konsultan as $a) {
                                        echo $a['count(*)'] . " KONSULTAN";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-diagnoses fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

    </div>

    <!-- Content Row -->

</div>
<!-- /.container-fluid -->

</div>

<!-- End of Main Content -->