$(document).ready(function () {

    $('#tabel-kjpp-blacklist').DataTable().destroy();
    $('#tabel-kjpp-blacklist').DataTable({
        ajax: {
            url: "http://localhost/rekanan/blacklist/tabel_kjpp_blacklist",
            type: 'POST'
        },
    });

    $('#tabel-kjpp-penilaiblacklist').DataTable().destroy();
    $('#tabel-kjpp-penilaiblacklist').DataTable({
        ajax: {
            url: "http://localhost/rekanan/blacklist/tabel_kjpp_penilaiblacklist",
            type: 'POST'
        },
    });

    $('#tabel-kjpp-perusahaan').DataTable().destroy();
    $('#tabel-kjpp-perusahaan').DataTable({
        ajax: {
            url: "http://localhost/rekanan/kjpp/tabel_kjpp_perusahaan",
            type: 'POST'
        },
    });

    $('#periode').change(function () {
        $('#tabel-kjpp-perusahaan').DataTable().destroy();
        $('#tabel-kjpp-perusahaan').DataTable({
            ajax: {
                data: { periode: $("#periode").val() },
                url: "http://localhost/rekanan/kjpp/tabel_kjpp_perusahaan",
                type: 'POST'
            },
        });
    });

    $('#kota_diizinkan').change(function () {
        if ($("#periode").val() == 'volvo') {
            $('#tabel-kjpp-perusahaan').DataTable().destroy();
            $('#tabel-kjpp-perusahaan').DataTable({
                ajax: {
                    data: { id_kota: $("#kota_diizinkan").val() },
                    url: "http://localhost/rekanan/kjpp/tabel_kjpp_perusahaan",
                    type: 'POST'
                },
            });
        } else {
            $('#tabel-kjpp-perusahaan').DataTable().destroy();
            $('#tabel-kjpp-perusahaan').DataTable({
                ajax: {
                    data: {
                        id_kota: $("#kota_diizinkan").val(),
                        periode: $("#periode").val()
                    },
                    url: "http://localhost/rekanan/kjpp/tabel_kjpp_perusahaan",
                    type: 'POST'
                },
            });
        }
    });

    $('#tabel-kjpp-terbatas').DataTable().destroy();
    $('#tabel-kjpp-terbatas').DataTable({
        ajax: {
            url: "http://localhost/rekanan/kjpp/tabel_kjpp_terbatas",
            type: 'POST'
        },
    });

    $('#periode').change(function () {
        $('#tabel-kjpp-terbatas').DataTable().destroy();
        $('#tabel-kjpp-terbatas').DataTable({
            ajax: {
                data: { periode: $("#periode").val() },
                url: "http://localhost/rekanan/kjpp/tabel_kjpp_terbatas",
                type: 'POST'
            },
        });
    });

    $('#kota_diizinkan').change(function () {
        if ($("#periode").val() == 'volvo') {
            $('#tabel-kjpp-terbatas').DataTable().destroy();
            $('#tabel-kjpp-terbatas').DataTable({
                ajax: {
                    data: { id_kota: $("#kota_diizinkan").val() },
                    url: "http://localhost/rekanan/kjpp/tabel_kjpp_terbatas",
                    type: 'POST'
                },
            });
        } else {
            $('#tabel-kjpp-terbatas').DataTable().destroy();
            $('#tabel-kjpp-terbatas').DataTable({
                ajax: {
                    data: {
                        id_kota: $("#kota_diizinkan").val(),
                        periode: $("#periode").val()
                    },
                    url: "http://localhost/rekanan/kjpp/tabel_kjpp_terbatas",
                    type: 'POST'
                },
            });
        }
    });

    $('#tabel-kjpp-dapatDigunakan').DataTable().destroy();
    $('#tabel-kjpp-dapatDigunakan').DataTable({
        ajax: {
            url: "http://localhost/rekanan/kjpp/tabel_kjpp_dapatDigunakan",
            type: 'POST'
        },
    });

    $('#periode').change(function () {
        $('#tabel-kjpp-dapatDigunakan').DataTable().destroy();
        $('#tabel-kjpp-dapatDigunakan').DataTable({
            ajax: {
                data: { periode: $("#periode").val() },
                url: "http://localhost/rekanan/kjpp/tabel_kjpp_dapatDigunakan",
                type: 'POST'
            },
        });
    });

    $('#kota_diizinkan').change(function () {
        if ($("#periode").val() == 'volvo') {
            $('#tabel-kjpp-dapatDigunakan').DataTable().destroy();
            $('#tabel-kjpp-dapatDigunakan').DataTable({
                ajax: {
                    data: { id_kota: $("#kota_diizinkan").val() },
                    url: "http://localhost/rekanan/kjpp/tabel_kjpp_dapatDigunakan",
                    type: 'POST'
                },
            });
        } else {
            $('#tabel-kjpp-dapatDigunakan').DataTable().destroy();
            $('#tabel-kjpp-dapatDigunakan').DataTable({
                ajax: {
                    data: {
                        id_kota: $("#kota_diizinkan").val(),
                        periode: $("#periode").val()
                    },
                    url: "http://localhost/rekanan/kjpp/tabel_kjpp_dapatDigunakan",
                    type: 'POST'
                },
            });
        }
    });

    $('#tabel-kjpp-tidakDapatDigunakan').DataTable().destroy();
    $('#tabel-kjpp-tidakDapatDigunakan').DataTable({
        ajax: {
            url: "http://localhost/rekanan/kjpp/tabel_kjpp_tidakDapatDigunakan",
            type: 'POST'
        },
    });

    $('#periode').change(function () {
        $('#tabel-kjpp-tidakDapatDigunakan').DataTable().destroy();
        $('#tabel-kjpp-tidakDapatDigunakan').DataTable({
            ajax: {
                data: { periode: $("#periode").val() },
                url: "http://localhost/rekanan/kjpp/tabel_kjpp_tidakDapatDigunakan",
                type: 'POST'
            },
        });
    });

    $('#kota_diizinkan').change(function () {
        if ($("#periode").val() == 'volvo') {
            $('#tabel-kjpp-tidakDapatDigunakan').DataTable().destroy();
            $('#tabel-kjpp-tidakDapatDigunakan').DataTable({
                ajax: {
                    data: { id_kota: $("#kota_diizinkan").val() },
                    url: "http://localhost/rekanan/kjpp/tabel_kjpp_tidakDapatDigunakan",
                    type: 'POST'
                },
            });
        } else {
            $('#tabel-kjpp-tidakDapatDigunakan').DataTable().destroy();
            $('#tabel-kjpp-tidakDapatDigunakan').DataTable({
                ajax: {
                    data: {
                        id_kota: $("#kota_diizinkan").val(),
                        periode: $("#periode").val()
                    },
                    url: "http://localhost/rekanan/kjpp/tabel_kjpp_tidakDapatDigunakan",
                    type: 'POST'
                },
            });
        }
    });

    var idKjpp = $('#inputIdKjpp').val();
    console.log(idKjpp);
    if (idKjpp > 0) {
        $('#tabel-kjpp-penilai').DataTable().destroy();
        $('#tabel-kjpp-penilai').DataTable({
            ajax: {
                data: { idKjpp: idKjpp },
                url: "http://localhost/rekanan/kjpp/tabel_kjpp_penilai",
                type: 'POST'
            },
        });

        $('#tabel-kjpp-penilai').DataTable().destroy();
        $('#tabel-kjpp-penilai').DataTable({
            ajax: {
                data: { idKjpp: idKjpp },
                url: "http://localhost/rekanan/kjpp/tabel_kjpp_penilai",
                type: 'POST'
            },
        });
    }

});