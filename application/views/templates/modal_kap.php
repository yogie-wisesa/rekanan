<!-- Modal KAP -->

<!-- Modal Tambah Akuntan -->
<div class="modal fade" id="tambahAkuntanModal" tabindex="-1" role="dialog" aria-labelledby="modalTambahAkuntan" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalTambahAkuntan">Tambah Akuntan Publik</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <form method="post" action="<?= base_url('kap/tambahAkuntanKap'); ?>">
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Akuntan</label>
                    <input type="text" class="form-control" id="namaAkuntan" name="namaAkuntan" placeholder="Masukkan Nama Akuntan..">
                    <input type="hidden" class="form-control" id="id_perusahaanKap" name="id_perusahaanKap" value="<?php echo($idKap) ?>" readonly="true">
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
                <div class="form-group">
                    <label>Kota</label><br>
                    <select id="id_kota" name="id_kota">
                        <option value='volvo'>--Pilih Provinsi--</option>
                    </select>
                </div>
                <div class="row justify-content-around">
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
                    <div class="col-md-6">
                    <div class="form-group">
                            <label>Status Kantor</label><br>
                            <select id="statusKantor" name="statusKantor">
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
                            <label>Pasar Modal</label><br>
                            <select id="pasarModal" name="pasarModal">
                                <option value='volvo'>--Pilih--</option>
                                <option value='Ya'>Ya</option>
                                <option value='Tidak'>Tidak</option>
                                <option value=''>Tidak Tahu</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Perbankan</label><br>
                            <select id="perbankan" name="perbankan">
                                <option value='volvo'>--Pilih--</option>
                                <option value='Ya'>Ya</option>
                                <option value='Tidak'>Tidak</option>
                                <option value=''>Tidak Tahu</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-around">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Status Akuntan</label><br>
                            <select id="id_status" name="id_status">
                                <option value='volvo'>--Pilih Status--</option>
                                <?php 
                                    foreach ($statusAkuntan as $sA) {
                                        echo "<option value='".$sA->id."'>".$sA->jenis_status."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>IKNB</label><br>
                            <select id="iknb" name="iknb">
                                <option value='volvo'>--Pilih--</option>
                                <option value='Ya'>Ya</option>
                                <option value='Tidak'>Tidak</option>
                                <option value=''>Tidak Tahu</option>
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

<!-- Modal Daftar Kantor KAP -->
<div class="modal fade" id="daftarKantorKapModal" tabindex="-1" role="dialog" aria-labelledby="modalDaftarKantorKap" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalDaftarKantorKap">Daftar Kantor KAP</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="tabel-kap-daftar-kantor" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kota</th>
                            <th>Status Kantor</th>
                            <th>Alamat</th>
                            <th>Phone</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <script>
                        function saveIdKap(id, nama) {
                            $("#kantorKap").text(nama);
                            $("#id_kantorKap").val(id);
                        }
                    </script> 
                </table>
            </div>
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