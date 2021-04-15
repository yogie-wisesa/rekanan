<!-- Modal BLS -->

<!-- Modal Tambah Lokasi BLS -->
<div class="modal fade" id="tambahLokasiBlsModal" tabindex="-1" role="dialog" aria-labelledby="modalTambahLokasiBls" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalTambahLokasiBls">Tambah Kantor BLS</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <form method="post" action="<?= base_url('bls/tambahKantorBls'); ?>">
            <div class="modal-body">
                <div class="form-group">
                    <label>Alamat Kantor</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat Kantor..">
                    <input type="hidden" class="form-control" id="id_perusahaanBLS" name="id_perusahaanBLS" value="<?php echo($idBls) ?>" readonly="true">
                </div>
                <div class="form-group">
                    <label>Telepon Kantor</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Masukkan Telepon Kantor..">
                </div>
                <div class="form-group">
                    <label>Fax</label>
                    <input type="text" class="form-control" id="fax" name="fax" placeholder="Masukkan Nomor Fax Kantor..">
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
                            <label>Jenis Kantor</label><br>
                            <select id="jenisKantor" name="jenisKantor">
                                <option value='volvo'>--Pilih Status--</option>
                                <option value='PUSAT'>PUSAT</option>
                                <option value='CABANG'>CABANG</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-around">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Status Kantor</label><br>
                            <select id="id_status" name="id_status">
                                <option value='volvo'>--Pilih Status--</option>
                                <?php 
                                    foreach ($status as $sA) {
                                        echo "<option value='".$sA->id."'>".$sA->jenis_status."</option>";
                                    }
                                ?>
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
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="button" data-dismiss="modal">Batal</button>
                <button class="btn btn-success" type="submit">Tambahkan</button>
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