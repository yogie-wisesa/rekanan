<!-- Modal KAP -->

<!-- Modal Daftar Kantor KAP -->
<div class="modal fade" id="kjppObjek" tabindex="-1" role="dialog" aria-labelledby="modalKjppObjek" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalKjppObjek">Objek KJPP</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div style="margin:20px">
                <div class="table-responsive">
                    <table class="table table-bordered" id="tabel-kjpp-objek" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Objek</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <script>
                            function saveIdKjpp(id, nama) {
                                $("#kantorKjpp").text(nama);
                                $("#id_kantorKjpp").val(id);
                            }
                        </script>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>