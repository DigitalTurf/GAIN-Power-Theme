<?php

global $listingpro_options;
$author_id  =   $object_id;

$author_listings    =   '';
if( isset( $listingpro_options['my_listings_author'] ) )
    $author_listings    =   $listingpro_options['my_listings_author'];

$author_about   =   '';

if( isset( $listingpro_options['about_me'] ) )
    $author_about   =   $listingpro_options['about_me'];



$author_reviews =   '';

$review_style   =   'style1';

if( isset( $listingpro_options['reviews'] ) )

{
    $author_reviews =   $listingpro_options['reviews'];
    $review_style   =   $listingpro_options['my_reviews_style'];
}





$author_photos  =   '';

if( isset( $listingpro_options['photos'] ) )

    $author_photos  =   $listingpro_options['photos'];



$author_contact =   '';

if( isset( $listingpro_options['contact'] ) )

    $author_contact =   $listingpro_options['contact'];

$listing_layout =   'grid_view_v2';

if( isset( $listingpro_options['my_listing_views'] ) )
{
    $listing_layout =   $listingpro_options['my_listing_views'];
}
?>

<div class="lp-author-content">

    <div class="container">

        <div class="row">

            <?php

            if( $author_contact == 1 || $author_photos == 1 || $author_reviews == 1 || $author_listings == 1 || $author_about == 1 ):

                ?>

                <div class="col-md-3 padding0">

                    <div class="lp-author-nav" data-author="<?php echo get_queried_object_id(); ?>">

                        <ul>

                            <?php

                            if( $author_about == 1 ):

                                ?>
                                <li><a href="#aboutme" class="active data-available" data-toggle="tab"><i class="fa fa-user"></i> <?php echo esc_html__('About Me', 'listingpro'); ?></a></li>
                            <?php endif; ?>
                            <?php
                            if( $author_listings == 1 ):
                                ?>
                                <li><a href="#mylistings" data-listing-layout="<?php echo $listing_layout; ?>" data-toggle="tab"><i class="fa fa-camera"></i> <?php echo esc_html__('My Listing', 'listingpro'); ?></a></li>
                            <?php endif; ?>
<!--                            --><?php
//                            if( $author_reviews == 1 ):
//                                ?>
<!--                                <li><a id="reviews-nav-li" href="#reviews" data-style="--><?php //echo $review_style; ?><!--" data-toggle="tab"><i class="far fa-star"></i> Reviews</a></li>-->
<!--                            --><?php //endif; ?>
                            <?php
                            if( $author_photos == 1 ):
                                ?>
                                <li><a href="#photos" data-toggle="tab"><i class="fa fa-list"></i> <?php echo esc_html__('Photos', 'listingpro'); ?></a></li>
                            <?php endif; ?>
                            <?php
                            if( $author_contact == 1 ):
                                ?>
                                <li><a href="#contact" data-toggle="tab"><i class="fa fa-envelope"></i> <?php echo esc_html__('Contact', 'listingpro'); ?></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9 padding0">
                    <div class="author-tab-content">
                        <?php
                        if( $author_about == 1 ):
                            ?>
                            <div class="tab-pane active" id="aboutme">
                                <h3><?php echo esc_html__( 'About Me', 'listingpro' ); ?></h3>
                                <div class="author-inner-content-wrap">
                                    <?php get_template_part( 'templates/author/author-about' ); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php
                        if( $author_listings == 1 ):
                            ?>
                            <div class="tab-pane" id="mylistings">
                                <h3><?php echo esc_html__( 'My Listings', 'listingpro' ); ?></h3>
                                <div class="author-inner-content-wrap"></div>
                            </div>
                        <?php endif; ?>
                        <?php
                        if( $author_reviews == 1 ):
                            $args=array(
                                'post_type' => 'listing',
                                'post_status' => 'publish',
                                'posts_per_page' => -1,
                                'order' => 'ASC',
                                'author' => get_queried_object_id(),
                            );
                            $my_query = null;
                            $my_query = new WP_Query($args);
                            ?>
                            <div class="tab-pane" id="reviews">
                                <h3><?php echo esc_html__( 'Reviews', 'listingpro' ); ?></h3>
                                <div class="lp-reviews-dropdown">
                                    <select id="lp-review-listing" name="lp-reviews-listing" class="select2">
                                        <?php
                                        if( $my_query->have_posts()): while ( $my_query->have_posts() ): $my_query->the_post();
                                        ?>
                                            <option value="<?php echo get_the_ID(); ?>"><?php the_title(); ?></option>
                                        <?php endwhile; wp_reset_postdata(); endif; ?>
                                    </select>
                                </div>
                                <div class="clearfix"></div>
                                <div class="author-inner-content-wrap"></div>
                            </div>
                        <?php endif; ?>
                        <?php
                        if( $author_photos == 1 ):
                            ?>
                            <div class="tab-pane" id="photos">
                                <h3><?php echo esc_html__( 'Photos', 'listingpro' ); ?></h3>
                                <div class="author-inner-content-wrap"></div>
                            </div>
                        <?php endif; ?>
                        <?php
                        if( $author_contact == 1 ):
                            ?>
                            <div class="tab-pane" id="contact">
                                <h3 style="text-align: center;"><?php echo esc_html__( 'Contact', 'listingpro' ); ?></h3>
                                <div class="author-inner-content-wrap"></div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>