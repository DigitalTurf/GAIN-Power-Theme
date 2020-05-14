<?php
/*------------------------------------------------------*/
/* Blog Grid Shortcode Override
/*------------------------------------------------------*/

function listingpro_shortcode_blog_grids_custom($atts, $content = null) {
    extract(shortcode_atts(array(
        'blog_style'   => 'style1',
        'category'   => '',
        'blog_per_page' => '3',
    ), $atts));

    $output = null;
    $post_count = 1;
    $output .= '<div class="lp-section-content-container lp-blog-grid-container row">';

    $type = 'post';
    $args = array(
        'post_type' => $type,
        'post_status' => 'publish',
        'posts_per_page' => "$blog_per_page",
        'cat' => $category,
    );

    $my_query = null;
    $my_query = new WP_Query($args);

    if ( $my_query->have_posts() ) {
        while ($my_query->have_posts()) : $my_query->the_post();
            $imgurl = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'listingpro-blog-grid');
            if($imgurl){
                $thumbnail = $imgurl[0];
            }else{
                $thumbnail = 'https://via.placeholder.com/372x240';
            }
            $display_category = 'Advice';
            $category_meta = listing_get_metabox('lp_post_label');
            if(!empty($category_meta)){
                $display_category = $category_meta;
            }

            $author_avatar_url = get_user_meta(get_the_author_meta( 'ID' ), "listingpro_author_img_url", true);
            $avatar ='';
            if (!empty($author_avatar_url)) {
                $avatar =  $author_avatar_url;
            } else {
                $avatar_url = listingpro_get_avatar_url (get_the_author_meta( 'ID' ), $size = '51' );
                $avatar =  $avatar_url;
            }
            $exc_length = 150;
            $excerpt = get_the_excerpt();
            $end = (strlen($excerpt) > $exc_length) ? '...':'';
            $excerpt = substr($excerpt, 0, $exc_length);
            $finalexcerpt = substr($excerpt, 0, strrpos($excerpt, ' '));

            $output .= '<div class="col-md-4 col-sm-4 lp-blog-grid-box">
                                <div class="lp-blog-grid-box-container lp-border">
                                    <div class="lp-blog-grid-box-thumb">
                                        <a href="'.get_the_permalink().'">
                                            <img src="'.$thumbnail.'" alt="blog-grid-1-410x308" />
                                        </a>
                                    </div>
                                    <div class="lp-blog-category">
                                        '.$display_category.'
                                    </div>
                                    <div class="lp-blog-grid-box-description text-center">
                                            <div class="lp-blog-grid-title">
                                                <h4 class="lp-h4">
                                                    <a href="'.get_the_permalink().'">'.get_the_title().'</a>
                                                </h4>
                                            </div>
                                            <div class="lp-blog-grid-excerpt">'. $finalexcerpt .'...</div>
                                    </div>
                                </div>
                            </div>';

						if($post_count==3){
							$output .='<div class="clearfix"></div>';
							$post_count=1;
						}
						else{
							$post_count++;
						}
        endwhile;
    }
    $output .= '</div>';
    return $output;
}

add_shortcode('blog_grids_custom', 'listingpro_shortcode_blog_grids_custom');
