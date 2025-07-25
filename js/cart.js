$(document).ready(function () {
    $('.quantity-input').on('input', function () {
        let price = $(this).attr('data-price');
        let quantity = $(this).val();
         if (quantity < 0) {
            quantity = 0;
            $(this).val(0); // Reset the input field to 0
        }
        let subtotal = price * quantity;
        $(this).closest('tr').find('.subtotal-input').val(subtotal);
    });

    $("#submitBuy").on("submit", function(e){
        e.preventDefault();

        
        let products = [];
        let hasError = false;

        $('tbody tr').each(function(index) {
            const quantity = parseInt($(this).find('.quantity-input').val());
            const product_id = parseInt($(this).find('.product_id').val());
            const cart_id = parseInt($(this).find('.cart_id').val());
            const price = parseInt($(this).find('.quantity-input').data('price'));
            
            // Skip empty quantities
            if (quantity > 0) {
                products.push({
                    quantity: quantity,
                    price: price,
                    product_id: product_id,
                    cart_id: cart_id
                });
            }
            if (isNaN(quantity) || quantity <= 0) {
                hasError = true;
            }
            if (hasError) {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "Quantity is empty",
                    showConfirmButton: false,
                    timer: 1000
                });
                return; 
            }
        });
        if(!hasError){
            $.ajax({
                url: 'backend/includes/buynow.inc.php',
                type: 'POST',
                data: JSON.stringify({ items: products }),
                cache: false,
                success: function(res){
                    location.reload();
                }
            }) 
        }
    })

});
