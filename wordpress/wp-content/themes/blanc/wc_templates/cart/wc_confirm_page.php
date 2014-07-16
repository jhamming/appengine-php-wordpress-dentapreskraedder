<?php
/**
 * <meta content="charset=UTF-8">
 * @package Welcart
 * @subpackage Welcart Default Theme
 *
 * @link          http://welcustom.net/
 * @arranged by   Mamekko
 */
get_header( 'nomenu' );
?>

<div class="row">
<div class="columns">

<?php if (have_posts()) : usces_remove_filter(); ?>

<section id="wc_<?php usces_page_name(); ?>" <?php post_class(); ?>>
    
<div class="entry">
		
<div id="info-confirm">
	<div class="confiem_notice">
	<?php _e('*Please do not add other items or change quantity in another window.','blanc'); ?>
	</div>
	
	<div class="usccart_navi">
		<ol class="ucart">
        <li class="ucart usccart"><?php _e('Cart','blanc'); ?></li>
		<li class="ucart usccustomer"><?php _e('Customer info','blanc'); ?></li>
		<li class="ucart uscdelivery"><?php _e('Payment','blanc'); ?></li>
		<li class="ucart uscconfirm usccart_confirm"><?php _e('Confirmation','blanc'); ?></li>
		</ol>
	</div>

	<div class="header_explanation">
<?php do_action('usces_action_confirm_page_header'); ?>
	</div><!-- end of header_explanation -->

	<div id="cart">
		<div class="currency_code"><?php _e('Currency','usces'); ?> : <?php usces_crcode(); ?></div>
		<table id="cart_table">
			<thead>
			<tr>
				<th class="thumbnail">&nbsp;&nbsp;</th>
				<th><?php _e('Product','blanc'); ?></th>
				<th class="price"><?php _e('Price','blanc'); ?></th>
				<th class="quantity"><?php _e('Qty','blanc'); ?></th>
				<th class="subtotal"><?php _e('Total','blanc'); ?></th>
			</tr>
			</thead>
			<tbody>
		<?php usces_get_confirm_rows(); ?>
			</tbody>
			<tfoot>
			<tr>
				<th colspan="4" class="aright"><?php _e('Subtotal','blanc'); ?></th>
				<th class="aright"><?php usces_crform($usces_entries['order']['total_items_price'], true, false); ?></th>
			</tr>
<?php if( !empty($usces_entries['order']['discount']) ) : ?>
			<tr>
				<td colspan="4" class="aright"><?php echo apply_filters('usces_confirm_discount_label', __('Campaign disnount', 'usces')); ?></td>
				<td class="aright" style="color:#FF0000"><?php usces_crform($usces_entries['order']['discount'], true, false); ?></td>
			</tr>
<?php endif; ?>
<?php if( 0.00 < (float)$usces_entries['order']['tax'] && 'products' == usces_get_tax_target() ) : ?>
			<tr>
				<td colspan="4" class="aright"><?php usces_tax_label(); ?></td>
				<td class="aright"><?php usces_tax($usces_entries) ?></td>
			</tr>
<?php endif; ?>
			<tr>
				<td colspan="4" class="aright"><?php _e('Shipping', 'usces'); ?></td>
				<td class="aright"><?php usces_crform($usces_entries['order']['shipping_charge'], true, false); ?></td>
			</tr>
<?php if( !empty($usces_entries['order']['cod_fee']) ) : ?>
			<tr>
				<td colspan="4" class="aright"><?php echo apply_filters('usces_filter_cod_label', __('COD fee', 'usces')); ?></td>
				<td class="aright"><?php usces_crform($usces_entries['order']['cod_fee'], true, false); ?></td>
			</tr>
<?php endif; ?>
<?php if( 0.00 < (float)$usces_entries['order']['tax'] && 'all' == usces_get_tax_target() ) : ?>
			<tr>
				<td colspan="4" class="aright"><?php usces_tax_label(); ?></td>
				<td class="aright"><?php usces_tax($usces_entries) ?></td>
			</tr>
