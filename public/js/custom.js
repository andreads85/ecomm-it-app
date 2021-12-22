jQuery(document).ready(function($){
    $(".cart-button").on( "click", function(e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var product_id = $(this).attr("data-id");
        $('.product-details button.cart-button').prop('disabled', true);
        $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
        $.ajax({
            type: 'POST',
            url: '/products/add_to_cart',
            data: {
                product_id
            },
            dataType: 'json',
            success: function (data) {
                $('.product-details button.cart-button').prop('disabled', false);
                $('.product-details button.cart-button').html('<i class="bi bi-cart-plus"></i> Aggiungi al carrello');
                $("#exampleModal .modal-body").text(data.product_name);
                //$('#exampleModal').modal('show');
                $('#exampleModal').modal('toggle');
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
    $("#btnCloseModal").on('click', function() {
        $('#exampleModal').modal('hide');
    });
    $(".del-prod-from-cart").on('click', function(e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var product_id = $(this).closest('tr').attr("id").replace("prod-", "");
        $.ajax({
            type: 'POST',
            url: '/products/remove_from_cart',
            data: {
                product_id
            },
            dataType: 'json',
            success: function (data) {
                $("#prod-"+ product_id).css("background-color", "red");
                $("#prod-"+ product_id).fadeOut("slow");
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
});