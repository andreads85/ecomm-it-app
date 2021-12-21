jQuery(document).ready(function($){
    $(".cart-button").on( "click", function(e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var product_id = $(this).attr("data-id");
        $.ajax({
            type: 'POST',
            url: '/products/add_to_cart',
            data: {
                product_id
            },
            dataType: 'json',
            success: function (data) {
                $('#exampleModal').modal('show');
                $('#exampleModal').show();
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
});