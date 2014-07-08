<?php
/**
 * The template for displaying Welcart e-commerce plugin cart pages.
 * @link       http://welcustom.net/
 * @author      Mamekko
 * @copyright   Copyright (c)2014 welcustom.net
 */
get_header('nomenu'); ?>

<div class="row">
    <div class="columns">
    <?php if(have_posts()): while(have_posts()): the_post(); ?>

        <section>
        <?php the_content(); ?>
        </section>

    <?php endwhile; endif; ?>
    </div><!-- columns -->
</div><!-- row -->

<?php get_footer('nomenu'); ?>