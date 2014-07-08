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
<div class="column">

<?php if (have_posts()) : usces_remove_filter(); ?>

<section id="wc_<?php usces_page_name(); ?>" <?php post_class(); ?>>
    
<div class="entry">
		
<div id="customer-info">

	<div class="usccart_navi">
		<ol class="ucart">
        <li class="ucart usccart"><?php _e('Cart','blanc'); ?></li>
		<li class="ucart usccustomer usccart_customer"><?php _e('Customer info','blanc'); ?></li>
		<li class="ucart uscdelivery"><?php _e('Payment','blanc'); ?></li>
		<li class="ucart uscconfirm"><?php _e('Confirmation','blanc'); ?></li>
		</ol>
	</div>
	
	<div class="header_explanation">
	<?php do_action('usces_action_customer_page_header'); ?>
	</div><!-- end of header_explanation -->
	
	<div class="error_message"><?php usces_error_message(); ?></div>
<?php if( usces_is_membersystem_state() ) : ?>
	<h2><?php _e('The member please enter at here.','usces'); ?></h2>
	<form action="<?php usces_url('cart'); ?>" method="post" name="customer_loginform" onKeyDown="if (event.keyCode == 13) {return false;}">
	<table class="customer_form">
		<tr>
			<th scope="row"><?php _e('e-mail adress', 'usces'); ?></th>
			<td><input name="loginmail" id="loginmail" type="email" value="<?php echo esc_attr($usces_entries['customer']['mailaddress1']); ?>" style="ime-mode: inactive" /></td>
		</tr>
		<tr>
			<th scope="row"><?php _e('password', 'usces'); ?></th>
			<td><input class="hidden" value=" " /><input name="loginpass" id="loginpass" type="password" value="" autocomplete="off" /><a href="<?php usces_url('lostmemberpassword'); ?>" title="<?php _e('Did you forget your password?', 'usces'); ?>"><?php _e('Did you forget your password?', 'usces'); ?></a></td>
		</tr>
	</table>
	<div class="send"><input name="customerlogin" type="submit" value="<?php _e(' Next ', 'usces'); ?>" /></div>
	<?php do_action('usces_action_customer_page_member_inform'); ?>
	</form>
	<h2><?php _e('The nonmember please enter at here.','usces'); ?></h2>
<?php endif; ?>

	<form action="<?php echo USCES_CART_URL; ?>" method="post" name="customer_form" onKeyDown="if (event.keyCode == 13) {return false;}">
	<table class="customer_form">
		<tr>
			<th scope="row"><em><?php _e('*', 'usces'); ?></em><?php _e('e-mail adress', 'usces'); ?></th>
			<td colspan="2"><input name="customer[mailaddress1]" id="mailaddress1" type="email" value="<?php echo esc_attr($usces_entries['customer']['mailaddress1']); ?>" style="ime-mode: inactive" /></td>
		</tr>
		<tr>
			<th scope="row"><em><?php _e('*', 'usces'); ?></em><?php _e('e-mail adress', 'usces'); ?>(<?php _e('Re-input', 'usces'); ?>)</th>
			<td colspan="2"><input name="customer[mailaddress2]" id="mailaddress2" type="email" value="<?php echo esc_attr($usces_entries['customer']['mailaddress2']); ?>" style="ime-mode: inactive" /></td>
		</tr>
<?php if( usces_is_membersystem_state() ) : ?>
		<tr>
			<th scope="row"><?php if( $member_regmode == 'editmemberfromcart' ) : ?><em><?php _e('*', 'usces'); ?></em><?php endif; ?><?php _e('password', 'usces'); ?></th>
			<td colspan="2"><input class="hidden" value=" " /><input name="customer[password1]" type="password" value="<?php echo esc_attr($usces_entries['customer']['password1']); ?>" id="password1" autocomplete="off" /><?php if( $member_regmode != 'editmemberfromcart' ) _e('When you enroll newly, please fill it out.', 'usces'); ?>	</td>
		</tr>
		<tr>
			<th scope="row"><?php if( $member_regmode == 'editmemberfromcart' ) : ?><em><?php _e('*', 'usces'); ?></em><?php endif; ?><?php _e('Password (confirm)', 'usces'); ?></th>
			<td colspan="2"><input name="customer[password2]" type="password" value="<?php echo esc_attr($usces_entries['customer']['password2']); ?>" id="password2" /><?php if( $member_regmode != 'editmemberfromcart' ) _e('When you enroll newly, please fill it out.', 'usces'); ?></td>
		</tr>
<?php endif; ?>

<?php uesces_addressform( 'customer', $usces_entries, 'echo' ); ?>
	</table>
	<input name="member_regmode" type="hidden" value="<?php echo $member_regmode; ?>" />
	<div class="send">
	<?php usces_get_customer_button(); ?>
	</div>
	<?php do_action('usces_action_customer_page_inform'); ?>
	</form>

	<div class="footer_explanation">
	<?php do_action('usces_action_customer_page_footer'); ?>
	</div><!-- end of footer_explanation -->
</div><!-- end of customer-info -->

		</div><!-- end of entry -->
	</section>
<?php endif; ?>
</div><!--column-->
</div><!--row-->

<?php get_footer('nomenu'); ?>
