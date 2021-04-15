<!-- Modal Tambah Penilai -->
<div class="modal fade" id="tambahPenilaiModal" tabindex="-1" role="dialog" aria-labelledby="modalTambahPenilai" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalTambahPenilai">Tambah Penilai Publik</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <form method="post" action="<?= base_url('kjpp/tambahPenilaiKjpp'); ?>">
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Penilai</label>
                    <input type="text" class="form-control" id="penilaiPublik" name="penilaiPublik" placeholder="Masukkan Nama Penilai..">
                    <input type="hidden" class="form-control" id="id_perusahanKjpp" name="id_perusahanKjpp" value="<?php echo($idKjpp) ?>" readonly="true">
                </div>
                <div class="form-group">
                    <label>Alamat Kantor</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat Kantor..">
                </div>
                <div class="form-group">
                    <label>Telepon Kantor</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Masukkan Telepon Kantor..">
                </div>
                <div class="form-group">
                    <label>Provinsi</label><br>
                    <select id="id_provinsi" name="id_provinsi">
                        <option value='volvo'>--Pilih Provinsi--</option>
                        <?php 
                            foreach ($provinsi as $pV) {
                                echo "<option value='".$pV->id."'>".$pV->nama_provinsi."</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="row justify-content-around">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kota</label><br>
                            <select id="id_kota" name="id_kota">
                                <option value='volvo'>--Pilih Provinsi--</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Sanksi</label><br>
                            <select id="id_sanksi" name="id_sanksi">
                                <option value='volvo'>--Pilih Sanksi--</option>
                                <?php 
                                    foreach ($sanksi as $sK) {
                                        echo "<option value='".$sK->id."'>".$sK->sanksi."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-around">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jenis Kantor</label><br>
                            <select id="jenisKantor" name="jenisKantor">
                                <option value='volvo'>--Pilih Jenis Kantor--</option>
                                <option value='PUSAT'>PUSAT</option>
                                <option value='CABANG'>CABANG</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jasa Penilaian</label><br>
                            <select id="id_jasaPenilai" name="id_jasaPenilai">
                                <option value='volvo'>--Pilih Jasa--</option>
                                <?php 
                                    foreach ($jasaPenilai as $jP) {
                                        echo "<option value='".$jP->id."'>".$jP->jasaPenilai."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-around">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Status Penilai</label><br>
                            <select id="id_status" name="id_status">
                                <option value='volvo'>--Pilih Status--</option>
                                <?php 
                                    foreach ($statusPenilai as $sP) {
                                        echo "<option value='".$sP->id."'>".$sP->jenis_status."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>OJK</label><br>
                            <select id="id_ojkKjpp" name="id_ojkKjpp">
                                <option value='volvo'>--Pilih OJK--</option>
                                <?php 
                                    foreach ($ojkKjpp as $ojK) {
                                        echo "<option value='".$ojK->id."'>".$ojK->ojkKjpp."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan Keterangan..">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="button" data-dismiss="modal">Batal</button>
                <button class="btn btn-success" type="submit">Tambahkan</button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- Modal Hapus KJPP -->
<div class="modal fade" id="hapusKjppModal" tabindex="-1" role="dialog" aria-labelledby="modalHapusKjpp" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalHapusKjpp">Hapus KJPP?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <form method="post" action="<?= base_url('dashboard/hapusKjpp'); ?>">
            <div class="modal-body">
                <p>Apa Anda yakin ingin menghapus <b id="namaKjppHapus">KJPP Ucok</b> ?</p>
                <input type="hidden" value="0" id="idHapusKjpp" name="idHapusKjpp">
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" data-dismiss="modal">Batal</button>
                <button class="btn btn-danger" type="submit">Hapus</button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- Modal Hapus Penilai Publik -->
<div class="modal fade" id="hapusPenilaiModal" tabindex="-1" role="dialog" aria-labelledby="modalHapusPenilai" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalHapusPenilai">Hapus Penilai Publik?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <form method="post" action="<?= base_url('dashboard/hapusPenilaiKjpp'); ?>">
            <div class="modal-body">
                <p>Apa Anda yakin ingin menghapus penilai bernama <b id="namaPenilaiHapus">KJPP Ucok</b> ?</p>
                <input type="hidden" value="0" id="idHapusPenilai" name="idHapusPenilai">
                <input type="hidden" value="<?php echo($idKjpp) ?>" id="idKjpp2" name="idKjpp2">
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" data-dismiss="modal">Batal</button>
                <button class="btn btn-danger" type="submit">Hapus</button>
            </div>
        </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() { // Ketika halaman sudah siap (sudah selesai di load)
        // Kita sembunyikan dulu untuk loadingnya

        $("#id_provinsi").change(function() { // Ketika user mengganti atau memilih data provinsi
            $("#id_kota").hide(); // Sembunyikan dulu combobox kota nya
            $("#loading").show(); // Tampilkan loadingnya

            $.ajax({
                type: "POST", // Method pengiriman data bisa dengan GET atau POST
                url: "<?php echo base_url("kjpp/listKota"); ?>", // Isi dengan url/path file php yang dituju
                data: {
                    id_provinsi: $("#id_provinsi").val()
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
                    $("#id_kota").html(response.list_kota).show();
                },
                error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                }
            });
        });
    });
</script>