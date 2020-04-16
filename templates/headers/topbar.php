<?php
  global $listingpro_options;
  $header_fullwidth   =   $listingpro_options['header_fullwidth'];
  $container_class    =   'container';

  if ( $header_fullwidth == 1 ) {
      $container_class = 'container-fluid';
  }

  $hide = (is_front_page())? "hidden-md hidden-lg": "";
?>

<div class="lp-top-bar <?php echo $hide; ?>">
    <div class="<?php echo $container_class; ?>">
        <div class="row">
            <div class="col-md-12 col-xs-12 hidden-xs">
                <div class="lp-top-bar-menu">
                    <?php echo listingpro_top_bar_menu(); ?>
                </div>
                <div class="hidden-md nav-menu-close">
                  <i class="far fa-times-circle"></i>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
