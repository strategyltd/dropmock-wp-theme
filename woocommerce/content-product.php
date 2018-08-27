<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
global $post;


// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$meta = get_post_meta($post->ID);
$preview_url = $meta['wpdmmp_m_preview_url'][0];
$type = $meta['wpdmmp_m_type'][0];
$imgURL = get_the_post_thumbnail_url($post->ID, apply_filters('single_product_large_thumbnail_size', 'shop_single'));
$title = get_the_title();

$file_extension = strrev(explode(".", strrev($preview_url))[0]);
$supported_image = array(
    'gif',
    'jpg',
    'jpeg',
    'png'
);
$supported_svg = array(
    'svg'
);

wc_print_notices();
$price = $product->get_price();
?>


<div class="col-sm-6 col-xs-12 col-md-4 col-lg-3" style="float:left;">
	<div class="product_in_loop">
		<div class="media_holder">
		<a href="<?= WEBSITE_URL.'/product/'.$product->slug; ?>">
			<?php if (in_array($file_extension, $supported_image)): ?>
		    	<img src="<?= $preview_url ?>" class="attachment-shop_single size-shop_single wp-post-image img-responsive">
		    <?php elseif(in_array($file_extension, $supported_svg)): ?>
		    	<img src="<?= $preview_url ?>" class="attachment-shop_single size-shop_single wp-post-image img-responsive">
		    <?php else: ?>
			    <video class="product_video hover_video" src="<?= $preview_url ?>" poster="<?= $imgURL ?>">
			    </video>
			<?php endif ?>
		</a>
		</div>
		<div class="title">
			<a href="<?= WEBSITE_URL.'/product/'.$product->slug; ?>" class="theme-font-color">
			<?php  
				if(strlen($title) > 50)
					echo substr($title,0,50).'..';
				else
					echo $title;
			?>
			</a>
		</div>
		<div class="product_bottom_section">
			<span class="price">
				<?php if ($price == '0'): ?>
					FREE
				<?php else: ?>
					<?=  get_woocommerce_currency_symbol() .$price; ?>.00
				<?php endif ?>
			</span>
			<span class="cart">
				<a href="<?= home_url( $wp->request ).'/?add-to-cart='.$post->ID; ?>">
					<i class="fa fa fa-cart-plus"></i>
				</a>
			</span>
		</div>
	</div>
</div>



            