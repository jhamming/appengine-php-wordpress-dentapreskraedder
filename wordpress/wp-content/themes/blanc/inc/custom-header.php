<?php
/**
 * Add custom header.
 * @link       http://welcustom.net/
 * @author      Mamekko
 * @copyright   Copyright (c)2014 welcustom.net
 */

function blanc_custom_header_setup(){
    $args = array(
        'width' => 1600,
        'height' => 400,
        'header-text' => false,
        'default-image' => get_template_directory_uri() .'/img/header.jpg',
    );
		add_theme_support( 'custom-header', $args );
}
add_action( 'after_setup_theme', 'blanc_custom_header_setup' );