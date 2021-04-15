$(document).ready(function () {

    $('#tabel-mi-blacklist').DataTable().destroy();
    $('#tabel-mi-blacklist').DataTable({
        ajax: {
            url: "http://localhost/rekanan/blacklist/tabel_mi_blacklist",
            type: 'POST'
        },
    });

    $('#tabel-mi-perusahaan').DataTable().destroy();
    $('#tabel-mi-perusahaan').DataTable({
        ajax: {
            url: "http://localhost/rekanan/manager_investasi/tabel_mi_perusahaan",
            type: 'POST'
        },
    });

    $('#periode').change(function () {
        $('#tabel-mi-perusahaan').DataTable().destroy();
        $('#tabel-mi-perusahaan').DataTable({
            ajax: {
                data: { periode: $("#periode").val() },
                url: "http://localhost/rekanan/manager_investasi/tabel_mi_perusahaan",
                type: 'POST'
            },
        });
    });

    $('#tabel-mi-terbatas').DataTable().destroy();
    $('#tabel-mi-terbatas').DataTable({
        ajax: {
            url: "http://localhost/rekanan/manager_investasi/tabel_mi_terbatas",
            type: 'POST'
        },
    });

    $('#periode').change(function () {
        $('#tabel-mi-terbatas').DataTable().destroy();
        $('#tabel-mi-terbatas').DataTable({
            ajax: {
                data: { periode: $("#periode").val() },
                url: "http://localhost/rekanan/manager_investasi/tabel_mi_terbatas",
                type: 'POST'
            },
        });
    });

    $('#tabel-mi-dapatDigunakan').DataTable().destroy();
    $('#tabel-mi-dapatDigunakan').DataTable({
        ajax: {
            url: "http://localhost/rekanan/manager_investasi/tabel_mi_dapatDigunakan",
            type: 'POST'
        },
    });

    $('#periode').change(function () {
        $('#tabel-mi-dapatDigunakan').DataTable().destroy();
        $('#tabel-mi-dapatDigunakan').DataTable({
            ajax: {
                data: { periode: $("#periode").val() },
                url: "http://localhost/rekanan/manager_investasi/tabel_mi_dapatDigunakan",
                type: 'POST'
            },
        });
    });

    $('#tabel-mi-tidakDapatDigunakan').DataTable().destroy();
    $('#tabel-mi-tidakDapatDigunakan').DataTable({
        ajax: {
            url: "http://localhost/rekanan/manager_investasi/tabel_mi_tidakDapatDigunakan",
            type: 'POST'
        },
    });

    $('#periode').change(function () {
        $('#tabel-mi-tidakDapatDigunakan').DataTable().destroy();
        $('#tabel-mi-tidakDapatDigunakan').DataTable({
            ajax: {
                data: { periode: $("#periode").val() },
                url: "http://localhost/rekanan/manager_investasi/tabel_mi_tidakDapatDigunakan",
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