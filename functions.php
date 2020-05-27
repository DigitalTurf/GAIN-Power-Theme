<?php
// Listing New/Edit shortcode overrides
include 'shortcodes/edit.php';
include 'shortcodes/submit.php';
include 'shortcodes/blog-grid.php';
include 'shortcodes/plans.php';

// Listing function override
include 'include/list-confirmation.php';
include 'include/reviews/last-review.php';
include 'include/widgets/recent_posts_widget.php';
include 'include/search-filter.php';
include 'include/campaign-listings.php';

/**
 * Public scripts and stylesheets
 */
function gain_power_enqueue_scripts() {
	/* Font Awesome 5 - Override parent theme */
	wp_enqueue_style('Font-awesome', get_stylesheet_directory_uri() . '/assets/lib/font-awesome-5/css/all.css');

	wp_enqueue_style( 'listingpro-parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'Main', get_stylesheet_directory_uri() . '/assets/css/main.css');
	wp_enqueue_style('version2-styles', get_stylesheet_directory_uri() . '/assets/css/main-new.css');
	wp_enqueue_style( 'listingpro-edit-sub-style', get_stylesheet_directory_uri() . '/assets/css/gp-listing-edit-submit.css' );
	wp_enqueue_style( 'featured-jobs-style', get_stylesheet_directory_uri() . '/assets/css/featured-jobs-style.css' );
	wp_enqueue_style( 'pricing-plans-style', get_stylesheet_directory_uri() . '/assets/css/pricing-plans.css' );
	wp_enqueue_style( 'header-inbox-notifications-style', get_stylesheet_directory_uri() . '/assets/css/header-inbox-notifications.css' );
	wp_enqueue_style( 'left-side-menu-style', get_stylesheet_directory_uri() . '/assets/css/left-side-menu.css' );
	wp_enqueue_style( 'listing-company-social-style', get_stylesheet_directory_uri() . '/assets/css/listing-company-social.css' );
	wp_enqueue_style( 'category-description-style', get_stylesheet_directory_uri() . '/assets/css/category-description.css' );
	wp_enqueue_style( 'modal-login-style', get_stylesheet_directory_uri() . '/assets/css/modal-login.css' );
	wp_enqueue_style( 'directory-inbox-style', get_stylesheet_directory_uri() . '/assets/css/directory-inbox.css' );
	wp_enqueue_style( 'donate-button-style', get_stylesheet_directory_uri() . '/assets/css/donate-button.css' );
	wp_enqueue_style( 'listing-fields-style', get_stylesheet_directory_uri() . '/assets/css/listing-fields.css' );
	wp_enqueue_style( 'url-preview-style', get_stylesheet_directory_uri() . '/assets/css/url-preview.css' );
	if(is_page( 'submit-listing' ) || is_page( 'edit-listing' )) {
		wp_enqueue_style( 'dropzone-style', get_stylesheet_directory_uri() . '/assets/css/dropzone.css' );
		wp_enqueue_style( 'cropper-style', get_stylesheet_directory_uri() . '/assets/css/cropper.min.css' );
		wp_enqueue_script( 'dropzone-js', get_stylesheet_directory_uri() . '/assets/js/dropzone.js', array( 'jquery' ), null, true);
		wp_dequeue_script('listingpro-submit-listing');
		wp_enqueue_script( 'submit-listing-js', get_stylesheet_directory_uri() . '/assets/js/submit-listing.js', array( 'jquery' ), null, true);
		wp_enqueue_script( 'cropper-js', get_stylesheet_directory_uri() . '/assets/js/cropper.min.js', array( 'jquery' ), null, true);
		wp_enqueue_script( 'custom-dropzone-js', get_stylesheet_directory_uri() . '/assets/js/custom-dropzone.js', array( 'jquery' ), null, true);
	}
	if(is_page( 'register' )) {
		wp_enqueue_style( 'register-style', get_stylesheet_directory_uri() . '/assets/css/register.css' );
	}
	if(is_page( 'payment-checkout' )) {
		wp_enqueue_style( 'checkout-style', get_stylesheet_directory_uri() . '/assets/css/checkout.css' );
	}
	wp_enqueue_script( 'register-js', get_stylesheet_directory_uri() . '/assets/js/register.js', array( 'jquery' ), null, true);
	wp_enqueue_script( 'login-validation-js', get_stylesheet_directory_uri() . '/assets/js/login-validation.js', array( 'jquery' ), null, true );
	//wp_enqueue_script( 'left-side-menu-js', get_stylesheet_directory_uri() . '/assets/js/left-menu.js', array( 'jquery' ), null, true);
	wp_enqueue_script( 'listing_edit_submit_js', get_stylesheet_directory_uri() . '/assets/js/edit-submit.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'global_js', get_stylesheet_directory_uri() . '/assets/js/global.js', array( 'jquery' ), null, true );
	/* Nice Select Plugin */
	wp_enqueue_style( 'nice_select_css', get_stylesheet_directory_uri() . '/assets/plugins/nice-select/nice-select.css' );
	wp_enqueue_script( 'nice_select_js', get_stylesheet_directory_uri() . '/assets/plugins/nice-select/jquery.nice-select.min.js', array( 'jquery' ), null, true );

	/* Responsive Stylesheet */
	wp_enqueue_style('Responsive', get_stylesheet_directory_uri() . '/assets/css/responsive.css');

	/* SCSS General Stylesheet */
	wp_enqueue_style( 'general_custom', get_stylesheet_directory_uri() . '/assets/css/scss/general.css', array('Responsive','bootstrap') );

	/* Overwrite Pricing Plan JS */
	global $listingpro_options;
	wp_enqueue_script( 'ajax-term-script', get_stylesheet_directory_uri() . '/assets/js/child-term.js', array( 'jquery' ), null, true );
	wp_localize_script( 'ajax-term-script', 'ajax_term_object', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
	));

	/* Dequeue unused parent theme styles and scripts */
	wp_dequeue_style( 'icon8' );
  wp_deregister_style( 'icon8' );
	wp_deregister_script( 'wc_accommodation_bookings_front_js' );


	/* Pass localized data  */
	$data = array(
		'site_url' => __( get_site_url() )
	);
	wp_localize_script( 'global_js', 'siteData', $data );
}
add_action( 'wp_enqueue_scripts', 'gain_power_enqueue_scripts' );

/**
 * Admin scripts and stylesheets
 */
function gain_power_admin_enqueue_scripts() {
	wp_enqueue_style( 'gp-admin-css', get_stylesheet_directory_uri(). '/assets/css/gp-admin.css', array(), false, 'all');
}
add_action( 'admin_enqueue_scripts', 'gain_power_admin_enqueue_scripts' );

/**
 * Register meta boxs for external link.
 */
function partisan_verified_meta_box() {
    $types = ['listing'];
    foreach ( $types as $type ) {
        add_meta_box(
            'partisan_verified',
            'Partisan Verified?',
            'partisan_verified_callback',
            $type,
            'normal',
            'high'
        );
    }
}
add_action( 'add_meta_boxes', 'partisan_verified_meta_box' );

/**
 * Meta box display callbacks.
 */
function partisan_verified_callback( $post ) {
	$value = get_post_meta($post->ID, '_partisan_verified_meta_key', true);
	$checked = '';
	if ( 'yes' === $value ) {
		$checked = ' checked="checked"';
	}
?>
<label class="toggle-switch" for="partisan-verified">
    <input name="partisan-verified" id="partisan-verified" type="checkbox" value="yes"<?php echo $checked; ?>>
    <span class="toggle-slider round"></span>
</label><br>
<small>Toggle this switch to show/hide the partisan verification icon on this listing.</small>
<?php
}

/**
 * Save meta box content.
 */
function partisan_verified_save_callback( $post_id ) {
    if (isset($_POST['partisan-verified'])) {
        update_post_meta(
            $post_id,
            '_partisan_verified_meta_key',
            $_POST['partisan-verified']
        );
    } else {
		delete_post_meta( $post_id, '_partisan_verified_meta_key' );
	}
}
add_action( 'save_post', 'partisan_verified_save_callback' );

/**
 * Extend search function to include port title
 */
function title_search_filter($where, $wp_query) {
    global $wpdb;
    if ( $post_title_like = $wp_query->get( 'post_title_like' ) ) {
        $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql( $wpdb->esc_like( $post_title_like ) ) . '%\'';
    }
    return $where;
}
add_filter( 'posts_where', 'title_search_filter', 10, 2 );



// Map BuddyBoss Plugin Profile Updates to User Meta for Profile Compatibility with ListingPro Theme
function updateSubscribe( $user_id, $posted_field_ids, $errors, $old_values, $new_values )
{
    if ( empty( $errors ) )
    {
        //map First Name
        $first_name = $new_values[1]['value'];
        update_user_meta( $user_id, 'first_name', $first_name );

        //map Last Name
        $last_name = $new_values[2]['value'];
        update_user_meta( $user_id, 'last_name', $last_name );

        //map email
        $email = $new_values[31]['value'];
        update_user_meta( $user_id, 'email', $email );

        //map phone
        $phone_html_content = $new_values[30]['value'];
        $phone_match = '';
        preg_match('/rel="nofollow">(.*?)<\/a>/s', $phone_html_content, $phone_match);
        $phone = $phone_match[1];
        update_user_meta( $user_id, 'phone', $phone );

        //map facebook
        $facebook = $new_values[22]['value'][0];
        update_user_meta( $user_id, 'facebook', $facebook );

        //map twitter
        $twitter = $new_values[22]['value'][2];
        update_user_meta( $user_id, 'twitter', $twitter );

        //map linkedin
        $linkedin = $new_values[22]['value'][1];
        update_user_meta( $user_id, 'linkedin', $linkedin );

        //map instagram
        $instagram = $new_values[22]['value'][3];
        update_user_meta( $user_id, 'instagram', $instagram );
    }

}
add_action('xprofile_updated_profile', 'updateSubscribe', 1, 5);

//Redirect away from ListingPro Profile page to BuddyBoss Profile Page
if (isset($_GET['dashboard']) && $_GET['dashboard'] == 'update-profile') {
	$member_name = wp_get_current_user()->user_login;
	$buddy_boss_profile_url = '/community/members/' . $member_name . '/profile/edit/group/1/';
	wp_redirect($buddy_boss_profile_url, '307');
}

/**
 * Register side menu
 */
function gain_power_left_side_menu() {
    register_nav_menus(
        array(
            'gain-left-side-menu' => __( 'Left Side Menu' )
        )
    );
}
add_action( 'init', 'gain_power_left_side_menu' );


/**
 * Update Added Listing Post Meta for New Post so that Verify Listing = Claimed
 */
function correct_verify_listing($meta_id, $post_id, $meta_key, $meta_value) {
    if($meta_key = 'lp_listingpro_options') {
        $meta = get_post_meta( $post_id, 'lp_listingpro_options', true);
        if(($meta) and ($meta['claimed_section'] == 'not_claimed') and (array_key_last($meta) == 'claimed_section') ) {
            $meta['claimed_section'] = 'claimed';
            update_post_meta($post_id, 'lp_listingpro_options', $meta);
        }
    }
}
add_action( 'updated_post_meta', 'correct_verify_listing', 10, 4 );

/**
 * Add Favicon
 */
function gain_power_add_favicon(){
	?>
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_stylesheet_directory_uri();?>/assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_stylesheet_directory_uri();?>/assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_stylesheet_directory_uri();?>/assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?php echo get_stylesheet_directory_uri();?>/assets/favicon/site.webmanifest">
    <link rel="mask-icon" href="<?php echo get_stylesheet_directory_uri();?>/assets/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#b91d47">
    <meta name="theme-color" content="#ffffff">
	<?php }
add_action('wp_head','gain_power_add_favicon');

/**
 * Redirects wp-login.php to custom login page
 */
add_action('init', 'prevent_wp_login');
function prevent_wp_login() {
  if(isset($_GET['dashboard']) && !is_user_logged_in()) {
    var_dump($_GET);
    wp_redirect('/login?redirect_to=/listing-author/?dashboard='.$_GET['dashboard']);
    exit;
  }
  global $pagenow;
  $action = (isset($_GET['action'])) ? $_GET['action'] : NULL;
	if ($pagenow == 'wp-login.php' ) {
		if (!bypass_social($_GET)) {
			// No parameters
			if (empty($_GET)) {
				wp_redirect('/login');
				exit();
			}
			if ($action && in_array($action, ['lostpassword', 'rp', 'resetpass'])) {
				wp_redirect('/login?a='.$action);
        exit();
			}
		}
	}
}

/**
 * After ajax login redirect
 */
function Listingpro_ajax_login_init(){
 		global $listingpro_options;
		$redirect = (isset($_GET['redirect_to']))? $_GET['redirect_to']: '/community/news-feed/';
 		$dashURL = $redirect;

 		wp_register_script('ajax-login-script', get_template_directory_uri() . '/assets/js/login.js', array('jquery') );
 		wp_enqueue_script('ajax-login-script');

 		wp_localize_script( 'ajax-login-script', 'ajax_login_object', array(
 			'ajaxurl' => admin_url( 'admin-ajax.php' ),
 			'redirecturl' => $dashURL ,
 			'loadingmessage' => '<span class="alert alert-info">'.esc_html__('Please wait...','listingpro').'<i class="fa fa-spinner fa-spin"></i></span>',
 		));

 		// Enable the user with no privileges to run ajax_login() in AJAX
 		add_action( 'wp_ajax_nopriv_ajaxlogin', 'ajax_login' );


 		add_action('wp_ajax_ajax_register',        'ajax_register');
 		add_action('wp_ajax_nopriv_ajax_register', 'ajax_register');

 		/* forget password */
 		add_action('wp_ajax_ajax_forget_pass',        'ajax_forget_pass');
 		add_action('wp_ajax_nopriv_ajax_forget_pass', 'ajax_forget_pass');
}

/**
 * After logout redirect
 */
add_action('wp_logout','gp_redirect_after_logout');
function gp_redirect_after_logout(){
	wp_redirect('/login');
	exit();
}

/**
 * Verify if social login attempt
 */
function bypass_social($params) {
	// Array of social parameters
	$social_bypass = ['loginFacebook','loginGoogle','loginSocial'];

	foreach ($params as $key => $val) {
		if (isset($social_bypass[$key])) {
			return TRUE;
		}
	}

	return FALSE;
}

/**
 * Replace member tokens in menus
 */
function menu_token_replace($items) {
	$member_name = wp_get_current_user()->user_login;
  foreach($items as $item) {
		$item->url = (strpos($item->url, '%MEMBER%') !== false ) ? str_replace('%MEMBER%', $member_name, $item->url) : $item->url;
  }
	return $items;
}
add_filter('wp_nav_menu_objects', 'menu_token_replace');

/**
 * Add role body classes
 */
function role_body_class( $classes ) {
	$user = wp_get_current_user();
 	$roles = ( array ) $user->roles;
	foreach ($roles as $role) {
		$classes[] = $role;
	}
	// Remove admin bar margin for non-admins
	if (!is_front_page()) {
		$classes[] = 'not-home-page';
	}

	$bg_header_imgs = ['home-page','tax-listing-category','search-results'];
	$header_class = (!empty(array_intersect($bg_header_imgs,$classes)))? 'has-header-img': 'no-header-img';
	$classes[] = $header_class;

  return $classes;
}
add_filter( 'body_class', 'role_body_class' );


/**
 * Remove admin bar margin for non-admins
 */
function remove_admin_margin() {
	$user = wp_get_current_user();
 	$roles = ( array ) $user->roles;
	if (!in_array('administrator', $roles)) {
	    remove_action('wp_head', '_admin_bar_bump_cb');
	}
}
add_action('get_header', 'remove_admin_margin');

/**
 * Listingpro Sharing
 */
if(!function_exists('listingpro_sharing')){
	function listingpro_sharing() {
		?>
		<a class="reviews-quantity">
			<span class="reviews-stars">
				<i class="fa fa-share-alt"></i>
			</span>
			<?php echo esc_html__('Share', 'listingpro');?>
		</a>
		<div class="md-overlay hide"></div>
		<ul class="social-icons post-socials smenu">
			<li>
				<a href="<?php echo listingpro_social_sharing_buttons('facebook'); ?>" target="_blank">
					<i class="fab fa-facebook-f"></i>
				</a>
			</li>
			<li>
				<a href="<?php echo listingpro_social_sharing_buttons('gplus'); ?>" target="_blank">
					<i class="fab fa-google-plus-g"></i>
				</a>
			</li>
			<li>
				<a href="<?php echo listingpro_social_sharing_buttons('twitter'); ?>" target="_blank">
					<i class="fab fa-twitter"></i>
				</a>
			</li>
			<li>
				<a href="<?php echo listingpro_social_sharing_buttons('linkedin'); ?>" target="_blank">
					<i class="fab fa-linkedin-in"></i>
				</a>
			</li>
			<li>
				<a href="<?php echo listingpro_social_sharing_buttons('pinterest'); ?>" target="_blank">
					<i class="fab fa-pinterest-p"></i>
				</a>
			</li>
			<li>
				<a href="<?php echo listingpro_social_sharing_buttons('reddit'); ?>" target="_blank">
					<i class="fab fa-reddit-alien"></i>
				</a>
			</li>
			<li>
				<a href="<?php echo listingpro_social_sharing_buttons('stumbleupon'); ?>" target="_blank">
					<i class="fab fa-stumbleupon"></i>
				</a>
			</li>
			<li>
				<a href="<?php echo listingpro_social_sharing_buttons('del'); ?>" target="_blank">
					<i class="fab fa-delicious"></i>
				</a>
			</li>
		</ul>
		<?php
	}
}

/**
 * Includes child theme's all-reviews.php and reviews-form.php instead of parent files
 */
require_once (dirname(__FILE__) . "/include/reviews/all-reviews.php");
require_once (dirname(__FILE__) . "/include/reviews/reviews-form.php");
require_once (dirname(__FILE__) . "/include/reviews/review-submit.php");

/**
 * Override parent theme's login-register.php
 */
require_once (dirname(__FILE__) . "/include/login-register.php");

/**
 * Overrides plugin's submit-ajax.php
 */
require_once (dirname(__FILE__) . "/include/submit-ajax.php");

/**
 * Override plugin's metaboxes-plan.php and post-type.php/post-options.php for custom options
 */
add_action( 'init', 'gain_power_plugin_functions', 0 );
function gain_power_plugin_functions(){
	include_once(dirname(__FILE__) . "/include/metaboxes-plans.php"); //Custom metaboxes plans
	include_once(dirname(__FILE__) . "/include/post-type.php"); //Shows custom options on admin page (edit array at /include/post-options.php line 422)
}

/**
 * Override parent theme's lp_filter_pricing_plans to use our vertical-view-1.php instead of plugin
 */
function lp_filter_pricing_plans() {

	$catId = '';
	$planUsage = '';
	$catTaxArray = array();
	$catTax2Array = array();

	if(isset($_POST['planUsage'])){
		$planUsage = stripslashes( $_POST['planUsage']);
	}

	if(isset($_POST['cat_id'])){
		$catId = stripslashes( $_POST['cat_id']);
		if(!empty($catId)){
			$catTaxArray = array(
					'key' => 'lp_selected_cats',
					'value' => $catId,
					'compare' => 'LIKE',
				);
		}
	}


	$durationType = stripslashes( $_POST['duration_type']);
	$relationParm = 'AND';
	if( empty($durationType) && empty($catTaxArray) ){
		$relationParm = 'OR';
	}


	$pricing_style_views = $_POST['currentStyle'];
	$returnData = null;
		/* code goes here */
		$output = null;
		$args = null;
		$args = array(
			'post_type' => 'price_plan',
			'posts_per_page' => -1,
			'post_status' => 'publish',
			'meta_query'=>array(
			'relation' => $relationParm,
				$catTaxArray,
				array(
					'key' => 'plan_duration_type',
					'value' => $durationType,
					'compare' => 'LIKE',
				),
				$catTax2Array,

			),
		);

		$cat_Plan_Query = null;
		$output = null;
		$gridNumber = 0;
		$cat_Plan_Query = new WP_Query($args);
		$count = $cat_Plan_Query->found_posts;
		$GLOBALS['plans_count'] = $count;
		if($cat_Plan_Query->have_posts()){
			while ( $cat_Plan_Query->have_posts() ) {
					$cat_Plan_Query->the_post();
					$showplan = true;
					$planfor = get_post_meta(get_the_ID(), 'plan_usge_for', true);
					if(isset($_POST['cat_id'])){
						if(!empty($_POST['cat_id'])){
							if(!empty($planUsage)){
								if($planUsage!=$planfor){
									$showplan = false;
								}
							}
						}else{
							if(!empty($planfor)){
								if($planUsage!=$planfor){
									$showplan = false;
								}
							}
						}
					}
					if(!empty($showplan)){
						ob_start();
						include( dirname(__FILE__) . '/templates/vertical-view-1.php');
						$output .= ob_get_contents();
						ob_end_clean();
						ob_flush();
					}

			}//END WHILE
			wp_reset_postdata();
			if(!empty($output)){
				$returnData = array('response'=>'success', 'plans'=>$output);
			}else{
				$returnData = array('response'=>'success', 'plans'=> esc_html__('Sorry! There is no plan associated with the category', 'listingpro'));
			}
		}else{
			$returnData = array('response'=>'success', 'plans'=> esc_html__('Sorry! There is no plan associated with the category', 'listingpro'));
		}

	exit(json_encode($returnData ));
	//wp_send_json_success( $returnData );
}

/**
 * Add donate button to listingpro options
 */
add_filter('redux/options/listingpro_options/field/lp-detail-page-layout-rsidebar/register', 'add_another_field_value_sk');
function add_another_field_value_sk($field){
    $field['options']['sidebar'] = array(
			'lp_timing_section' => 'Timings',
			'lp_mapsocial_section'   => 'Map/Contacts',
			'lp_event_section'   => 'Event',
			'lp_leadform_section'   => 'Leadform',
			'lp_donate_section'		=> 'Donate Button',
			'lp_quicks_section'   => 'Quick Actions',
			'lp_additional_section'   => 'Additional Details',
			'lp_offers_section'   => 'Offers/Discounts/Deals',
			'lp_sidebarelemnts_section'   => 'Detail Page Sidebar Widgets',
	);

    return $field;
}

/**
 * Add option to set public-facing term to replace "listing"
 */
function add_listing_name_redux($section) {
	array_unshift( $section['fields'], array(
		'id'       => 'listing_public_name',
		'type'     => 'text',
		'title'    => __( 'Change name for listings', 'listingpro' ),
		'subtitle' => __( 'Use singular. Example: page', 'listingpro' ),
		'default'  => 'listing'
	) );

	return $section;
}
add_filter('redux/options/listingpro_options/section/listing_setting_general', 'add_listing_name_redux');

/**
 * Override BuddyBoss "listing" term to use the public-facing term we set manually
 */
function gp_bb_listing_name($label) {
	if ( $label === 'cpt-listing' ){
		$label = lp_theme_option( 'listing_public_name' ) . 's';
	}
	return $label;
}
add_filter('bp_search_label_search_type', 'gp_bb_listing_name');

/**
 * Override listing notifications
 */
if(!function_exists('lp_notification_div')){
	function lp_notification_div(){
		 if(is_singular( 'listing' )){
			?>
				<div class="lp-notifaction-area lp-pending-lis-infor lp-notifaction-error" data-error-msg="<?php echo esc_html__('Something went wrong!', 'listingpro'); ?>">
					<div class="lp-notifaction-area-outer">
						<div class="row">
							<div class="col-md-12">
								<div class="lp-notifi-icons"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAYAAACM/rhtAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAE2SURBVFhH7dhBaoQwFMZxoZu5w5ygPc7AlF6gF5gLtbNpwVVn7LKQMG4b3c9ZCp1E3jdEEI1JnnGRP7h5Iv4wKmiRy+U8qkT7Wkn1VpblA43Yqn7abSWb+luqRxpNZ3D6oP+zUO+cSIPT57jqc/1p4I7G0xmUwXEibdxJ/j7T2D1OZDAOcSD7y9ruaexfTGR0HIqBZMOhECQ7DvkgF8OhOcjFccgFmQyHxpDJcWgIuRoc6iFl87kqHOqunFQfBtltQr3QrnVkLWsHxHLT7rTZ95y5cvflXgNy6IHo3ZNCHZMhx55WQh6TIV1eJcmQLji0OHIODi2G9MEhdmQIDrEhY+BQdGRMHIqG5MChYKSNC/puHSkIqQ+qOXGoh5TqQOPpvi7N06x/JQF1SI0TQmxolMvl3CuKG6LJpCW33jxQAAAAAElFTkSuQmCC"></div>
								<div class="lp-notifaction-inner">
									<h4></h4>
									<p></p>
								</div>
							</div>
						</div>

					</div>
				</div>
			<?php
		 }
	}
	add_action('lp_add_at_startof_footer', 'lp_notification_div', 1);
}
/**
 * Redirect /forums/ to /community/forums/
 */
function forums_redirect() {
 if($_SERVER['REQUEST_URI'] == '/forums/') {
	 wp_redirect('/community/forums/');
	 exit();
 }
}
add_action('template_redirect', 'forums_redirect');

/**
 * Add custom admin page for managing banner images
 */
$cpt_args = array(
	'public'          => false,
	'show_ui'         => true,
	'show_in_menu'    => false,
	'capability_type' => 'page',
	'query_var'       => false,
	'supports'        => array(
		'title',
		'revisions',
		'editor'
	),
	'labels'          => array(
		'name'               => 'Banner Images',
		'all_items'          => 'All',
		'add_new'            => 'New',
		'add_new_item'       => 'New',
		'edit_item'          => 'Banner Images',
		'new_item'           => 'New',
		'view_item'          => 'View',
		'search_item'        => 'Search',
		'not_found'          => 'Not found',
		'not_found_in_trash' => 'Not found in Trash',
	),
);
register_post_type( 'banner_images', $cpt_args );
if(!get_page_by_title( 'Banner Images', OBJECT, 'banner_images' )){
	$options_page = array(
		'post_title'     => 'Banner Images',
		'post_type'      => 'banner_images',
		'post_status'    => 'private',
		'ping_status'    => 'closed',
		'comment_status' => 'closed',
	);

	wp_insert_post( $options_page );
}
function banner_images_menu(){
	$options_page = get_page_by_title('Banner Images', OBJECT, 'banner_images');
	add_menu_page(
		'Banner Images',
		'Banner Images',
		'edit_posts',
		'/post.php?post=' . $options_page->ID .'&action=edit',
		'',
		'dashicons-format-gallery'
	);
}
add_action('admin_menu', 'banner_images_menu');

/**
 * To get Banner Images post ID from other pages
 */
function get_banner_images_id(){
	return get_page_by_title( 'Banner Images', OBJECT, 'banner_images' )->ID;
}

/**
 * Add classes to menu li items
 */
function add_additional_class_on_li ($classes, $item, $args) {
	if (isset($args->add_li_class)) {
		$classes[] = $args->add_li_class;
	}
	return $classes;
}
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);

