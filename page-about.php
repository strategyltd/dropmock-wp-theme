<?php /* Template Name: About */ ?>
 

<?php get_header(); ?>
 
<?php 
    $page = get_page();
    $content = $page->post_content;
    $feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $page->ID ), 'large' );
    if(is_array($feat_image))
        $feat_image = $feat_image[0];
    else
        $feat_image = false;
?>

</div> </div>


<div class="product_full_div hide_on_mobile dynamic_content_parent" style="height:500px;margin-top:0px;">
    <div class="wide_banner"></div>
    <div class="product_div" style="padding:0px;height:auto;height:100%;">
        <?php if ($feat_image): ?>
            <div class="col-sm-6" style="height:100%;float:left;padding:0px;margin:0px;background-image:url('<?= $feat_image ?>');background-size:cover">
            </div>
        <?php else: ?>
            <div class="col-sm-6" style="height:100%;float:left;padding:0px;margin:0px;background-image:url('<?= get_template_directory_uri() ?>/inc/assets/img/about_pic.jpg');background-size:cover">
            </div>
        <?php endif ?>
        
        <div class="col-sm-6" style="float:left;padding:3%;">
            <h4 class="theme-font-color about_title"><span>Abo</span>ut Us!</h4>
            <p class="dynamic_content"><?= $content ?></p>
        </div>
    </div>
</div>
 
    
 <div class="visible_mobile" >
    <?php if ($feat_image): ?>
        <div class="col-sm-6" style="float:left;padding:0px;margin:0px;">
                <img class="contact_image" src="<?= $feat_image ?>">
        </div>
    <?php else: ?>
        <div class="col-sm-6" style="float:left;padding:0px;margin:0px;">
            <img class="contact_image" src="<?= get_template_directory_uri() ?>/inc/assets/img/about_pic.jpg">
    </div>
    <?php endif ?>
    <div class="col-sm-6" style="float:left;padding:3%;">
        <h4 class="theme-font-color about_title"><span>Abo</span>ut Us!</h4>
        <p><?= $content ?></p>
    </div>
 </div>

<?php get_footer(); ?>