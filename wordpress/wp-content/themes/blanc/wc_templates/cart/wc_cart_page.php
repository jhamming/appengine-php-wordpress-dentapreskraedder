<?php
/**
 * <meta content="charset=UTF-8">
 * @package Welcart
 * @subpackage Welcart Default Theme
 *
 * @link          http://welcustom.net/
 * @arranged by   Mamekko
 */
get_header('nomenu'); ?>

<div class="row">
<div class="columns">

<?php if (have_posts()) : usces_remove_filter(); ?>
	
<section id="wc_<?php usces_page_name(); ?>" <?php post_class(); ?>>

<div class="entry">

<div id="inside-cart">

	<div class="usccart_navi">
		<ol class="ucart">
		<li class="ucart usccart usccart_cart"><?php _e('Cart','blanc'); ?></li>
		<li class="ucart usccustomer"><?php _e('Customer info','blanc'); ?></li>
		<li class="ucart uscdelivery"><?php _e('Payment','blanc'); ?></li>
		<li class="ucart uscconfirm"><?php _e('Confirmation','blanc'); ?></li>
		</ol>
	</div>
	
	<div class="header_explanation">
	<?php do_action('usces_action_cart_page_header'); ?>
	</div>
	
	<div class="error_message"><?php usces_error_message(); ?></div>
	<form action="<?php usces_url('cart'); ?>" method="post" onKeyDown="if (event.keyCode == 13) {return false;}">
	<?php if( usces_is_cart() ) : ?>
		
	<div id="cart">
		<div class="upbutton"><?php _e('To change quantity, press Update button.','blanc'); ?><input name="upButton" type="submit" value="<?php _e('Quantity renewal','usces'); ?>" onclick="return uscesCart.upCart()" /></div>
		<table id="cart_table">
			<thead>
			<tr>
				<th class="thumbnail"> </th>
				<th><?php _e('Product','blanc'); ?></th>
				<th class="price"><?php _e('Price','blanc'); ?></th>
				<th class="quantity"><?php _e('Qty','blanc'); ?></th>
				<th class="subtotal"><?php _e('Total','blanc'); ?><?php usces_guid_tax(); ?></th>
				<th class="action">&nbsp;</th>
			</tr>
			</thead>
			<tbody>
		<?php usces_get_cart_rows(); ?>
			</tbody>
			<tfoot>
			<tr>
				<th colspan="4" scope="row" class="aright"><?php _e('Subtotal','blanc'); ?><?php usces_guid_tax(); ?></th>
				<th class="aright"><?php usces_crform(usces_total_price('return'), true, false); ?></th>
				<th>&nbsp;</th>
			</tr>
			</tfoot>
		</table>
		<div class="currency_code"><?php _e('Currency','usces'); ?> : <?php usces_crcode(); ?></div>
		<?php if( $usces_gp ) : ?>
		<img src="<?php get_template_directory_uri(); ?>/images/gp.gif" alt="<?php _e('Business package discount','usces'); ?>" /><br /><?php _e('The price with this mark applys to Business pack discount.','usces'); ?>
		<?php endif; ?>
        
        <?php $num = ( $this->options['postage_privilege'] )- ( $this->get_total_price() );
        if( 0 < $num ): ?>
            <div class="postage_privilege">
                
            <?php echo sprintf(__('Get Free Shipping with <span>%s</span> more parchase.','blanc'), usces_crform($num, true, false, 'return')); ?>
            </div>
        <?php endif; ?>

	</div><!-- end of cart -->
	
	<?php else : ?>
	<div class="no_cart"><?php _e('There are no items in your cart.','usces'); ?></div>
	<?php endif; ?>
	
	<?php the_content();?>
	
	<div class="send"><?php usces_get_cart_button(); ?></div>
	<?php do_action('usces_action_cart_page_inform'); ?>
	</form>
	
	<div class="footer_explanation">
	<?php do_action('usces_action_cart_page_footer'); ?>
	</div>
</div><!-- end of inside-cart -->

		</div><!-- end of entry -->
	</section>
    
<?php endif; ?>
</div><!--columns-->
</div><!--row-->

<?php get_footer('nomenu'); ?>
