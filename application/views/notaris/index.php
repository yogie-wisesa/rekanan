<!-- Begin Page Content -->
<?php
foreach ($Kelolaan1 as $K1) {
    $idWilayah1 = $K1->id;
    $namaWilayah1 = $K1->wilayah;
}
?>

<?php
foreach ($Kelolaan2 as $K2) {
    $idWilayah2 = $K2->id;
    $namaWilayah2 = $K2->wilayah;
}
?>

<?php
foreach ($Kelolaan3 as $K3) {
    $idWilayah3 = $K3->id;
    $namaWilayah3 = $K3->wilayah;
}
?>

<?php
foreach ($Kelolaan4 as $K4) {
    $idWilayah4 = $K4->id;
    $namaWilayah4 = $K4->wilayah;
}
?>

<?php
foreach ($Kelolaan5 as $K5) {
    $idWilayah7 = $K5->id;
    $namaWilayah7 = $K5->wilayah;
}
?>

<?php
foreach ($Kelolaan6 as $K6) {
    $idWilayah6 = $K6->id;
    $namaWilayah6 = $K6->wilayah;
}
?>

<?php
foreach ($Kelolaan7 as $K7) {
    $idWilayah7 = $K7->id;
    $namaWilayah7 = $K7->wilayah;
}
?>

<?php
foreach ($Kelolaan8 as $K8) {
    $idWilayah8 = $K8->id;
    $namaWilayah8 = $K8->wilayah;
}
?>

<?php
foreach ($Kelolaan9 as $K9) {
    $idWilayah9 = $K9->id;
    $namaWilayah9 = $K9->wilayah;
}
?>

<?php
foreach ($Kelolaan10 as $K10) {
    $idWilayah10 = $K10->id;
    $namaWilayah10 = $K10->wilayah;
}
?>

<?php
foreach ($Kelolaan11 as $K11) {
    $idWilayah11 = $K11->id;
    $namaWilayah11 = $K11->wilayah;
}
?>

<?php
foreach ($Kelolaan12 as $K12) {
    $idWilayah12 = $K12->id;
    $namaWilayah12 = $K12->wilayah;
}
?>

<?php
foreach ($Kelolaan13 as $K13) {
    $idWilayah13 = $K13->id;
    $namaWilayah13 = $K13->wilayah;
}
?>

