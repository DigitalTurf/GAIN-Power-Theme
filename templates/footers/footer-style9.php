<?php
global $listingpro_options;
	$copy_right = $listingpro_options['copy_right'];
	$copy_right = str_replace('%YEAR%', date("Y"), $copy_right);
	$footer_logo    =   $listingpro_options['footer_logo'];
    $footer_address = $listingpro_options['footer_address'];
    $phone_number = $listingpro_options['phone_number'];
    $author_info = $listingpro_options['author_info'];
    $fb = $listingpro_options['fb'];
    $tw = $listingpro_options['tw'];
    $gog = $listingpro_options['gog'];
    $insta = $listingpro_options['insta'];
    $tumb = $listingpro_options['tumb'];
    $fyout = $listingpro_options['f-yout'];
    $flinked = $listingpro_options['f-linked'];
    $fpintereset = $listingpro_options['f-pintereset'];
    $fvk = $listingpro_options['f-vk'];
    $footer_style = $listingpro_options['footer_style'];

?>

<!--footer 9-->
<div class="clearfix"></div>

<footer class="footer-style9">
        <div class="footer9-bottom-area padding-top-60 padding-bottom-60">
            <div class="container global-footer">
							<?php if ( is_front_page() ) { ?>
							<div class="home-footer">
								<div class="container row">
										<div class="col-md-12">
											<p>GAIN POWER: Directories, jobs, stories, resources, networking & marketing for progressive nonprofits, Democratic campaigns, the Resistance movement, and the professionals & activists who support them...<br><span>all right here.</span></p>
										</div>
									</div>
								</div>
							<?php }; ?>
							<div class='global-footer-wrap'>
                <div class="container row">
                    <div class="col-md-2 col-sm-12">
                        <div class="lp-footer-logo">
                            <a href="<?php echo esc_url(home_url('/')); ?>">
                                <?php
                                if( isset( $footer_logo ) && !empty( $footer_logo ) ):
                                ?>
                                <img src="<?php echo $footer_logo['url']; ?>" alt="">
                                <?php endif; ?>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-12">
                         <?php
                            if(has_nav_menu('footer_menu')):
                        ?>

                            <?php echo listingpro_footer_menu(); ?>

                        <?php endif; ?>
												<div class="copyright-text"><?php echo $copy_right; ?></div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <?php if(!empty($tw) || !empty($gog) || !empty($fb) || !empty($insta) || !empty($tumb) || !empty($fpintereset) || !empty($flinked) || !empty($fyout) || !empty($fvk)){ ?>
                                    <ul class="social-icons footer-social-icons">
                                        <?php if(!empty($fb)){ ?>
                                            <li>
                                                <a href="<?php echo esc_url($fb); ?>" target="_blank">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path fill="#fff" d="M16 0c-8.8 0-16 7.2-16 16s7.2 16 16 16c8.8 0 16-7.2 16-16s-7.2-16-16-16v0zM20.192 10.688h-1.504c-1.184 0-1.376 0.608-1.376 1.408v1.792h2.784l-0.384 2.816h-2.4v7.296h-2.912v-7.296h-2.496v-2.816h2.496v-2.080c-0.096-2.496 1.408-3.808 3.616-3.808 0.992 0 1.888 0.096 2.176 0.096v2.592z"></path></svg>
                                                </a>
                                            </li>
                                        <?php } ?>
                                        <?php if(!empty($gog)){ ?>
                                            <li>
                                                <a href="<?php echo esc_url($gog); ?>" target="_blank">
                                                    <?php echo listingpro_icons('google'); ?>
                                                </a>
                                            </li>
                                        <?php } ?>
                                        <?php if(!empty($tw)){ ?>
                                            <li>
                                                <a href="<?php echo esc_url($tw); ?>" target="_blank">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path fill="#fff" d="M16 0c-8.8 0-16 7.2-16 16s7.2 16 16 16c8.8 0 16-7.2 16-16s-7.2-16-16-16v0zM22.4 12.704v0.384c0 4.32-3.296 9.312-9.312 9.312-1.888 0-3.584-0.512-4.992-1.504h0.8c1.504 0 3.008-0.512 4.096-1.408-1.376 0-2.592-0.992-3.104-2.304 0.224 0 0.416 0.128 0.608 0.128 0.32 0 0.608 0 0.896-0.128-1.504-0.288-2.592-1.6-2.592-3.2v0c0.416 0.224 0.896 0.416 1.504 0.416-0.896-0.608-1.504-1.6-1.504-2.688 0-0.608 0.192-1.216 0.416-1.728 1.6 2.016 4 3.328 6.784 3.424-0.096-0.224-0.096-0.512-0.096-0.704 0-1.792 1.504-3.296 3.296-3.296 0.896 0 1.792 0.384 2.4 0.992 0.704-0.096 1.504-0.416 2.112-0.8-0.224 0.8-0.8 1.408-1.408 1.792 0.704-0.096 1.312-0.288 1.888-0.48-0.576 0.8-1.184 1.376-1.792 1.792v0z"></path></svg>
                                                </a>
                                            </li>
                                        <?php } ?>
                                        <?php if(!empty($insta)){ ?>
                                            <li>
                                                <a href="<?php echo esc_url($insta); ?>" target="_blank">
                                                    <?php echo listingpro_icons('instagram'); ?>
                                                </a>
                                            </li>
                                        <?php } ?>
                                        <?php if(!empty($fyout)){ ?>
                                            <li>
                                                <a href="<?php echo esc_url($fyout); ?>" target="_blank">
                                                    <?php echo listingpro_icons('ytwite'); ?>
                                                </a>
                                            </li>
                                        <?php } ?>
                                        <?php if(!empty($flinked)){ ?>
                                            <li>
                                                <a href="<?php echo esc_url($flinked); ?>" target="_blank">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill="#fff" d="M10 0.4c-5.302 0-9.6 4.298-9.6 9.6s4.298 9.6 9.6 9.6 9.6-4.298 9.6-9.6-4.298-9.6-9.6-9.6zM7.65 13.979h-1.944v-6.256h1.944v6.256zM6.666 6.955c-0.614 0-1.011-0.435-1.011-0.973 0-0.549 0.409-0.971 1.036-0.971s1.011 0.422 1.023 0.971c0 0.538-0.396 0.973-1.048 0.973zM14.75 13.979h-1.944v-3.467c0-0.807-0.282-1.355-0.985-1.355-0.537 0-0.856 0.371-0.997 0.728-0.052 0.127-0.065 0.307-0.065 0.486v3.607h-1.945v-4.26c0-0.781-0.025-1.434-0.051-1.996h1.689l0.089 0.869h0.039c0.256-0.408 0.883-1.010 1.932-1.010 1.279 0 2.238 0.857 2.238 2.699v3.699z"></path></svg>
                                                </a>
                                            </li>
                                        <?php } ?>
                                        <?php if(!empty($fpintereset)){ ?>
                                            <li>
                                                <a href="<?php echo esc_url($fpintereset); ?>" target="_blank">
                                                    <?php echo listingpro_icons('pinterest'); ?>
                                                </a>
                                            </li>
                                        <?php } ?>
                                        <?php if(!empty($tumb)){ ?>
                                            <li>
                                                <a href="<?php echo esc_url($tumb); ?>" target="_blank">
                                                    <?php echo listingpro_icons('tumbler'); ?>
                                                </a>
                                            </li>
                                        <?php } ?>
                                        <?php if(!empty($fvk)){ ?>
                                            <li>
                                                <a href="<?php echo esc_url($fvk); ?>" target="_blank">
                                                    <?php echo listingpro_icons('vk'); ?>
                                                </a>
                                            </li>
                                        <?php } ?>

                                    </ul>
                                <?php } ?>
                    </div>

                </div>
							</div>
            </div>
        </div>
</footer>
