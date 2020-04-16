<?php
/* ============== Listingpro compaigns ============ */
function listingpro_get_campaigns_listing( $campaign_type, $IDSonly, $taxQuery=array(), $searchQuery=array(),$priceQuery=array(),$s=null, $noOfListings = null, $posts_in = null ){
  $Clistingid =   '';
  if (is_singular( 'listing' )){
    global $post;
    $Clistingid = $post->ID;
  }

  global $listingpro_options;
  $listing_mobile_view = $listingpro_options['single_listing_mobile_view'];

  $adsType = array(
    'lp_random_ads',
    'lp_detail_page_ads',
    'lp_top_in_search_page_ads'
  );

  global $listingpro_options;
  $listing_style = '';
  $listing_style = $listingpro_options['listing_style'];
  $postNumber = '';
  if($listing_style == '3' && !is_front_page()){
    if(empty($noOfListings)){
      $postNumber = 2;
    }
    else{
      $postNumber = $noOfListings;
    }

  }elseif($listing_style == '4' && !is_front_page()){
    if(empty($noOfListings)){
      $postNumber = 2;
    }
    else{
      $postNumber = $noOfListings;
    }

  }else{
    if(empty($noOfListings)){
      $postNumber = 3;
    }
    else{
      $postNumber = $noOfListings;
    }
  }


  if( !empty($campaign_type) ){
    if( in_array($campaign_type, $adsType, true) ){

      $TxQuery = array();
      if( !empty( $taxQuery ) && is_array($taxQuery)){
        $TxQuery = $taxQuery;
      }elseif(!empty($searchQuery) && is_array($searchQuery)){
        $TxQuery = $searchQuery;
      }
      $args = array(
        'orderby' => 'rand',
        'post_type' => 'listing',
        'post_status' => 'publish',
        'posts_per_page' => $postNumber,
        'post__not_in'	=> array($Clistingid),
        'tax_query' => $TxQuery,
        'meta_query' => array(
          'relation'=>'AND',
          array(
            'key'     => 'campaign_status',
            'value'   => array( 'active' ),
            'compare' => 'IN',
          ),
          array(
            'key'     => $campaign_type,
            'value'   => array( 'active' ),
            'compare' => 'IN',
          ),
          $priceQuery,
        ),
      );
      if(!empty($s)){
        $args = array(
          'orderby' => 'rand',
          'post_type' => 'listing',
          'post_status' => 'publish',
          's' => $s,
          'posts_per_page' => $postNumber,
          'tax_query' => $TxQuery,
          'meta_query' => array(
            'relation'=>'AND',
            array(
              'key'     => 'campaign_status',
              'value'   => array( 'active' ),
              'compare' => 'IN',
            ),
            array(
              'key'     => $campaign_type,
              'value'   => array( 'active' ),
              'compare' => 'IN',
            ),
            $priceQuery,
          ),
        );
      }

      if(!empty($posts_in)){
        $args['post__in'] = $posts_in;
      }

      $idsArray = array();
      $the_query = new WP_Query( $args );
      if ( $the_query->have_posts() ) {
        while ( $the_query->have_posts() ) {
          $the_query->the_post();
          if( $IDSonly==TRUE ){
            $idsArray[] =  get_the_ID();

          }
          else{
            if(is_singular('listing') ){
              if( $listing_mobile_view == 'app_view' && wp_is_mobile() ) {
                echo  '<div class="row app-view-ads lp-row-app">';
                get_template_part('mobile/listing-loop-app-view');
                echo '</div>';
              }else{
                get_template_part( 'templates/details-page-ads' );
              }
            }
          elseif( ( is_page()  || is_home() || is_singular('post') ) &&  (is_active_sidebar( 'default-sidebar' ) || is_active_sidebar('listing_archive_sidebar') )  ){
              get_template_part( 'templates/details-page-ads' );
            }
            elseif(is_singular( 'post' )){
              get_template_part( 'templates/details-page-ads' );
            }
            else{
              $listing_mobile_view    =   $listingpro_options['single_listing_mobile_view'];
              if( $listing_mobile_view == 'app_view' && wp_is_mobile() ){
                  get_template_part( 'mobile/listing-loop-app-view' );
              }else
              {
                  if( isset($GLOBALS['sidebar_add_loop']) && $GLOBALS['sidebar_add_loop'] == 'yes' )
                 {
                     get_template_part( 'templates/details-page-ads' );
                 }
                 else
                 {
                  if (!empty($posts_in)) {
                    set_query_var( 'is_ad', true );
                  }
                  get_template_part( 'listing-loop' );
                 }
              }
            }

          }

          wp_reset_postdata();
        }
        if( $IDSonly==TRUE ){
          if(!empty($idsArray)){
            return $idsArray;
          }
        }
      }
    }
  }
}
