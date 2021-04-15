$(document).ready(function () {

    $('#tabel-kap-blacklist').DataTable().destroy();
    $('#tabel-kap-blacklist').DataTable({
        ajax: {
            url: "http://localhost/rekanan/blacklist/tabel_kap_blacklist",
            type: 'POST'
        },
    });

    $('#tabel-akuntan-blacklist').DataTable().destroy();
    $('#tabel-akuntan-blacklist').DataTable({
        ajax: {
            url: "http://localhost/rekanan/blacklist/tabel_kap_akuntanblacklist",
            type: 'POST'
        },
    });

    $('#periode').change(function () {
        $('#tabel-kap-perusahaan').DataTable().destroy();
        $('#tabel-kap-perusahaan').DataTable({
            ajax: {
                data: { periode: $("#periode").val() },
                url: "http://localhost/rekanan/kap/tabel_kap_perusahaan",
                type: 'POST'
            },
        });
    });


    $('#tabel-kap-perusahaan').DataTable().destroy();
    $('#tabel-kap-perusahaan').DataTable({
        ajax: {
            url: "http://localhost/rekanan/kap/tabel_kap_perusahaan",
            type: 'POST'
        },
    });

    $('#periode').change(function () {
        $('#tabel-kap-perusahaan').DataTable().destroy();
        $('#tabel-kap-perusahaan').DataTable({
            ajax: {
                data: { periode: $("#periode").val() },
                url: "http://localhost/rekanan/kap/tabel_kap_perusahaan",
                type: 'POST'
            },
        });
    });

    $('#kota_diizinkan').change(function () {
        if ($("#periode").val() == 'volvo') {
            $('#tabel-kap-perusahaan').DataTable().destroy();
            $('#tabel-kap-perusahaan').DataTable({
                ajax: {
                    data: { id_kota: $("#kota_diizinkan").val() },
                    url: "http://localhost/rekanan/kap/tabel_kap_perusahaan",
                    type: 'POST'
                },
            });
        } else {
            $('#tabel-kap-perusahaan').DataTable().destroy();
            $('#tabel-kap-perusahaan').DataTable({
                ajax: {
                    data: {
                        id_kota: $("#kota_diizinkan").val(),
                        periode: $("#periode").val()
                    },
                    url: "http://localhost/rekanan/kap/tabel_kap_perusahaan",
                    type: 'POST'
                },
            });
        }
    });

    $('#periode').change(function () {
        $('#tabel-kap-terbatas').DataTable().destroy();
        $('#tabel-kap-terbatas').DataTable({
            ajax: {
                data: { periode: $("#periode").val() },
                url: "http://localhost/rekanan/kap/tabel_kap_terbatas",
                type: 'POST'
            },
        });
    });


    $('#tabel-kap-terbatas').DataTable().destroy();
    $('#tabel-kap-terbatas').DataTable({
        ajax: {
            url: "http://localhost/rekanan/kap/tabel_kap_terbatas",
            type: 'POST'
        },
    });

    $('#periode').change(function () {
        $('#tabel-kap-terbatas').DataTable().destroy();
        $('#tabel-kap-terbatas').DataTable({
            ajax: {
                data: { periode: $("#periode").val() },
                url: "http://localhost/rekanan/kap/tabel_kap_terbatas",
                type: 'POST'
            },
        });
    });

    $('#kota_diizinkan').change(function () {
        if ($("#periode").val() == 'volvo') {
            $('#tabel-kap-terbatas').DataTable().destroy();
            $('#tabel-kap-terbatas').DataTable({
                ajax: {
                    data: { id_kota: $("#kota_diizinkan").val() },
                    url: "http://localhost/rekanan/kap/tabel_kap_terbatas",
                    type: 'POST'
                },
            });
        } else {
            $('#tabel-kap-terbatas').DataTable().destroy();
            $('#tabel-kap-terbatas').DataTable({
                ajax: {
                    data: {
                        id_kota: $("#kota_diizinkan").val(),
                        periode: $("#periode").val()
                    },
                    url: "http://localhost/rekanan/kap/tabel_kap_terbatas",
                    type: 'POST'
                },
            });
        }
    });

    $('#tabel-kap-dapatDigunakan').DataTable().destroy();
    $('#tabel-kap-dapatDigunakan').DataTable({
        ajax: {
            url: "http://localhost/rekanan/kap/tabel_kap_dapatDigunakan",
            type: 'POST'
        },
    });

    $('#periode').change(function () {
        $('#tabel-kap-dapatDigunakan').DataTable().destroy();
        $('#tabel-kap-dapatDigunakan').DataTable({
            ajax: {
                data: { periode: $("#periode").val() },
                url: "http://localhost/rekanan/kap/tabel_kap_dapatDigunakan",
                type: 'POST'
            },
        });
    });

    $('#kota_diizinkan').change(function () {
        if ($("#periode").val() == 'volvo') {
            $('#tabel-kap-dapatDigunakan').DataTable().destroy();
            $('#tabel-kap-dapatDigunakan').DataTable({
                ajax: {
                    data: { id_kota: $("#kota_diizinkan").val() },
                    url: "http://localhost/rekanan/kap/tabel_kap_dapatDigunakan",
                    type: 'POST'
                },
            });
        } else {
            $('#tabel-kap-dapatDigunakan').DataTable().destroy();
            $('#tabel-kap-dapatDigunakan').DataTable({
                ajax: {
                    data: {
                        id_kota: $("#kota_diizinkan").val(),
                        periode: $("#periode").val()
                    },
                    url: "http://localhost/rekanan/kap/tabel_kap_dapatDigunakan",
                    type: 'POST'
                },
            });
        }
    });

    $('#tabel-kap-tidakDapatDigunakan').DataTable().destroy();
    $('#tabel-kap-tidakDapatDigunakan').DataTable({
        ajax: {
            url: "http://localhost/rekanan/kap/tabel_kap_tidakDapatDigunakan",
            type: 'POST'
        },
    });

    $('#periode').change(function () {
        $('#tabel-kap-tidakDapatDigunakan').DataTable().destroy();
        $('#tabel-kap-tidakDapatDigunakan').DataTable({
            ajax: {
                data: { periode: $("#periode").val() },
                url: "http://localhost/rekanan/kap/tabel_kap_tidakDapatDigunakan",
                type: 'POST'
            },
        });
    });

    $('#kota_diizinkan').change(function () {
        if ($("#periode").val() == 'volvo') {
            $('#tabel-kap-tidakDapatDigunakan').DataTable().destroy();
            $('#tabel-kap-tidakDapatDigunakan').DataTable({
                ajax: {
                    data: { id_kota: $("#kota_diizinkan").val() },
                    url: "http://localhost/rekanan/kap/tabel_kap_tidakDapatDigunakan",
                    type: 'POST'
                },
            });
        } else {
            $('#tabel-kap-tidakDapatDigunakan').DataTable().destroy();
            $('#tabel-kap-tidakDapatDigunakan').DataTable({
                ajax: {
                    data: {
                        id_kota: $("#kota_diizinkan").val(),
                        periode: $("#periode").val()
                    },
                    url: "http://localhost/rekanan/kap/tabel_kap_tidakDapatDigunakan",
                    type: 'POST'
                },
            });
        }
    });

    var idKap = $('#inputIdKap').val();
    console.log(idKap);
    if (idKap > 0) {
        $('#tabel-kap-akuntan').DataTable().destroy();
        $('#tabel-kap-akuntan').DataTable({
            ajax: {
                data: { idKap: idKap },
                url: "http://localhost/rekanan/kap/tabel_kap_akuntan",
                type: 'POST'
            },
        });
    }

});