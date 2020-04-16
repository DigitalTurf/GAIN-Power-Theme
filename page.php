<?php get_header();?>
<!-- Header end -->
<?php the_post();
if (has_shortcode( get_the_content(), 'vc_row' ) || has_shortcode( get_the_content(), 'listingpro_submit' ) || has_shortcode( get_the_content(), 'listingpro_pricing' ) || is_front_page()) {
	if (has_shortcode( get_the_content(), 'vc_row' ) && has_shortcode( get_the_content(), 'listingpro_promotional' )) { ?>
		<section class="section-contianer aliceblue lp-blog-for-app-view">
				<?php the_content(); ?>
		</section>
	<?php
	}
	else { ?>
	 <section class="section-contianer">
		<?php the_content(); ?>
	 </section>
<?php }
}
else { ?>
<!-- section-contianer open -->
<div class="section-contianer">
	<div class="container page-container-five">
		<!-- page title close -->
		<div class="row">
			<!-- content open -->
			<div class="col-md-12 col-sm-12">
				<h1 class="page-title"><?php echo get_the_title(); ?></h1>
				<div class="blog-post clearfix">
					<div class="post-content blog-test-page">
						<?php the_content(); ?>
					</div>
				<?php wp_link_pages(); ?>
				<?php comments_template('', true); ?>
				</div>
			</div>
			<!-- content close -->
			<!-- sider open -->
		</div>
	</div>
</div>
</div>
<!-- section-contianer close -->
<?php } ?>
<?php get_footer(); ?>
