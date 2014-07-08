<?php
/**
 * The template for displaying search results page of items for Welcart e-commerce plugin.
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
        <h1><span><?php _e('SEARCH','blanc'); ?>&nbsp;</span><?php echo get_search_query(); ?></h1>
    </div>
</div><!-- row -->

<?php
    global $wpdb;
    // If you use a custom search form
    // $keyword = sanitize_text_field( $_POST['keyword'] );
    // If you use default WordPress search form
    $keyword = get_search_query();
    $keyword = '%' . like_escape( $keyword ) . '%'; // Thanks Manny Fleurmond
    // Search in all custom fields
    $post_ids_meta = $wpdb->get_col( $wpdb->prepare( "
        SELECT DISTINCT post_id FROM {$wpdb->postmeta}
        WHERE meta_value LIKE '%s'
    ", $keyword ) );
    // Search in post_title and post_content
    $post_ids_post = $wpdb->get_col( $wpdb->prepare( "
        SELECT DISTINCT ID FROM {$wpdb->posts}
        WHERE post_title LIKE '%s'
        OR post_content LIKE '%s'
    ", $keyword, $keyword ) );
    $post_ids = array_merge( $post_ids_meta, $post_ids_post );
    // Query arguments
    $args = array(
        'post_type'   => 'post',
        'post_status' => 'publish',
        'post__in'    => $post_ids,
        'category_name' => 'item',
    );
    $query = new WP_Query( $args );
    if ( $query->have_posts() ):
?>
    <div class="row">
        <div class="columns">
        
        <ul class="medium-block-grid-4 small-block-grid-2">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
            <?php get_template_part('thumbnail-box'); ?>
            <?php endwhile; ?>
        </ul>
        
        </div><!-- columns -->
    </div><!-- row -->
    
    <div class="row">
        <div class="columns">
            <?php get_template_part('pagination'); ?>
        </div><!-- columns -->
    </div><!-- row -->
        
<?php else: ?>
    <div class="row">
        <div class="columns">
        
        <div class="noresult">
        <?php $search = get_search_query(); ?>
        <p><?php echo sprintf(__('Your search for "%s" did not match any results.', 'blanc'), $search ); ?></p>
        <p><?php _e('Try different keywords','blanc'); ?></p>
        <form action="<?php echo esc_url( home_url('/') ); ?>" class="searchform" id="searchform_s" method="get" role="search">
            <div>
                <input type="search" class="field" name="s" value="<?php esc_attr( get_search_query() ); ?>" id="s_posts" placeholder="<?php _e('Search...','blanc'); ?>">
                <input type="submit" class="submit" id="searchsubmit_icon" value="&#xf002;">
            </div>
        </form>
        </div>
            
        </div><!-- columns -->
    </div><!-- row -->
        
<?php endif; ?>

</section>

<?php get_footer(); ?>