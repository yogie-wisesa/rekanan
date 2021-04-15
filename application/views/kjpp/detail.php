<?php
foreach ($dataKjpp as $dK) {
    $namaPerusahaanKjpp = $dK->namaPerusahaanKjpp;
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h4 class="h3 mb-0" style="font-weight: bold"><?php echo $namaPerusahaanKjpp ?></h4>
    </div>

    <?php if (isset($_SESSION['successAlert'])) { ?>
        <div class="card bg-success text-white shadow mb-4" id="successAlert" onclick="document.getElementById('successAlert').style.display='none'">
            <div class="card-body">
                SUKSES!
                <div class="text-white-50 small"><?php echo ($_SESSION['successAlert']) ?></div>
            </div>
        </div>
    <?php } ?>

    <?php if (isset($_SESSION['dangerAlert'])) { ?>
        <div class="card bg-danger text-white shadow mb-4" id="dangerAlert" onclick="document.getElementById('dangerAlert').style.display='none'">
            <div class="card-body">
                TERJADI KESALAHAN!
                <div class="text-white-50 small"><?php echo ($_SESSION['dangerAlert']) ?></div>
            </div>
        </div>
    <?php } ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Penilai Publik Terdaftar</h6>

            <?php if ($_SESSION['role_id'] == 1) { ?>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-plus fa-sm fa-fw text-grey-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Tambah:</div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#tambahPenilaiModal">Penilai Publik</a>
                    </div>
                </div>
            <?php } ?>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table style="font-size: 12px" class="table table-bordered" id="tabel-kjpp-penilai" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Cabang/Pusat</th>
                            <th>Kota</th>
                            <th>Alamat</th>
                            <th>status</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <input type="hidden" value="<?php echo $idKjpp ?>" id="inputIdKjpp" readonly="true">
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<script src="<?= base_url() ?>vendor/sbadmin2/js/jquery.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $('#tabel-kjpp-penilai').dataTable({
            columnDefs: [{
                    "targets": 0, // your case first column
                    "width": "1%"

                },
                {
                    "targets": 1, // your case first column
                    "width": "40%",


                },
                {
                    "targets": 2, // your case first column
                    "width": "1%",

                },
                {
                    "targets": 3, // your case first column
                    "width": "20%",

                },
                {
                    "targets": 4, // your case first column
                    "width": "20%",


                },
                {
                    "targets": 5, // your case first column
                    "width": "5%",


                },
            ]
        });
    });
</script>

<script>
    $(document).ready(function() { // Ketika halaman sudah siap (sudah selesai di load)
        // Kita sembunyikan dulu untuk loadingnya
        $("#loading").hide();

        $("#provinsi").change(function() { // Ketika user mengganti atau memilih data provinsi
            $("#kota").hide(); // Sembunyikan dulu combobox kota nya
            $("#loading").show(); // Tampilkan loadingnya

            $.ajax({
                type: "POST", // Method pengiriman data bisa dengan GET atau POST
                url: "<?php echo base_url("kjpp/listKota"); ?>", // Isi dengan url/path file php yang dituju
                data: {
                    id_provinsi: $("#provinsi").val()
                }, // data yang akan dikirim ke file yang dituju
                dataType: "json",
                beforeSend: function(e) {
                    if (e && e.overrideMimeType) {
                        e.overrideMimeType("application/json;charset=UTF-8");
                    }
                },
                success: function(response) { // Ketika proses pengiriman berhasil
                    $("#loading").hide(); // Sembunyikan loadingnya
                    // set isi dari combobox kota
                    // lalu munculkan kembali combobox kotanya
                    $("#kota").html(response.list_kota).show();
                },
                error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                }
            });
        });
    });
</script>

<!-- End of Main Content -->