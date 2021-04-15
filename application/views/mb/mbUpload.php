<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800" style="font-weight: bold">Upload Data Money Broker</h1>
    <div class="row">

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
            <!-- Card Header - Dropdown -->
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-success">Upload dari Excel</h6>
            </div>
            <div class="card-body">
                <form class="user" method="post" action="<?= base_url('MoneyBroker/uploadMb'); ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <p class="p mb-2 text-gray-800">ID Money Broker Terakhir: 
                            <?php
                            foreach ($lastMbId as $dataId) { // Lakukan looping pada variabel siswa dari controller
                                echo "<b>".$dataId->id."</b>";
                            }
                            ?>
                        </p>
                        <a class="btn btn-warning btn-block btn-sm" style="width: 50%;" href="<?= base_url('downloadable/moneyBroker.csv'); ?>">Unduh Template MB</a>
                        <i>Nb: JANGAN MERUBAH NAMA FILE!</i><br><br>

                        <label>Upload File CSV Excel</label>
                        <input type="file" class="form-control-file" name="upl_csv">
                    </div>
                    <button type="submit" class="btn btn-success btn-block">
                        Upload File
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>
<!-- /.container-fluid -->

</div>
<script src="<?= base_url() ?>vendor/sbadmin2/js/jquery.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/datepicker/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/bootstrap-datetimepicker.js"></script>

<script>
    $(document).ready(function() { // Ketika halaman sudah siap (sudah selesai di load)
        // Kita sembunyikan dulu untuk loadingnya
        $("#loading").hide();

        $("#provinsi").change(function() { // Ketika user mengganti atau memilih data provinsi
            $("#kota").hide(); // Sembunyikan dulu combobox kota nya
            $("#loading").show(); // Tampilkan loadingnya

            $.ajax({
                type: "POST", // Method pengiriman data bisa dengan GET atau POST
                url: "<?php echo base_url("diizinkan/listKota"); ?>", // Isi dengan url/path file php yang dituju
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
<script>
    // $('#datetimepicker4').datepicker({
    //     format: 'yyyy-mm-dd',
    //     startDate: '2000-01-01',
    //     endDate: '2050-12-30',
    //     todayHighlight: true,
    // });
</script>
<script>
    $("#jenisInstansi").change(function() {
        var jenis = $("#jenisInstansi").val();
        console.log(jenis);
    })
</script>
<!--End of Main Content-- >