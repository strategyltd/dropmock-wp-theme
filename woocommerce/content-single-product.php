<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Hook Woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );
global $product;

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}

$meta = get_post_meta($post->ID);

$preview_url = $meta['wpdmmp_m_preview_url'][0];
$type = $meta['wpdmmp_m_type'][0];

$HD_Types = array('Kinetic','Canvas','Vertical','Movezz');
$is_hd_type = false;



	


$canvas = false;
if(strtolower($type) == 'canvas')
    $canvas = true;

if(strtolower($type) == 'featured'){
  $extra = get_post_meta($post->ID, 'wpdmmp_m_extra')[0];
  if(strtolower($extra) == 'canvas')
    $canvas = true;
}

if(strtolower($type) == 'videoremix'){
	$product_src = get_post_meta($post->ID, 'wpdmmp_m_product_src')[0];
}


$imgURL = get_the_post_thumbnail_url($post->ID, apply_filters('single_product_large_thumbnail_size', 'shop_single'));
$title = get_the_title();
$description = get_post($post->ID)->post_content;


if(in_array($type, $HD_Types)){
	$is_hd_type = true;
	$text_count = (int) $meta['wpdmmp_m_text_count'][0];
	$images_count = (int) $meta['wpdmmp_m_images_count'][0];
	$videos_count = (int) $meta['wpdmmp_m_videos_count'][0];
	$description = 'This template consists of '.$text_count. ' text fields, '.$images_count.' images and '.$videos_count.' videos';
}


$file_extension = strrev(explode(".", strrev($preview_url))[0]);
$supported_image = array(
    'gif',
    'jpg',
    'jpeg',
    'png',
    'svg'
);

wc_print_notices();

$price = $product->get_price();
if($price == '0')
	$price = 'FREE';
else
	$price = get_woocommerce_currency_symbol().$price;

?>

<a href="<?= WEBSITE_URL.'/shop'; ?>" class=" no-decoration">
	<i class="fa fa-arrow-left"></i>
	Back To Shop
</a>

</div> </div>


<?php if (!$canvas): ?>
	<div class="product_full_div">
		<div class="wide_banner"></div>
		<div class="product_div">
			<div class="col-sm-8 col-xs-12" style="float:left;height:100%">
				<?php if ($type == 'Videoremix'): ?>
					<iframe src="<?= $product_src ?>" width="100%" height="100%"></iframe>
				<?php else: ?>
					<?php if (in_array($file_extension, $supported_image)): ?>
						<img src="<?= $preview_url ?>" class="img-responsive" style="width:100%;height:100%;">
					<?php else: ?>
						<video class="product_video" autoplay controls controlsList="nodownload" src="<?= $preview_url ?>" poster="<?= $imgURL ?>">
					    </video>
					<?php endif ?>
				<?php endif ?>
				
			</div>
			<div class="col-sm-4 product_info_section center" style="float:left;margin-top:10%;">
				<h2 style=""><?= $title  ?></h2>
				<span class="price">
					<?= $price?>
				</span>
				<hr class="after_price">
				<a href="<?= WEBSITE_URL.'/product/'.$product->slug.'/?add-to-cart='.$post->ID; ?>" class="single_add_to_cart_button button alt">Add to cart</a>
				<p style="margin-top:5%;"><?= $description; ?></p>
			</div>
		</div>
	</div>
<?php else: ?>
	<div class="product_full_div canvas_div" style="height:520px;">
		<div class="wide_banner"></div>
		<div class="product_div" style="padding:0px;background-color:#eaebef;height:100%;">
			<div style="width:100%;height:10%;background-size:100% 100%;background-image:url('<?= get_template_directory_uri() ?>/inc/assets/img/fbheader_curved.png');">
			</div>
			<div style="width:100%;height:65%;overflow:hidden">
				<div class="col-sm-3 canvas_left_section" style="height:100%;float:left;padding:2%;" >
					<img style="width:100%;height:100%;" src="<?= get_template_directory_uri() ?>/inc/assets/img/canvasleft.png">
				</div>
				<div class="col-sm-9 canvas_right_section canvas_video_container" style="float:left;width:100%;height:85%;padding:0px;">
					<video  id="myVideo" style="background-color:black;" class="product_video canvas_video" controls controlsList="nodownload" src="<?= $preview_url ?>" poster="<?= $imgURL ?>" autoplay>
					    </video>
					
				</div>
				<div class="col-sm-9 col-sm-offset-3" style="float:left;padding:0px;">
					<img style="margin-top:-1%;width:100%;border-radius:2px;height:15%;" src="<?= get_template_directory_uri() ?>/inc/assets/img/fbfooter_nobtn.png">
				</div>
				
			</div>
			
			<div class="" style="background-color:white;height:22%;margin-top:2%;border-radius:2px">
				<div class="col-sm-10" style="float:left;margin-top:2%;clear:both;">
					<h2 class="canvas_title" style="margin-bottom:px;padding-bottom:0px;">
						<?= $title  ?>
						-
						<span class="price">
						<b><?= $price; ?></b>
					</span>
					</h2>
					<p><?= $description; ?></p>
				</div>
				<div class="col-sm-2" style="float:left;text-align:right;margin-top:2%">
					
					<a href="<?= WEBSITE_URL.'/product/'.$product->slug.'/?add-to-cart='.$post->ID; ?>" class="single_add_to_cart_button button alt">Add to cart</a>
				</div>
			</div>
			
			
		</div>
	</div>

	<div class="product_full_div canvas_div_mobile">
		<div class="product_full_div">
			<div class="wide_banner"></div>
			<div class="product_div">
				<div class="col-sm-8 col-xs-12" style="float:left;height:100%">
					<?php if (in_array($file_extension, $supported_image)): ?>
						<img src="<?= $preview_url ?>" class="img-responsive" style="width:100%;height:100%;">
					<?php else: ?>
						<video class="product_video" controls controlsList="nodownload" src="<?= $preview_url ?>" poster="<?= $imgURL ?>">
					    </video>
					<?php endif ?>
				</div>
				<div class="col-sm-4 product_info_section center" style="float:left;margin-top:10%;">
					<h2 style=";"><?= $title  ?></h2>
					<span class="price">
						<?= $price ?>
					</span>
					<hr class="after_price">
					<a href="<?= WEBSITE_URL.'/product/'.$product->slug.'/?add-to-cart='.$post->ID; ?>" class="single_add_to_cart_button button alt">Add to cart</a>
					<p style="margin-top:5%;"><?= $description; ?></p>
				</div>
			</div>
		</div>
	</div>

<?php endif ?>


<div class="product_info_section_xs center">
		<h2 class="center"><?= $title  ?></h2>
		<span class="price">
				<?= $price; ?>
		</span>
		<a href="<?= WEBSITE_URL.'/product/'.$product->slug.'/?add-to-cart='.$post->ID; ?>" class="single_add_to_cart_button button alt">Add to cart</a>
		<p style="margin-top:5%;"><?= $description; ?></p>
		<hr class="after_price">
</div>


<div class="related_products container" style="margin-top:10%;clear:both;">

	<h3 class="center">Related Products</h3>

	<?php woocommerce_output_related_products();?>

</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
