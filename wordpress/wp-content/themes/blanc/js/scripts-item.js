/*
    scripts-item.js v1.1
	License: GNU General Public License v3.0 (except referred code below)
	License URI: http://www.gnu.org/licenses/gpl-3.0.html	
	Copyright: (c) 2014 Mamekko, http://welcustom.net
*/

jQuery(function($){
    /* Source: http://jigowatt.co.uk/blog/magento-quantity-increments-jquery-edition/ */
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
    
    /* Review system */
    $('#respond h3').click(function(){
        $('.comment-form').slideToggle();
    });
    $('.comment-reply-link').click(function(){
        $('.comment-form').slideDown();
    });
});