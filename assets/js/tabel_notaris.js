$(document).ready(function () {

    $('#tabel-notaris-perusahaanblacklist').DataTable().destroy();
    $('#tabel-notaris-perusahaanblacklist').DataTable({
        ajax: {
            url: "http://localhost/rekanan/blacklist/tabel_notaris_perusahaanblacklist",
            type: 'POST'
        },
    });

    $('#tabel-notaris-perusahaan').DataTable().destroy();
    $('#tabel-notaris-perusahaan').DataTable({
        ajax: {
            url: "http://localhost/rekanan/notaris/tabel_notaris_perusahaan",
            type: 'POST'
        },
    });

    $('#periode').change(function () {
        $('#tabel-notaris-perusahaan').DataTable().destroy();
        $('#tabel-notaris-perusahaan').DataTable({
            ajax: {
                data: { periode: $("#periode").val() },
                url: "http://localhost/rekanan/notaris/tabel_notaris_perusahaan",
                type: 'POST'
            },
        });
    });

    $('#kota_diizinkan').change(function () {
        if ($("#periode").val() == 'volvo') {
            $('#tabel-notaris-perusahaan').DataTable().destroy();
            $('#tabel-notaris-perusahaan').DataTable({
                ajax: {
                    data: { id_kota: $("#kota_diizinkan").val() },
                    url: "http://localhost/rekanan/notaris/tabel_notaris_perusahaan",
                    type: 'POST'
                },
            });
        } else {
            $('#tabel-notaris-perusahaan').DataTable().destroy();
            $('#tabel-notaris-perusahaan').DataTable({
                ajax: {
                    data: {
                        id_kota: $("#kota_diizinkan").val(),
                        periode: $("#periode").val()
                    },
                    url: "http://localhost/rekanan/notaris/tabel_notaris_perusahaan",
                    type: 'POST'
                },
            });
        }
    });

    $('#tabel-notaris-terbatas').DataTable().destroy();
    $('#tabel-notaris-terbatas').DataTable({
        ajax: {
            url: "http://localhost/rekanan/notaris/tabel_notaris_terbatas",
            type: 'POST'
        },
    });

    $('#periode').change(function () {
        $('#tabel-notaris-terbatas').DataTable().destroy();
        $('#tabel-notaris-terbatas').DataTable({
            ajax: {
                data: { periode: $("#periode").val() },
                url: "http://localhost/rekanan/notaris/tabel_notaris_terbatas",
                type: 'POST'
            },
        });
    });

    $('#kota_diizinkan').change(function () {
        if ($("#periode").val() == 'volvo') {
            $('#tabel-notaris-terbatas').DataTable().destroy();
            $('#tabel-notaris-terbatas').DataTable({
                ajax: {
                    data: { id_kota: $("#kota_diizinkan").val() },
                    url: "http://localhost/rekanan/notaris/tabel_notaris_terbatas",
                    type: 'POST'
                },
            });
        } else {
            $('#tabel-notaris-terbatas').DataTable().destroy();
            $('#tabel-notaris-terbatas').DataTable({
                ajax: {
                    data: {
                        id_kota: $("#kota_diizinkan").val(),
                        periode: $("#periode").val()
                    },
                    url: "http://localhost/rekanan/notaris/tabel_notaris_terbatas",
                    type: 'POST'
                },
            });
        }
    });

    $('#tabel-notaris-dapatDigunakan').DataTable().destroy();
    $('#tabel-notaris-dapatDigunakan').DataTable({
        ajax: {
            url: "http://localhost/rekanan/notaris/tabel_notaris_dapatDigunakan",
            type: 'POST'
        },
    });

    $('#periode').change(function () {
        $('#tabel-notaris-dapatDigunakan').DataTable().destroy();
        $('#tabel-notaris-dapatDigunakan').DataTable({
            ajax: {
                data: { periode: $("#periode").val() },
                url: "http://localhost/rekanan/notaris/tabel_notaris_dapatDigunakan",
                type: 'POST'
            },
        });
    });

    $('#kota_diizinkan').change(function () {
        if ($("#periode").val() == 'volvo') {
            $('#tabel-notaris-dapatDigunakan').DataTable().destroy();
            $('#tabel-notaris-dapatDigunakan').DataTable({
                ajax: {
                    data: { id_kota: $("#kota_diizinkan").val() },
                    url: "http://localhost/rekanan/notaris/tabel_notaris_dapatDigunakan",
                    type: 'POST'
                },
            });
        } else {
            $('#tabel-notaris-dapatDigunakan').DataTable().destroy();
            $('#tabel-notaris-dapatDigunakan').DataTable({
                ajax: {
                    data: {
                        id_kota: $("#kota_diizinkan").val(),
                        periode: $("#periode").val()
                    },
                    url: "http://localhost/rekanan/notaris/tabel_notaris_dapatDigunakan",
                    type: 'POST'
                },
            });
        }
    });

    $('#tabel-notaris-tidakDapatDigunakan').DataTable().destroy();
    $('#tabel-notaris-tidakDapatDigunakan').DataTable({
        ajax: {
            url: "http://localhost/rekanan/notaris/tabel_notaris_tidakDapatDigunakan",
            type: 'POST'
        },
    });

    $('#periode').change(function () {
        $('#tabel-notaris-tidakDapatDigunakan').DataTable().destroy();
        $('#tabel-notaris-tidakDapatDigunakan').DataTable({
            ajax: {
                data: { periode: $("#periode").val() },
                url: "http://localhost/rekanan/notaris/tabel_notaris_tidakDapatDigunakan",
                type: 'POST'
            },
        });
    });

    $('#kota_diizinkan').change(function () {
        if ($("#periode").val() == 'volvo') {
            $('#tabel-notaris-tidakDapatDigunakan').DataTable().destroy();
            $('#tabel-notaris-tidakDapatDigunakan').DataTable({
                ajax: {
                    data: { id_kota: $("#kota_diizinkan").val() },
                    url: "http://localhost/rekanan/notaris/tabel_notaris_tidakDapatDigunakan",
                    type: 'POST'
                },
            });
        } else {
            $('#tabel-notaris-tidakDapatDigunakan').DataTable().destroy();
            $('#tabel-notaris-tidakDapatDigunakan').DataTable({
                ajax: {
                    data: {
                        id_kota: $("#kota_diizinkan").val(),
                        periode: $("#periode").val()
                    },
                    url: "http://localhost/rekanan/notaris/tabel_notaris_tidakDapatDigunakan",
                    type: 'POST'
                },
            });
        }
    });


    var idWilayah = $('#inputidWilayah').val();
    console.log(idWilayah);
    $('#tabel-notaris-kelolaan').DataTable().destroy();
    $('#tabel-notaris-kelolaan').DataTable({
        ajax: {
            data: { idWilayah: idWilayah },
            url: "http://localhost/rekanan/NotarisKelolaan/tabel_notaris_kelolaan",
            type: 'POST'
        },
    });

    $('#periode').change(function () {
        $('#tabel-notaris-kelolaan').DataTable().destroy();
        $('#tabel-notaris-kelolaan').DataTable({
            ajax: {
                data: { periode: $("#periode").val(), idWilayah: idWilayah },
                url: "http://localhost/rekanan/NotarisKelolaan/tabel_notaris_kelolaan",
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