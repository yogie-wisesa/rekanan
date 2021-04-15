<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row justify-content-around">
        <div class="col-md-4">
            <div class="input-group" style="display: none">
                <input type="text" class="form-control bg-white border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- DataTales Example -->

    <div class="card shadow mb-4">
        <div class="card-header bg-danger py-1 d-flex flex-row align-items-center justify-content-between">
            <h7 class="m-0 font-weight-bold text-light">Notaris Black List</h7>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table style="font-size: 12px" class="table table-bordered" id="tabel-notaris-perusahaanblacklist" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Notaris</th>
                            <th>Pengelola</th>
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

        $('#tabel-notaris-perusahaanblacklist').dataTable({
            columnDefs: [{
                    "targets": 0, // your case first column
                    "width": "1%"

                },
                {
                    "targets": 1, // your case first column
                    "width": "15%",


                },
                {
                    "targets": 2, // your case first column
                    "width": "10%",

                },
                {
                    "targets": 3, // your case first column
                    "width": "10%",

                },
                {
                    "targets": 4, // your case first column
                    "width": "20%",

                },
                {
                    "targets": 5, // your case first column
                    "width": "10%",

                },
            ]
        });
    });
</script>
<!--End of Main Content-- >