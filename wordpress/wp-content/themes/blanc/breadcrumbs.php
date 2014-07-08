<?php
/**
 * The template for displaying breadcrumbs.
 * @link       http://welcustom.net/
 * @author      Mamekko
 * @copyright   Copyright (c)2014 welcustom.net
 */

global $post;
$front_page = get_option('page_on_front');
$home = get_option('page_for_posts');
$str ='';
if(!is_admin()){
    $str.= '<ol id="breadcrumbs" class="clearfix">';
    $str.= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. home_url() .'/" itemprop="url"><span itemprop="title">' .__( "Home", "blanc" ). '</span></a></li>';
    if(is_search()){
        $s_word = get_search_query();
        $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'.sprintf(__("Results for '%s'", "blanc"), $s_word ).'</span></li>';
    } elseif(is_tag()){
        if( $home && $front_page!=0 ){
            $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><a href="'. get_permalink($home) .'" itemprop="url">' .get_the_title($home). '</a></span></li>';
        }
        $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">' .__( "Tag:", "blanc" ) . single_tag_title( '' , false ). '</span></li>';
    } elseif(is_404()){
        $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">' .__('404 Not found','blanc') . '</span></li>';
    } elseif(is_date()){
        $date = __('jS', 'blanc');
        $month = __('F', 'blanc');
        $year = __('Y', 'blanc');
        if( $home && $front_page!=0 ){
            $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><a href="'. get_permalink($home) .'" itemprop="url">' .get_the_title($home). '</a></span></li>';
        }
        if(is_day()){
            $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_year_link(get_query_var('year')). '" itemprop="url">' . get_the_date( $year ). '</a></li>';
            $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_month_link(get_query_var('year'), get_query_var('monthnum')). '" itemprop="url"><span itemprop="title">'. get_the_date( $month ) .'</span></a></li>';
            $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'. get_the_date( $date ). '</span></li>';
        } elseif(is_month()){
            $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_year_link(get_query_var('year')) .'" itemprop="url"><span itemprop="title">'. get_the_date( $year ) .'</span></a></li>';
            $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'. get_the_date( $month ). '</span></li>';
        } else {
            $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'. get_the_date( $year ) .'</span></li>';
        }
    } elseif(is_category()) {
        if( $home && $front_page!=0 ){
            $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><a href="'. get_permalink($home) .'" itemprop="url">' .get_the_title($home). '</a></span></li>';
        }
        $cat = get_queried_object();
        if($cat -> parent != 0){
            $ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
            foreach($ancestors as $ancestor){
                $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_category_link($ancestor) .'" itemprop="url"><span itemprop="title">'. get_cat_name($ancestor) .'</span></a></li>';
            }
        }
        $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'. $cat -> name;
        if( is_paged()){
            $current = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $str.= sprintf(__(" - Page %d", "blanc"), $current );
        }
        $str.='</span></li>';
    } elseif(is_author()){
        if( $home && $front_page!=0 ){
            $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><a href="'. get_permalink($home) .'" itemprop="url">' .get_the_title($home). '</a></span></li>';
        }
        $str .='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">' .__( "Author:", "blanc" ) . get_the_author_meta('display_name', get_query_var('author')).'</span></li>';
    } elseif(is_attachment()){
        if( $home && $front_page!=0 ){
            $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><a href="'. get_permalink($home) .'" itemprop="url">' .get_the_title($home). '</a></span></li>';
        }
        if($post -> post_parent != 0 ){
            $post_parent = $post -> post_parent;
            $str.= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_permalink($post -> post_parent).'" itemprop="url"><span itemprop="title">'. get_the_title($post -> post_parent) .'</span></a></li>';
        }
        $str.= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">' . $post -> post_title . '</span></li>';
    } elseif(is_single()){
        if( $home && $front_page!=0 ){
            $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><a href="'. get_permalink($home) .'" itemprop="url">' .get_the_title($home). '</a></span></li>';
        }
        $categories = get_the_category($post->ID);
        $cat = $categories[0];
        if($cat -> parent != 0){
            $ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
            foreach($ancestors as $ancestor){
                $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_category_link($ancestor).'" itemprop="url"><span itemprop="title">'. get_cat_name($ancestor). '</span></a></li>';
            }
        }
        $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_category_link($cat -> term_id). '" itemprop="url"><span itemprop="title">'. $cat-> cat_name . '</span></a></li>';
        $str.= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'. $post -> post_title .'</span></li>';
    } elseif(is_page()){
        if($post -> post_parent != 0 ){
            $ancestors = array_reverse(get_post_ancestors( $post->ID ));
            foreach($ancestors as $ancestor){
                $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_permalink($ancestor).'" itemprop="url"><span itemprop="title">'. get_the_title($ancestor) .'</span></a></li>';
            }
        }
        $str.= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'. $post -> post_title .'</span></li>';
    } elseif(is_home()){
        $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'.  get_the_title($home);
        if( is_paged()){
            $current = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $str.= sprintf(__(" - Page %d", "blanc"), $current );
        }
        $str.='</span></li>';
    } else {
        $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'.  wp_title('', false, 'right') .'</span></li>';
    }
    $str.='</ol>';
}
echo $str;