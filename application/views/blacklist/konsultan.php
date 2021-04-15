<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-1 bg-danger d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-light">Konsultan BlackList</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table style="font-size: 12px" class="table table-bordered" id="tabel-konsultan-blacklist" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Konsultan</th>
                            <th>Kota</th>
                            <th>Alamat</th>
                            <th>Segmen</th>
                            <th>Klasifiaksi</th>
                            <th>PIC</th>
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

        $('#tabel-konsultan-blacklist').dataTable({
            columnDefs: [{
                    "targets": 0, // your case first column
                    "width": "1%"

                },
                {
                    "targets": [1], // your case first column
                    "width": "20%",


                },
                {
                    "targets": 2, // your case first column
                    "width": "15%",

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
                    "width": "1%",

                },
                {
                    "targets": 6, // your case first column
                    "width": "15%",

                },
                {
                    "targets": 7, // your case first column
                    "width": "5%",

                },
            ]
        });
    });
</script>
<!--End of Main Content-- >