/**
 * Get BuddyBoss Profile link by ID
 */
function get_profile_url_by_id ($id = FALSE) {
	$id = (!$id) ? get_current_user_id() : $id;
	$author_obj = get_user_by('id', $id);
	$profile_url = get_site_url() . '/community/members/' . $author_obj->user_login. '/';
	return $profile_url;
}

/**
 * Add Report button to profiles
 */
function gp_profile_report_btn() {
	$member_id = bp_displayed_user_id();
	$user_id = get_current_user_id();

	if ( !is_user_logged_in() || bp_is_my_profile() ) {
			return;
	}
	$link = bp_core_get_user_domain( $member_id );
	$el = ( bp_get_theme_package_id() == 'nouveau' )? 'li' : 'div';
	echo '<'.$el.' class="generic-button bptk-report-profile bptk-report-button bptk-report-member-button" data-link="' . $link . '" data-reported="' . $member_id . '"><a href="" class="activity-button">' . __( 'Report', 'bp-toolkit' ) . '</a></'.$el.'>' ;
}

/**
 * Add Block button to profiles
 */
function gp_block_link($list_id,$user_id) {
	return apply_filters(
			'bptk_block_link',
			add_query_arg( array(
			'action' => 'block',
			'list'   => $list_id,
			'num'    => $user_id,
			'token'  => wp_create_nonce( 'block-' . $list_id ),
	) ),
			$list_id,
			$user_id
	);
}
function gp_profile_report_block_btns() {
	$member_id = bp_displayed_user_id();
	$user_id = get_current_user_id();

	if ( !is_user_logged_in() || bp_is_my_profile() ) {
			return;
	}
	$link = bp_core_get_user_domain( $member_id );
	$el = ( bp_get_theme_package_id() == 'nouveau' )? 'li' : 'div';

	echo '<'.$el.' class="generic-button bptk-report-profile bptk-report-button bptk-report-member-button" data-link="' . $link . '" data-reported="' . $member_id . '"><a href="" class="activity-button">' . __( 'Report', 'bp-toolkit' ) . '</a></'.$el.'>' ;

	if (class_exists('BPTK_Block')) {
		echo '<'.$el.' class="generic-button bptk-block-profile"><a href="' . gp_block_link( $user_id, $member_id ) . '" class="activity-button">' . __( 'Block', 'bp-toolkit' ) . '</a></'.$el.'>' ;
	}
}
add_action( 'bp_member_header_actions', 'gp_profile_report_block_btns' );

