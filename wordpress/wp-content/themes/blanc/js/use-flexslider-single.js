/*
	use-flexslider-single.js v1.0
	License: GNU General Public License v3.0
	License URI: http://www.gnu.org/licenses/gpl-3.0.html	
	Copyright: (c) 2014 Mamekko, http://welcustom.net
*/

jQuery(function($) {
    $('#carousel').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        itemWidth: 138,
        itemMargin: 5,
        asNavFor: '#slider'
    });
    $('#slider').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        sync: "#carousel"
    });
    
    $('#slider li:first-child img').attr('itemprop', 'image');
});