<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-1 bg-danger d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-light">Money Broker BlackList</h6>

            <?php if ($_SESSION['role_id'] == 1) { ?>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" data-toggle="modal" data-target="#tambahMbModal">
                        <i class="fas fa-plus fa-sm fa-fw text-grey-400"></i>
                    </a>
                </div>
            <?php } ?>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table style="font-size: 12px" class="table table-bordered" id="tabel-mb-blacklist" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Money Broker</th>
                            <th>Pusat/Cabang</th>
                            <th>No. Rekanan</th>
                            <th>Kota</th>
                            <th>Alamat</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<script src="<?= base_url() ?>vendor/sbadmin2/js/jquery.min.js" type="text/javascript"></script>

<script>
    $(document).ready(function() { // Ketika halaman sudah siap (sudah selesai di load)
        // Kita sembunyikan dulu untuk loadingnya
        $("#loading").hide();

        $('#tabel-mb-blacklist').dataTable({
            columnDefs: [{
                    "targets": 0, // your case first column
                    "width": "1%"

                },
                {
                    "targets": [1], // your case first column
                    "width": "15%",


                },
                {
                    "targets": 2, // your case first column
                    "width": "10%",

                },
                {
                    "targets": 3, // your case first column
                    "width": "15%",

                },
                {
                    "targets": 4, // your case first column
                    "width": "15%",

                },
                {
                    "targets": 5, // your case first column
                    "width": "10%",

                },
                {
                    "targets": 6, // your case first column
                    "width": "10%",

                },
            ]
        });
    });
</script>
<!--End of Main Content-- >