/* Change plan button */
function listingpro_change_plan_button($post, $listing_id=''){
	global $listingpro_options;
	$buttonEnabled = $listingpro_options['lp_listing_change_plan_option'];
	if ($buttonEnabled=="enable") {
		$currency = listingpro_currency_sign();
		$buttonCode = '';
		$havePlan = "no";
		$planPrice = '';
		$listing_status = '';
		if(empty($listing_id)){
			$listing_id = $post->ID;
			$listing_status =  get_post_status( $listing_id );
			$plan_id = listing_get_metabox_by_ID('Plan_id', $listing_id);
			$planTitle = '';
			if(!empty($plan_id)){
				$planTitle = get_the_title($plan_id);
				$planPrice = get_post_meta($plan_id, 'plan_price', true);
				if(!empty($planPrice)){
					$planPrice = $currency.$planPrice;
				}
				else{
					$planPrice = esc_html__('Free', 'listingpro');
				}
				$planPrice .='/'. get_post_meta($plan_id, 'plan_package_type', true);
				$havePlan = "yes";
			}
			else{
				$planTitle = esc_html__('No Plan Assigned Yet', 'listingpro');
			}
			$buttonCode = '<a href="#" class="lp-review-btn btn-second-hover text-center lp-change-plan-btn" data-toggle="modal" data-target="#modal-packages" data-listingstatus="'.$listing_status.'" data-planprice="'.$planPrice.'"  data-haveplan="'.$havePlan.'" data-plantitle = "'.$planTitle.'" data-listingid="'.$listing_id.'" title="change"><i class="fa fa-paper-plane" aria-hidden="true"></i>'.esc_html__('Change Plan', 'listingpro').'</a>';
		}
		else{
			$listing_id = $post->ID;
			$listing_status =  get_post_status( $listing_id );
			$plan_id = listing_get_metabox_by_ID('Plan_id', $listing_id);
			$planTitle = '';
			if(!empty($plan_id)){
				$planPrice = get_post_meta($plan_id, 'plan_price', true);
				if(!empty($planPrice)){
					$planPrice = $currency.$planPrice;
				}
				else{
					$planPrice = esc_html__('Free', 'listingpro');
				}
				$planTitle = get_the_title($plan_id);
				$planpkgtype = '';
				$plantype = get_post_meta($plan_id, 'plan_package_type', true);
				if($plantype=="Package"){
					$planpkgtype = esc_html__('Package', 'listingpro');
				}
				else{
					$planpkgtype = esc_html__('Pay Per Listing', 'listingpro');
				}
				$planPrice .='/'. $planpkgtype;
				$havePlan = "yes";
			}
			else{
				$planTitle = esc_html__('No Plan Assigned Yet', 'listingpro');
			}
			$buttonCode = '<a href="#" class="lp-review-btn btn-second-hover text-center lp-change-plan-btn" data-toggle="modal" data-target="#modal-packages" data-listingstatus="'.$listing_status.'"  data-planprice="'.$planPrice.'"  data-haveplan="'.$havePlan.'" data-plantitle = "'.$planTitle.'" data-listingid="'.$listing_id.'" title="change"><i class="fa fa-paper-plane" aria-hidden="true"></i>'.esc_html__("Change Plan", "listingpro").'</a>';
		}

		$paidmode = $listingpro_options['enable_paid_submission'];
		return (!empty($paidmode) && $paidmode=="yes") ? $buttonCode : '';
	}
}

