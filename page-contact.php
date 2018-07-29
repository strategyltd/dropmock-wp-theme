<?php /* Template Name: About */ ?>



 
<?php get_header(); ?>


<?php 
    // $page = get_page();
    $page_ID = get_the_ID();
    $page = get_page($page_ID);
    $content = $page->post_content;
    $feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $page->ID ), 'large' );
    if(is_array($feat_image))
        $feat_image = $feat_image[0];
    else
        $feat_image = false;
?> 

</div> </div>


<div class="product_full_div hide_on_mobile" style="height:500px;margin-top:0px;">
    <div class="wide_banner"></div>
    <div class="product_div" style="padding:0px;height:100%;">
        <div class="col-sm-6" style="float:left;padding:3%;">
        	<h4 class="theme-font-color">Say Hello to us!</h4>
        	<span class="theme-font-color">Share with us your questions and/or concerns</span>
        	<span class="theme-font-color">We'd love to hear from you</span>
        	<hr>

        	<h6 class="theme-font-color">ADDRESS :</h6>
        	<small><?= (get_theme_mod('contact_info_address_1'))? get_theme_mod('contact_info_address_1') : '88 Lorem Street' ;?></small></br>
        	<small><?= (get_theme_mod('contact_info_address_2'))? get_theme_mod('contact_info_address_2') : 'Los Angelos, USA 10108' ;?></small>
        </br>
        </br>
        	<h6 class="theme-font-color">PHONE :</h6>
        	<small><?= (get_theme_mod('contact_info_phone_1'))? get_theme_mod('contact_info_phone_1') : '(+01) 123456789 ' ;?></small></br>
        	<small><?= (get_theme_mod('contact_info_phone_2'))? get_theme_mod('contact_info_phone_2') : '(+01) 123456789 ' ;?></small>
        </br>
        </br>
        	<h6 class="theme-font-color">EMAIL :</h6>
        	<small><?= (get_theme_mod('contact_info_email'))? get_theme_mod('contact_info_email') : 'test@gmail.com' ;?></small>
        </div>
        <!-- <div class="col-sm-6" style="float:left;padding:0px;margin:0px;">
        	<img class="contact_image" src="<?= get_template_directory_uri() ?>/inc/assets/img/contact_pic.jpg">
        </div> -->
         <?php if ($feat_image): ?>
         <div class="col-sm-6" style="height:100%;float:left;padding:0px;margin:0px;background-image:url('<?= $feat_image ?>');background-size:cover">
         <?php else: ?>
         <div class="col-sm-6" style="height:100%;float:left;padding:0px;margin:0px;background-image:url('<?= get_template_directory_uri() ?>/inc/assets/img/contact_pic.jpg');background-size:cover">
         <?php endif ?>
        </div>
    </div>
</div>
 

 <div class="visible_mobile" >
    <div class="col-sm-6" style="float:left;padding:3%;">
            <h4 class="theme-font-color">Say Hello to us!</h4>
            <span class="theme-font-color">Share with us your questions and/or concerns</span>
            <span class="theme-font-color">We'd love to hear from you</span>
            <hr>

            <h6 class="theme-font-color">ADDRESS :</h6>
            <small><?= (get_theme_mod('contact_info_address_1'))? get_theme_mod('contact_info_address_1') : '88 Lorem Street' ;?></small></br>
            <small><?= (get_theme_mod('contact_info_address_2'))? get_theme_mod('contact_info_address_2') : 'Los Angelos, USA 10108' ;?></small>
        </br>
        </br>
            <h6 class="theme-font-color">PHONE :</h6>
            <small><?= (get_theme_mod('contact_info_phone_1'))? get_theme_mod('contact_info_phone_1') : '(+01) 123456789 ' ;?></small></br>
            <small><?= (get_theme_mod('contact_info_phone_2'))? get_theme_mod('contact_info_phone_2') : '(+01) 123456789 ' ;?></small>
        </br>
        </br>
            <h6 class="theme-font-color">EMAIL :</h6>
            <small><?= (get_theme_mod('contact_info_email'))? get_theme_mod('contact_info_email') : 'test@gmail.com' ;?></small>
        </div>
        <div class="col-sm-6" style="float:left;padding:0px;margin:0px;">
            <?php if ($feat_image): ?>
                 <img class="contact_image" src="<?= $feat_image ?>">
            <?php else: ?>
                 <img class="contact_image" src="<?= get_template_directory_uri() ?>/inc/assets/img/contact_pic.jpg">
            <?php endif ?>
        </div>
 </div>
    
 
<?php get_footer(); ?>