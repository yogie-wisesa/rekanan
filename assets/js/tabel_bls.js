$(document).ready(function () {
    $('#tabel-bls-perusahaan').DataTable().destroy();
    $('#tabel-bls-perusahaan').DataTable({
        ajax: {
            url: "http://localhost/rekanan/bls/tabel_bls_perusahaan",
            type: 'POST'
        },
    });

    $('#periode').change(function () {
        $('#tabel-bls-perusahaan').DataTable().destroy();
        $('#tabel-bls-perusahaan').DataTable({
            ajax: {
                data: { periode: $("#periode").val() },
                url: "http://localhost/rekanan/bls/tabel_bls_perusahaan",
                type: 'POST'
            },
        });
    });

    $('#kota_diizinkan').change(function () {
        if ($("#periode").val() == 'volvo') {
            $('#tabel-bls-perusahaan').DataTable().destroy();
            $('#tabel-bls-perusahaan').DataTable({
                ajax: {
                    data: { id_kota: $("#kota_diizinkan").val() },
                    url: "http://localhost/rekanan/bls/tabel_bls_perusahaan",
                    type: 'POST'
                },
            });
        } else {
            $('#tabel-bls-perusahaan').DataTable().destroy();
            $('#tabel-bls-perusahaan').DataTable({
                ajax: {
                    data: {
                        id_kota: $("#kota_diizinkan").val(),
                        periode: $("#periode").val()
                    },
                    url: "http://localhost/rekanan/bls/tabel_bls_perusahaan",
                    type: 'POST'
                },
            });
        }
    });

    $('#tabel-bls-terbatas').DataTable().destroy();
    $('#tabel-bls-terbatas').DataTable({
        ajax: {
            url: "http://localhost/rekanan/bls/tabel_bls_terbatas",
            type: 'POST'
        },
    });

    $('#periode').change(function () {
        $('#tabel-bls-terbatas').DataTable().destroy();
        $('#tabel-bls-terbatas').DataTable({
            ajax: {
                data: { periode: $("#periode").val() },
                url: "http://localhost/rekanan/bls/tabel_bls_terbatas",
                type: 'POST'
            },
        });
    });

    $('#kota_diizinkan').change(function () {
        if ($("#periode").val() == 'volvo') {
            $('#tabel-bls-terbatas').DataTable().destroy();
            $('#tabel-bls-terbatas').DataTable({
                ajax: {
                    data: { id_kota: $("#kota_diizinkan").val() },
                    url: "http://localhost/rekanan/bls/tabel_bls_terbatas",
                    type: 'POST'
                },
            });
        } else {
            $('#tabel-bls-terbatas').DataTable().destroy();
            $('#tabel-bls-terbatas').DataTable({
                ajax: {
                    data: {
                        id_kota: $("#kota_diizinkan").val(),
                        periode: $("#periode").val()
                    },
                    url: "http://localhost/rekanan/bls/tabel_bls_terbatas",
                    type: 'POST'
                },
            });
        }
    });

    $('#tabel-bls-dapatDigunakan').DataTable().destroy();
    $('#tabel-bls-dapatDigunakan').DataTable({
        ajax: {
            url: "http://localhost/rekanan/bls/tabel_bls_dapatDigunakan",
            type: 'POST'
        },
    });

    $('#periode').change(function () {
        $('#tabel-bls-dapatDigunakan').DataTable().destroy();
        $('#tabel-bls-dapatDigunakan').DataTable({
            ajax: {
                data: { periode: $("#periode").val() },
                url: "http://localhost/rekanan/bls/tabel_bls_dapatDigunakan",
                type: 'POST'
            },
        });
    });

    $('#kota_diizinkan').change(function () {
        if ($("#periode").val() == 'volvo') {
            $('#tabel-bls-dapatDigunakan').DataTable().destroy();
            $('#tabel-bls-dapatDigunakan').DataTable({
                ajax: {
                    data: { id_kota: $("#kota_diizinkan").val() },
                    url: "http://localhost/rekanan/bls/tabel_bls_dapatDigunakan",
                    type: 'POST'
                },
            });
        } else {
            $('#tabel-bls-dapatDigunakan').DataTable().destroy();
            $('#tabel-bls-dapatDigunakan').DataTable({
                ajax: {
                    data: {
                        id_kota: $("#kota_diizinkan").val(),
                        periode: $("#periode").val()
                    },
                    url: "http://localhost/rekanan/bls/tabel_bls_dapatDigunakan",
                    type: 'POST'
                },
            });
        }
    });

    $('#tabel-bls-tidakDapatDigunakan').DataTable().destroy();
    $('#tabel-bls-tidakDapatDigunakan').DataTable({
        ajax: {
            url: "http://localhost/rekanan/bls/tabel_bls_tidakDapatDigunakan",
            type: 'POST'
        },
    });

    $('#periode').change(function () {
        $('#tabel-bls-tidakDapatDigunakan').DataTable().destroy();
        $('#tabel-bls-tidakDapatDigunakan').DataTable({
            ajax: {
                data: { periode: $("#periode").val() },
                url: "http://localhost/rekanan/bls/tabel_bls_tidakDapatDigunakan",
                type: 'POST'
            },
        });
    });

    $('#kota_diizinkan').change(function () {
        if ($("#periode").val() == 'volvo') {
            $('#tabel-bls-tidakDapatDigunakan').DataTable().destroy();
            $('#tabel-bls-tidakDapatDigunakan').DataTable({
                ajax: {
                    data: { id_kota: $("#kota_diizinkan").val() },
                    url: "http://localhost/rekanan/bls/tabel_bls_tidakDapatDigunakan",
                    type: 'POST'
                },
            });
        } else {
            $('#tabel-bls-tidakDapatDigunakan').DataTable().destroy();
            $('#tabel-bls-tidakDapatDigunakan').DataTable({
                ajax: {
                    data: {
                        id_kota: $("#kota_diizinkan").val(),
                        periode: $("#periode").val()
                    },
                    url: "http://localhost/rekanan/bls/tabel_bls_tidakDapatDigunakan",
                    type: 'POST'
                },
            });
        }
    });

    var idBls = $('#inputIdBls').val();
    if (idBls > 0) {
        $('#tabel-bls-detail').DataTable().destroy();
        $('#tabel-bls-detail').DataTable({
            ajax: {
                data: { idBls: idBls },
                url: "http://localhost/rekanan/bls/tabel_bls_detail",
                type: 'POST'
            },
        });
    }

});