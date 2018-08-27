<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Bootstrap_Starter
 */

if(get_theme_mod('footer_ad_space'))
	$ad_url = get_theme_mod('footer_ad_space');


$social_links = ['facebook','instagram','twitter','linkedin'];
?>



<?php if(!is_page_template( 'blank-page.php' ) && !is_page_template( 'blank-page-with-container.php' )): ?>
			</div><!-- .row -->
		</div><!-- .container -->
	</div><!-- #content -->
    <?php get_template_part( 'footer-widget' ); ?>
<?php endif; ?>
</div><!-- #page -->

<?php wp_footer(); ?>

<!-- <hr> -->
<div class="col-sm-12 center" style="margin-top:5%;">
	<h3 class="center theme-font-color">Explore Templates</h3>
	<?php get_search_form();  ?>

	<a href="<?= (get_theme_mod('footer_ad_link'))? addhttp(get_theme_mod('footer_ad_link')) : '#' ; ?>" target="_blank">
	<?php if (isset($ad_url)): ?>
		<?php if (get_theme_mod('footer_ad_width') && get_theme_mod('footer_ad_height')): ?>
			<div class="my_ad_space" style="background-image:url('<?= $ad_url  ?>');
					width:<?= get_theme_mod('footer_ad_width') ?>%;
					height:<?= get_theme_mod('footer_ad_height') ?>px ">
		<?php else: ?>
			<div class="my_ad_space" style="background-image:url('<?= $ad_url  ?>');">
		<?php endif ?>
	<?php else: ?>
		<div class="my_ad_space" style="background-color: #f1f1f1;">
			AD SPACE
	<?php endif ?>
</div>
</a>


</div>

<div class="dm_footer col-sm-12">
	<h2 class="theme-font-color">Contact Us</h2>
	<div class="row">
		<div class="col-sm-6" style="margin:0 auto">
		<?php foreach ($social_links as $link): ?>
		<span style="marign-left:2%;margin-right:2%;">
			<?php $name = 'social_'.$link.'_link'; ?>
			<?php if (get_theme_mod($name) && get_theme_mod($name) != "" ): ?>
				<a target="_blank" href="<?= get_theme_mod($name) ?>"><i class="fa fa-2x fa-<?= $link ?>"></i></a>
			<?php endif ?>
		</span>	
		<?php endforeach ?>
		</div>
	</div>
	
	<div class="row" style="padding-left:15%;padding-right:15%;clear:both;">
		
		<div style="width:100%;margin:0 auto;position:relative;">
			<?php if (get_theme_mod('contact_info_phone_1') || get_theme_mod('contact_info_phone_2')): ?>
			<div class="col-xs-12 footer-section">
				<i class="fa fa-2x fa-phone theme-font-color"></i>
				</br>
				</br>
				<?php if (get_theme_mod('contact_info_phone_1')): ?>
					<?= get_theme_mod('contact_info_phone_1')  ?>
				<?php endif ?>
				</br>
				<?php if (get_theme_mod('contact_info_phone_2')): ?>
					<?= get_theme_mod('contact_info_phone_2')  ?>
				<?php else: ?>
				</br>
				<?php endif ?>
			</div>
		<?php endif ?>
		
		<?php if (get_theme_mod('contact_info_email')): ?>
			<div class="col-xs-12 footer-section">
				<i class="fa fa-2x fa-envelope theme-font-color"></i>
				</br>
				</br>
				<span><?= (get_theme_mod('contact_info_email'))? get_theme_mod('contact_info_email') : 'Email' ;?></span>
				</br>
				<a href="mailto:<?= get_theme_mod('contact_info_email') ?>" target="_top">Contact Us</a>
			</div>
		<?php endif ?>
		
		<?php if (get_theme_mod('contact_info_address_1') || get_theme_mod('contact_info_address_2')): ?>
			<div class="col-xs-12 footer-section">
				<i class="fa fa-2x fa-map-marker theme-font-color"></i>
				</br>
				</br>
				<?php if (get_theme_mod('contact_info_address_1')): ?>
					<?= get_theme_mod('contact_info_address_1')  ?>
				<?php endif ?>
				</br>
				<?php if (get_theme_mod('contact_info_address_2')): ?>
					<?= get_theme_mod('contact_info_address_2')  ?>
				<?php else: ?>
				</br>
				<?php endif ?>
			</div>
		<?php endif ?>

		</div>
	</div>
