<?php
/* The loop starts here. */
global $listingpro_options;
if ( have_posts() ) {
    while ( have_posts() ) {
        the_post();
        setPostViews(get_the_ID());
        $claimed_section = listing_get_metabox('claimed_section');
        $tagline_text = listing_get_metabox('tagline_text');
        $listingAuthorId = get_post_field( 'post_author', get_the_ID() );
        $currentUserId = get_current_user_id();

        $plan_id = listing_get_metabox_by_ID('Plan_id',get_the_ID());
        if(!empty($plan_id)){
            $plan_id = $plan_id;
        }else{
            $plan_id = 'none';
        }

        $contact_show = get_post_meta( $plan_id, 'contact_show', true );
        $map_show = get_post_meta( $plan_id, 'map_show', true );
        $video_show = get_post_meta( $plan_id, 'video_show', true );
        $gallery_show = get_post_meta( $plan_id, 'gallery_show', true );
        $tagline_show = get_post_meta( $plan_id, 'listingproc_tagline', true );
        $location_show = get_post_meta( $plan_id, 'listingproc_location', true );
        $website_show = get_post_meta( $plan_id, 'listingproc_website', true );
        $social_show = get_post_meta( $plan_id, 'listingproc_social', true );
        $faqs_show = get_post_meta( $plan_id, 'listingproc_faq', true );
        $price_show = get_post_meta( $plan_id, 'listingproc_price', true );
        $tags_show = get_post_meta( $plan_id, 'listingproc_tag_key', true );
		$hours_show = get_post_meta( $plan_id, 'listingproc_bhours', true );
		$partisan_show = get_post_meta( $post->ID, '_partisan_verified_meta_key', true );

        if($plan_id=="none"){
            $contact_show = 'true';
            $map_show = 'true';
            $video_show = 'true';
            $gallery_show = 'true';
            $tagline_show = 'true';
            $location_show = 'true';
            $website_show = 'true';
            $social_show = 'true';
            $faqs_show = 'true';
            $price_show = 'true';
            $tags_show = 'true';
            $hours_show = 'true';
        }

        $claim = '';
        if($claimed_section == 'claimed') {
			$claim = '<span style="white-space:nowrap" class="claimed"><i class="fas fa-check"></i> '. esc_html__('Claimed', 'listingpro').'</span>';

        }elseif($claimed_section == 'not_claimed') {
            $claim = '';

		}
		
		$partisan = '';
		if ( 'yes' === $partisan_show ) {
			$partisan = '<span class="partisan">D</span>';
		}

		$claim = $claim . $partisan;

        global $post;

        $resurva_url = get_post_meta($post->ID, 'resurva_url', true);
        $menuOption = false;
        $menuTitle = '';
        $menuImg = '';
        $menuMeta = get_post_meta($post->ID, 'menu_listing', true);
        if(!empty($menuMeta)){
            $menuTitle = $menuMeta['menu-title'];
            $menuImg = $menuMeta['menu-img'];
            $menuOption = true;
        }

        $timekit = false;
        $timekit_booking = get_post_meta($post->ID, 'timekit_bookings', true);

        if(!empty($timekit_booking)){
            $timekit = true;
        }



        /* get user meta */
        $user_id=$post->post_author;
        $user_facebook = '';
        $user_linkedin = '';
        $user_clinkedin = '';
        $user_facebook = '';
        $user_instagram = '';
        $user_twitter = '';
        $user_pinterest = '';
        $user_cpinterest = '';

        $user_facebook = get_the_author_meta('facebook', $user_id);
        $user_google = get_the_author_meta('google', $user_id);
        $user_linkedin = get_the_author_meta('linkedin', $user_id);
        $user_instagram = get_the_author_meta('instagram', $user_id);
        $user_twitter = get_the_author_meta('twitter', $user_id);
        $user_pinterest = get_the_author_meta('pinterest', $user_id);

        $gAddress = listing_get_metabox('gAddress');
        lp_get_lat_long_from_address($gAddress, get_the_ID());
        /* get user meta */
        $lp_detail_page_additional_detail_position = $listingpro_options['lp_detail_page_additional_styles'];

        $showReport = true;
        if( isset($listingpro_options['lp_detail_page_report_button']) ){
            if( $listingpro_options['lp_detail_page_report_button']=='off' ){
                $showReport = false;
            }
        }

        ?>
        <!--==================================Section Open=================================-->
        <section class="aliceblue listing-second-view">
            <!--=======Galerry=====-->
            <?php
            //gallery
            include ( locate_template( 'templates/single-list/listing-details-style1/content/gallery.php' ) );
            //title bar
            include ( locate_template( 'templates/single-list/listing-details-style1/content/title-bar.php' ) );
            ?>
            <div class="content-white-area">
                <div class="container single-inner-container single_listing" >
                    <?php if( isset($listingpro_options['lp-gads-editor']) ){
                        $listingGAdsense = $listingpro_options['lp-gads-editor'];
                        if( !empty($listingGAdsense) ){ ?>

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <?php echo $listingGAdsense; ?>
                                </div>
                            </div>

                        <?php }
                    } ?>
                    <div class="row">
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <?php
                            $pagelayoutOption = $listingpro_options['lp-detail-page-layout-content']['general'];
                            if ($pagelayoutOption):
                                foreach ($pagelayoutOption as $key=>$value) {
                                    switch($key) {

                                        case 'lp_video_section': get_template_part( 'templates/single-list/listing-details-style1/content/video' );
                                            break;

                                        case 'lp_content_section': get_template_part( 'templates/single-list/listing-details-style1/content/content' );
                                            break;

                                        case 'lp_features_section': get_template_part( 'templates/single-list/listing-details-style1/content/features' );
                                            break;

                                        case 'lp_additional_section': get_template_part( 'templates/single-list/listing-details-style1/content/additional' );
                                            break;

                                        case 'lp_faqs_section': get_template_part( 'templates/single-list/listing-details-style1/content/faqs' );
                                            break;

                                        case 'lp_reviews_section': get_template_part( 'templates/single-list/listing-details-style1/content/reviews' );
                                            break;

                                        case 'lp_announcements_section' :
                                            get_template_part( 'templates/single-list/listing-details-style1/content/list-announcements' );
                                            break;
                                        case 'lp_menu_section': get_template_part( 'templates/single-list/listing-details-style1/content/list-menu' );
                                            break;

                                        case 'lp_reviewform_section': get_template_part( 'templates/single-list/listing-details-style1/content/reviewform' );
                                            break;

                                        case 'lp_offers_section':
                                            $post_author_id = get_post_field( 'post_author', get_the_ID() );
                                            $discount_displayin =   get_user_meta( $post_author_id, 'discount_display_area', true );

                                            if( $discount_displayin == 'content' || empty( $discount_displayin ) )
                                            {
                                                get_template_part( 'templates/single-list/listing-details-style1/content/list-offer-deals-discount' );
                                            }
                                            break;
                                    }
                                }

                            endif;
                            ?>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <?php
                      		$business_logo  =   '';
                      		$business_logo = listing_get_metabox_by_ID('business_logo',get_the_ID());

                          $business_logo_url = (empty( $business_logo ))? FALSE : $business_logo;

                      		if ( $business_logo_url ) { ?>
                            <div class="widget-box logo-widget-box">
                              <div class="lp-listing-logo">
                                 <img src="<?php echo $business_logo_url; ?>" alt="Listing Logo">
                              </div>
                            </div>
                          <?php }; ?>
                            <?php
                            $pagesidebrOption = $listingpro_options['lp-detail-page-layout-rsidebar']['sidebar'];
                            if ($pagesidebrOption):
                                foreach ($pagesidebrOption as $key=>$value) {

                                    switch($key) {

                                        case 'lp_timing_section': get_template_part( 'templates/single-list/listing-details-style1/sidebar/timings' );
                                            break;

                                        case 'lp_mapsocial_section': get_template_part( 'templates/single-list/listing-details-style1/sidebar/map-contacts' );
                                            break;

                                        case 'lp_leadform_section': get_template_part( 'templates/single-list/listing-details-style1/sidebar/leadform' );
                                            break;

                                        case 'lp_quicks_section': get_template_part( 'templates/single-list/listing-details-style1/sidebar/quicks' );
                                            break;

                                        case 'lp_additional_section': get_template_part( 'templates/single-list/listing-details-style1/sidebar/additional' );
                                            break;

                                        case 'lp_sidebarelemnts_section': get_template_part( 'templates/single-list/listing-details-style1/sidebar/def-sidebar' );
                                            break;
                                        case 'lp_event_section': get_template_part( 'templates/single-list/event' );
                                            break;

                                        case 'lp_offers_section':
                                            $post_author_id = get_post_field( 'post_author', get_the_ID() );
                                            $discount_displayin =   get_user_meta( $post_author_id, 'discount_display_area', true );
                                            if( $discount_displayin == 'sidebar' )
                                            {
                                                get_template_part( 'templates/single-list/listing-details-style3/content/list-offer-deals-discount' );
                                            }
                                            break;
                                        case 'lp_donate_section' :
                                            //Donate Button
                                            $listcats = get_the_terms( get_the_ID(), 'listing-category' );
                                            $isFreelancer = false;
											foreach($listcats as $cat) {
												if ($cat->name == 'Firms and Freelancers') {
													$isFreelancer = true;
												}else if($cat->parent == 39){
													$isFreelancer = true;
                                                }
                                                else{
                                                    $isFreelancer = false;
                                                    break;
                                                }
											}
											$donate = listing_get_metabox('donate');
											if($donate != "" && !$isFreelancer){
                                                echo '
                                                    <div class="clear"></div>
                                                    <div class= "single-donate">
                                                        <div class="donate-wrap">
                                                            <a href="'.esc_url($donate).'" target="_blank" role="button">
                                                                <div class="donate-button">Donate</div>
                                                            </a>
                                                        </div>
                                                    </div>';
											}

                                            break;

                                    }
                                }
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--==================================Section Close=================================-->
        <?php
        global $post;
        echo listingpro_post_confirmation($post);
    } // end while
}
