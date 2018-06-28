<?php /* Template Name: Blog */ ?>
 
<?php get_header(); ?>
 


<div  style="clear:both;width:100%;">

        <?php query_posts('post_type=post&post_status=publish&posts_per_page=10&paged='. get_query_var('paged')); ?>

	<?php if( have_posts() ): ?>
		<?php $i = 0; ?>
        <?php while( have_posts() ): the_post(); ?>
        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
        <?php $post_time =  get_the_date('l, F j, Y')?>
        <?php if ($i == 0): ?>
        	<div class="col-sm-12">
        		<div style="width:100%;height:300px;background-image:url('<?= $image[0] ?>');background-size:cover;"></div>
        		<div style="margin-top:1%;">
        			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        			<?php the_excerpt(__('Continue reading »','example')); ?>
        			<a href="<?= get_post_permalink($post->ID); ?>"> <i class="fa fa-arrow-right"></i> Read More
        			</a>
        			<span style="margin-left:3%;"><i class="fa fa-clock"></i> <?= $post_time ?></span>
        		</div>
        	</div>
        	<hr style="margin-bottom:5%;">
        <?php else: ?>
        	<div class="col-sm-6" style="float:left;height:600px;">
    			<div style="width:100%;height:50%;background-image:url('<?= $image[0] ?>');background-size:cover;"></div>
        		<div style="margin-top:1%;">
        			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        			<?php the_excerpt(__('Continue reading »','example')); ?>
        			<a href="<?= get_post_permalink($post->ID); ?>"> <i class="fa fa-arrow-right"></i> Read More
        			</a>
        			<span style="margin-left:3%;"><i class="fa fa-clock"></i> <?= $post_time ?></span>
        		</div>
        	</div>
        	<?php if ($i % 2 == 0): ?>
        		<!-- <hr> -->
        	<?php endif ?>
        <?php endif ?>
        <?php $i++; ?>
        <?php endwhile; ?>

		<div class="navigation">
			<span class="newer"><?php previous_posts_link(__('« Newer','example')) ?></span> <span class="older"><?php next_posts_link(__('Older »','example')) ?></span>
		</div><!-- /.navigation -->

	<?php else: ?>

		<div id="post-404" class="noposts">

		    <p>No articles available at the moment.</p>

	    </div><!-- /#post-404 -->

	<?php endif; wp_reset_query(); ?>

	</div><!-- /#content -->

<?php get_footer(); ?>