<?php
/**
 * Template Name: Forums Index Page
 */
get_header();?>
<!-- section-contianer open -->
<div class="section-contianer">
	<div class="container page-container-five">
		<!-- page title close -->
		<div class="row">
			<!-- content open -->
			<div class="col-md-12 col-sm-12">
                <?php echo do_shortcode('[bbp-forum-index]'); ?>
            </div>
			<!-- content close -->
		</div>
	</div>
</div>

<?php get_footer(); ?>