/**
 * Override BuddyBoss url preview function
 */
add_action( 'after_setup_theme', 'gain_power_load_url_preview');
function gain_power_load_url_preview(){
	remove_action( 'wp_ajax_bp_activity_parse_url', 'bp_activity_action_parse_url' );
	add_action( 'wp_ajax_bp_activity_parse_url', 'gain_power_url_preview' );
}
include_once (dirname(__FILE__) . '/include/url-preview.php'); // Includes gain_power_url_preview function

/**
 * Override url previews for display on posts
 */
remove_filter( 'bp_get_activity_content_body', 'bp_activity_link_preview', 20, 2 );
add_filter('bp_get_activity_content_body', 'gain_power_activity_link_preview', 20, 2 );
function gain_power_activity_link_preview($content, $activity){
	$activity_id = $activity->id;

	$preview_data = bp_activity_get_meta( $activity_id, '_link_preview_data', true );

	if ( empty( $preview_data['url'] ) ) {
		return $content;
	}

	$preview_data = bp_parse_args(
		$preview_data,
		array(
			'title'       => '',
			'description' => '',
		)
	);

	$description = $preview_data['description'];
	$read_more   = ' &hellip; <a class="activity-link-preview-more" href="' . esc_url( $preview_data['url'] ) . '" target="_blank" rel="nofollow">' . __( 'Continue reading', 'buddyboss' ) . '</a>';
	$description = wp_trim_words( $description, 40, $read_more );

	$content = make_clickable( $content );

	$domain = str_ireplace('www.', '', parse_url(esc_url( $preview_data['url']), PHP_URL_HOST));

	$content .= '<div class="activity-link-preview-container">';
	if ( ! empty( $preview_data['attachment_id'] ) ) {
		$image_url = wp_get_attachment_image_url( $preview_data['attachment_id'], 'full' );
		$content  .= '<div class="activity-link-preview-image">';
		$content  .= '<a href="' . esc_url( $preview_data['url'] ) . '" target="_blank"><img src="' . $image_url . '" /></a>';
		$content  .= '</div>';
	}
	$content .= '<div class="activity-link-preview-excerpt">';
	$content .= '<p class="activity-link-url"><a href="' . esc_url( $preview_data['url'] ) . '" target="_blank" rel="nofollow">' . $domain . '</a></p>';
	$content .= '<p class="activity-link-preview-title"><a href="' . esc_url( $preview_data['url'] ) . '" target="_blank" rel="nofollow">' . addslashes( $preview_data['title'] ) . '</a></p>';
	$content .= '<p class="activity-link-preview-description">' . $description . '</p>';
	$content .= '</div>';

	return $content;
}

