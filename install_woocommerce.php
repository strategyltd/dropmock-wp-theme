<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Bootstrap_Starter
 */


$header_image = get_header_image();
if($header_image == '')
    $header_image = get_template_directory_uri().'/inc/assets/img/featured.jpg';


?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>

<style type="text/css">
html,body{
    height:91.4%;
}
</style>
</head>

<body>
<header id="masthead" class="site-header navbar-static-top <?php echo wp_bootstrap_starter_bg_class(); ?>" role="banner">
    <div class="container">
        <nav class="navbar navbar-expand-xl p-0">
            <div class="navbar-brand">
                <?php if ( get_theme_mod( 'wp_bootstrap_starter_logo' ) ): ?>
                    <a href="<?php echo esc_url( home_url( '/' )); ?>">
                        <img style="max-width:100% !important;max-height:100%;" src="<?php echo esc_attr(get_theme_mod( 'wp_bootstrap_starter_logo' )); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                    </a>
                <?php else : ?>
                    <a class="site-title" href="<?php echo esc_url( home_url( '/' )); ?>"><?php esc_url(bloginfo('name')); ?></a>
                <?php endif; ?>

            </div>
    </div>
</header>
<div id="page-sub-header" style="background-image : url('<?= $header_image ?>');height:100%;">      
    <div class="header_overlay" style="background-image: url('<?= get_template_directory_uri()."/inc/assets/img/Gray-Overlay.png"; ?>');">
        <div class="container" >
            <h1>Please install Woocommerce Plugin To Start Using Your Store</h1>
            <p>Login to your dashboard and install the required plugins to start using your store</p>
            <a class="btn bg-primary" href="<?= get_site_url().'/wp-admin' ?>">Go To Dashboard</a>
        </div>
    </div>
</div>


<?php exit(); ?>
