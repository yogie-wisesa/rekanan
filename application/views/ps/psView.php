<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row justify-content-around">
        <div class="col-md-8">
            <div class="row mb-1 ml-2">
                <select style="border-radius: 5px; margin-bottom: 10px; border-width:0px 0px 0px 0px; background-color:transparent; padding: 5px;
          box-shadow: 1px 3px rgba(0, 0, 0, 0.1); width: 250px;" name="periode" id="periode">
                    <option value="volvo">--Pilih Periode--</option>
                    <?php
                    foreach ($periode as $pe) { // Lakukan looping pada variabel siswa dari controller
                        echo "<option value='" . $pe->date . "'>" . $pe->keterangan . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
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
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Pialang Asuransi Terdaftar</h6>

            <?php if ($_SESSION['role_id'] == 1) { ?>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" data-toggle="modal" data-target="#tambahPsModal">
                        <i class="fas fa-plus fa-sm fa-fw text-grey-400"></i>
                    </a>
                </div>
            <?php } ?>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table style="font-size: 12px" class="table table-bordered" id="tabel-ps-perusahaan" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Pialang Asuransi</th>
                            <th>Kota</th>
                            <th>Alamat</th>
                            <th>Phone</th>
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

        $('#tabel-ps-perusahaan').dataTable({
            columnDefs: [{
                    "targets": 0, // your case first column
                    "width": "1%"

                },
                {
                    "targets": [1], // your case first column
                    "width": "10%",


                },
                {
                    "targets": 2, // your case first column
                    "width": "10%",

                },
                {
                    "targets": 3, // your case first column
                    "width": "5%",

                },
                {
                    "targets": 4, // your case first column
                    "width": "15%",

                },
                {
                    "targets": 5, // your case first column
                    "width": "5%",

                },
            ]
        });

        $("#provinsi_diizinkan").change(function() { // Ketika user mengganti atau memilih data provinsi
            $("#kota_diizinkan").hide(); // Sembunyikan dulu combobox kota nya
            $("#loading").show(); // Tampilkan loadingnya

            $.ajax({
                type: "POST", // Method pengiriman data bisa dengan GET atau POST
                url: "<?php echo base_url("kjpp/listKota"); ?>", // Isi dengan url/path file php yang dituju
                data: {
                    id_provinsi: $("#provinsi_diizinkan").val()
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
                    $("#kota_diizinkan").html(response.list_kota).show();
                },
                error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                }
            });
        });
    });
</script>
<!--End of Main Content-- >