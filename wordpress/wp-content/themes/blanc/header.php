<?php
/**
 * The template for displaying Header.
 * @link       http://welcustom.net/
 * @author      Mamekko
 * @copyright   Copyright (c)2014 welcustom.net
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width,user-scalable=no">
    
<title><?php wp_title('&ndash;', true, 'right'); ?></title>

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<header id="header">
<div class="row">
	<div class="columns medium-5 small-10">
	<h1><a href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo('name'); ?></a></h1>
	<p><?php bloginfo('description'); ?></p>
	</div>
	
    <?php if(function_exists('usces_the_item')): ?>
	<div class="cart columns medium-1 medium-push-6 small-2">
        <a href="<?php echo USCES_CART_URL; ?>" title="<?php _e('Shopping Cart','blanc'); ?>" style="display: inline-flex;">
            <i class="fa fa-shopping-cart"></i>
            <span class="item_quantity"><?php usces_totalquantity_in_cart(); ?></span>
        </a>
    </div>
	
	<dl class="nav columns medium-6 medium-pull-1">
	<dt class="nav-button"><i class="fa fa-list fa-fw"></i><?php _e('MENU','blanc'); ?></dt>
	<dd class="menu-wrap">
        <nav>
        <?php wp_nav_menu( array(
            'theme_location'=> 'navigation'
        )); ?>
        </nav>
	</dd>
	</dl><!-- columns -->
    
    <?php else: ?>
    
	<dl class="nav columns medium-7">
	<dt class="nav-button"><i class="fa fa-list fa-fw"></i><?php _e('MENU','blanc'); ?></dt>
	<dd class="menu-wrap">
        <nav>
        <?php wp_nav_menu( array(
            'theme_location'=> 'navigation'
        )); ?>
        </nav>
	</dd>
	</dl><!-- columns -->
    
    <?php endif; ?>

</div><!-- row -->
</header>