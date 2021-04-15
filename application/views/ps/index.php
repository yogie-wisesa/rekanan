<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h4 class="h3 mb-0" style="font-weight: bold">Dashboard Pialang Asuransi</h4>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <a href="<?= base_url('pialang_asuransi/allPialangSaham') ?>">
                <div class="card border-bottom-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total</div>
                                <div class="h7 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                    foreach ($Ps as $a) {
                                        echo $a['count(*)'] . " Pialang Asuransi";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fab fa-accessible-icon fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <a href="<?= base_url('pialang_asuransi/dapatDigunakan') ?>">
                <div class="card border-bottom-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Dapat digunakan</div>
                                <div class="h7 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                    foreach ($PsDiterima as $ad) {
                                        echo $ad['count(*)'] . " Pialang Asuransi";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-check fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <a href="<?= base_url('pialang_asuransi/terbatas') ?>">
                <div class="card border-bottom-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Terbatas</div>
                                <div class="h7 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                    foreach ($PsTerbatas as $Ad) {
                                        echo $Ad['count(*)'] . " Pialang Saham";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-ban fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <a href="<?= base_url('pialang_asuransi/tidakDapatDigunakan') ?>">
                <div class="card border-bottom-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Tidak Dapat digunakan</div>
                                <div class="h7 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                    foreach ($PsDitolak as $Ad) {
                                        echo $Ad['count(*)'] . " Pialang Saham";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-ban fa-2x text-danger"></i>
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