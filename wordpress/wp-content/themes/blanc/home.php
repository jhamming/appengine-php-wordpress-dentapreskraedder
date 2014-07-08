<?php
/**
 * The template for displaying front-page of blog posts (when it's set).
 * @link       http://welcustom.net/
 * @author      Mamekko
 * @copyright   Copyright (c)2014 welcustom.net
 */
get_header(); ?>

<?php $front_page = get_option('page_on_front'); ?>
<?php if($front_page!=0): ?>
<div class="row">
    <div class="columns">
        <?php get_template_part('breadcrumbs'); ?>
    </div><!-- columns -->
</div><!-- row -->
<?php endif; ?>

<div class="row" <?php if($front_page==0){echo 'style="margin-top:2em;"';} ?>>
    
    <div class="columns medium-9">
    <section class="list">
    
        <?php if($front_page!=0): ?>
            <?php $home = get_option('page_for_posts'); ?>
            <?php $page = get_page($home); ?>
            <h1><span style="font-weight:bold"><?php echo strtoupper($page->post_name); ?></span></h1>
        <?php endif; ?>

    <?php if(have_posts()): while(have_posts()): the_post(); ?>
        <article <?php post_class('clearfix'); ?>>

        <a href="<?php the_permalink(); ?>">        

            <?php preg_match( '/wp-image-(\d+)/s', $post->post_content, $thumb ); ?>
            <?php preg_match( '/< *img[^>]*src *= *["\']?([^"\']*)/i', $post->post_content, $thumb_link ); ?>
            
            <?php if( has_post_thumbnail()) {
                the_post_thumbnail( 'thumbnail' );
            } elseif( $thumb ){
                if( wp_get_attachment_image($thumb[1]) ){
                echo wp_get_attachment_image( $thumb[1], 'thumbnail' );
                } else {
                echo '<img src="' .$thumb_link[1]. '" alt="'. get_the_title() .'" width="150" height="150" class="attachment-thumbnail">';
                }
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
            <a class="link-comments" href="<?php  comments_link(); ?>"><?php comments_number(); ?></a>
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
    
</div><!-- row -->

<?php get_footer(); ?>