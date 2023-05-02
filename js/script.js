$(document).ready(function() {

    // menghilangkan tombol cari

    $('#tombol-cari').hide();

    // event ketika keyword ditulis
    
    $('#keyword').on('keyup', function() {
        $('.loader').show();
        // ajax menggunakan load
        // $('#container').load('ajax/inventory.php?keyword=' + $('#keyword').val());
        // ajax menggunakan GET
        $.get('ajax/inventory.php?keyword=' + $('#keyword').val(), function(data){

            $('#container').html(data);
            $('.loader').hide();

        });
    });

});