// Retrieves the attachment ID from the file URL
function gp_get_image_id($image_url) {
	global $wpdb;
	$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ));
        return $attachment[0];
}

/**
 * Override BuddyBoss media script
 */
add_action( 'bp_nouveau_enqueue_scripts', 'gain_power_media_enqueue_scripts', 50);
function gain_power_media_enqueue_scripts() {
	if(wp_script_is( 'bp-nouveau-media', 'enqueued')){
		wp_enqueue_style('gain-nouveau-media-fix', get_stylesheet_directory_uri() . '/assets/css/media-fix.css');
	}
}

/**
 * Overrides listingpro extra fields function to ensure the Additional Details box does not appear if empty
 */
function listing_all_extra_fields($postid){
	global $listingpro_options;
	$lp_detail_page_styles = $listingpro_options['lp_detail_page_styles'];

	$output = '';
	$count = 0;
	$metaboxes = get_post_meta($postid, 'lp_' . strtolower(THEMENAME) . '_options_fields', true);
	if(!empty($metaboxes)){
		unset($metaboxes['lp_feature']);
		if(!empty($metaboxes)){
			$numberOF = count($metaboxes);
			//Added this if statement
			if($numberOF === 1){
				foreach($metaboxes as $key => $value){
					if(!is_array($value) && $value == ''){
						return;
					}
				}
			}
			$output = null;
			$output .= '<div class="widget-box"><div class="features-listing extra-fields">';		
			$output .= '<div class="post-row-header clearfix margin-bottom-15"><h3>'. esc_html__('Additional Details', 'listingpro').'</h3></div>';		
			$output .= '<ul>';
			
			foreach($metaboxes as $slug=>$value){
				if($count <= 5) {
					$queried_post = get_page_by_path($slug,OBJECT,'form-fields');
					if(!empty($queried_post)){
						$dieldsID = $queried_post->ID;
						if(is_array($value)){
							$value = implode(', ', $value);
						}
						if(!empty($value)){
							if($lp_detail_page_styles == 'lp_detail_page_styles5') {
								$output .= '<li class="lp-fields-for-details5 clearfix"><div class="lp-first-pull-left pull-left"><strong>'.get_the_title($dieldsID).':</strong></div><div class="pull-left"><span>'.$value.'</span></div></li>';
							}else{
							$output .= '<li><strong>'.get_the_title($dieldsID).':</strong><span>'.$value.'</span></li>';
						}
					}

					}
				}
				$count++;
			}
			
			$output .= '</ul>';
			if($numberOF > 5){
				$output .= '<a class="show-all-timings" href="#">'.esc_html__('Show all', 'listingpro').'</a>';
			}
			$output .= '<ul class="hidding-timings">';
			$count = 0;
			foreach($metaboxes as $slug=>$value){
				if($count > 5) {
					$queried_post = get_page_by_path($slug,OBJECT,'form-fields');
					if(!empty($queried_post)){
						$dieldsID = $queried_post->ID;
						if(is_array($value)){
							$value = implode(', ', $value);
						}
						if(!empty($value)){
							if($lp_detail_page_styles == 'lp_detail_page_styles5') {
								$output .= '<li class="lp-fields-for-details5 clearfix"><div class="lp-first-pull-left pull-left"><strong>'.get_the_title($dieldsID).':</strong></div><div class="pull-left"><span>'.$value.'</span></div></li>';
							}else{
							$output .= '<li><strong>'.get_the_title($dieldsID).':</strong><span>'.$value.'</span></li>';
						}
					}
				}
				}
				$count++;
			}
			$output .= '</ul></div></div>';
			// closing
		}
		return $output;
	}
}

