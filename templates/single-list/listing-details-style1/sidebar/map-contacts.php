<?php
	global $listingpro_options;
	$plan_id = listing_get_metabox_by_ID('Plan_id',$post->ID);
	if(!empty($plan_id)){
		$plan_id = $plan_id;
	}else{
		$plan_id = 'none';
	}
	$map_show = get_post_meta( $plan_id, 'map_show', true );
	$social_show = get_post_meta( $plan_id, 'listingproc_social', true );
	$location_show = get_post_meta( $plan_id, 'listingproc_location', true );
	$contact_show = get_post_meta( $plan_id, 'contact_show', true );
	$website_show = get_post_meta( $plan_id, 'listingproc_website', true );

	if($plan_id=="none"){
		$map_show = 'true';
		$social_show = 'true';
		$location_show = 'true';
		$contact_show = 'true';
		$website_show = 'true';
	}

	$facebook = listing_get_metabox('facebook');
	$twitter = listing_get_metabox('twitter');
	$linkedin = listing_get_metabox('linkedin');
	$google_plus = listing_get_metabox('google_plus');
	$youtube = listing_get_metabox('youtube');
	$instagram = listing_get_metabox('instagram');
	$medium = listing_get_metabox('medium');
	$phone = listing_get_metabox('phone');
	$website = listing_get_metabox('website');
	$gAddress = listing_get_metabox('gAddress');
	$latitude = listing_get_metabox('latitude');
	$longitude = listing_get_metabox('longitude');
	$whatsapp = listing_get_metabox('whatsapp');

?>

