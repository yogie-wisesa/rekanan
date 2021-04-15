$(document).ready(function () {

    $('#tabel-mb-blacklist').DataTable().destroy();
    $('#tabel-mb-blacklist').DataTable({
        ajax: {
            url: "http://localhost/rekanan/blacklist/tabel_mb_blacklist",
            type: 'POST'
        },
    });

    $('#tabel-mb-perusahaan').DataTable().destroy();
    $('#tabel-mb-perusahaan').DataTable({
        ajax: {
            url: "http://localhost/rekanan/MoneyBroker/tabel_mb_perusahaan",
            type: 'POST'
        },
    });

    $('#periode').change(function () {
        $('#tabel-mb-perusahaan').DataTable().destroy();
        $('#tabel-mb-perusahaan').DataTable({
            ajax: {
                data: { periode: $("#periode").val() },
                url: "http://localhost/rekanan/MoneyBroker/tabel_mb_perusahaan",
                type: 'POST'
            },
        });
    });

    $('#tabel-mb-terbatas').DataTable().destroy();
    $('#tabel-mb-terbatas').DataTable({
        ajax: {
            url: "http://localhost/rekanan/MoneyBroker/tabel_mb_terbatas",
            type: 'POST'
        },
    });

    $('#periode').change(function () {
        $('#tabel-mb-terbatas').DataTable().destroy();
        $('#tabel-mb-terbatas').DataTable({
            ajax: {
                data: { periode: $("#periode").val() },
                url: "http://localhost/rekanan/MoneyBroker/tabel_mb_terbatas",
                type: 'POST'
            },
        });
    });

    $('#tabel-mb-dapatDigunakan').DataTable().destroy();
    $('#tabel-mb-dapatDigunakan').DataTable({
        ajax: {
            url: "http://localhost/rekanan/MoneyBroker/tabel_mb_dapatDigunakan",
            type: 'POST'
        },
    });

    $('#periode').change(function () {
        $('#tabel-mb-dapatDigunakan').DataTable().destroy();
        $('#tabel-mb-dapatDigunakan').DataTable({
            ajax: {
                data: { periode: $("#periode").val() },
                url: "http://localhost/rekanan/MoneyBroker/tabel_mb_dapatDigunakan",
                type: 'POST'
            },
        });
    });

    $('#tabel-mb-tidakDapatDigunakan').DataTable().destroy();
    $('#tabel-mb-tidakDapatDigunakan').DataTable({
        ajax: {
            url: "http://localhost/rekanan/MoneyBroker/tabel_mb_tidakDapatDigunakan",
            type: 'POST'
        },
    });

    $('#periode').change(function () {
        $('#tabel-mb-tidakDapatDigunakan').DataTable().destroy();
        $('#tabel-mb-tidakDapatDigunakan').DataTable({
            ajax: {
                data: { periode: $("#periode").val() },
                url: "http://localhost/rekanan/MoneyBroker/tabel_mb_tidakDapatDigunakan",
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