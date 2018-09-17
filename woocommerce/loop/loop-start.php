<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
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
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$category_title = single_cat_title("", false);;
?>
<!-- <ul class="products columns-<?php echo esc_attr( wc_get_loop_prop( 'columns' ) ); ?>"> -->

<div class="col-sm-12" style="clear:both;">


<?php if (is_product_category()): ?>
<h3 class="center mobile_margin_top">
		<?php if (get_theme_mod('homepage_main_heading')): ?>
			<?= get_theme_mod('homepage_main_heading') ?>
		<?php else: ?>
			Templates
		<?php endif ?>
	</h3>

	<hr style="margin:0px;">
	<div class="category_filters row">
		<?php $categories = getProductCategories();  ?>
		<div class="col-sm-12 col-xs-12">
			<?php foreach ( $categories as $category): ?>
			<div class="col-sm-2" style="float:left">
				<a href="<?= get_term_link($category->term_taxonomy_id); ?>">
					<?php if ($category->name == $category_title): ?>
						<span class="theme-font-color">
							<?= $category->name ?>
						</span>
					<?php else: ?>
						<?= $category->name ?>
					<?php endif ?>
					
				</a>
			</div>	
			<?php endforeach ?>
		</div>
	</div>
	<hr style="margin:0px;margin-bottom:2%;">
 <?php endif ?>
