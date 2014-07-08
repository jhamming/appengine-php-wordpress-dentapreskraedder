<?php
/**
 * The template for displaying Header without widgets (for Welcart e-commerce plugin cart page).
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

	<div class="columns">
	<h1><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
	<p><?php bloginfo('description'); ?></p>
	</div>

</div><!-- row -->
</header>

