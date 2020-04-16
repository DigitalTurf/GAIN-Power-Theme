<?php
global $listingpro_options;

$lp_detail_page_styles  =   $listingpro_options['lp_detail_page_styles'];
$plan_id = listing_get_metabox_by_ID('Plan_id',get_the_ID());

$announcements_show =   'true';

if(!empty($plan_id)){
    $plan_id = $plan_id;

}else{
    $plan_id = 'none';
}
if( $plan_id != 'none' )
{
    $announcements_show = get_post_meta( $plan_id, 'listingproc_plan_announcment', true );
}
if( $announcements_show == 'false' ) return false;

if( isset( $listingpro_options['announcements_dashoard'] ) && $listingpro_options['announcements_dashoard'] == 0 )
{
    $announcements_show =   false;
}
if( $announcements_show == false ) return false;



$lp_listing_announcements  =   get_post_meta( get_the_ID(), 'lp_listing_announcements', true );

if( $lp_listing_announcements != '' && is_array( $lp_listing_announcements ) && count($lp_listing_announcements) > 0 ):
    ?>
    <h4 class="lp-detail-section-title"><?php echo esc_html__( 'Announcements', 'listingpro' ); ?></h4>
    <div class="lp-listing-announcement">

        <?php
        foreach ( $lp_listing_announcements as $k => $v ):
            if( $v['annLI'] == get_the_ID() ):
                if( !isset( $v['annStatus'] ) || $v['annStatus'] == 1 ):
                    $annSt  =   'style1';
                    if( isset( $v['annSt'] ) && !empty( $v['annSt'] ) )
                    {
                        $annSt  =    $v['annSt'];
                    }
					$icon_class =   'fa fa-bullhorn';

					if( !empty( $v['annIC'] ) )

					{

					   $icon_class =   $v['annIC'];

					}
                    ?>
                    <div class="announcement-wrap ann-<?php echo $annSt; ?>">
                        <i class="<?php echo $icon_class; ?>" aria-hidden="true"></i>
                        <p>
                            <?php
                            if( !empty( $v['annTI'] ) ):
                            ?>
                            <strong><?php echo $v['annTI']; ?></strong>
                            <?php endif; ?>
                            <span><?php echo $v['annMsg']; ?></span>
                        </p>
                        <?php
                        if( !empty( $v['annBT'] ) ):
                            ?>
                            <a target="_blank" href="<?php echo $v['annBL']; ?>" class="announcement-btn"><?php echo $v['annBT']; ?></a>
                        <?php endif; ?>
                        <div class="clearfix"></div>
                    </div>
                <?php endif; endif; endforeach; ?>
        <div class="clearfix"></div>
    </div>
<?php endif; ?>
