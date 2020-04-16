<div class="lp-search-bar lp-search-bar-header">
	<form autocomplete="off" class="form-inline" action="<?php echo home_url(); ?>" method="get" accept-charset="UTF-8">

		<div class="form-group lp-suggested-search no-whitespace">
			<div class="pos-relative">
				<div class="what-placeholder pos-relative" data-holder="">
					<input type="text" id="lp_t_search" name="lp_t_search" placeholder="What are you looking for?" class="search-bar-home">
				</div>
			</div>
		</div>
		<div class="form-group search-switcher  no-whitespace">
			<div class="pos-relative">
				<div class="what-placeholder pos-relative" data-holder="">
					<select id="home-search-switcher">
						<option value="everything" selected>Everything</option>
						<option value="directory">Directory</option>
						<option value="network">Network</option>
						<option value="job">Job</option>
					</select>
				</div>
			</div>
		</div>
		<div class="form-group pull-right search-hide no-whitespace">
			<div class="lp-search-bar-right">
				<input value="<?php echo esc_html__( 'Search', 'listingpro' );?>" class="lp-search-btn" type="submit">
				<i class="icons8-search lp-search-icon"></i>
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/ellipsis.gif" class="searchloading">
			</div>
		</div>
		<input type="hidden" name="lp_s_tag" id="lp_s_tag">
		<input type="hidden" name="lp_s_cat" id="lp_s_cat">
		<input type="hidden" name="s" value="home">
		<input type="hidden" name="post_type" value="listing">
	</form>
</div>
