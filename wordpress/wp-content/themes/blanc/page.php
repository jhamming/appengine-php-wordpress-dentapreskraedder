<?php
/**
 * The template for displaying pages except for member/cart pages.
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
    <div class="columns medium-8 large-9">
    <?php if(have_posts()): while(have_posts()): the_post(); ?>
        <article <?php post_class(); ?>>
            <h1><?php the_title(); ?></h1>
            <?php the_content(); ?>
            <?php comments_template(); ?>
        </article>
    <?php endwhile; endif; ?>
    </div><!-- columns -->

    <div class="columns medium-4 large-3">
        <div id="sidebar">
            <?php dynamic_sidebar('column-page'); ?>
        </div>
    </div><!-- columns -->

</div><!-- row -->

<?php get_footer(); ?>