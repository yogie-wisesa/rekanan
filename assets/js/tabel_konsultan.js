$(document).ready(function () {

    $('#tabel-konsultan-blacklist').DataTable().destroy();
    $('#tabel-konsultan-blacklist').DataTable({
        ajax: {
            url: "http://localhost/rekanan/blacklist/tabel_konsultan_blacklist",
            type: 'POST'
        },
    });

    $('#tabel-konsultan-perusahaan').DataTable().destroy();
    $('#tabel-konsultan-perusahaan').DataTable({
        ajax: {
            url: "http://localhost/rekanan/konsultan/tabel_konsultan_perusahaan",
            type: 'POST'
        },
    });

    $('#periode').change(function () {
        $('#tabel-konsultan-perusahaan').DataTable().destroy();
        $('#tabel-konsultan-perusahaan').DataTable({
            ajax: {
                data: { periode: $("#periode").val() },
                url: "http://localhost/rekanan/konsultan/tabel_konsultan_perusahaan",
                type: 'POST'
            },
        });
    });

    $('#kota_diizinkan').change(function () {
        if ($("#periode").val() == 'volvo') {
            $('#tabel-konsultan-perusahaan').DataTable().destroy();
            $('#tabel-konsultan-perusahaan').DataTable({
                ajax: {
                    data: { id_kota: $("#kota_diizinkan").val() },
                    url: "http://localhost/rekanan/konsultan/tabel_konsultan_perusahaan",
                    type: 'POST'
                },
            });
        } else {
            $('#tabel-konsultan-perusahaan').DataTable().destroy();
            $('#tabel-konsultan-perusahaan').DataTable({
                ajax: {
                    data: {
                        id_kota: $("#kota_diizinkan").val(),
                        periode: $("#periode").val()
                    },
                    url: "http://localhost/rekanan/konsultan/tabel_konsultan_perusahaan",
                    type: 'POST'
                },
            });
        }
    });

    $('#tabel-konsultan-terbatas').DataTable().destroy();
    $('#tabel-konsultan-terbatas').DataTable({
        ajax: {
            url: "http://localhost/rekanan/konsultan/tabel_konsultan_terbatas",
            type: 'POST'
        },
    });

    $('#periode').change(function () {
        $('#tabel-konsultan-terbatas').DataTable().destroy();
        $('#tabel-konsultan-terbatas').DataTable({
            ajax: {
                data: { periode: $("#periode").val() },
                url: "http://localhost/rekanan/konsultan/tabel_konsultan_terbatas",
                type: 'POST'
            },
        });
    });

    $('#kota_diizinkan').change(function () {
        if ($("#periode").val() == 'volvo') {
            $('#tabel-konsultan-terbatas').DataTable().destroy();
            $('#tabel-konsultan-terbatas').DataTable({
                ajax: {
                    data: { id_kota: $("#kota_diizinkan").val() },
                    url: "http://localhost/rekanan/konsultan/tabel_konsultan_terbatas",
                    type: 'POST'
                },
            });
        } else {
            $('#tabel-konsultan-terbatas').DataTable().destroy();
            $('#tabel-konsultan-terbatas').DataTable({
                ajax: {
                    data: {
                        id_kota: $("#kota_diizinkan").val(),
                        periode: $("#periode").val()
                    },
                    url: "http://localhost/rekanan/konsultan/tabel_konsultan_terbatas",
                    type: 'POST'
                },
            });
        }
    });

    $('#tabel-konsultan-dapatDigunakan').DataTable().destroy();
    $('#tabel-konsultan-dapatDigunakan').DataTable({
        ajax: {
            url: "http://localhost/rekanan/konsultan/tabel_konsultan_dapatDigunakan",
            type: 'POST'
        },
    });

    $('#periode').change(function () {
        $('#tabel-konsultan-dapatDigunakan').DataTable().destroy();
        $('#tabel-konsultan-dapatDigunakan').DataTable({
            ajax: {
                data: { periode: $("#periode").val() },
                url: "http://localhost/rekanan/konsultan/tabel_konsultan_dapatDigunakan",
                type: 'POST'
            },
        });
    });

    $('#kota_diizinkan').change(function () {
        if ($("#periode").val() == 'volvo') {
            $('#tabel-konsultan-dapatDigunakan').DataTable().destroy();
            $('#tabel-konsultan-dapatDigunakan').DataTable({
                ajax: {
                    data: { id_kota: $("#kota_diizinkan").val() },
                    url: "http://localhost/rekanan/konsultan/tabel_konsultan_dapatDigunakan",
                    type: 'POST'
                },
            });
        } else {
            $('#tabel-konsultan-dapatDigunakan').DataTable().destroy();
            $('#tabel-konsultan-dapatDigunakan').DataTable({
                ajax: {
                    data: {
                        id_kota: $("#kota_diizinkan").val(),
                        periode: $("#periode").val()
                    },
                    url: "http://localhost/rekanan/konsultan/tabel_konsultan_dapatDigunakan",
                    type: 'POST'
                },
            });
        }
    });

    $('#tabel-konsultan-tidakDapatDigunakan').DataTable().destroy();
    $('#tabel-konsultan-tidakDapatDigunakan').DataTable({
        ajax: {
            url: "http://localhost/rekanan/konsultan/tabel_konsultan_tidakDapatDigunakan",
            type: 'POST'
        },
    });

    $('#periode').change(function () {
        $('#tabel-konsultan-tidakDapatDigunakan').DataTable().destroy();
        $('#tabel-konsultan-tidakDapatDigunakan').DataTable({
            ajax: {
                data: { periode: $("#periode").val() },
                url: "http://localhost/rekanan/konsultan/tabel_konsultan_tidakDapatDigunakan",
                type: 'POST'
            },
        });
    });

    $('#kota_diizinkan').change(function () {
        if ($("#periode").val() == 'volvo') {
            $('#tabel-konsultan-tidakDapatDigunakan').DataTable().destroy();
            $('#tabel-konsultan-tidakDapatDigunakan').DataTable({
                ajax: {
                    data: { id_kota: $("#kota_diizinkan").val() },
                    url: "http://localhost/rekanan/konsultan/tabel_konsultan_tidakDapatDigunakan",
                    type: 'POST'
                },
            });
        } else {
            $('#tabel-konsultan-tidakDapatDigunakan').DataTable().destroy();
            $('#tabel-konsultan-tidakDapatDigunakan').DataTable({
                ajax: {
                    data: {
                        id_kota: $("#kota_diizinkan").val(),
                        periode: $("#periode").val()
                    },
                    url: "http://localhost/rekanan/konsultan/tabel_konsultan_tidakDapatDigunakan",
                    type: 'POST'
                },
            });
        }
    });

    $('#periode').change(function () {
        $('#tabel-konsultan-kelolaan').DataTable().destroy();
        $('#tabel-konsultan-kelolaan').DataTable({
            ajax: {
                data: { periode: $("#periode").val()},
                url: "http://localhost/rekanan/konsultan/tabel_konsultan_kelolaan",
                type: 'POST'
            },
        });
    });

    // var idNotaris = $('#inputIdNotaris').val();
    // if (idNotaris > 0) {
    //     $('#tabel-notaris-detail').DataTable().destroy();
    //     $('#tabel-notaris-detail').DataTable({
    //         ajax: {
    //             data: { idNotaris: idNotaris },
    //             url: "http://localhost/rekanan/notaris/tabel_notaris_detail",
    //             type: 'POST'
    //         },
    //     });
    // }

});