</div>
<footer id="colophon" class=" center site-footer <?php echo wp_bootstrap_starter_bg_class(); ?>" role="contentinfo">
		<div class="site-info">
            &copy; <?php echo date('Y'); ?> <?php echo '<a href="'.home_url().'">'.get_bloginfo('name').'</a>'; ?>
            <span class="sep"> | Home</span>
        </div>
</footer>

</body>

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>


  <script type="text/javascript">
  	$(document).ready(function(){



  		if($("#myVideo").length != 0){
  			$("#myVideo").bind("loadedmetadata", function () {
		        var width = this.videoWidth;
		        var height = this.videoHeight;
		       	
		       	if(width == 420 && height == 160)
		       		$("#myVideo").css('object-fit','contain');
		       	else
		       		$("#myVideo").css('object-fit','cover');
		    });
  		}

  		// var primary_color = $("a").css('color');
  		var primary_color = $(":root").css('--primary');
  		var secondary_color = $(":root").css('--secondary');
  		$(".theme-font-color").css('color',primary_color);
  		$(".dm_footer .borders").css('border-color',primary_color);
  		$(".wide_banner").css('background-color',primary_color);
  		$(".after_price").css('border-color',primary_color);
  		$(".search_input").css('border-color',primary_color);

  		adjustFonts();
  		checkHoverVideos();

  		var logo_color = $(".site-title").css('color');
		var nav_bar_color = $(".navbar-static-top").css('background-color');
		
		if(logo_color == nav_bar_color)
			$(".site-title").css('color',secondary_color);
  		

  		$('.canvas_video').hover(function toggleControls() {
		    this.setAttribute("controls", "controls")
		});

		$('.canvas_video').mouseleave(function toggleControls() {
		    this.removeAttribute("controls")
		    
		});

		var original_product_bg = $(".product_in_loop").css('background-color');

		$(".product_in_loop").hover(function(){
			$(this).css('background-color',primary_color);
			$(this).find('a').css('color',secondary_color);
		});

		$(".product_in_loop").mouseleave(function(){
			$(this).css('background-color',original_product_bg);
			$(this).find('a').css('color',primary_color);
		});



	    


  		
  	});
	

  	function checkHoverVideos(){
  		if($(".hover_video").length != 0){
  			$('.hover_video').hover(function() {
			    $(this).get(0).play();
			});

			$('.hover_video').mouseleave(function() {
			    $(this).get(0).pause();
			})
  		}

  	}


  	function adjustFonts(){
  		if($(".product_div h2").length != 0){
  			var check = false;
	  		while(!check){
	  			console.log('font-resizing');
	  			var div_height = parseInt($(".product_div").css('height'));
		  		var h2_height  = parseInt($(".product_div h2").css('height'));
		  		var h2_font    = $(".product_div h2").css('font-size');
		  		var h2_font    = parseInt(h2_font.split('px')[0]);

	  			var percentage =(h2_height/div_height)*100;
	  			if(percentage > 30){
	  				var new_font_size = parseInt((h2_font*90)/100);
	  				$(".product_div h2").css('font-size',new_font_size+'px');
	  			}else{
	  				break;
	  			}
	  		}
  		}


  		if($(".dynamic_content").length != 0){
  			while(1==1){
  				var height 		  = parseInt($('.dynamic_content').css('height'));
  				var parent_height = parseInt($('.dynamic_content_parent').css('height'));
  				var font = $(".dynamic_content").css('font-size');
  				var percentage =(height/parent_height)*100;
  				if(percentage > 70){
  					var new_font_size = parseInt(font)*90;
	  				new_font_size = parseInt(new_font_size/100);
	  				$(".dynamic_content").css('font-size',new_font_size+'px');
	  			}else{
	  				break;
	  			}
  			}
  		}
  	}
  </script>

</html>