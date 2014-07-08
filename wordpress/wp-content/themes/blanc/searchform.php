<?php
/**
 * The template for displaying search form
 * @link       http://welcustom.net/
 * @author      Mamekko
 * @copyright   Copyright (c)2014 welcustom.net
 */
?>

<form action="<?php echo esc_url( home_url('/') ); ?>" class="searchform" id="searchform_s" method="get" role="search">
	<div>
		<input type="search" class="field" name="s" value="<?php esc_attr( get_search_query() ); ?>" id="s_posts" placeholder="<?php _e('Search...','blanc'); ?>">
		<input type="submit" class="submit" id="searchsubmit_icon" value="&#xf002;">
        <input type="hidden" name="searchitem" value="posts">
	</div>
</form>