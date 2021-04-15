<!-- Modal Notaris -->

<!-- Modal Tambah Notaris -->
<div class="modal fade" id="tambahNotarisModal" tabindex="-1" role="dialog" aria-labelledby="modalTambahNotaris" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalTambahNotaris">Tambah Notaris</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <form method="post" action="<?= base_url('notaris/newNotaris'); ?>">
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Notaris</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Notaris..">
                </div>
                <div class="form-group">
                    <label>Alamat Kantor Notaris</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat Kantor Notaris..">
                </div>
                <div class="form-group">
                    <label>Telepon Kantor Notaris</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Masukkan Telepon Kantor Notaris..">
                </div>
                <div class="form-group">
                    <label>HP Notaris</label>
                    <input type="text" class="form-control" id="ponsel" name="ponsel" placeholder="Masukkan HP Notaris..">
                </div>
                <div class="form-group">
                    <label>Fax</label>
                    <input type="text" class="form-control" id="fax" name="fax" placeholder="Masukkan Nomor Fax Kantor Notaris..">
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
                            <label>Wilayah</label><br>
                            <select id="id_wilayah" name="id_wilayah">
                                <option value='volvo'>--Pilih Wilayah--</option>
                                <?php 
                                    foreach ($wilayah as $w) {
                                        echo "<option value='".$w->id."'>".$w->wilayah."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-around">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Klasifikasi</label><br>
                            <select id="klasifikasi" name="klasifikasi">
                                <option value='volvo'>--Pilih Klasifikasi--</option>
                                <option value='A'>A</option>
                                <option value='B'>B</option>
                                <option value='C'>C</option>
                                <option value='D'>D</option>
                                <option value='E'>E</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label>Status</label><br>
                            <select id="id_status" name="id_status">
                                <option value='volvo'>--Pilih Status--</option>
                                <?php 
                                    foreach ($status as $s) {
                                        echo "<option value='".$s->id."'>".$s->jenis_status."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
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
                            <label>Tanggal Jatuh Tempo</label>
                            <input id="jatuhTempo" class="form-control" name="jatuhTempo">
                            <script>
                                $('#jatuhTempo').datepicker({
                                    uiLibrary: 'bootstrap4',
                                    format: 'yyyy-mm-dd',
                                    startDate: '1910-01-01',
                                    endDate: '2024-12-30',
                                    todayHighlight: true,
                                });
                            </script>
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
<script>
    // $('#jatuhTempoNotaris').datepicker({
    //     format: 'yyyy-mm-dd',
    //     startDate: '2000-01-01',
    //     endDate: '2050-12-30',
    //     todayHighlight: true,
    // });
</script>