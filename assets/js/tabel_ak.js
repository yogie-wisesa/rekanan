$(document).ready(function () {
    $('#tabel-ak-perusahaan').DataTable().destroy();
    $('#tabel-ak-perusahaan').DataTable({
        ajax: {
            url: "http://localhost/rekanan/asuransi_kerugian/tabel_ak_perusahaan",
            type: 'POST'
        },
    });

    $('#periode').change(function () {
        $('#tabel-ak-perusahaan').DataTable().destroy();
        $('#tabel-ak-perusahaan').DataTable({
            ajax: {
                data: { periode: $("#periode").val() },
                url: "http://localhost/rekanan/asuransi_kerugian/tabel_ak_perusahaan",
                type: 'POST'
            },
        });
    });

    $('#tabel-ak-terbatas').DataTable().destroy();
    $('#tabel-ak-terbatas').DataTable({
        ajax: {
            url: "http://localhost/rekanan/asuransi_kerugian/tabel_ak_terbatas",
            type: 'POST'
        },
    });

    $('#periode').change(function () {
        $('#tabel-ak-terbatas').DataTable().destroy();
        $('#tabel-ak-terbatas').DataTable({
            ajax: {
                data: { periode: $("#periode").val() },
                url: "http://localhost/rekanan/asuransi_kerugian/tabel_ak_terbatas",
                type: 'POST'
            },
        });
    });

    $('#tabel-ak-dapatDigunakan').DataTable().destroy();
    $('#tabel-ak-dapatDigunakan').DataTable({
        ajax: {
            url: "http://localhost/rekanan/asuransi_kerugian/tabel_ak_dapatDigunakan",
            type: 'POST'
        },
    });

    $('#periode').change(function () {
        $('#tabel-ak-dapatDigunakan').DataTable().destroy();
        $('#tabel-ak-dapatDigunakan').DataTable({
            ajax: {
                data: { periode: $("#periode").val() },
                url: "http://localhost/rekanan/asuransi_kerugian/tabel_ak_dapatDigunakan",
                type: 'POST'
            },
        });
    });

    $('#tabel-ak-tidakDapatDigunakan').DataTable().destroy();
    $('#tabel-ak-tidakDapatDigunakan').DataTable({
        ajax: {
            url: "http://localhost/rekanan/asuransi_kerugian/tabel_ak_tidakDapatDigunakan",
            type: 'POST'
        },
    });

    $('#periode').change(function () {
        $('#tabel-ak-tidakDapatDigunakan').DataTable().destroy();
        $('#tabel-ak-tidakDapatDigunakan').DataTable({
            ajax: {
                data: { periode: $("#periode").val() },
                url: "http://localhost/rekanan/asuransi_kerugian/tabel_ak_tidakDapatDigunakan",
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