/**
 * Override parent theme's single-ajax.js
 */
function Listingpro_single_ajax_init(){
			
			
	wp_register_script('ajax-single-ajax', get_stylesheet_directory_uri() . '/assets/js/single-ajax.js', array('jquery') ); 
	 
	wp_enqueue_script('ajax-single-ajax');
	

	wp_localize_script( 'ajax-single-ajax', 'single_ajax_object', array( 
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
	));
	
}
if(!is_admin()){
	if(!is_singular('listing')){
		add_action('init', 'Listingpro_single_ajax_init');
	}
}

/**
 * Include custom WP Bakery element for listing categories
 */
add_action('init', 'gp_vc_elements');
function gp_vc_elements(){
	include_once(dirname(__FILE__) . "/include/vc-elements.php");
}

/**
 * Add Sponsor metabox to blog posts
 */
function gp_sponsor_metabox() {
	add_meta_box( 'gp_sponsorship', 'Sponsorship', 'gp_sponsorship_content', 'post', 'side', 'high' );
}

/**
 * Content for the gp_sponsorship metabox
 */
function gp_sponsorship_content( $post ) {
	wp_nonce_field( 'gp_save_sponsorship_data', 'gp_sponsorship_metabox_nonce');

	$value = get_post_meta( $post->ID, '_sponsorship_meta_value_key', true );

	echo '<label for="gp_sponsorship_field"></label>Sponsor Name</label>';
	echo '<input type="text" id="gp_sponsorship_field" name="gp_sponsorship_field" value="' . esc_attr( $value ) . '">';
	echo '<p>Enter the name of the sponsor for this post only. If a value is entered into this field, the message "Sponsored by [Sponsor Name]" will be displayed below the blog post&apos;s title.</p>';
}
add_action('add_meta_boxes', 'gp_sponsor_metabox');

/**
 * Saves the Sponshorship data from metabox
 */
function gp_save_sponsorship_data( $post_id ) {
	// Checks to ensure save is permitted
	if ( ! isset( $_POST['gp_sponsorship_metabox_nonce'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce( $_POST['gp_sponsorship_metabox_nonce'], 'gp_save_sponsorship_data' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	if( ! isset( $_POST['gp_sponsorship_field'] ) ) {
		return;
	}

	$sponsorship = sanitize_text_field( $_POST['gp_sponsorship_field'] );
	update_post_meta( $post_id, '_sponsorship_meta_value_key', $sponsorship );
}
add_action( 'save_post', 'gp_save_sponsorship_data' );
