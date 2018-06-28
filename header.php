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
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'wp-bootstrap-starter' ); ?></a>
    <?php if(!is_page_template( 'blank-page.php' ) && !is_page_template( 'blank-page-with-container.php' )): ?>
	<header id="masthead" class="site-header navbar-static-top <?php echo wp_bootstrap_starter_bg_class(); ?>" role="banner">
        <div class="container">
            <nav class="navbar navbar-expand-xl p-0">
                <div class="navbar-brand">
                    <?php if ( get_theme_mod( 'wp_bootstrap_starter_logo' ) ): ?>
                        <a href="<?php echo esc_url( home_url( '/' )); ?>">

                            <?php if (get_theme_mod('header_logo_height') || get_theme_mod('header_logo_width')): ?>
                                <img style="
                                    <?php if (get_theme_mod('header_logo_height')): ?>
                                        height:<?= get_theme_mod('header_logo_height') ?>px;
                                    <?php endif ?>
                                    <?php if (get_theme_mod('header_logo_width')): ?>
                                        width:<?= get_theme_mod('header_logo_width') ?>px;
                                    <?php endif ?>
                                    "
                                    src="<?php echo esc_attr(get_theme_mod( 'wp_bootstrap_starter_logo' )); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                            <?php else: ?>
                                <img style="width:100% !important;height:100%;" src="<?php echo esc_attr(get_theme_mod( 'wp_bootstrap_starter_logo' )); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                            <?php endif ?>
                            
                        </a>
                    <?php else : ?>
                        <a class="site-title" href="<?php echo esc_url( home_url( '/' )); ?>"><?php esc_url(bloginfo('name')); ?></a>
                    <?php endif; ?>

                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-nav" aria-controls="" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>


                <?php
                wp_nav_menu(array(
                'theme_location'    => 'primary',
                'container'       => 'div',
                'container_id'    => 'main-nav',
                'container_class' => 'collapse navbar-collapse justify-content-end',
                'menu_id'         => get_option('navigation_menu_id'),
                'menu_class'      => 'navbar-nav font_theme_color',
                'depth'           => 3,
                'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
                'walker'          => new wp_bootstrap_navwalker()
                ));
                ?>
            </nav>
        </div>
	</header><!-- #masthead -->
    <?php if(is_front_page() && !get_theme_mod( 'header_banner_visibility' )): ?>
        <div id="page-sub-header" style="background-image : url('<?= $header_image ?>') ">      
            <div class="header_overlay" style="background-image: url('<?= get_template_directory_uri()."/inc/assets/img/Gray-Overlay.png"; ?>');">
                <div class="container" >
                    <?php if (!get_theme_mod('header_banner_title_setting_color')): ?>
                        <h1><?= (get_theme_mod( 'header_banner_title_setting' ))? get_theme_mod( 'header_banner_title_setting' ) : 'PURCHASE STUNNING MOCKUPS & VIDEO ADS' ?></h1>
                    <?php else: ?>
                        <h1 style="color:<?= get_theme_mod('header_banner_title_setting_color');  ?>"><?= (get_theme_mod( 'header_banner_title_setting' ))? get_theme_mod( 'header_banner_title_setting' ) : 'PURCHASE STUNNING MOCKUPS & VIDEO ADS' ?></h1>
                    <?php endif ?>
                    
                    <?php if (!get_theme_mod('header_banner_tagline_setting_color')): ?>
                        <p><?=  (get_theme_mod( 'header_banner_tagline_setting' ))? get_theme_mod( 'header_banner_tagline_setting' ) : 'Professionally created, delivered in hours.' ?></p>
                    <?php else: ?>
                        <p style="color: <?= get_theme_mod('header_banner_tagline_setting_color') ?>" ><?=  (get_theme_mod( 'header_banner_tagline_setting' ))? get_theme_mod( 'header_banner_tagline_setting' ) : 'Professionally created, delivered in hours.' ?></p>
                    <?php endif ?>
                    
                    <a class="btn bg-primary" href="<?= get_site_url().'/shop' ?>"><?= (get_theme_mod( 'header_banner_button_setting' ))? get_theme_mod( 'header_banner_button_setting' ) : 'SHOP NOW'  ?></a>
                </br>
                    <a href="#content" class="page-scroller"><i class="fa fa-fw fa-angle-down"></i></a>
                </div>
            </div>
        </div>
        <div class="page-extra-header col-sm-12 bg-primary">
            <div class="row">
                <div class="col-md-4 col-xs-12 col-sm-12">
                    <i class="fa <?= (get_theme_mod('header_subsection_left_icon'))? get_theme_mod('header_subsection_left_icon') : 'fa-angellist' ?>"></i>
                    <span> <?= (get_theme_mod('header_subsection_left_text'))? get_theme_mod('header_subsection_left_text') : 'Easy to-use platform' ?></span>
                </div>
                <div class="col-md-4 col-xs-12 col-sm-12">
                    <i class="fa <?= (get_theme_mod('header_subsection_middle_icon'))? get_theme_mod('header_subsection_middle_icon') : 'fa-film' ?>"></i>
                    <span> <?=( get_theme_mod('header_subsection_middle_text'))?  get_theme_mod('header_subsection_middle_text') : 'Wide variety of templates' ?></span>
                </div>
                <div class="col-md-4 col-xs-12 col-sm-12">
                   <i class="fa <?= (get_theme_mod('header_subsection_right_icon')) ? get_theme_mod('header_subsection_right_icon') : 'fa-asterisk' ?>"></i>
                    <span> <?= (get_theme_mod('header_subsection_right_text'))? get_theme_mod('header_subsection_right_text') : 'Flexible across niches' ?></span>
                </div>
            </div>
        </div>
    <?php endif; ?>
	<div id="content" class="site-content">
		<div class="container">
			<div class="row">
                <?php endif; ?>