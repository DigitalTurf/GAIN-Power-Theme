<?php get_header();?>

	<?php

	/* The loop starts here. */

	if ( have_posts() ) {

		while ( have_posts() ) {

			the_post();

			$post_time = get_the_time('U');

			$post_modified_time = get_the_modified_time('U');

			$modified = FALSE;

			if ($post_modified_time >= $post_time + 86400) {

				$modified = TRUE;

			}



			$lp_page_banner =   get_the_post_thumbnail_url( $post->ID, 'full' );



			$author_avatar_url = get_user_meta(get_the_author_meta( 'ID' ), "listingpro_author_img_url", true);

			$avatar ='';

			if(!empty($author_avatar_url)) {

				$avatar =  $author_avatar_url;



			} else {

				$avatar_url = listingpro_get_avatar_url (get_the_author_meta( 'ID' ), $size = '51' );

				$avatar =  $avatar_url;



			}

            global $listingpro_options;

            $blog_detail_template   =   $listingpro_options['blog_single_template'];

            $blog_sidebar_style   =   $listingpro_options['blog_sidebar_style'];

            $blog_detail_class      =   '12';



            if( $blog_detail_template == 'left_sidebar' || $blog_detail_template == 'right_sidebar' || $blog_detail_template == 'right_sidebar2' || $blog_detail_template == 'left_sidebar2' )

            {

                $blog_detail_class      =   '8';

            }



            $style2Class    =   '';

            $style2_detail_class    =   '';

            $style2_detail_class_container  =   '';

            if( $blog_detail_template == 'fullwidth2' || $blog_detail_template == 'right_sidebar2' || $blog_detail_template == 'left_sidebar2' )

            {

                $style2Class    =   'blog-single-page-style2';

                $style2_detail_class    =   'blog-single-inner-container-style2';



            }

            if( $blog_detail_template == 'fullwidth2' || $blog_detail_template == 'left_sidebar2' || $blog_detail_template == 'right_sidebar2' )

            {

                $style2_detail_class_container  =   'page-container-second-style2';

            }

			?>

	<!--==================================Section Open=================================-->

	<section class="aliceblue">

		<div class="container page-container-second page-container-second-blog <?php echo $style2_detail_class_container; ?>">

			<div class="row">

                <div class="blog-single-inner-container lp-border lp-border-radius-8 <?php echo $blog_detail_template; ?> <?php echo $style2_detail_class; ?>">

                    <?php

                    if( $blog_detail_template == 'left_sidebar' || $blog_detail_template == 'left_sidebar2' )

                    {

                        if( $blog_sidebar_style == 'sidebar_style1' ){

                        echo '<div class="col-md-4"><div class="sidebar-style1 listing-second-view">';

                            get_sidebar();

                        echo '</div></div>';

						}else{

							 echo '<div class="col-md-4"><div class="sidebar-style2 listing-second-view">';

							get_sidebar();

							echo '</div></div>';



						}

                    }

                    ?>

                    <div class="col-md-<?php echo $blog_detail_class; ?>">

						<div class="blog-content-outer-container">

							<div class="blog-title-area">

								<h1 class="blog-title"><?php echo get_the_title(); ?></h1>

								<?php
								$sponsor = get_post_meta( $post->ID, '_sponsorship_meta_value_key', true );
								if ( ! empty( $sponsor ) ) {
									?>
									<h3 class="blog-sponsor">Sponsored by <?php echo esc_html( $sponsor ); ?></h3>
									<?php
								}
								?>

								<?php if (has_excerpt()) { ?>

									<div class="blog-intro-text">

										<?php the_excerpt(); ?>

									</div>

								<?php } ?>

							</div>

							<div class="blog-meta-area">

								<div class="blog-auth">

									<a href="<?php echo get_profile_url_by_id( get_the_author_meta( 'ID' ) ); ?>">

										<span><?php the_author(); ?></span>

									</a>

								</div>

								<div class="blog-date">

									<?php if ($modified) { ?>

										<span class="blog-mod-date">Updated <?php the_modified_time('M. j, Y g:iA'); ?> ET</span> / <span class="blog-pub-date">Published <?php the_time('M. j, Y g:iA'); ?> ET</span>

									<?php }

									else { ?>

										<span class="blog-pub-date pub-only">Published <?php the_time('M. j, Y g:iA'); ?> ET</span>

									<?php } ?>

								</div>

							</div>

							<div class="blog-content popup-gallery">

								<?php if ($lp_page_banner) { ?>

									<div class="blog-featured"><img src="<?php echo $lp_page_banner; ?>"></div>

								<?php } ?>

								<?php the_content(); ?>

							</div>

							<div class="blog-meta clearfix">

								<div class="blog-tags pull-left">

									<ul>

										<?php

										$posttags = get_the_tags($post->ID);

										if ($posttags) {

											echo '<li><i class="fa fa-tag"></i></li>';

											foreach($posttags as $tag) {

												echo '&nbsp;<li><a href="' .get_tag_link($tag->term_id). '">#' .$tag->name. '</a></li>';

											}

										}

										?>

									</ul>

								</div>

								<div class="blog-social pull-right listing-second-view">

                                    <div class="lp-blog-grid-shares">

                                        <span><i class="fa fa-share-alt" aria-hidden="true"></i></span>

                                        <a href="<?php echo listingpro_social_sharing_buttons('facebook'); ?>" class="lp-blog-grid-shares-icon icon-fb"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>

                                        <a href="<?php echo listingpro_social_sharing_buttons('twitter'); ?>" class="lp-blog-grid-shares-icon icon-tw"><i class="fab fa-twitter" aria-hidden="true"></i></a>

                                        <a href="<?php echo listingpro_social_sharing_buttons('gplus'); ?>" class="lp-blog-grid-shares-icon icon-gp"><i class="fab fa-google-plus-g" aria-hidden="true"></i></a>

                                        <a href="<?php echo listingpro_social_sharing_buttons('pinterest'); ?>" class="lp-blog-grid-shares-icon icon-pin"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a>

                                        <a href="<?php echo listingpro_social_sharing_buttons('reddit'); ?>" class="lp-blog-grid-shares-icon icon-pin"><i class="fab fa-reddit"></i></a>

                                        <a href="<?php echo listingpro_social_sharing_buttons('stumbleupon'); ?>" class="lp-blog-grid-shares-icon icon-pin"><i class="fa fa-stumbleupon"></i></a>

                                        <a href="<?php echo listingpro_social_sharing_buttons('del'); ?>" class="lp-blog-grid-shares-icon icon-pin"><i class="fab fa-delicious"></i></a>

                                    </div>

<!--									<ul class="post-stat">-->

<!--										<li class="reviews sbutton">-->

<!--										--><?php //listingpro_sharing(); ?>

<!--										</li>-->

<!--									</ul>-->

								</div>

							</div>

							<div class="blog-pagination clearfix">

								<div class="pull-left"><?php previous_post_link('%link', '<i class="fa fa-angle-double-left" aria-hidden="true"></i> '.esc_html__('Previous', 'listingpro'), false); ?></div>

								<div class="pull-right"><?php next_post_link( '%link', esc_html__('Next', 'listingpro').' <i class="fa fa-angle-double-right" aria-hidden="true"></i> ', false ); ?></div>

							</div> <!-- end navigation -->

							<?php



							comments_template();

							?>



						</div>

                    </div>

                    <?php

                    if( $blog_detail_template == 'right_sidebar' || $blog_detail_template == 'right_sidebar2' )

                    {

						if( $blog_sidebar_style == 'sidebar_style1' ){

                        echo '<div class="col-md-4 listing-second-view"><div class="sidebar-style1 listing-second-view">';

                            get_sidebar();

                        echo '</div></div>';

						}else{

							 echo '<div class="col-md-4 listing-second-view"><div class="sidebar-style2 listing-second-view">';

							get_sidebar();

							echo '</div></div>';



						}

                    }

                    ?>

                    <div class="clearfix"></div>

                </div>

			</div>

		</div>

	</section>

	<!--==================================Section Close=================================-->

	<?php

		} // end while

	} // end if

	?>

<?php get_footer();?>

