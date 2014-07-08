<?php
/**
 * <meta content="charset=UTF-8">
 * @package Welcart
 * @subpackage Welcart Default Theme
 *
 * @link          http://welcustom.net/
 * @arranged by   Mamekko
 */
get_header();
?>

<div class="row">
    <div class="columns">
        <ol id="breadcrumbs" class="clearfix">
            <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                <a href="<?php echo home_url(); ?>" itemprop="url">
                    <span itemprop="title">Home</span>
                </a>
            </li>
            <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                <span itemprop="title"><?php _e( 'Multiple Category Search', 'blanc' ); ?></span>
            </li>
        </ol>
    </div><!-- columns -->
</div><!-- row -->

<section class="thumb">
<div class="row">
<div class="columns">
<?php if (have_posts()) : have_posts(); the_post(); ?>
<h1 class="pagetitle"><span><?php _e('SEARCH','blanc'); ?>&nbsp;</span><?php _e( 'Multiple Category Search', 'blanc' ); ?></h1>
	<div class="post" id="<?php echo $post->post_name; ?>">
		
<?php $uscpaged = isset($_REQUEST['paged']) ? $_REQUEST['paged'] : 1; ?>
<script type="text/javascript">
	function usces_nextpage() {
		document.getElementById('usces_paged').value = <?php echo ($uscpaged + 1); ?>;
		document.searchindetail.submit();
	}
	function usces_prepage() {
		document.getElementById('usces_paged').value = <?php echo ($uscpaged - 1); ?>;
		document.searchindetail.submit();
	}
	function newsubmit() {
		document.getElementById('usces_paged').value = 1;
	}
</script>

<div id="searchbox">

<?php //******* part of result ************** ?>
<?php
usces_remove_filter();
if (isset($_REQUEST['usces_search'])) :
	$catresult = usces_search_categories(); 
	$search_query = array('category__and' => $catresult, 'posts_per_page' => 10, 'paged' => $uscpaged);
	$search_query = apply_filters('usces_filter_search_query', $search_query);
	$my_query = new WP_Query( $search_query );
?>
<section>
	<h1 class="title"><?php _e('Search results', 'usces'); ?>  <?php echo number_format($my_query->found_posts); ?><?php _e('cases', 'usces'); ?></h1>

<?php if ($my_query->have_posts()) : ?>	
	
	<div class="searchitems">
        
	<?php if( $uscpaged > 1 ) : ?>
        <div class="navigation clearfix">
		<a style="float:left; cursor:pointer;" onclick="usces_prepage();"><?php _e('&laquo; Previous article', 'usces'); ?></a>
        </div>
	<?php endif; ?>
	<?php if( $uscpaged < $my_query->max_num_pages ) : ?>
        <div class="navigation clearfix">
		<a style="float:right; cursor:pointer;" onclick="usces_nextpage();"><?php _e('Next article &raquo;', 'usces'); ?></a>
        </div>
	<?php endif; ?>
	

	<?php if( $search_result = apply_filters('usces_filter_search_result', NULL, $my_query)) : ?>
	<?php echo $search_result; ?>
	<?php else : ?>
        
        <ul class="medium-block-grid-4 small-block-grid-2">
        <?php while ($my_query->have_posts()) : $my_query->the_post(); 	usces_the_item(); ?>
            <?php get_template_part('thumbnail-box'); ?>
        <?php endwhile; ?>
        </ul>
	</div><!-- searchitems -->

	<?php endif; ?>

	<?php if( $uscpaged > 1 ) : ?>
        <div class="navigation clearfix">
		<a style="float:left; cursor:pointer;" onclick="usces_prepage();"><?php _e('&laquo; Previous article', 'usces'); ?></a>
        </div>
	<?php endif; ?>
	<?php if( $uscpaged < $my_query->max_num_pages ) : ?>
        <div class="navigation clearfix">
		<a style="float:right; cursor:pointer;" onclick="usces_nextpage();"><?php _e('Next article &raquo;', 'usces'); ?></a>
        </div>
	<?php endif; ?>

<?php else : ?>
	<p style="margin-bottom: 2em; "><?php _e('The article was not found.', 'usces'); ?></p>
<?php endif; ?>

</section>
<?php endif; wp_reset_query(); ?>
<?php //******* End Result ************** ?>

<section>
    <?php //******* Start Form ************** ?>
        <form name="searchindetail" action="<?php echo USCES_CART_URL . $this->delim; ?>page=search_item" method="post">
        <div class="field">
            <?php echo usces_categories_checkbox('return'); ?>
        </div>
        <input name="usces_search_button" class="usces_search_button" type="submit" value="<?php _e('Search', 'usces'); ?>" onclick="newsubmit()" />
        <?php printf( '<input name="paged" id="usces_paged" type="hidden" value="%s" />', esc_attr( $uscpaged )); ?>
        <input name="usces_search" type="hidden" />
        <?php do_action('usces_action_search_item_inform'); ?>
        </form>
    <?php //******* End Form ************** ?>
</section>

</div><!-- searchbox -->

	</div><!-- end of post -->
	<?php endif; ?>
</div><!--columns-->
</div><!--row-->
</section>

<?php get_footer(); ?>
