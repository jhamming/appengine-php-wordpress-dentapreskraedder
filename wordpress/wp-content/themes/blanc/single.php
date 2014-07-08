<?php
/**
 * The template for displaying blog posts.
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
        <article <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">

        <header>
        <h1 itemprop="name"><?php the_title(); ?></h1>

        <ul class="postinfo">
            <li>
            <span class="fa-stack">
                <i class="fa fa-circle fa-stack-2x fa-red"></i>
                <i class="fa fa-calendar fa-stack-1x fa-inverse"></i>
            </span>
            <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished">
            <?php echo get_the_date(); ?>
            </time>
            </li>

            <?php if(!is_attachment() ): ?>
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
            <?php endif; ?>

            <li>
            <span class="fa-stack">
                <i class="fa fa-circle fa-stack-2x fa-blue"></i>
                <i class="fa fa-comment fa-stack-1x fa-inverse"></i>
            </span>
            <a class="link-comments" href="<?php  comments_link(); ?>"><?php comments_number(); ?></a>
            </li>

        </ul>
        </header>
        
        <span itemprop="articleBody">
        <?php the_content(); ?>
        <?php wp_link_pages('before=<div id="page-links">&after=</div>&pagelink=<span>%</span>'); ?>
        </span>
        
        <footer>
        <?php the_tags('<p><i class="fa fa-tag"></i> ', ' / ', '</p>'); ?>
        <div class="navlink clearfix">
            <span class="navlink-prev">
                <?php previous_post_link('<span class="navlink-meta">&laquo; ' . __( 'Previous Post', 'blanc' ) . '</span> %link', '%title', true); ?>
            </span>
            <span class="navlink-next">
                <?php next_post_link('<span class="navlink-meta">' . __( 'Next Post', 'blanc' ) . ' &raquo;</span> %link', '%title', true); ?>
            </span>
        </div>
        </footer>

        <?php comments_template(); ?>

        </article>
    <?php endwhile; endif; ?>
    </div><!-- columns -->

    <div class="columns medium-4 large-3">
        <div id="sidebar">
            <?php dynamic_sidebar('column-blog'); ?>
        </div>
    </div><!-- columns -->

</div><!-- row -->

<?php get_footer(); ?>