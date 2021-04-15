$(document).ready(function () {
    $('#tabel-aj-perusahaan').DataTable().destroy();
    $('#tabel-aj-perusahaan').DataTable({
        ajax: {
            url: "http://localhost/rekanan/asuransi_jiwa/tabel_aj_perusahaan",
            type: 'POST'
        },
    });

    $('#periode').change(function () {
        $('#tabel-aj-perusahaan').DataTable().destroy();
        $('#tabel-aj-perusahaan').DataTable({
            ajax: {
                data: { periode: $("#periode").val() },
                url: "http://localhost/rekanan/asuransi_jiwa/tabel_aj_perusahaan",
                type: 'POST'
            },
        });
    });

    $('#tabel-aj-terbatas').DataTable().destroy();
    $('#tabel-aj-terbatas').DataTable({
        ajax: {
            url: "http://localhost/rekanan/asuransi_jiwa/tabel_aj_terbatas",
            type: 'POST'
        },
    });

    $('#periode').change(function () {
        $('#tabel-aj-terbatas').DataTable().destroy();
        $('#tabel-aj-terbatas').DataTable({
            ajax: {
                data: { periode: $("#periode").val() },
                url: "http://localhost/rekanan/asuransi_jiwa/tabel_aj_terbatas",
                type: 'POST'
            },
        });
    });

    $('#tabel-aj-dapatDigunakan').DataTable().destroy();
    $('#tabel-aj-dapatDigunakan').DataTable({
        ajax: {
            url: "http://localhost/rekanan/asuransi_jiwa/tabel_aj_dapatDigunakan",
            type: 'POST'
        },
    });

    $('#periode').change(function () {
        $('#tabel-aj-dapatDigunakan').DataTable().destroy();
        $('#tabel-aj-dapatDigunakan').DataTable({
            ajax: {
                data: { periode: $("#periode").val() },
                url: "http://localhost/rekanan/asuransi_jiwa/tabel_aj_dapatDigunakan",
                type: 'POST'
            },
        });
    });

    $('#tabel-aj-tidakDapatDigunakan').DataTable().destroy();
    $('#tabel-aj-tidakDapatDigunakan').DataTable({
        ajax: {
            url: "http://localhost/rekanan/asuransi_jiwa/tabel_aj_tidakDapatDigunakan",
            type: 'POST'
        },
    });

    $('#periode').change(function () {
        $('#tabel-aj-tidakDapatDigunakan').DataTable().destroy();
        $('#tabel-aj-tidakDapatDigunakan').DataTable({
            ajax: {
                data: { periode: $("#periode").val() },
                url: "http://localhost/rekanan/asuransi_jiwa/tabel_aj_tidakDapatDigunakan",
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