<?php

	if( !empty($latitude) || !empty($longitude) || !empty($gAddress) || !empty($phone) || !empty($website) || !empty($facebook) || !empty($twitter) || !empty($linkedin) || !empty($google_plus) || !empty($youtube) || !empty($instagram) ){
?>
		<div class="sidebar-post">
			<div class="widget-box map-area">
				<?php
				if(!empty($latitude) && !empty($longitude)){
					if($map_show=="true"){
				?>
							<div class="widget-bg-color post-author-box lp-border-radius-5">
								<div class="widget-header margin-bottom-25 hideonmobile">
									<ul class="post-stat">
										<li>
											<a class="md-trigger parimary-link singlebigmaptrigger" data-lat="<?php echo esc_attr($latitude); ?>" data-lan="<?php echo esc_attr($longitude); ?>" data-modal="modal-4" >
												<!-- <span class="phone-icon">
													Marker icon by Icons8
													<?php echo listingpro_icons('mapMarker'); ?>
												</span>
												<span class="phone-number ">
													<?php echo esc_html__('View Large Map', 'listingpro'); ?>
												</span> -->
											</a>
										</li>
									</ul>
								</div>
								<?php
								$lp_map_pin = $listingpro_options['lp_map_pin']['url'];
								?>
								<div class="widget-content ">
									<div class="widget-map pos-relative">
										<div id="singlepostmap" class="singlemap" data-pinicon="<?php echo esc_attr($lp_map_pin); ?>"></div>
										<div class="get-directions">
											<a href="https://www.google.com/maps?daddr=<?php echo esc_attr($latitude); ?>,<?php echo esc_attr($longitude); ?>" target="_blank" >
												<span class="phone-icon">
													<i class="fas fa-map-marked-alt"></i>
												</span>
												<span class="phone-number ">
													<?php echo esc_html__('Get Directions', 'listingpro'); ?>
												</span>
											</a>
										</div>
									</div>
								</div>
							</div><!-- ../widget-box  -->
					<?php } ?>
				<?php } ?>
				<div class="listing-detail-infos margin-top-20 clearfix">
					<ul class="list-style-none list-st-img clearfix">
						<?php

						$phone = listing_get_metabox('phone');
						$website = listing_get_metabox('website');
						//if(empty($facebook) && empty($twitter) && empty($linkedin)){}else{
							?>
							<?php if(!empty($gAddress)) {
								if($location_show=="true"){?>
									<li class="lp-details-address">
										<a>
											<span class="cat-icon">
												<?php echo listingpro_icons('mapMarkerGrey'); ?>
												<!-- <i class="fa fa-map-marker"></i> -->
											</span>
											<span>
												<?php echo $gAddress ?>
											</span>
										</a>
									</li>
								<?php } ?>
							<?php } ?>
							<?php if(!empty($phone)) { ?>
								<?php if($contact_show=="true"){ ?>
									<li class="lp-listing-phone">
										<a data-lpID="<?php echo $post->ID; ?>" href="tel:<?php echo esc_attr($phone); ?>">
											<span class="cat-icon">
												<?php echo listingpro_icons('phone'); ?>
												<!-- <i class="fa fa-mobile"></i> -->
											</span>
											<span>
												<?php echo esc_html($phone); ?>
											</span>
										</a>
									</li>
							<?php } ?>
							<?php } ?>
									<?php
										$whatsappStatus = $listingpro_options['lp_detail_page_whatsapp_button'];
										$whatsappMsg = esc_html__('Hi, Contacting for you listing', 'listingpro');
										if($whatsappStatus=="on" && !empty($whatsapp) && !empty($phone)){
											if($contact_show=="true"){
											$whatsappobj = "https://api.whatsapp.com/send?";
											$whatsappobj .= "phone=$whatsapp";
											$whatsappobj .= "&";
											$whatsappobj .= "text=$whatsappMsg";
									?>
											<li class="lp-listing-phone-whatsapp">
												<a href="<?php echo $whatsappobj; ?>" target="_blank">
													<span class="cat-icon">
														<i class="fa fa-whatsapp" aria-hidden="true"></i>
													</span>
													<span>
														<?php echo esc_html__('Call on Whatsapp', 'listingpro'); ?>
													</span>
												</a>
											</li>
									<?php
										}
									?>

								<?php } ?>

							<?php if(!empty($website)) {
									if($website_show=="true"){?>
										<li class="lp-user-web">
											<a data-lpID="<?php echo $post->ID; ?>" href="<?php echo esc_url($website); ?>" target="_blank" rel="nofollow">
												<span class="cat-icon">
													<?php echo listingpro_icons('globe'); ?>
													<!-- <i class="fa fa-globe"></i> -->
												</span>
												<span><?php echo esc_url($website); ?></span>
											</a>
										</li>
									<?php } ?>
							<?php } ?>
						<?php //} ?>
					</ul>
					<?php
					$facebook = listing_get_metabox('facebook');
					$twitter = listing_get_metabox('twitter');
					$linkedin = listing_get_metabox('linkedin');
					$google_plus = listing_get_metabox('google_plus');
					$youtube = listing_get_metabox('youtube');
					$instagram = listing_get_metabox('instagram');
					if($social_show=="true"){
						if(empty($facebook) && empty($twitter) && empty($linkedin) && empty($google_plus) && empty($youtube) && empty($instagram)){}else{
							?>
							<div class="widget-box widget-social">
								<div class="widget-content clearfix">
									<ul class="list-style-none list-st-img">
										<?php if(!empty($facebook)){ ?>
											<li class="lp-fb no-border">
												<a href="<?php echo esc_url($facebook); ?>" class="padding-left-0" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path fill="#333" d="M16 0c-8.8 0-16 7.2-16 16s7.2 16 16 16c8.8 0 16-7.2 16-16s-7.2-16-16-16v0zM20.192 10.688h-1.504c-1.184 0-1.376 0.608-1.376 1.408v1.792h2.784l-0.384 2.816h-2.4v7.296h-2.912v-7.296h-2.496v-2.816h2.496v-2.080c-0.096-2.496 1.408-3.808 3.616-3.808 0.992 0 1.888 0.096 2.176 0.096v2.592z"></path></svg></a>
											</li>
										<?php } ?>
										<?php if(!empty($twitter)){ ?>
											<li class="lp-tw no-border">
												<a href="<?php echo esc_url($twitter); ?>" class="padding-left-0" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path fill="#333" d="M16 0c-8.8 0-16 7.2-16 16s7.2 16 16 16c8.8 0 16-7.2 16-16s-7.2-16-16-16v0zM22.4 12.704v0.384c0 4.32-3.296 9.312-9.312 9.312-1.888 0-3.584-0.512-4.992-1.504h0.8c1.504 0 3.008-0.512 4.096-1.408-1.376 0-2.592-0.992-3.104-2.304 0.224 0 0.416 0.128 0.608 0.128 0.32 0 0.608 0 0.896-0.128-1.504-0.288-2.592-1.6-2.592-3.2v0c0.416 0.224 0.896 0.416 1.504 0.416-0.896-0.608-1.504-1.6-1.504-2.688 0-0.608 0.192-1.216 0.416-1.728 1.6 2.016 4 3.328 6.784 3.424-0.096-0.224-0.096-0.512-0.096-0.704 0-1.792 1.504-3.296 3.296-3.296 0.896 0 1.792 0.384 2.4 0.992 0.704-0.096 1.504-0.416 2.112-0.8-0.224 0.8-0.8 1.408-1.408 1.792 0.704-0.096 1.312-0.288 1.888-0.48-0.576 0.8-1.184 1.376-1.792 1.792v0z"></path></svg></a>
											</li>
										<?php } ?>
										<?php if(!empty($linkedin)){ ?>
											<li  class="lp-li no-border">
												<a href="<?php echo esc_url($linkedin); ?>" class="padding-left-0" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill="#333" d="M10 0.4c-5.302 0-9.6 4.298-9.6 9.6s4.298 9.6 9.6 9.6 9.6-4.298 9.6-9.6-4.298-9.6-9.6-9.6zM7.65 13.979h-1.944v-6.256h1.944v6.256zM6.666 6.955c-0.614 0-1.011-0.435-1.011-0.973 0-0.549 0.409-0.971 1.036-0.971s1.011 0.422 1.023 0.971c0 0.538-0.396 0.973-1.048 0.973zM14.75 13.979h-1.944v-3.467c0-0.807-0.282-1.355-0.985-1.355-0.537 0-0.856 0.371-0.997 0.728-0.052 0.127-0.065 0.307-0.065 0.486v3.607h-1.945v-4.26c0-0.781-0.025-1.434-0.051-1.996h1.689l0.089 0.869h0.039c0.256-0.408 0.883-1.010 1.932-1.010 1.279 0 2.238 0.857 2.238 2.699v3.699z"></path></svg></a>
											</li>
										<?php } ?>
										<?php if(!empty($google_plus)){ ?>
											<li  class="lp-li no-border">
												<a href="<?php echo esc_url($google_plus); ?>" class="padding-left-0" target="_blank"><svg width="22" height="22" xmlns="http://www.w3.org/2000/svg"><g><rect fill="none" id="canvas_background" height="402" width="582" y="-1" x="-1"/></g><g><g id="surface1"><path id="svg_1" fill-rule="nonzero" fill="rgb(20%,20%,20%)" d="m11,0c-6.07422,0 -11,4.92578 -11,11c0,6.07422 4.92578,11 11,11c6.07422,0 11,-4.92578 11,-11c0,-6.07422 -4.92578,-11 -11,-11zm0,0"/><path id="svg_2" fill-rule="nonzero" fill="rgb(100%,100%,100%)" d="m8.39063,16.19922c-2.92188,0 -5.29688,-2.33203 -5.29688,-5.19922c0,-2.86719 2.375,-5.19922 5.29688,-5.19922c1.27343,0 2.50781,0.45313 3.47265,1.27344l-1.34765,1.51953c-0.58985,-0.5 -1.34375,-0.78125 -2.12891,-0.78125c-1.78906,0 -3.24219,1.42969 -3.24219,3.1875c0,1.75781 1.45313,3.1875 3.24219,3.1875c1.51562,0 2.50391,-0.72656 2.82812,-2.02734l-2.80078,0l0,-2.01563l4.96485,0l0,1.00781c0,3.01954 -2.00391,5.04688 -4.98828,5.04688zm0,0"/><path id="svg_3" fill-rule="nonzero" fill="rgb(100%,100%,100%)" d="m18.90625,10.14453l-1.53516,0l0,-1.53515l-1.22656,0l0,1.53515l-1.53515,0l0,1.23047l1.53515,0l0,1.53516l1.22656,0l0,-1.53516l1.53516,0l0,-1.23047zm0,0"/></g></g></svg></a>
											</li>
										<?php } ?>
										<?php if(!empty($youtube)){ ?>
											<li  class="lp-li no-border">
												<a href="<?php echo esc_url($youtube); ?>" class="padding-left-0" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path fill="#333" d="M16 0c-8.8 0-16 7.2-16 16s7.2 16 16 16c8.8 0 16-7.2 16-16s-7.2-16-16-16v0zM24 16.608c0 1.28-0.192 2.592-0.192 2.592s-0.192 1.088-0.608 1.6c-0.608 0.608-1.312 0.608-1.6 0.704-2.208 0.192-5.6 0.192-5.6 0.192s-4.192 0-5.408-0.192c-0.384-0.096-1.184 0-1.792-0.704-0.512-0.512-0.608-1.6-0.608-1.6s-0.192-1.312-0.192-2.592v-1.216c0-1.28 0.192-2.592 0.192-2.592s0.224-1.088 0.608-1.6c0.608-0.608 1.312-0.608 1.6-0.704 2.208-0.192 5.6-0.192 5.6-0.192s3.392 0 5.6 0.192c0.288 0 0.992 0 1.6 0.704 0.512 0.512 0.608 1.6 0.608 1.6s0.192 1.312 0.192 2.592v1.216zM14.304 18.112l4.384-2.304-4.384-2.208v4.512z"></path></svg></a>
											</li>
										<?php } ?>
										<?php if(!empty($instagram)){ ?>
											<li  class="lp-li no-border">
												<a href="<?php echo esc_url($instagram); ?>" class="padding-left-0" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path fill="#333" d="M16 19.104c-1.696 0-3.104-1.408-3.104-3.104 0-1.728 1.408-3.104 3.104-3.104 1.728 0 3.104 1.376 3.104 3.104 0 1.696-1.376 3.104-3.104 3.104zM19.616 12.896c-0.32 0-0.512-0.192-0.416-0.384v-2.208c0-0.192 0.192-0.416 0.416-0.416h2.176c0.224 0 0.416 0.224 0.416 0.416v2.208c0 0.192-0.192 0.384-0.416 0.384h-2.176zM16 0c-8.8 0-16 7.2-16 16s7.2 16 16 16c8.8 0 16-7.2 16-16s-7.2-16-16-16v0zM24 22.112c0 0.992-0.896 1.888-1.888 1.888h-12.224c-0.992 0-1.888-0.8-1.888-1.888v-12.224c0-1.088 0.896-1.888 1.888-1.888h12.224c0.992 0 1.888 0.8 1.888 1.888v12.224zM20.896 16c0 2.688-2.208 4.896-4.896 4.896s-4.896-2.208-4.896-4.896c0-0.416 0.096-0.896 0.192-1.312h-1.504v7.008c0 0.192 0.224 0.416 0.416 0.416h11.488c0.192 0 0.416-0.224 0.416-0.416v-7.008h-1.504c0.192 0.416 0.288 0.896 0.288 1.312z"></path></svg></a>
											</li>
										<?php } ?>
										<?php if(!empty($medium)){ ?>
											<li  class="lp-li no-border">
												<a href="<?php echo esc_url($medium); ?>" class="padding-left-0" target="_blank"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="22px" height="22px" viewBox="0 0 22 22" style="enable-background:new 0 0 22 22;" xml:space="preserve">
												<path fill="#333" d="M11,0C4.9,0,0,4.9,0,11c0,6.1,4.9,11,11,11c6.1,0,11-4.9,11-11S17.1,0,11,0z M8.5,16.2C8.5,16.3,8.5,16.3,8.5,16.2
												C8.5,16.3,8.5,16.3,8.5,16.2l-3.8-1.9c-0.1,0-0.1-0.1-0.1-0.2l0-8.7l3.9,2V16.2z M9,12.1v-4l3.5,5.7L9,12.1z M10.6,9.8l2.7-4.4l4,2
												L13.2,14L10.6,9.8z M17.4,16.2C17.4,16.3,17.4,16.3,17.4,16.2C17.3,16.3,17.3,16.3,17.4,16.2l-3.8-1.9l3.8-6.2V16.2z"/>
												</svg></a>
											</li>
										<?php } ?>
									</ul>
								</div>

							</div><!-- ../widget-box  -->
						<?php } ?>
				<?php } ?>
				</div>
			</div>
		</div>
<?php } ?>
