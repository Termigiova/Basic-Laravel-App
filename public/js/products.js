$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.getRequest').click( function() {
        let product = $(this).data('product');
        let shop = $('#storeSelect option:selected').val();
        let quantityValueName = 'quantityValue' + product;
        let quantity = $('input[name=' + quantityValueName + ']').val();
        let url = "/getRequest";

        $.ajax({

            type: "POST",
            url: url,
            data: {
                product: product,
                shop: shop,
                quantity: quantity,
            },
            success: function (status) {
                sweetAlert(status);
            },
            error: function (status) {
                sweetAlert(status);
            }
        });
    });

    function sweetAlert(status) {
        switch (status) {
            case "success":
                swal({
                    title: '<strong>Rejoice! Your purchase is complete</strong>',
                    type: 'success',
                    confirmButtonText: 'Neat',
                });
                break;
            case "Invalid values":
                swal({
                    title: 'Error! ' + status,
                    type: 'error',
                    html:
                        '<img src="https://i.pinimg.com/originals/e3/16/a4/e316a4c9cbbb391f8dd7c02174f20bdb.png">',
                    confirmButtonText: 'Indeed'
                });
                break;
        }
    }
});