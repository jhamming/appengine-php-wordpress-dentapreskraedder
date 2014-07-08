<?php
/**
 * The template for displaying Footer.
 * @link       http://welcustom.net/
 * @author      Mamekko
 * @copyright   Copyright (c)2014 welcustom.net
 */
?>

<footer id="footer">
    <div class="row">
        <?php get_sidebar(); ?>
    </div><!-- row -->

<div class="copyright">
    <div class="row">
        <div class="columns">
            <small>Copyright&nbsp;&copy;&nbsp;<?php echo date('Y'); ?>&nbsp;<a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>, All rights reserved.<span class="author">&nbsp;Theme by <a href="<?php echo esc_url( 'http://welcustom.net/'); ?>"><?php printf('Mamekko'); ?></a></span></small>
            <div class="page-top"><a href="#header"><i class="fa fa-arrow-up"></i></a></div>
        </div>
    </div><!-- row -->
</div>

</footer>

<?php wp_footer(); ?>

</body>
</html>