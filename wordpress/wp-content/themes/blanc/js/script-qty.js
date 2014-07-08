/*
	script-qty.js
    Source: http://jigowatt.co.uk/blog/magento-quantity-increments-jquery-edition/
*/

jQuery(function($){
    $('.quant').append('<input type="button" value="+" id="add1" class="plus" />').prepend('<input type="button" value="-" id="minus1" class="minus" />');
    $('.plus').click(function(){
        var currentVal = parseInt(jQuery(this).prev('.skuquantity').val());
        if (!currentVal || currentVal=='' || currentVal == 'NaN') currentVal = 0;
        $(this).prev('.skuquantity').val(currentVal + 1); 
    });

    $('.minus').click(function(){
        var currentVal = parseInt(jQuery(this).next('.skuquantity').val());
        if (currentVal == 'NaN') currentVal = 0;
        if (currentVal > 0) {
            $(this).next('.skuquantity').val(currentVal - 1);
        }
    });
});