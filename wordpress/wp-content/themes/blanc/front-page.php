<?php
/**
 * The template for displaying front page.
 * @link       http://welcustom.net/
 * @author      Mamekko
 * @copyright   Copyright (c)2014 welcustom.net
 */
get_header(); ?>

<?php if(!is_paged() && get_header_image()): ?>
<section class="top-slider">
    <?php $headers = get_uploaded_header_images(); ?>
    <?php if($headers): ?>
    <div class="flexslider">
        <ul class="slides">
            <?php foreach ($headers as $key => $value): ?>
            <?php
            //this code is refered to: http://frankiejarrett.com/get-an-attachment-id-by-url-in-wordpress/
            //in order to get attachment id from image url.
            $parse_url  = explode( parse_url( WP_CONTENT_URL, PHP_URL_PATH ), $value['url'] );
            $this_host = str_ireplace( 'www.', '', parse_url( home_url(), PHP_URL_HOST ) );
            $file_host = str_ireplace( 'www.', '', parse_url( $value['url'], PHP_URL_HOST ) );
            if ( ! isset( $parse_url[1] ) || empty( $parse_url[1] ) || ( $this_host != $file_host ) ) {
                return;
            }
            global $wpdb;
            $img_id = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM {$wpdb->prefix}posts WHERE guid RLIKE %s;", $parse_url[1] ) );
            ?>
            <?php $img_meta = get_post($img_id[0]); ?>
            <li style="background:url(<?php echo $value['url']; ?>) no-repeat 50% 50%;">
                <?php if($img_meta->post_content && (strpos($img_meta->post_content, 'jpg')===false)): ?>
                    <a href="<?php echo esc_html($img_meta->post_content); ?>">
                <?php endif; ?>
                <?php if($img_meta->post_title && (strpos($img_meta->post_title, 'jpg')===false)): ?>
                    <p class="top-slider-p top-slider-title"><?php echo esc_html($img_meta->post_title); ?></p>
                <?php endif; ?>
                <?php if($img_meta->post_excerpt): ?>
                    <p class="top-slider-p top-slider-caption"><?php echo esc_html($img_meta->post_excerpt); ?></p>
                <?php endif; ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php else: ?>
        <img src="<?php header_image(); ?>" alt="*" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>">
    <?php endif; ?>
</section>
<?php endif; ?>

<?php if(function_exists('usces_the_item')): ?>
    <?php
        function blanc_filter_where1( $where = '' ) {
            global $wpdb; 
            $where .= $wpdb->prepare( " AND post_date > %s", date( 'Y-m-d', strtotime('-15 days') ) );
            return $where;
        }
        add_filter( 'posts_where', 'blanc_filter_where1' );
        $new_items = get_posts( array(
            'post_type' => 'post',
            'category_name' => 'item',
            'posts_per_page' => '4',
            'orderby' => 'rand',
            'suppress_filters' => false,
            'meta_query' => array(
                array(
                    'key' => '_isku_',
                    'value' => '"stocknum";s:1:"0"',
                    'compare' => 'NOT LIKE',
                ),
                array(
                    'key' => '_isku_',
                    'value' => '"stocknum";i:0',
                    'compare' => 'NOT LIKE',
                )
            )
        ));
        remove_filter( 'posts_where', 'blanc_filter_where1' );
    ?>
    <?php if( $new_items ): ?>
        <section class="front-page new_items">
            <div class="row">
                <div class="columns">
            <h1><?php _e("WHAT'S NEW","blanc"); ?><i class="fa fa-bookmark fa-fw"></i></h1>
            <ul class="medium-block-grid-4 small-block-grid-2">
            <?php foreach( $new_items as $post ): setup_postdata( $post ); ?>
                    <?php get_template_part( 'thumbnail-box' ); ?>    
            <?php endforeach; wp_reset_postdata(); ?>
            </ul>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>

