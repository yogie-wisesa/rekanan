<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h4 class="h3 mb-0" style="font-weight: bold">Detail Penilai</h4>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <h6>Nama KJPP</h6>
                </div>
                <?php
                $no = 1;
                foreach ($dataKjpp as $d) { ?>
                    <h6>
                        : <?= $d->namaPerusahaanKjpp ?>
                    </h6>
                <?php } ?>
            </div>

            <div class="row" style="margin-top: 10px">
                <div class="col-md-2">
                    <h6>Nama Penilai</h6>
                </div>
                <?php
                $no = 1;
                foreach ($dataKjpp as $d) { ?>
                    <h6>
                        : <?= $d->penilaiPublik ?>
                    </h6>
                <?php } ?>
            </div>

            <div class="row" style="margin-top: 10px">
                <div class="col-md-2">
                    <h6>Pusat/Cabang</h6>
                </div>
                <?php
                $no = 1;
                foreach ($dataKjpp as $d) { ?>
                    <h6>
                        : <?= $d->jenisKantor ?>
                    </h6>
                <?php } ?>
            </div>

            <div class="row" style="margin-top: 10px">
                <div class="col-md-2">
                    <h6>Provinsi</h6>
                </div>
                <?php
                $no = 1;
                foreach ($dataKjpp as $d) { ?>
                    <h6>
                        : <?= $d->nama_provinsi ?>
                    </h6>
                <?php } ?>
            </div>

            <div class="row" style="margin-top: 10px">
                <div class="col-md-2">
                    <h6>Kota</h6>
                </div>
                <?php
                $no = 1;
                foreach ($dataKjpp as $d) { ?>
                    <h6>
                        : <?= $d->nama_kota ?>
                    </h6>
                <?php } ?>
            </div>

            <div class="row" style="margin-top: 10px">
                <div class="col-md-2">
                    <h6>Alamat</h6>
                </div>
                <?php
                $no = 1;
                foreach ($dataKjpp as $d) { ?>
                    <h6>
                        : <?= $d->alamat ?>
                    </h6>
                <?php } ?>
            </div>

            <div class="row" style="margin-top: 10px">
                <div class="col-md-2">
                    <h6>Phone</h6>
                </div>
                <?php
                $no = 1;
                foreach ($dataKjpp as $d) { ?>
                    <h6>
                        : <?= $d->phone ?>
                    </h6>
                <?php } ?>
            </div>

            <div class="row" style="margin-top: 10px">
                <div class="col-md-2">
                    <h6>Jasa Penilai</h6>
                </div>
                <?php
                $no = 1;
                foreach ($dataKjpp as $d) { ?>
                    <h6>
                        : <?= $d->id_jasaPenilai ?>
                    </h6>
                <?php } ?>
            </div>

            <div class="row" style="margin-top: 10px">
                <div class="col-md-2">
                    <h6>OJK</h6>
                </div>
                <?php
                $no = 1;
                foreach ($dataKjpp as $d) { ?>
                    <h6>
                        : <?= $d->id_ojkKjpp ?>
                    </h6>
                <?php } ?>
            </div>

            <div class="row" style="margin-top: 10px">
                <div class="col-md-2">
                    <h6>Status</h6>
                </div>
                <?php
                $no = 1;
                foreach ($dataKjpp as $d) { ?>
                    <h6>
                        : <?= $d->id_status ?>
                    </h6>
                <?php } ?>
            </div>

            <div class="row" style="margin-top: 10px">
                <div class="col-md-2">
                    <h6>Sanksi</h6>
                </div>
                <?php
                $no = 1;
                foreach ($dataKjpp as $d) { ?>
                    <h6>
                        : <?= $d->sanksi ?>
                    </h6>
                <?php } ?>
            </div>

            <div class="row" style="margin-top: 10px">
                <div class="col-md-2">
                    <h6>Keterangan</h6>
                </div>
                <?php
                $no = 1;
                foreach ($dataKjpp as $d) { ?>
                    <h6>
                        : <?= $d->keterangan ?>
                    </h6>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- Content Row -->

</div>
<!-- /.container-fluid -->

</div>

<!-- End of Main Content -->