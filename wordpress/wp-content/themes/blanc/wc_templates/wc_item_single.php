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
        <?php get_template_part('breadcrumbs-item'); ?>
    </div><!-- columns -->
</div><!-- row -->

<article <?php post_class(); ?>>

<?php if (have_posts()) : the_post(); ?>

<?php usces_remove_filter(); ?>
<?php usces_the_item(); ?>

<div class="row" itemscope itemtype="http://schema.org/Product">

<div class="columns medium-7">
    <div id="slider" class="flexslider">
        <ul class="slides">
            <li>
                <a href="<?php usces_the_itemImageURL(0); ?>" <?php echo apply_filters('usces_itemimg_anchor_rel', NULL); ?>><?php usces_the_itemImage(0, 600, 600, $post); ?></a>
            </li>
            <?php $imageid = usces_get_itemSubImageNums(); ?>
            <?php foreach ( $imageid as $id ) : ?>
            <li><a href="<?php usces_the_itemImageURL($id); ?>" <?php echo apply_filters('usces_itemimg_anchor_rel', NULL); ?>><?php usces_the_itemImage($id, 600, 600, $post); ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <?php if( $imageid ): ?>
    <div id="carousel" class="flexslider">
        <ul class="slides">
            <li><?php usces_the_itemImage(0, 200, 200, $post); ?></li>
            <?php foreach ( $imageid as $id ) : ?>
            <li><?php usces_the_itemImage($id, 200, 200, $post); ?></li>
            <?php endforeach; ?>
        </ul>
    </div><!-- carousel -->
    <?php endif; ?>
</div><!--columns-->
    
    
<div class="columns medium-5">
<?php if(usces_sku_num() === 1) : usces_have_skus(); ?>
<!--1SKU-->
	<h1 class="item_name" itemprop="name"><?php usces_the_itemName(); ?></h1>
	<div class="exp clearfix">
        <form action="<?php echo USCES_CART_URL; ?>" method="post">
            <div class="field" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                 <meta itemprop="availability" href="http://schema.org/InStock" content="<?php usces_the_itemZaiko(); ?>">
            <?php if( usces_the_itemCprice('return') > 0 ) : ?>
                <div class="field_cprice"><?php usces_the_itemCpriceCr(); ?><?php usces_guid_tax(); ?></div>
            <?php endif; ?>
            <div class="field_price"><span class="price" itemprop="price"><?php usces_the_itemPriceCr(); ?><?php usces_guid_tax(); ?></span></div>
            <?php usces_the_itemGpExp(); ?>
            <?php if (usces_is_options()) : ?>
                <table class='item_option'>
                <caption><?php _e('Please appoint an option.', 'usces'); ?></caption>
                <?php while (usces_have_options()) : ?>
                <tr><th><?php usces_the_itemOptName(); ?></th><td><?php usces_the_itemOption(usces_getItemOptName(),''); ?></td></tr>
                <?php endwhile; ?>
                </table>
            <?php endif; ?>
            <?php if( !usces_have_zaiko() ) : ?>
                <div class="zaiko_status">
                    <?php echo apply_filters('usces_filters_single_sku_zaiko_message', esc_html(usces_get_itemZaiko( 'name' ))); ?>
                </div>
            <?php else : ?>
                <span class="quant"><?php usces_the_itemQuant(); ?></span><?php usces_the_itemSkuUnit(); ?><?php usces_the_itemSkuButton(__('ADD TO CART', 'blanc'), 0); ?>
                <div class="error_message"><?php usces_singleitem_error_message($post->ID, usces_the_itemSku('return')); ?></div>
            <?php endif; ?>
            </div>
            <?php echo apply_filters('single_item_single_sku_after_field', NULL); ?>
            <?php do_action('usces_action_single_item_inform'); ?>
        </form>
            <?php do_action('usces_action_single_item_outform'); ?>

        <?php if( $item_custom = usces_get_item_custom( $post->ID, 'list', 'return' ) ) : ?>
            <div class="field"><?php echo $item_custom; ?></div>
        <?php endif; ?>
		
        <div itemprop="description">
		<?php the_content(); ?>
        </div>
	</div><!-- end of exp -->
	
<?php elseif(usces_sku_num() > 1) : usces_have_skus(); ?>
<!--some SKU-->
	<h1 class="item_name" itemprop="name"><?php usces_the_itemName(); ?></h1>

    <div class="exp clearfix">
	<form action="<?php echo USCES_CART_URL; ?>" method="post">
	<div class="skuform">

	<?php do { ?>
        <div class="field" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
            <meta itemprop="availability" href="http://schema.org/InStock" content="<?php usces_the_itemZaiko(); ?>">
            <div class="field_price" >
                <span class="skudisp"><?php usces_the_itemSkuDisp(); ?></span>
                <?php if( usces_the_itemCprice('return') > 0 ) : ?>
                    <span class="cprice"><?php usces_the_itemCpriceCr(); ?><?php usces_guid_tax(); ?></span>
                <?php endif; ?>     
                <span class="price" itemprop="price"><?php usces_the_itemPriceCr(); ?><?php usces_guid_tax(); ?></span>
                <?php usces_the_itemGpExp(); ?>
            </div>

            <?php if (usces_is_options()) : ?>
                <table class='item_option'>
                <caption><?php _e('Please appoint an option.', 'usces'); ?></caption>
                <?php while (usces_have_options()) : ?>
                    <tr>
                        <th><?php usces_the_itemOptName(); ?></th>
                        <td><?php usces_the_itemOption(usces_getItemOptName(),''); ?></td>
                    </tr>
                <?php endwhile; ?>
                </table>
            <?php endif; ?>
			<?php if( !usces_have_zaiko() ) : ?>
                <div class="zaiko_status">
				<?php echo apply_filters('usces_filters_multi_sku_zaiko_message', esc_html(usces_get_itemZaiko( 'name' ))); ?>
                </div>
			<?php else : ?>
                <span class="quant"><?php usces_the_itemQuant(); ?></span><?php usces_the_itemSkuUnit(); ?>
				<?php usces_the_itemSkuButton(__('ADD TO CART', 'blanc'), 0); ?>
			<?php endif; ?>

            <div class="error_message">
                <?php usces_singleitem_error_message($post->ID, usces_the_itemSku('return')); ?>
            </div>
        </div>
	<?php } while (usces_have_skus()); ?>

	</div><!-- end of skuform -->
	<?php echo apply_filters('single_item_multi_sku_after_field', NULL); ?>
	<?php do_action('usces_action_single_item_inform'); ?>
	</form>
	<?php do_action('usces_action_single_item_outform'); ?>

		<?php if( $item_custom = usces_get_item_custom( $post->ID, 'list', 'return' ) ) : ?>
		<div class="field">
			<?php echo $item_custom; ?>
		</div>
		<?php endif; ?>
        <div itemprop="description">
            <?php the_content(); ?>
        </div>
	</div><!-- end of exp -->
    
<?php endif; ?>
    </div><!--columns-->

<?php usces_assistance_item( $post->ID, __('An article concerned', 'usces') ); ?>

</div><!--row-->

<?php endif; ?>

</article>

<?php get_template_part('related-item'); ?>

<?php comments_template('/comments-item.php'); ?>

<?php get_footer(); ?>