<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h4 class="h3 mb-0" style="font-weight: bold">Detail Notaris</h4>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <h6>Nama Notaris</h6>
                </div>
                <?php
                $no = 1;
                foreach ($dataNotaris as $d) { ?>
                    <h6>
                        : <?= $d->nama ?>
                    </h6>
                <?php } ?>
            </div>

            <div class="row" style="margin-top: 10px">
                <div class="col-md-2">
                    <h6>Wilayah Kelolaan</h6>
                </div>
                <?php
                $no = 1;
                foreach ($dataNotaris as $d) { ?>
                    <h6>
                        : <?= $d->wilayah ?>
                    </h6>
                <?php } ?>
            </div>

            <div class="row" style="margin-top: 10px">
                <div class="col-md-2">
                    <h6>Provinsi</h6>
                </div>
                <?php
                $no = 1;
                foreach ($dataNotaris as $d) { ?>
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
                foreach ($dataNotaris as $d) { ?>
                    <h6>
                        : <?= $d->nama_kota ?>
                    </h6>
                <?php } ?>
            </div>

            <div class="row" style="margin-top: 10px">
                <div class="col-md-2">
                    <h6>Klasifikasi</h6>
                </div>
                <?php
                $no = 1;
                foreach ($dataNotaris as $d) { ?>
                    <h6>
                        : <?= $d->klasifikasi ?>
                    </h6>
                <?php } ?>
            </div>

            <div class="row" style="margin-top: 10px">
                <div class="col-md-2">
                    <h6>Jatuh Tempo</h6>
                </div>
                <?php
                $no = 1;
                foreach ($dataNotaris as $d) { ?>
                    <h6>
                        : <?= $d->jatuhTempo ?>
                    </h6>
                <?php } ?>
            </div>

            <div class="row" style="margin-top: 10px">
                <div class="col-md-2">
                    <h6>Alamat</h6>
                </div>
                <?php
                $no = 1;
                foreach ($dataNotaris as $d) { ?>
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
                foreach ($dataNotaris as $d) { ?>
                    <h6>
                        : <?= $d->phone ?>
                    </h6>
                <?php } ?>
            </div>

            <div class="row" style="margin-top: 10px">
                <div class="col-md-2">
                    <h6>Faks</h6>
                </div>
                <?php
                $no = 1;
                foreach ($dataNotaris as $d) { ?>
                    <h6>
                        : <?= $d->fax ?>
                    </h6>
                <?php } ?>
            </div>

            <div class="row" style="margin-top: 10px">
                <div class="col-md-2">
                    <h6>Ponsel</h6>
                </div>
                <?php
                $no = 1;
                foreach ($dataNotaris as $d) { ?>
                    <h6>
                        : <?= $d->ponsel ?>
                    </h6>
                <?php } ?>
            </div>

            <div class="row" style="margin-top: 10px">
                <div class="col-md-2">
                    <h6>Status</h6>
                </div>
                <?php
                $no = 1;
                foreach ($dataNotaris as $d) { ?>
                    <h6>
                        : <?= $d->jenis_status ?>
                    </h6>
                <?php } ?>
            </div>

            <div class="row" style="margin-top: 10px">
                <div class="col-md-2">
                    <h6>Sanksi</h6>
                </div>
                <?php
                $no = 1;
                foreach ($dataNotaris as $d) { ?>
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
                foreach ($dataNotaris as $d) { ?>
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