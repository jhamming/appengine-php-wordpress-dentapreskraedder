<?php
/**
 * The template for displaying item archives.
 * @link       http://welcustom.net/
 * @author      Mamekko
 * @copyright   Copyright (c)2014 welcustom.net
 */
get_header(); ?>

<div class="row">
    <div class="columns">
        <?php get_template_part('breadcrumbs-item'); ?>
    </div><!-- columns -->
</div><!-- row -->

<section class="thumb">
<div class="row">
    <div class="columns">
        <?php if( is_category() ): ?>
            <h1><span><?php _e('CATEGORY','blanc'); ?>&nbsp;</span><?php single_cat_title(); ?></h1>
            <?php echo category_description(); ?>
        <?php elseif( is_tag() ): ?>
            <h1><span><?php _e('TAG','blanc'); ?>&nbsp;</span><?php single_tag_title(); ?></h1>
            <?php echo tag_description(); ?>
        <?php else: ?>
            <h1><span><?php _e('ARCHIVES','blanc'); ?>&nbsp;</span><?php single_term_title(); ?></h1>
            <?php echo term_description(); ?> 
        <?php endif; ?>
    </div>
</div><!-- row -->

<div class="row">
    <div class="columns">
        <ul class="medium-block-grid-4 small-block-grid-2">
            <?php if(have_posts()): while(have_posts()): the_post(); ?>
            <?php get_template_part('thumbnail-box'); ?>
            <?php endwhile; endif; ?>
        </ul>
    </div><!-- columns -->
</div><!-- row -->

<div class="row">
    <div class="columns">
        <?php get_template_part('pagination'); ?>
    </div><!-- columns -->
</div><!-- row -->
</section>

<?php get_footer(); ?>