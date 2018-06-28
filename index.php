<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */


if ( !class_exists( 'WooCommerce' ) ) {
    include('install_woocommerce.php');
}

get_header(); ?>

	<section id="primary" class="content-area col-sm-12 col-md-12 col-lg-12">
		<main id="main" class="site-main" role="main">

		<h3 class="center mobile_margin_top">
			<?php if (get_theme_mod('homepage_main_heading')): ?>
				<?= get_theme_mod('homepage_main_heading') ?>
			<?php else: ?>
				Templates
			<?php endif ?>
		</h3>

		<hr style="margin:0px;">
		<div class="category_filters">
			<?php $categories = getProductCategories();  ?>
			<div class="col-sm-12 col-xs-12">
				<?php foreach ( $categories as $category): ?>
					<a href="<?= get_term_link($category->term_taxonomy_id); ?>">
						<?= $category->name ?>
					</a>
				<?php endforeach ?>
			</div>
		</div>
		<hr>

		<?php 
			$homeProductsPerPage = 8;
			$homeColumns = 4;
			$shortCodeTodo = '[recent_products per_page="' . $homeProductsPerPage . '" columns="' . $homeColumns . '"]';
			echo '<div class="dropmock_products">' . do_shortcode($shortCodeTodo) . '</div>';
		?>

		</main><!-- #main -->

		
	</section><!-- #primary -->
	<div class="col-sm-12 center" style="margin-top:4%;">
		<a href="<?= get_permalink( wc_get_page_id( 'shop' ) ); ?>" class="center no-decoration">
			<i class="fa fa-arrow-right"></i>
			Shop All
		</a>
	</div>



<?php
get_footer();
