$(document).ready(function () {
    $('.quantity-input').on('input', function () {
        let price = $(this).attr('data-price');
        let quantity = $(this).val();
        let subtotal = price * quantity;
        $(this).closest('tr').find('.subtotal-input').val(subtotal);
    });

});
