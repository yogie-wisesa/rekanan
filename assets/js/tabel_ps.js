$(document).ready(function () {

    $('#tabel-ps-blacklist').DataTable().destroy();
    $('#tabel-ps-blacklist').DataTable({
        ajax: {
            url: "http://localhost/rekanan/blacklist/tabel_ps_blacklist",
            type: 'POST'
        },
    });

    $('#tabel-ps-perusahaan').DataTable().destroy();
    $('#tabel-ps-perusahaan').DataTable({
        ajax: {
            url: "http://localhost/rekanan/pialang_asuransi/tabel_ps_perusahaan",
            type: 'POST'
        },
    });

    $('#periode').change(function () {
        $('#tabel-ps-perusahaan').DataTable().destroy();
        $('#tabel-ps-perusahaan').DataTable({
            ajax: {
                data: { periode: $("#periode").val() },
                url: "http://localhost/rekanan/pialang_asuransi/tabel_ps_perusahaan",
                type: 'POST'
            },
        });
    });

    $('#tabel-ps-terbatas').DataTable().destroy();
    $('#tabel-ps-terbatas').DataTable({
        ajax: {
            url: "http://localhost/rekanan/pialang_asuransi/tabel_ps_terbatas",
            type: 'POST'
        },
    });

    $('#periode').change(function () {
        $('#tabel-ps-terbatas').DataTable().destroy();
        $('#tabel-ps-terbatas').DataTable({
            ajax: {
                data: { periode: $("#periode").val() },
                url: "http://localhost/rekanan/pialang_asuransi/tabel_ps_terbatas",
                type: 'POST'
            },
        });
    });

    $('#tabel-ps-dapatDigunakan').DataTable().destroy();
    $('#tabel-ps-dapatDigunakan').DataTable({
        ajax: {
            url: "http://localhost/rekanan/pialang_asuransi/tabel_ps_dapatDigunakan",
            type: 'POST'
        },
    });

    $('#periode').change(function () {
        $('#tabel-ps-dapatDigunakan').DataTable().destroy();
        $('#tabel-ps-dapatDigunakan').DataTable({
            ajax: {
                data: { periode: $("#periode").val() },
                url: "http://localhost/rekanan/pialang_asuransi/tabel_ps_dapatDigunakan",
                type: 'POST'
            },
        });
    });

    $('#tabel-ps-tidakDapatDigunakan').DataTable().destroy();
    $('#tabel-ps-tidakDapatDigunakan').DataTable({
        ajax: {
            url: "http://localhost/rekanan/pialang_asuransi/tabel_ps_tidakDapatDigunakan",
            type: 'POST'
        },
    });

    $('#periode').change(function () {
        $('#tabel-ps-tidakDapatDigunakan').DataTable().destroy();
        $('#tabel-ps-tidakDapatDigunakan').DataTable({
            ajax: {
                data: { periode: $("#periode").val() },
                url: "http://localhost/rekanan/pialang_asuransi/tabel_ps_tidakDapatDigunakan",
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