<?php if( is_home()): ?>
<div class="row" style="margin-top: 2em;">
    <div class="columns medium-9">
        <section class="list">
            
        <?php if(have_posts()): while(have_posts()): the_post(); ?>
        <article <?php post_class('clearfix'); ?>>

        <a href="<?php the_permalink(); ?>">        

            <?php preg_match( '/wp-image-(\d+)/s', $post->post_content, $thumb ); ?>
            
            <?php if( has_post_thumbnail()) {
                the_post_thumbnail( 'thumbnail' );
            } elseif( $thumb ){
                echo wp_get_attachment_image( $thumb[1], 'thumbnail' );
            } else {
                echo '<img src="' . get_template_directory_uri() . '/img/no-image.jpg" alt="No Image" width="150" height="150" class="attachment-thumbnail">';
            }; ?>
        </a>

        <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

        <ul class="postinfo">
            <li>
            <span class="fa-stack">
                <i class="fa fa-circle fa-stack-2x fa-red"></i>
                <i class="fa fa-calendar fa-stack-1x fa-inverse"></i>
            </span>
            <time datetime="<?php echo get_the_date('c'); ?>">
            <?php echo get_the_date(); ?>
            </time>
            </li>

            <li>
            <span class="fa-stack">
                <i class="fa fa-circle fa-stack-2x fa-green"></i>
                <i class="fa fa-folder fa-stack-1x fa-inverse"></i>
            </span>
            <?php
            $cats = '';
            $categories = get_the_category();
            foreach( $categories as $category){
                $category_id = $category->term_id;
                $category_child = get_term_children($category_id, 'category');
                if($category_child != true){
                    $cats .= '<a href="'. get_category_link($category_id) .'" itemprop="url"><span itemprop="title">' . get_cat_name($category_id) . '</span></a>&nbsp;/&nbsp;';
                }
            }
            $cats = rtrim( $cats, '&nbsp;/&nbsp;' );
            echo $cats;
            ?>
            </li>
            
            <li>
            <span class="fa-stack">
                <i class="fa fa-circle fa-stack-2x fa-blue"></i>
                <i class="fa fa-comment fa-stack-1x fa-inverse"></i>
            </span>
            <a class="link-comments" href="<?php comments_link(); ?>"><?php comments_number(); ?></a>
            </li>

        </ul>

        <?php the_excerpt(); ?>

        <p class="link-next">
        <a href="<?php the_permalink(); ?>"><?php _e('READ MORE','blanc'); ?></a>
        </p>

        </article>
        <?php endwhile; endif; ?>

        <?php get_template_part('pagination'); ?>

        </section>
    </div><!-- columns -->
    
    <div id="sidebar" class="columns medium-3">
        <?php dynamic_sidebar('column-blog'); ?>
    </div><!-- columns -->
</div>

<?php else: ?>

<div class="row" style="margin-top: 2em;">
    <div class="columns">
        <article <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">
        <?php if(have_posts()): while(have_posts()): the_post(); ?>
            <?php the_content(); ?>
        <?php endwhile; endif; ?>
        </article>
    </div>
</div>

<?php endif; ?>

<?php if(function_exists('usces_the_item') && term_exists('itemreco')): ?>
<?php
    $itemreco = get_category_by_slug('itemreco');
    $itemreco_data = get_category($itemreco);
    if ( $itemreco_data->count != 0 ):
?>
<section class="front-page recommend_items">
<div class="row">
    <div class="columns">
        <?php $recommend_items = get_posts( array(
            'post_type' => 'post',
            'category_name' => 'itemreco',
            'posts_per_page' => '4',
            'orderby' => 'rand',
            'meta_query' => array(
                array(
                    'key' => '_isku_',
                    'value' => '"stocknum";s:1:"0"',
                    'compare' => 'NOT LIKE',
                ),
                array(
                    'key' => '_isku_',
                    'value' => '"stocknum";i:0',
                    'compare' => 'NOT LIKE',
                )
            )
        )); ?>
        <?php if( $recommend_items ): ?>
            <h1><?php _e('RECOMMENDS','blanc'); ?><i class="fa fa-star fa-fw"></i></h1>
            <ul class="medium-block-grid-4 small-block-grid-2">
            <?php foreach( $recommend_items as $post ): setup_postdata( $post ); ?>
                <?php get_template_part( 'thumbnail-box' ); ?>        
            <?php endforeach; wp_reset_postdata(); ?>
            </ul>
        <?php endif; ?>
    </div>
</div>
</section>
<?php endif; ?>
<?php endif; ?>

<?php get_footer(); ?>