<?php endif; ?>
<?php if( usces_is_member_system() && usces_is_member_system_point() && !empty($usces_entries['order']['usedpoint']) ) : ?>
			<tr>
				<td colspan="4" class="aright"><?php _e('Used points', 'usces'); ?></td>
				<td class="aright" style="color:#FF0000"><?php echo number_format($usces_entries['order']['usedpoint']); ?></td>
			</tr>
<?php endif; ?>
			<tr>
				<th colspan="4" class="aright"><?php _e('Total Amount', 'usces'); ?></th>
				<th class="aright"><?php usces_crform($usces_entries['order']['total_full_price'], true, false); ?></th>
			</tr>
			</tfoot>
		</table>
<?php if( usces_is_member_system() && usces_is_member_system_point() &&  usces_is_login() ) : ?>
		<form action="<?php usces_url('cart'); ?>" method="post" onKeyDown="if (event.keyCode == 13) {return false;}">
		<div class="error_message" style="text-align: center;"><?php usces_error_message(); ?></div>
		<table cellspacing="0" id="point_table">
			<tr>
				<td><?php _e('The current point', 'usces'); ?></td>
				<td><span class="point"><?php echo $usces_members['point']; ?></span>pt</td>
			</tr>
			<tr>
				<td><?php _e('Points you are using here', 'usces'); ?></td>
				<td><input name="offer[usedpoint]" class="used_point" type="text" value="<?php echo esc_attr($usces_entries['order']['usedpoint']); ?>" />pt</td>
			</tr>
				<tr>
				<td colspan="2"><input name="use_point" type="submit" class="use_point_button" value="<?php _e('Use the points', 'usces'); ?>" /></td>
			</tr>
	</table>
	<?php do_action('usces_action_confirm_page_point_inform'); ?>
	</form>
<?php endif; ?>
 
	</div>
	<table id="confirm_table">
		<tr class="ttl" >
			<td colspan="2"><h3><?php _e('Customer Information', 'usces'); ?></h3></td>
		</tr>
		<tr>
			<th><?php _e('e-mail adress', 'usces'); ?></th>
			<td><?php echo esc_html($usces_entries['customer']['mailaddress1']); ?></td>
		</tr>
            <?php uesces_addressform( 'confirm', $usces_entries, 'echo' ); ?>
		<tr class="ttl">
			<td colspan="2"><h3><?php _e('Others', 'usces'); ?></h3></td>
		</tr>
		<tr>
			<th><?php _e('shipping option', 'usces'); ?></th><td><?php echo esc_html(usces_delivery_method_name( $usces_entries['order']['delivery_method'], 'return' )); ?></td>
		</tr>
		<tr>
			<th><?php _e('Delivery date', 'usces'); ?></th><td><?php echo esc_html($usces_entries['order']['delivery_date']); ?></td>
		</tr>
		<tr class="bdc">
			<th><?php _e('Delivery Time', 'usces'); ?></th><td><?php echo esc_html($usces_entries['order']['delivery_time']); ?></td>
		</tr>
		<tr>
			<th><?php _e('payment method', 'usces'); ?></th><td><?php echo esc_html($usces_entries['order']['payment_name'] . usces_payment_detail($usces_entries)); ?></td>
		</tr>
<?php usces_custom_field_info($usces_entries, 'order', ''); ?>
		<tr>
			<th><?php _e('Notes', 'usces'); ?></th><td><?php echo nl2br(esc_html($usces_entries['order']['note'])); ?></td>
		</tr>
	</table>

<?php usces_purchase_button(); ?>

	<div class="footer_explanation">
<?php do_action('usces_action_confirm_page_footer'); ?>
	</div><!-- end of footer_explanation -->

</div><!-- end of info-confirm -->

		</div><!-- end of entry -->
	</section>
<?php endif; ?>
</div><!--columns-->
</div><!--row-->

<?php get_footer( 'nomenu' ); ?>
