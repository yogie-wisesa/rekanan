<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800" style="font-weight: bold">Upload Data KJPP</h1>

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

    <div class="row justify-content-around">
        <div class="col-md-6">
           <!-- DataTales Example -->
           <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Input Manual</h6>
                </div>

                <div class="card-body">
                    <form class="user" method="post" action="<?= base_url('kjpp/newKjpp'); ?>">
                        <div class="form-group">
                            <label>Nama Perusahaan KJPP</label>
                            <input type="text" class="form-control" id="namaPerusahaanKjpp" name="namaPerusahaanKjpp" placeholder="Masukkan Nama Instansi..">
                        </div>
                        <div class="row justify-content-around">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor Rekanan</label>
                                    <input type="text" class="form-control" id="nomorRekananKjpp" name="nomorRekananKjpp" placeholder="Masukkan Nomor Rekanan..">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status Perusahaan</label><br>
                                    <select id="id_status" name="id_status">
                                        <option value='volvo'>--Pilih Status--</option>
                                        <?php
                                        foreach ($status as $data) { // Lakukan looping pada variabel siswa dari controller
                                            echo "<option value='" . $data->id . "'>" . $data->jenis_status . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-around">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Jatuh Tempo</label>
                                    <input id="jatuhTempoKjpp" class="form-control" name="jatuhTempoKjpp">
                                    <script>
                                        var $j = jQuery.noConflict();
                                        $j('#jatuhTempoKjpp').datepicker({
                                            uiLibrary: 'bootstrap4',
                                            format: 'yyyy-mm-dd',
                                            startDate: '1910-01-01',
                                            endDate: '2024-12-30',
                                            todayHighlight: true,
                                        });
                                    </script>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nilai Perusahaan</label>
                                    <input type="text" class="form-control" id="nilaiKjpp" name="nilaiKjpp" placeholder="Masukkan Angka..">
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-around">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Terdaftar di OJK</label><br>
                                    <select id="terdaftarOjkKjpp" name="terdaftarOjkKjpp">
                                        <option value='volvo'>--Pilih--</option>
                                        <option value='Ya'>Ya</option>
                                        <option value='Tidak'>Tidak</option>
                                        <option value=''>Tidak Tahu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Sanksi</label><br>
                                    <select id="id_sanksi" name="id_sanksi">
                                        <option value='volvo'>--Pilih Sanksi--</option>
                                        <?php
                                        foreach ($sanksi as $sK) { // Lakukan looping pada variabel siswa dari controller
                                            echo "<option value='" . $sK->id . "'>" . $sK->sanksi . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">
                            Submit Perusahaan Baru
                        </button>
                    </form>
                </div>
            </div> 
        </div>

        <div class="col-md-6">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-success">Upload dari CSV Excel</h6>
                </div>
                <div class="card-body">
                    <form class="user" method="post" action="<?= base_url('kjpp/uploadKjpp'); ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <p class="p mb-2 text-gray-800">ID Instansi KJPP Terakhir: 
                                <?php
                                foreach ($lastKjppId as $dataId) { // Lakukan looping pada variabel siswa dari controller
                                    echo "<b>".$dataId->id."</b>";
                                }
                                ?>
                            </p>
                            <p class="p mb-2 text-gray-800">ID Penilai Publik Terakhir: 
                                <?php
                                foreach ($lastPenilaiPublikId as $dataPenId) { // Lakukan looping pada variabel siswa dari controller
                                    echo "<b>".$dataPenId->id."</b>";
                                }
                                ?>
                            </p>
                            <a class="btn btn-warning btn-block btn-sm" style="width: 50%;" href="<?= base_url('downloadable/perusahaanKjpp.csv'); ?>">Unduh Template KJPP</a>
                            <a class="btn btn-warning btn-block btn-sm" style="width: 50%;" href="<?= base_url('downloadable/penilaiPublik.csv'); ?>">Unduh Template Penilai Publik</a>
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