<?php

global $listingpro_options;

$copy_right = $listingpro_options['copy_right'];
$copy_right = str_replace('%YEAR%', date("Y"), $copy_right);

$footer_logo    =   $listingpro_options['footer_logo'];

$listing_style = $listingpro_options['listing_style'];

if(isset($_GET['list-style']) && !empty($_GET['list-style'])){

    $listing_style = esc_html($_GET['list-style']);

}

if( ( $listing_style == 4 || $listing_style == 1 ) || ( !is_tax('location') && !is_tax('listing-category')  && !is_tax('list-tags') && !is_tax('features') && !is_search() ) )

{

?>

<div class="clearfix"></div>
<footer class="style3 footer-style3">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="lp-footer-logo">
                    <a href="<?php echo esc_url(home_url('/')); ?>">
                        <?php
                        if( isset( $footer_logo ) && !empty( $footer_logo ) ):
                        ?>
                        <img src="<?php echo $footer_logo['url']; ?>" alt="">
                        <?php endif; ?>
                    </a>
                </div>
                <div class="lp-footer-copyrights">
                <?php
                if( !empty( $copy_right ) ):
                    ?>
                    <span class="copyrights"><?php echo $copy_right; ?></span>
                <?php endif; ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="footer-menu">
                    <?php listingpro_footer_menu(); ?>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</footer>
<?php } ?>
