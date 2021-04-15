<!-- Modal KAP -->

<!-- Modal Daftar Kantor KAP -->
<div class="modal fade" id="kjppSektor" tabindex="-1" role="dialog" aria-labelledby="modalKjppSektor" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalKjppSektor">Sektor KJPP</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div style="margin:20px">
                <div class="table-responsive">
                    <table class="table table-bordered" id="tabel-kjpp-sektor" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Sektor</th>
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