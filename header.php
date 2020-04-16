<!DOCTYPE html>
<!--[if IE 7 ]>    <html class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8"> <![endif]-->
<?php
  $mobile_view = lp_theme_option('single_listing_mobile_view');
	if(wp_is_mobile() && $mobile_view == 'app_view') {
		get_template_part( 'templates/headers/header-app-view' );
	}
	else {
?>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
	   <!-- Mobile Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE" />
		<?php
      listingpro_favicon();
			$listing_detail_slider_style = lp_theme_option('lp_detail_slider_styles');
      wp_head();
		?>
  </head>
	<body <?php body_class(); lp_header_data_atts('body'); ?>>
	<?php if(is_user_logged_in() && FALSE){ ?>
		<aside class="left-sidebar-menu closed">
			<div id="hidden-message-count"><?php echo bp_total_unread_messages_count(get_current_user_id()); ?></div>
			<div class="panel-head">
				<a class="toggle-panel"><i class="fa fa-bars"></i></a>
			</div>
			<div class="side-panel-inner">
				<div class="side-panel-menu-container">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'gain-left-side-menu',
					'container_class' => 'left-side-menu' ) );
				?>
				</div>
			</div>
		</aside>
	<?php }
		$listing_styledata = '';
		$topBannerView = lp_theme_option('top_banner_styles');
		$lp_detail_page_styles = lp_theme_option('lp_detail_page_styles');
		$search_alignment = lp_theme_option('search_alignment');

		// New
		$addclass_banner_upper_cat = '';
    $differentcats_views = lp_theme_option('categories_different_styles');
    $bannercat_category_inside = lp_theme_option('categories_different_styles_category_inside');

		$alignClass = '';
		switch($topBannerView){
			case 'map_view':
			switch($search_alignment){
				case 'align_top':
		$alignClass = 'lp-align-top';
					break;
				case 'align_middle':
		$alignClass = 'lp-align-underBanner';
					break;
				case 'align_bottom':
		$alignClass = 'lp-align-bottom';
			break;
			}
			break;
		}

		//-------------Start New view style banner add class------------------//
		$class_cat_banner_view = '';
		if($topBannerView=="banner_view_search_bottom" && $differentcats_views == 'category_view2'){
				$class_cat_banner_view = 'banner-category-mix-view2';
		}

		if($topBannerView == 'banner_view_category_upper'){
		// banner_view_category_upper
		$addclass_banner_upper_cat = '';
		if($topBannerView =='banner_view_category_upper' && $bannercat_category_inside == 'category_view'){
			$addclass_banner_upper_cat = 'banner-view-cat-tranparent-category';
		}elseif($topBannerView =='banner_view_category_upper' && $bannercat_category_inside == 'category_view1'){
			$addclass_banner_upper_cat = 'banner-view-cat-tranparent-category';
		}elseif($topBannerView =='banner_view_category_upper' && $bannercat_category_inside == 'category_view2'){
			$addclass_banner_upper_cat = 'banner-view-cat-tranparent-category';
		}elseif($topBannerView =='banner_view_category_upper' && $bannercat_category_inside == 'category_view3'){
			$addclass_banner_upper_cat = 'banner-view-cat-tranparent-category';
		}
		}

		$newbannerstyleClass = '';
		if($topBannerView == 'banner_view_search_bottom'){
			$newbannerstyleClass = 'new-banner-view-category';
		}elseif($topBannerView == 'banner_view_search_inside'){
			$newbannerstyleClass = 'new-banner-view-category';
		}elseif($topBannerView == 'banner_view'){
			$newbannerstyleClass = 'banner-view-classic';
		}
		$maintxtstyleClass = '';
    if(empty($main_txt)){
        $maintxtstyleClass = 'new-banner-view-category-st';
    }
		//-------------End New view style banner add class------------------//
	?>
    <div id="page" <?php lp_header_data_atts('page'); ?> class="clearfix <?php echo $lp_detail_page_styles; ?>">

		<!--===========================header-views========================-->
		<?php get_template_part( 'templates/headers/header-views' ); ?>
		<?php
			if (is_front_page() && $topBannerView != 'banner_view2' ) { ?>
			<div class="home-categories-area <?php echo esc_attr($alignClass); ?>
				<?php echo esc_attr($newbannerstyleClass); ?>
				<?php echo esc_attr($maintxtstyleClass); ?>
				<?php echo esc_attr($class_cat_banner_view); ?>
				<?php echo esc_attr($addclass_banner_upper_cat);?>">
				<?php //echo listingpro_banner_categories(); ?>
        <div class="site-features">
          <a href="https://careercenter.democraticgain.org/"><div class="feature-block jobs"><span>Jobs</span></div></a>
          <a href="<?php echo site_url(); ?>/?select=&lp_s_tag=&lp_s_cat=&s=home&post_type=listing"><div class="feature-block directories"><span>Directories</span></div></a>
          <a href="<?php echo site_url(); ?>/community/news-feed/"><div class="feature-block networking"><span>Networking</span></div></a>
        </div>
			</div>
		<?php } ?>
  <?php } ?>
