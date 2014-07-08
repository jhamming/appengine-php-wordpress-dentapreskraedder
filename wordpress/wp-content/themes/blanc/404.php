<?php
/**
 * The template for displaying 404 (not found) page.
 * @link       http://welcustom.net/
 * @author      Mamekko
 * @copyright   Copyright (c)2014 welcustom.net
 */
get_header(); ?>

<div class="row">
    <div class="columns">
        <?php get_template_part('breadcrumbs'); ?>
    </div><!-- columns -->
</div><!-- row -->

<div class="row">
    <div class="columns">
        <article <?php post_class(); ?>>

        <h1><?php the_title(); ?></h1>

        <div class="nopage">
        <p><?php _e('404 Not found','blanc'); ?></p>
        <p class="link"><a href="<?php echo home_url(); ?>"><?php _e('Back to Home','blanc'); ?></a></p>
        </div>

        </article>
    </div><!-- columns -->

</div><!-- row -->

<?php get_footer(); ?>