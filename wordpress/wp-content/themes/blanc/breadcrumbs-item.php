<?php
/**
 * The template for displaying breadcrumbs for Welcart e-commerce plugin posts/pages.
 * @link       http://welcustom.net/
 * @author      Mamekko
 * @copyright   Copyright (c)2014 welcustom.net
 */

global $post;
$str ='';
if(!is_home()&&!is_admin()){
    $str.= '<ol id="breadcrumbs" class="clearfix">';
    $str.= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. home_url() .'/" itemprop="url"><span itemprop="title">' .__( "Home", "blanc" ). '</span></a></li>';
    if(is_search()){
        $s_word = get_search_query();
        $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">' .sprintf(__("Results for '%s'", "blanc"), $s_word ). '</li>';
    } elseif(is_tag()){
        $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">' .__( "Tag:", "blanc" ) . single_tag_title( '' , false ). '</span></li>';
    } elseif(is_category()) {
        $cat = get_queried_object();
        $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'. $cat -> name;
        if( is_paged()){
            $current = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $str.= sprintf(__(" - Page %d", "blanc"), $current );
        }
        $str.='</span></li>';
    } elseif(is_single()){
        $str .= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">';
        $cats = '';
        $categories = get_the_category();
        foreach( $categories as $category){
            $category_id = $category->term_id;
            $category_child = get_term_children($category_id, 'category');
            if($category_child != true){
                $cats .= '<a href="'. get_category_link($category_id) .'" itemprop="url"><span itemprop="title">' . get_cat_name($category_id) . '</span></a>&nbsp;/&nbsp;';
            }
        }
        $str.= rtrim( $cats, '&nbsp;/&nbsp;' );
        $str.= '</li>';
        $str.= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'. $post -> post_title .'</span></li>';
    } else{
        $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'. wp_title('', false) .'</span></li>';
    }
    $str.='</ol>';
}
echo $str;