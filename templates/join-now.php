<?php
global $listingpro_options;
$lp_detail_page_styles = $listingpro_options['lp_detail_page_styles'];
$header_viewss  =   $listingpro_options['header_views'];

$user_status = (is_user_logged_in())? "logged-in": "logged-out";

if( $header_viewss == 'header_with_topbar_menu' )
{
    ?>
    <div class="lp-header-user-nav-top <?php echo $user_status; ?>">
        <?php
        if ( !is_user_logged_in() )
        {
            ?>
            <a class="header-login-btn md-trigger signInClick" data-modal="modal-3">Log In</a>
            <a class="header-get-started-btn md-trigger signUpClick" data-modal="modal-3">Get Started</a>
            <?php
        }
        else
        {
            $current_user = wp_get_current_user();
            $u_display_name = $current_user->display_name;
            if(empty($u_display_name))
            {
                $u_display_name = $current_user->nickname;
            }
            global $listingpro_options;
            $authorURL = get_profile_url_by_id( get_current_user_id() );
            ?>
            <div class="lp-user-name-container">
              <div class="lp-user-name"><?php echo esc_html($u_display_name); ?></div>
              <ul id="lp-user-name-menu">
                <?php
                  $args = [
                      'menu'              => 71,
                      'items_wrap'        => '%3$s',
                      'container'         => '',
                      'fallback_cb'       => false,
                      'echo'              => true,
                      'depth'             => 0,
                      'add_li_class'      => 'menupop directory-items',
                      'link_before'       => '<span class="wp-admin-bar-arrow" aria-hidden="true"></span>',
                  ];
                  wp_nav_menu($args);
                ?>
                <li id="user-menu-logout" class="menupop">
                  <a href="<?php echo esc_url(wp_logout_url(get_site_url())); ?>"><span class="wp-admin-bar-arrow" aria-hidden="true"></span>Logout<i class="fas fa-sign-out-alt"></i></a>
                </li>
              </ul>
            </div>
            <div class="lp-join-now after-login lp-join-user-info lp-join-now-v2">
                <ul>
                    <li class="juname">
                        <?php
                        if ( is_plugin_active( 'listingpro-plugin/plugin.php' ) ) {
                            ?>
                            <a href="<?php echo esc_url($authorURL); ?>" class="juname">
                                <img src="<?php echo listingpro_author_image(); ?>" alt="userimg" height="50" width="50" />
                            </a>
                        <?php } ?>
                    </li>
                </ul>
            </div>
            <div class="header-notifications">
                <?php
                    $notifications = bp_notifications_get_unread_notification_count(get_current_user_id());
                    $unread_messages = bp_get_total_unread_messages_count(get_current_user_id());
                    $user_url = '/community/members/' . bp_core_get_username(get_current_user_id()) . '/';
                ?>
                <a href="<?php echo $user_url . 'messages/'; ?>"><?php if($unread_messages > 0){ ?><div class="badge"><?php echo $unread_messages; ?></div><?php } ?><i class="fa fa-inbox"></i></a>
                <a href="<?php echo $user_url . 'notifications/'; ?>"><?php if($notifications > 0){ ?><div class="badge"><?php echo $notifications; ?></div><?php } ?><i class="fa fa-bell"></i></a>
            </div>
            <div class="hidden-md mobile-search-btn">
              <i class="fas fa-search"></i>
            </div>
            <?php
        }
        ?>
    </div>
    <?php
}
else
{
    if (!is_user_logged_in()) {
        ?>
        <div class="lp-join-now">
                                <span>
                                    <!-- Contacts icon by Icons8 -->
                                    <?php echo listingpro_icons('contacts'); ?>
                                </span>
            <a class=" md-trigger" data-modal="modal-3"><?php esc_html_e('Join Now', 'listingpro'); ?></a>
        </div>
    <?php }else{
        $current_user = wp_get_current_user();
        $u_display_name = $current_user->display_name;
        if(empty($u_display_name)){
            $u_display_name = $current_user->nickname;
        }
        global $listingpro_options;
        $authorURL = $listingpro_options['listing-author'];
        ?>
        <div class="lp-join-now after-login lp-join-user-info">
            <ul>
                <li>
                                        <span>
                                            <img src="<?php echo listingpro_author_image(); ?>" alt="userimg" />
                                        </span>
                    <?php

                    if ( is_plugin_active( 'listingpro-plugin/plugin.php' ) ) {
                        ?>
                        <a href="<?php echo esc_url($authorURL); ?>">
                            <?php
                            echo  esc_html($u_display_name);
                            ?>
                        </a>
                    <?php }else{ ?>
                        <a href="<?php echo get_profile_url_by_id($current_user->ID); ?>">
                            <?php
                            echo  esc_html($u_display_name);
                            ?>
                        </a>
                    <?php } ?>
                    <?php
                    $dashURL = listingpro_url('listing-author');
                    if(!empty($dashURL)){
                        $currentURL = $dashURL;
                        $perma = '';
                        $dashQuery = 'dashboard=';
                        global $wp_rewrite;
                        if ($wp_rewrite->permalink_structure == ''){
                            $perma = "&";
                        }else{
                            $perma = "?";
                        }
                        ?>
                        <ul class="lp-user-menu list-style-none">
                            <li><a href="<?php echo listingpro_url('listing-author'); ?>"><?php esc_html_e('Dashboard','listingpro'); ?> </a></li>
                            <li><a href="<?php echo $currentURL.$perma.$dashQuery.'update-profile'; ?>"><?php esc_html_e('Update Profile','listingpro'); ?></a></li>
                            <li><a href="<?php echo wp_logout_url( esc_url(home_url('/')) ); ?>"><?php esc_html_e('Sign out ','listingpro'); ?></a></li>
                        </ul>
                    <?php } ?>
                </li>
            </ul>
        </div>
        <?php
    }

}
?>
