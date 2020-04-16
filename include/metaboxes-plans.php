<?php

	remove_action('add_meta_boxes', 'plan_contact_box');
	add_action( 'add_meta_boxes', 'plan_contact_box_custom' );
	function plan_contact_box_custom() {
		$screens = array( 'price_plan');
		foreach ( $screens as $screen ) {
			add_meta_box( 
				'plan_contact_box',
				__( 'Enable/Disable Listing Fields By Plan', 'listingpro-plugin' ),
				'plan_contact_content_custom',
				$screen,
				 'normal',
				'high'
			);
		}
	}
	
	
		function plan_contact_content_custom( $post ) {

		$contact_show = get_post_meta( $post->ID, 'contact_show', true );
		$checked = '';
		if($contact_show == 'true'){
			$checked = 'checked';
		}
		?>
		<div style="border-bottom: 1px solid #ccc;padding: 10px 0px;">
			<div style="width:60%;float:left">
		<?php 
		echo '<label class="switch">';
		echo '<input '.$checked.' type="checkbox" id="contact_show" name="contact_show" value="';
		echo wp_kses_post($contact_show); 
		echo '">';
		echo '<span class="slider round"></span>';
		echo'</label>';
		
		echo __('<label for="contact_show"><b>contact information</b></label>', 'listingpro-plugin');
		
		$checked = get_post_meta( $post->ID, 'contact_show_hide', 'true' );
		if(!empty($checked)){
			$checked = 'checked';
		}
		?>
			</div>
			<div style="width:40%;float:left">
				<?php
		echo '<label class="switch">';		
		echo ' <input type="checkbox" id="contact_show_hide" name="contact_show_hide" '.$checked.'  />';
		echo '<span class="slider round slider2"></span>';
		echo'</label>';
		
		?>
			</div>
			<br clear="all" />
		</div>
		<?php
		?>
		<div style="border-bottom: 1px solid #ccc;padding: 10px 0px;">
			<div style="width:60%;float:left">
		<?php 
		$map_show = get_post_meta( $post->ID, 'map_show', true );
		$checked = '';
		if($map_show == 'true'){
			$checked = 'checked';
		}
		echo '<label class="switch">';
		echo '<input '.$checked.' type="checkbox" id="map_show" name="map_show" value="';
		echo wp_kses_post($map_show); 
		echo '">';
		echo '<span class="slider round"></span>';
		echo'</label>';
		echo __('<label for="map_show"><b>Google map</b></label>', 'listingpro-plugin');
		
		$checked =get_post_meta( $post->ID, 'map_show_hide', 'true' );
			if(!empty($checked)){
				$checked = 'checked';
			}
			?>
			</div>
			<div style="width:40%;float:left">
				<?php
		echo '<label class="switch">';		
		echo ' <input type="checkbox" id="map_show_hide" name="map_show_hide" '.$checked.'  />';
		echo '<span class="slider round slider2"></span>';
		echo'</label>';
		
		?>
			</div>
			<br clear="all" />
		</div>
		<?php
		?>
		<div style="border-bottom: 1px solid #ccc;padding: 10px 0px;">
			<div style="width:60%;float:left">
		<?php 
		$video_show = get_post_meta( $post->ID, 'video_show', true );
		$checked = '';
		if($video_show == 'true'){
			$checked = 'checked';
		}
		echo '<label class="switch">';
		echo '<input '.$checked.' type="checkbox" id="video_show" name="video_show" value="';
		echo wp_kses_post($video_show); 
		echo '">';
		echo '<span class="slider round"></span>';
		echo'</label>';
		echo __('<label for="video_show"><b>video</b></label>', 'listingpro-plugin');
		
		$checked =get_post_meta( $post->ID, 'video_show_hide', 'true' );
			if(!empty($checked)){
				$checked = 'checked';
			}
			?>
			</div>
			<div style="width:40%;float:left">
				<?php
		echo '<label class="switch">';		
		echo ' <input type="checkbox" id="video_show_hide" name="video_show_hide" '.$checked.'  />';
		echo '<span class="slider round slider2"></span>';
		echo'</label>';
		
		?>
			</div>
			<br clear="all" />
		</div>
		<?php
		?>
		<div style="border-bottom: 1px solid #ccc;padding: 10px 0px;">
			<div style="width:60%;float:left">
		<?php 
		$gallery_show = get_post_meta( $post->ID, 'gallery_show', true );
		$checked = '';
		if($gallery_show == 'true'){
			$checked = 'checked';
		}
		echo '<label class="switch">';
		echo '<input '.$checked.' type="checkbox" id="gallery_show" name="gallery_show" value="';
		echo wp_kses_post($gallery_show); 
		echo '">';
		echo '<span class="slider round"></span>';
		echo'</label>';
		echo __('<label for="gallery_show"><b>Gallery</b></label>', 'listingpro-plugin');
		
		$checked =get_post_meta( $post->ID, 'gall_show_hide', 'true' );
			if(!empty($checked)){
				$checked = 'checked';
			}
		?>
			</div>
			<div style="width:40%;float:left">
				<?php
		echo '<label class="switch">';		
		echo ' <input type="checkbox" id="gall_show_hide" name="gall_show_hide" '.$checked.'  />';
		echo '<span class="slider round slider2"></span>';
		echo'</label>';
		?>
		</div>
			<br clear="all" />
		</div>
		<?php
		$meta_value_tagline = get_post_meta( $post->ID, 'listingproc_tagline', true );
		$checked = '';
		if($meta_value_tagline == 'true'){
			$checked = 'checked';
		}
		?>
		<div style="border-bottom: 1px solid #ccc;padding: 10px 0px;">
			<div style="width:60%;float:left">
				<label class="switch">
				<input <?php echo $checked; ?> type="checkbox" id="listingproc_tagline" name="listingproc_tagline" value="<?php echo wp_kses_post($meta_value_tagline); ?>" />
				<span class="slider round"></span>
				</label>
				<label for="listingproc_tagline"> <?php echo __('<b>Tagline</b>', 'listingpro-plugin'); ?></label>
				<?php
				$checked =get_post_meta( $post->ID, 'tagline_show_hide', 'true' );
					if(!empty($checked)){
						$checked = 'checked';
					}
				?>
			</div>
			<div style="width:40%;float:left">
				<?php
				echo '<label class="switch">';
				echo ' <input type="checkbox" id="tagline_show_hide" name="tagline_show_hide" '.$checked.'  />';
				echo '<span class="slider round slider2"></span>';
				echo'</label>';
				?>
			</div>
			<br clear="all" />
		</div>
		<div style="border-bottom: 1px solid #ccc;padding: 10px 0px;">
			<div style="width:60%;float:left">
		<?php
		$meta_value_location = get_post_meta( $post->ID, 'listingproc_location', true ); 
		$checked = '';
		if($meta_value_location == 'true'){
			$checked = 'checked';
		}
		?>
		<label class="switch">
		<input <?php echo $checked ?> type="checkbox" id="listingproc_location"  name="listingproc_location" value="<?php echo wp_kses_post($meta_value_location) ?>" />
		<span class="slider round"></span>
				</label>
		<label for="listingproc_location"> <?php echo __('<b>Location.</b>', 'listingpro-plugin'); ?></label>
		<?php
		$checked =get_post_meta( $post->ID, 'location_show_hide', 'true' );
			if(!empty($checked)){
				$checked = 'checked';
			}
			?>
			</div>
			<div style="width:40%;float:left">
				<?php
		echo '<label class="switch">';		
		echo ' <input type="checkbox" id="location_show_hide" name="location_show_hide" '.$checked.'  />';
		echo '<span class="slider round slider2"></span>';
		echo'</label>';
		?>
			</div>
			<br clear="all" />
		</div>
		<div style="border-bottom: 1px solid #ccc;padding: 10px 0px;">
			<div style="width:60%;float:left">
		<?php
		$meta_value_web = get_post_meta( $post->ID, 'listingproc_website', true ); 
		$checked = '';
		if($meta_value_web == 'true'){
			$checked = 'checked';
		}
		?>
		<label class="switch">
		<input <?php echo $checked ?> type="checkbox" id="listingproc_website" name="listingproc_website" value="<?php echo wp_kses_post($meta_value_web); ?>"/>
		<span class="slider round"></span>
				</label>
		<label for="listingproc_website"><?php echo __('<b>Website.</b>', 'listingpro-plugin'); ?></label>
		<?php
		$checked =get_post_meta( $post->ID, 'website_show_hide', 'true' );
			if(!empty($checked)){
				$checked = 'checked';
			}
			?>
			</div>
			<div style="width:40%;float:left">
				<?php
				echo '<label class="switch">';
		echo ' <input type="checkbox" id="website_show_hide" name="website_show_hide" '.$checked.'  />';
		echo '<span class="slider round slider2"></span>';
		echo'</label>';
		?>
			</div>
			<br clear="all" />
		</div>
		<div style="border-bottom: 1px solid #ccc;padding: 10px 0px;">
			<div style="width:60%;float:left">
		<?php
		$meta_value_social     = get_post_meta( $post->ID, 'listingproc_social', true );
		$checked = '';
		if($meta_value_social == 'true'){
			$checked = 'checked';
		}
		?>
		<label class="switch">
		<input <?php echo $checked ?> type="checkbox" id="listingproc_social" name="listingproc_social" value="<?php echo wp_kses_post($meta_value_social); ?>" />
		<span class="slider round"></span>
				</label>
		<label for="listingproc_social"><?php echo __('<b>Social Media links.</b>', 'listingpro-plugin'); ?></label>
		<?php
		$checked =get_post_meta( $post->ID, 'social_show_hide', 'true' );
			if(!empty($checked)){
				$checked = 'checked';
			}
			?>
			</div>
			<div style="width:40%;float:left">
				<?php
		echo '<label class="switch">';		
		echo ' <input type="checkbox" id="social_show_hide" name="social_show_hide" '.$checked.'  />';
		echo '<span class="slider round slider2"></span>';
		echo'</label>';
		?>
			</div>
			<br clear="all" />
		</div>
		<?php
		$meta_value_faq     = get_post_meta( $post->ID, 'listingproc_faq', true );
		$checked = '';
		if($meta_value_faq == 'true'){
			$checked = 'checked';
		}
		?>
		<div style="border-bottom: 1px solid #ccc;padding: 10px 0px;">
			<div style="width:60%;float:left">
				
				<label class="switch">
				<input <?php echo $checked ?> type="checkbox" id="listingproc_faq" name="listingproc_faq" value="<?php echo wp_kses_post($meta_value_faq); ?>" />
				<span class="slider round"></span>
				</label>
				<label for="listingproc_faq"><?php echo __('<b>FAQs list.</b>', 'listingpro-plugin'); ?></label>
			</div>
			<?php
			$checked =get_post_meta( $post->ID, 'faqs_show_hide', 'true' );
				if(!empty($checked)){
					$checked = 'checked';
				}
			?>
			<div style="width:40%;float:left">
				<?php
				echo '<label class="switch">';
				echo ' <input type="checkbox" id="faqs_show_hide" name="faqs_show_hide" '.$checked.'  />';
				echo '<span class="slider round slider2"></span>';
				echo'</label>';
				?>
			</div>
			<br clear="all" />
		</div>
		<div style="border-bottom: 1px solid #ccc;padding: 10px 0px;">
			<div style="width:60%;float:left">
		<?php
		$meta_value_price     = get_post_meta( $post->ID, 'listingproc_price', true );
		$checked = '';
		if($meta_value_price == 'true'){
			$checked = 'checked';
		}
		?>
		
		<label class="switch">
		<input <?php echo $checked ?> type="checkbox" id="listingproc_price" name="listingproc_price" value="<?php echo wp_kses_post($meta_value_price); ?>" />
		<span class="slider round"></span>
				</label>
		<label for="listingproc_price"><?php echo __('<b>Price Range.</b>', 'listingpro-plugin'); ?></label>
		<?php
		$checked =get_post_meta( $post->ID, 'price_show_hide', 'true' );
			if(!empty($checked)){
				$checked = 'checked';
			}
			?>
			</div>
			<div style="width:40%;float:left">
				<?php
		echo '<label class="switch">';			
		echo ' <input type="checkbox" id="price_show_hide" name="price_show_hide" '.$checked.'  />';
		echo '<span class="slider round slider2"></span>';
		echo'</label>';
		?>
			</div>
			<br clear="all" />
		</div>
		<div style="border-bottom: 1px solid #ccc;padding: 10px 0px;">
			<div style="width:60%;float:left">
		<?php
		$meta_value_tag_key     = get_post_meta( $post->ID, 'listingproc_tag_key', true );
		$checked = '';
		if($meta_value_tag_key == 'true'){
			$checked = 'checked';
		}
		?>
		<label class="switch">
		<input <?php echo $checked ?> type="checkbox" id="listingproc_tag_key" name="listingproc_tag_key" value="<?php echo wp_kses_post($meta_value_tag_key); ?>"/>
		<span class="slider round"></span>
				</label>
		<label for="listingproc_tag_key"><?php echo __('<b>Tags or Keywords.</b>', 'listingpro-plugin'); ?></label>
		<?php
		$checked =get_post_meta( $post->ID, 'tags_show_hide', 'true' );
			if(!empty($checked)){
				$checked = 'checked';
			}
		?>
		</div>
			<div style="width:40%;float:left">
				<?php
		echo '<label class="switch">';		
		echo ' <input type="checkbox" id="tags_show_hide" name="tags_show_hide" '.$checked.'  />';
		echo '<span class="slider round slider2"></span>';
		echo'</label>';
		?>
			</div>
			<br clear="all" />
		</div>
		<div style="border-bottom: 1px solid #ccc;padding: 10px 0px;">
			<div style="width:60%;float:left">
		<?php
		$meta_value_bhours     = get_post_meta( $post->ID, 'listingproc_bhours', true );
		$checked = '';
		if($meta_value_bhours == 'true'){
			$checked = 'checked';
		}
		?>
		<label class="switch">
		<input <?php echo $checked ?> type="checkbox" id="listingproc_bhours" name="listingproc_bhours" value="<?php echo wp_kses_post($meta_value_bhours); ?>" />
		<span class="slider round"></span>
				</label>
		<label for="listingproc_bhours"><?php echo __('<b>Business Hours.</b>', 'listingpro-plugin'); ?></label>

		<?php
		$checked =get_post_meta( $post->ID, 'bhours_show_hide', 'true' );
			if(!empty($checked)){
				$checked = 'checked';
			}
			?>
			</div>
			<div style="width:40%;float:left">
				<?php
		echo '<label class="switch">';		
		echo ' <input type="checkbox" id="bhours_show_hide" name="bhours_show_hide" '.$checked.'  />';
		echo '<span class="slider round slider2"></span>';
		echo'</label>';
		?>
			</div>
			<br clear="all" />
		</div>
		<div style="border-bottom: 1px solid #ccc;padding: 10px 0px;">
			<div style="width:60%;float:left">
		<?php
		/* for 2.0 */
		$meta_value_resurva     = get_post_meta( $post->ID, 'listingproc_plan_reservera', true );
		$checked = '';
		if($meta_value_resurva == 'true'){
			$checked = 'checked';
		}
		?>
		<label class="switch">
		<input <?php echo $checked ?> type="checkbox" id="listingproc_plan_reservera" name="listingproc_plan_reservera" value="<?php echo wp_kses_post($meta_value_resurva); ?>" />
		<span class="slider round"></span>
				</label>
		<label for="listingproc_plan_reservera"><?php echo __('<b>Reserva Booking.</b>', 'listingpro-plugin'); ?></label>

		<?php
		$checked =get_post_meta( $post->ID, 'reserva_show_hide', 'true' );
			if(!empty($checked)){
				$checked = 'checked';
			}
			?>
			</div>
			<div style="width:40%;float:left">
				<?php
		echo '<label class="switch">';		
		echo ' <input type="checkbox" id="reserva_show_hide" name="reserva_show_hide" '.$checked.'  />';
		echo '<span class="slider round slider2"></span>';
		echo'</label>';
		?>
			</div>
			<br clear="all" />
		</div>
		<div style="border-bottom: 1px solid #ccc;padding: 10px 0px;">
			<div style="width:60%;float:left">
		<?php
		$meta_value_timket     = get_post_meta( $post->ID, 'listingproc_plan_timekit', true );
		$checked = '';
		if($meta_value_timket == 'true'){
			$checked = 'checked';
		}
		?>
		<label class="switch">
		<input <?php echo $checked ?> type="checkbox" id="listingproc_plan_timekit" name="listingproc_plan_timekit" value="<?php echo wp_kses_post($meta_value_timket); ?>" />
		<span class="slider round"></span>
				</label>
		<label for="listingproc_plan_timekit"><?php echo __('<b>Timekit Booking.</b>', 'listingpro-plugin'); ?></label>

		<?php
		$checked =get_post_meta( $post->ID, 'timekit_show_hide', 'true' );
			if(!empty($checked)){
				$checked = 'checked';
			}
			?>
			</div>
			<div style="width:40%;float:left">
				<?php
		echo '<label class="switch">';		
		echo ' <input type="checkbox" id="timekit_show_hide" name="timekit_show_hide" '.$checked.'  />';
		echo '<span class="slider round slider2"></span>';
		echo'</label>';
		?>
			</div>
			<br clear="all" />
		</div>
		<div style="border-bottom: 1px solid #ccc;padding: 10px 0px;">
			<div style="width:60%;float:left">
		<?php
		$meta_value_menu     = get_post_meta( $post->ID, 'listingproc_plan_menu', true );
		$checked = '';
		if($meta_value_menu == 'true'){
			$checked = 'checked';
		}
		?>
		<label class="switch">
		<input <?php echo $checked ?> type="checkbox" id="listingproc_plan_menu" name="listingproc_plan_menu" value="<?php echo wp_kses_post($meta_value_menu); ?>" />
		<span class="slider round"></span>
				</label>
		<label for="listingproc_plan_menu"><?php echo __('<b>Menu.</b>', 'listingpro-plugin'); ?></label>

		<?php
		$checked =get_post_meta( $post->ID, 'menu_show_hide', 'true' );
			if(!empty($checked)){
				$checked = 'checked';
			}
			?>
			</div>
			<div style="width:40%;float:left">
				<?php
		echo '<label class="switch">';		
		echo ' <input type="checkbox" id="menu_show_hide" name="menu_show_hide" '.$checked.'  />';
		echo '<span class="slider round slider2"></span>';
		echo'</label>';
		?>
			</div>
			<br clear="all" />
		</div>
		<div style="border-bottom: 1px solid #ccc;padding: 10px 0px;">
			<div style="width:60%;float:left">
		<?php
		$meta_value_announcment     = get_post_meta( $post->ID, 'listingproc_plan_announcment', true );
		$checked = '';
		if($meta_value_announcment == 'true'){
			$checked = 'checked';
		}
		?>
		<label class="switch">
		<input <?php echo $checked ?> type="checkbox" id="listingproc_plan_announcment" name="listingproc_plan_announcment" value="<?php echo wp_kses_post($meta_value_announcment); ?>" />
		<span class="slider round"></span>
				</label>
		<label for="listingproc_plan_announcment"><?php echo __('<b>Announcement.</b>', 'listingpro-plugin'); ?></label>

		<?php
		$checked =get_post_meta( $post->ID, 'announcment_show_hide', 'true' );
			if(!empty($checked)){
				$checked = 'checked';
			}
			?>
			</div>
			<div style="width:40%;float:left">
				<?php
				echo '<label class="switch">';
		echo ' <input type="checkbox" id="announcment_show_hide" name="announcment_show_hide" '.$checked.'  />';
		echo '<span class="slider round slider2"></span>';
		echo'</label>';
		?>
			</div>
			<br clear="all" />
		</div>
		<div style="border-bottom: 1px solid #ccc;padding: 10px 0px;">
			<div style="width:60%;float:left">
		<?php
		$meta_value_deals     = get_post_meta( $post->ID, 'listingproc_plan_deals', true );
		$checked = '';
		if($meta_value_deals == 'true'){
			$checked = 'checked';
		}
		?>
		<label class="switch">
		<input <?php echo $checked ?> type="checkbox" id="listingproc_plan_deals" name="listingproc_plan_deals" value="<?php echo wp_kses_post($meta_value_deals); ?>" />
		<span class="slider round"></span>
				</label>
		<label for="listingproc_plan_deals"><?php echo __('<b>Deals, Offers, Discounts.</b>', 'listingpro-plugin'); ?></label>

		<?php
		$checked =get_post_meta( $post->ID, 'deals_show_hide', 'true' );
			if(!empty($checked)){
				$checked = 'checked';
			}
			?>
			</div>
			<div style="width:40%;float:left">
				<?php
		echo '<label class="switch">';		
		echo ' <input type="checkbox" id="deals_show_hide" name="deals_show_hide" '.$checked.'  />';
		echo '<span class="slider round slider2"></span>';
		echo'</label>';
		?>
			</div>
			<br clear="all" />
		</div>
		<div style="border-bottom: 1px solid #ccc;padding: 10px 0px;">
			<div style="width:60%;float:left">
		<?php
		$meta_value_campaigns    = get_post_meta( $post->ID, 'listingproc_plan_campaigns', true );
		$checked = '';
		if($meta_value_campaigns == 'true'){
			$checked = 'checked';
		}
		?>
		<label class="switch">
		<input <?php echo $checked ?> type="checkbox" id="listingproc_plan_campaigns" name="listingproc_plan_campaigns" value="<?php echo wp_kses_post($meta_value_campaigns); ?>" />
		<span class="slider round"></span>
				</label>
		
		<label for="listingproc_plan_campaigns"><?php echo __('<b>competitor campaigns</b> on Listing Detail Page', 'listingpro-plugin'); ?></label>
		<?php
		$checked =get_post_meta( $post->ID, 'metacampaign_show_hide', 'true' );
			if(!empty($checked)){
				$checked = 'checked';
			}
			?>
			</div>
			<div style="width:40%;float:left">
				<?php
		echo '<label class="switch">';		
		echo ' <input type="checkbox" id="metacampaign_show_hide" name="metacampaign_show_hide" '.$checked.'  />';
		echo '<span class="slider round slider2"></span>';
		echo'</label>';
		?>
			</div>
			<br clear="all" />
		</div>
		<div style="border-bottom: 1px solid #ccc;padding: 10px 0px; display:none">
			<div style="width:60%;float:left">
		<?php
		$lp_featured_imageplan    = get_post_meta( $post->ID, 'lp_featured_imageplan', true );
		$checked = '';
		if($lp_featured_imageplan == 'true'){
			$checked = 'checked';
		}
		?>
		<label class="switch">
		<input <?php echo $checked ?> type="checkbox" id="lp_featured_imageplan" name="lp_featured_imageplan" value="<?php echo wp_kses_post($lp_featured_imageplan); ?>" />
		<span class="slider round"></span>
				</label>
		<label for="lp_featured_imageplan"><?php echo __('<b>featured image</b> on Listing Detail Page', 'listingpro-plugin'); ?></label>
		<?php
		$checked =get_post_meta( $post->ID, 'featimg_show_hide', 'true' );
			if(!empty($checked)){
				$checked = 'checked';
			}
		?>
		</div>
			<div style="width:40%;float:left">
				<?php
		echo '<label class="switch">';		
		echo ' <input type="checkbox" id="featimg_show_hide" name="featimg_show_hide" '.$checked.'  />';
		echo '<span class="slider round slider2"></span>';
		echo'</label>';
		?>
			</div>
			<br clear="all" />
		</div>
		<!-- Custom Donate Option -->
		<div style="border-bottom: 1px solid #ccc;padding: 10px 0px;">
			<div style="width:60%;float:left">
		<?php
		$lp_donatebutton    = get_post_meta( $post->ID, 'lp_donatebutton', true );
		$checked = '';
		if($lp_donatebutton == 'true'){
			$checked = 'checked';
		}
		?>
		<label class="switch">
		<input <?php echo $checked ?> type="checkbox" id="lp_donatebutton" name="lp_donatebutton" value="<?php echo wp_kses_post($lp_donatebutton); ?>" />
		<span class="slider round"></span>
				</label>
		<label for="lp_donatebutton"><?php echo __('<b>Donate button', 'listingpro-plugin'); ?></label>
		<?php
		$checked =get_post_meta( $post->ID, 'donate_show_hide', 'true' );
			if(!empty($checked)){
				$checked = 'checked';
			}
			?>
			</div>
			<div style="width:40%;float:left">
				<?php
		echo '<label class="switch">';		
		echo '<input type="checkbox" id="donate_show_hide" name="donate_show_hide" '.$checked.'  />';
		echo '<span class="slider round slider2"></span>';
		echo'</label>';
		?>
			</div>
			<br clear="all" />
		</div>
		<!-- End Custom donate option -->
		<div style="border-bottom: 1px solid #ccc;padding: 10px 0px;">
			<div style="width:60%;float:left">
		<?php
		$lp_eventsplan    = get_post_meta( $post->ID, 'lp_eventsplan', true );
		$checked = '';
		if($lp_eventsplan == 'true'){
			$checked = 'checked';
		}
		?>
		<label class="switch">
		<input <?php echo $checked ?> type="checkbox" id="lp_eventsplan" name="lp_eventsplan" value="<?php echo wp_kses_post($lp_eventsplan); ?>" />
		<span class="slider round"></span>
				</label>
		<label for="lp_eventsplan"><?php echo __('<b>Events in listings', 'listingpro-plugin'); ?></label>
		<?php
		$checked =get_post_meta( $post->ID, 'events_show_hide', 'true' );
			if(!empty($checked)){
				$checked = 'checked';
			}
			?>
			</div>
			<div style="width:40%;float:left">
				<?php
		echo '<label class="switch">';		
		echo '<input type="checkbox" id="events_show_hide" name="events_show_hide" '.$checked.'  />';
		echo '<span class="slider round slider2"></span>';
		echo'</label>';
		?>
			</div>
			<br clear="all" />
		</div>
		
		<?php
		$lp_adswithplan    = get_post_meta( $post->ID, 'lp_ads_wih_plan', true );
		?>
		
		<input type="hidden" id="lp_ads_wih_plan" placeholder="5" name="lp_ads_wih_plan" value="<?php echo wp_kses_post($lp_adswithplan); ?>" />
		
		<?php
		wp_nonce_field( '', 'lp_metaplans_hidden' );
	}
	remove_action( 'save_post', 'plan_contact_box_save' );
	add_action( 'save_post', 'plan_contact_box_save_custom' );
	function plan_contact_box_save_custom( $post_id ) {
		if (!isset($_POST['lp_metaplans_hidden'])) {
			return;
		}
		$post_type = get_post_type($post_id);
		if ( "price_plan" != $post_type ){
			return;
		}
		if (!isset($_POST['lp_metaplans_hidden'])) {
			return;
		}
		else{
			/*  */
			
			if(isset($_POST["lp_ads_wih_plan"])){
				$freeads = $_POST["lp_ads_wih_plan"];
				if(!empty($freeads)){
					update_post_meta( $post_id, 'lp_ads_wih_plan', $freeads );
				}else{
					update_post_meta( $post_id, 'lp_ads_wih_plan', 0 );
				}
			}else{
				update_post_meta( $post_id, 'lp_ads_wih_plan', 0 );
			}
			
			if(isset($_POST["lp_eventsplan"])){
			update_post_meta( $post_id, 'lp_eventsplan', 'true' );
			}else{
			update_post_meta( $post_id, 'lp_eventsplan', 'false' );
			}

			//For custom donate button
			if(isset($_POST["lp_donatebutton"])){
			update_post_meta( $post_id, 'lp_donatebutton', 'true' );
			}else{
			update_post_meta( $post_id, 'lp_donatebutton', 'false' );
			}
			
			if(isset($_POST["lp_featured_imageplan"])){
			update_post_meta( $post_id, 'lp_featured_imageplan', 'true' );
			}else{
			update_post_meta( $post_id, 'lp_featured_imageplan', 'false' );
			}
			
			if(isset($_POST["listingproc_plan_campaigns"])){
			update_post_meta( $post_id, 'listingproc_plan_campaigns', 'true' );
			}else{
			update_post_meta( $post_id, 'listingproc_plan_campaigns', 'false' );
			}

			if(isset($_POST["listingproc_plan_deals"])){
			update_post_meta( $post_id, 'listingproc_plan_deals', 'true' );
			}else{
			update_post_meta( $post_id, 'listingproc_plan_deals', 'false' );
			}

			if(isset($_POST["listingproc_plan_timekit"])){
			update_post_meta( $post_id, 'listingproc_plan_timekit', 'true' );
			}else{
			update_post_meta( $post_id, 'listingproc_plan_timekit', 'false' );
			}

			if(isset($_POST["listingproc_plan_announcment"])){
			update_post_meta( $post_id, 'listingproc_plan_announcment', 'true' );
			}else{
			update_post_meta( $post_id, 'listingproc_plan_announcment', 'false' );
			}

			if(isset($_POST["listingproc_plan_menu"])){
			update_post_meta( $post_id, 'listingproc_plan_menu', 'true' );
			}else{
			update_post_meta( $post_id, 'listingproc_plan_menu', 'false' );
			}

			if(isset($_POST["listingproc_plan_reservera"])){
			update_post_meta( $post_id, 'listingproc_plan_reservera', 'true' );
			}else{
			update_post_meta( $post_id, 'listingproc_plan_reservera', 'false' );
			}


			/*  */

			if(isset($_POST["contact_show"])){
			update_post_meta( $post_id, 'contact_show', 'true' );
			}else{
			update_post_meta( $post_id, 'contact_show', 'false' );
			}
			
			if(isset($_POST["map_show"])){
			update_post_meta( $post_id, 'map_show', 'true' );
			}else{
			update_post_meta( $post_id, 'map_show', 'false' );
			}
			
			if(isset($_POST["video_show"])){
			update_post_meta( $post_id, 'video_show', 'true' );
			}else{
			update_post_meta( $post_id, 'video_show', 'false' );
			}
			
			if(isset($_POST["gallery_show"])){
			update_post_meta( $post_id, 'gallery_show', 'true' );
			}else{
			update_post_meta( $post_id, 'gallery_show', 'false' );
			}
			
			if(isset($_POST["gallery_show"])){
			update_post_meta( $post_id, 'gallery_show', 'true' );
			}else{
			update_post_meta( $post_id, 'gallery_show', 'false' );
			}
			
			
			if(isset($_POST["listingproc_tagline"])){
			update_post_meta( $post_id, 'listingproc_tagline', 'true' );
			}else{
			update_post_meta( $post_id, 'listingproc_tagline', 'false' );
			}
			
			if(isset($_POST["listingproc_location"])){
			update_post_meta( $post_id, 'listingproc_location', 'true' );
			}else{
			update_post_meta( $post_id, 'listingproc_location', 'false' );
			}
			
			if(isset($_POST["listingproc_website"])){
			update_post_meta( $post_id, 'listingproc_website', 'true' );
			}else{
			update_post_meta( $post_id, 'listingproc_website', 'false' );
			}
			
			if(isset($_POST["listingproc_social"])){
			update_post_meta( $post_id, 'listingproc_social', 'true' );
			}else{
			update_post_meta( $post_id, 'listingproc_social', 'false' );
			}
			
			if(isset($_POST["listingproc_faq"])){
			update_post_meta( $post_id, 'listingproc_faq', 'true' );
			}else{
			update_post_meta( $post_id, 'listingproc_faq', 'false' );
			}
			
			if(isset($_POST["listingproc_price"])){
			update_post_meta( $post_id, 'listingproc_price', 'true' );
			}else{
			update_post_meta( $post_id, 'listingproc_price', 'false' );
			}
			
			if(isset($_POST["listingproc_tag_key"])){
			update_post_meta( $post_id, 'listingproc_tag_key', 'true' );
			}else{
			update_post_meta( $post_id, 'listingproc_tag_key', 'false' );
			}
			
			if(isset($_POST["listingproc_bhours"])){
			update_post_meta( $post_id, 'listingproc_bhours', 'true' );
			}else{
			update_post_meta( $post_id, 'listingproc_bhours', 'false' );
			}
			
			/* for show hide checkbox */
			
			if(isset($_POST["contact_show_hide"])){
			update_post_meta( $post_id, 'contact_show_hide', 'true' );
			}else{
			update_post_meta( $post_id, 'contact_show_hide', '' );
			}
			
			if(isset($_POST["map_show_hide"])){
			update_post_meta( $post_id, 'map_show_hide', 'true' );
			}else{
			update_post_meta( $post_id, 'map_show_hide', '' );
			}
			
			if(isset($_POST["video_show_hide"])){
			update_post_meta( $post_id, 'video_show_hide', 'true' );
			}else{
			update_post_meta( $post_id, 'video_show_hide', '' );
			}
			
			if(isset($_POST["gall_show_hide"])){
			update_post_meta( $post_id, 'gall_show_hide', 'true' );
			}else{
			update_post_meta( $post_id, 'gall_show_hide', '' );
			}
			
			if(isset($_POST["tagline_show_hide"])){
			update_post_meta( $post_id, 'tagline_show_hide', 'true' );
			}else{
			update_post_meta( $post_id, 'tagline_show_hide', '' );
			}
			
			if(isset($_POST["location_show_hide"])){
			update_post_meta( $post_id, 'location_show_hide', 'true' );
			}else{
			update_post_meta( $post_id, 'location_show_hide', '' );
			}
			
			if(isset($_POST["website_show_hide"])){
			update_post_meta( $post_id, 'website_show_hide', 'true' );
			}else{
			update_post_meta( $post_id, 'website_show_hide', '' );
			}
			
			if(isset($_POST["social_show_hide"])){
			update_post_meta( $post_id, 'social_show_hide', 'true' );
			}else{
			update_post_meta( $post_id, 'social_show_hide', '' );
			}
			
			if(isset($_POST["faqs_show_hide"])){
			update_post_meta( $post_id, 'faqs_show_hide', 'true' );
			}else{
			update_post_meta( $post_id, 'faqs_show_hide', '' );
			}
			
			if(isset($_POST["price_show_hide"])){
			update_post_meta( $post_id, 'price_show_hide', 'true' );
			}else{
			update_post_meta( $post_id, 'price_show_hide', '' );
			}
			
			if(isset($_POST["tags_show_hide"])){
			update_post_meta( $post_id, 'tags_show_hide', 'true' );
			}else{
			update_post_meta( $post_id, 'tags_show_hide', '' );
			}
			
			if(isset($_POST["bhours_show_hide"])){
			update_post_meta( $post_id, 'bhours_show_hide', 'true' );
			}else{
			update_post_meta( $post_id, 'bhours_show_hide', '' );
			}
			
			if(isset($_POST["reserva_show_hide"])){
			update_post_meta( $post_id, 'reserva_show_hide', 'true' );
			}else{
			update_post_meta( $post_id, 'reserva_show_hide', '' );
			}
			
			if(isset($_POST["timekit_show_hide"])){
			update_post_meta( $post_id, 'timekit_show_hide', 'true' );
			}else{
			update_post_meta( $post_id, 'timekit_show_hide', '' );
			}
			
			if(isset($_POST["menu_show_hide"])){
			update_post_meta( $post_id, 'menu_show_hide', 'true' );
			}else{
			update_post_meta( $post_id, 'menu_show_hide', '' );
			}
			
			if(isset($_POST["announcment_show_hide"])){
			update_post_meta( $post_id, 'announcment_show_hide', 'true' );
			}else{
			update_post_meta( $post_id, 'announcment_show_hide', '' );
			}
			
			if(isset($_POST["deals_show_hide"])){
			update_post_meta( $post_id, 'deals_show_hide', 'true' );
			}else{
			update_post_meta( $post_id, 'deals_show_hide', '' );
			}
			
			if(isset($_POST["metacampaign_show_hide"])){
			update_post_meta( $post_id, 'metacampaign_show_hide', 'true' );
			}else{
			update_post_meta( $post_id, 'metacampaign_show_hide', '' );
			}
			
			if(isset($_POST["featimg_show_hide"])){
			update_post_meta( $post_id, 'featimg_show_hide', 'true' );
			}else{
			update_post_meta( $post_id, 'featimg_show_hide', '' );
			}
			
			
			if(isset($_POST["events_show_hide"])){
			update_post_meta( $post_id, 'events_show_hide', 'true' );
			}else{
			update_post_meta( $post_id, 'events_show_hide', '' );
			}

			//For custom donate button
			if(isset($_POST["donate_show_hide"])){
			update_post_meta( $post_id, 'donate_show_hide', 'true' );
			}else{
			update_post_meta( $post_id, 'donate_show_hide', '' );
			}
			
			/* end for show hide checkbox */
			
		}
	}	