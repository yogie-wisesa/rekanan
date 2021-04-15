<form method="post" action="./application/view/save.php">
    <div class="form-group row">
        <label class="col-sm-4 col-form-label">Kode Paket</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" value="<?php echo $row['kode_paket']; ?>" name="kode_paket">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-4 col-form-label">Nama Paket</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" value="<?php echo $row['nama_paket']; ?>" name="nama_paket">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-4 col-form-label">Harga</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" value="<?php echo $row['harga']; ?>" name="harga">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-4 col-form-label">Keterangan</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" value="<?php echo $row['keterangan']; ?>" name="keterangan">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-4 col-form-label">Jadwal</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" value="<?php echo $row['jadwal']; ?>" name="jadwal">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-4 col-form-label">Pemateri</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" value="<?php echo $row['pengajar']; ?>" name="pengajar">
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-danger pull-left" data-dismiss="modal">Cancel</a></button>
        <button type="submit" class="btn btn-primary pull-right">Save</a></button>
    </div>
</form>