<?php
foreach ($Kelolaan14 as $K14) {
    $idWilayah14 = $K14->id;
    $namaWilayah14 = $K14->wilayah;
}
?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h4 class="h3 mb-0" style="font-weight: bold">Dashboard Notaris</h4>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <a href="<?= base_url('notaris/allNotaris') ?>">
                <div class="card border-bottom-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total</div>
                                <div class="h7 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                    foreach ($Notaris as $N) {
                                        echo $N['count(*)'] . " Notaris";
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

        <div class="col-xl-4 col-md-6 mb-4">
            <a href="<?= base_url('notaris/notarisDapatDigunakan') ?>">
                <div class="card border-bottom-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Dapat digunakan</div>
                                <div class="h7 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                    foreach ($NotarisDiterima as $N) {
                                        echo $N['count(*)'] . " Notaris";
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
            <a href="<?= base_url('notaris/notarisTerbatas') ?>">
                <div class="card border-bottom-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Terbatas</div>
                                <div class="h7 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                    foreach ($NotarisTerbatas as $N) {
                                        echo $N['count(*)'] . " Notaris";
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
            <a href="<?= base_url('notaris/notarisTidakDapatDigunakan') ?>">
                <div class="card border-bottom-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Tidak dapat digunakan</div>
                                <div class="h7 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                    foreach ($NotarisDitolak as $N) {
                                        echo $N['count(*)'] . " Notaris";
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

    <!-- <div class="row">
        <div class="col-xl-2 col-md-6 mb-4">
            <a href="<?= base_url('NotarisKelolaan/kelolaan1/') . $idWilayah1 ?>">
                <div class="card border-bottom-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?= $namaWilayah1 ?></div>
                                <div class="h7 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                    foreach ($Notaris1 as $N1) {
                                        echo $N1['count(*)'] . " Notaris";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-secret fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-2 col-md-6 mb-4">
            <a href="<?= base_url('NotarisKelolaan/kelolaan1/') . $idWilayah2 ?>">
                <div class="card border-bottom-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?= $namaWilayah2 ?></div>
                                <div class="h7 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                    foreach ($Notaris2 as $N2) {
                                        echo $N2['count(*)'] . " Notaris";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-secret fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-2 col-md-6 mb-4">
            <a href="<?= base_url('NotarisKelolaan/kelolaan1/') . $idWilayah3 ?>">
                <div class="card border-bottom-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?= $namaWilayah3 ?></div>
                                <div class="h7 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                    foreach ($Notaris3 as $N3) {
                                        echo $N3['count(*)'] . " Notaris";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-secret fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-2 col-md-6 mb-4">
            <a href="<?= base_url('NotarisKelolaan/kelolaan1/') . $idWilayah4 ?>">
                <div class="card border-bottom-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?= $namaWilayah4 ?></div>
                                <div class="h7 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                    foreach ($Notaris4 as $N4) {
                                        echo $N4['count(*)'] . " Notaris";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-secret fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-2 col-md-6 mb-4">
            <a href="<?= base_url('NotarisKelolaan/kelolaan1/') . $idWilayah7 ?>">
                <div class="card border-bottom-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?= $namaWilayah7 ?></div>
                                <div class="h7 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                    foreach ($Notaris5 as $N5) {
                                        echo $N5['count(*)'] . " Notaris";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-secret fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-2 col-md-6 mb-4">
            <a href="<?= base_url('NotarisKelolaan/kelolaan1/') . $idWilayah6 ?>">
                <div class="card border-bottom-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?= $namaWilayah6 ?></div>
                                <div class="h7 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                    foreach ($Notaris6 as $N6) {
                                        echo $N6['count(*)'] . " Notaris";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-secret fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

    </div>

    <div class="row">
        <div class="col-xl-2 col-md-6 mb-4">
            <a href="<?= base_url('NotarisKelolaan/kelolaan1/') . $idWilayah7 ?>">
                <div class="card border-bottom-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?= $namaWilayah7 ?></div>
                                <div class="h7 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                    foreach ($Notaris7 as $N7) {
                                        echo $N7['count(*)'] . " Notaris";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-secret fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-2 col-md-6 mb-4">
            <a href="<?= base_url('NotarisKelolaan/kelolaan1/') . $idWilayah8 ?>">
                <div class="card border-bottom-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?= $namaWilayah8 ?></div>
                                <div class="h7 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                    foreach ($Notaris8 as $N8) {
                                        echo $N8['count(*)'] . " Notaris";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-secret fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-2 col-md-6 mb-4">
            <a href="<?= base_url('NotarisKelolaan/kelolaan1/') . $idWilayah9 ?>">
                <div class="card border-bottom-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?= $namaWilayah9 ?></div>
                                <div class="h7 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                    foreach ($Notaris9 as $N9) {
                                        echo $N9['count(*)'] . " Notaris";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-secret fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-2 col-md-6 mb-4">
            <a href="<?= base_url('NotarisKelolaan/kelolaan1/') . $idWilayah10 ?>">
                <div class="card border-bottom-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?= $namaWilayah10 ?></div>
                                <div class="h7 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                    foreach ($Notaris10 as $N10) {
                                        echo $N10['count(*)'] . " Notaris";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-secret fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-2 col-md-6 mb-4">
            <a href="<?= base_url('NotarisKelolaan/kelolaan1/') . $idWilayah11 ?>">
                <div class="card border-bottom-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?= $namaWilayah11 ?></div>
                                <div class="h7 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                    foreach ($Notaris11 as $N11) {
                                        echo $N11['count(*)'] . " Notaris";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-secret fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-2 col-md-6 mb-4">
            <a href="<?= base_url('NotarisKelolaan/kelolaan1/') . $idWilayah12 ?>">
                <div class="card border-bottom-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?= $namaWilayah12 ?></div>
                                <div class="h7 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                    foreach ($Notaris12 as $N12) {
                                        echo $N12['count(*)'] . " Notaris";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-secret fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

    </div>

    <div class="row">
        <div class="col-xl-2 col-md-6 mb-4">
            <a href="<?= base_url('NotarisKelolaan/kelolaan1/') . $idWilayah13 ?>">
                <div class="card border-bottom-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?= $namaWilayah13 ?></div>
                                <div class="h7 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                    foreach ($Notaris13 as $N13) {
                                        echo $N13['count(*)'] . " Notaris";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-secret fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-2 col-md-6 mb-4">
            <a href="<?= base_url('NotarisKelolaan/kelolaan1/') . $idWilayah14 ?>">
                <div class="card border-bottom-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?= $namaWilayah14 ?></div>
                                <div class="h7 mb-0 font-weight-bold text-gray-800">
                                    <?php
                                    foreach ($Notaris14 as $N14) {
                                        echo $N14['count(*)'] . " Notaris";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-secret fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

    </div> -->
    <!-- Content Row -->

</div>
<!-- /.container-fluid -->

</div>

<!-- End of Main Content -->