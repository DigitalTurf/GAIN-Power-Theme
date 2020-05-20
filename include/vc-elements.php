<?php
/*------------------------------------------------------*/
/* Custom  Listing Categories Display
/*------------------------------------------------------*/
$args = array(
    'post_type' => 'listing',
    'order' => 'ASC',
    'hide_empty' => false,
    'parent' => 0,
);
$categories = get_terms('listing-category', $args);

$values = array();
foreach($categories as $category) {
    $values[esc_html__( $category->name, 'js_composer' )] = $category->slug;
}

vc_map( array(
    "name"                      => esc_html__("GainPower Listing Categories", "js_composer"),
    "base"                      => 'gp_categories',
    "category"                  => esc_html__('Gain Power', 'js_composer'),
    "description"               => 'Custom listing categories display',
    "params"                    => array(
        array(
            "type"        => "checkbox",
            "class"       => "",
            "heading"     => esc_html__("Categories","js_composer"),
            "param_name"  => "gp_categories",
            "value"       => $values,
            "description" => ""
        ),
    ),
) );
function gp_shortcode_categories($atts) {
    extract(shortcode_atts(array(
        'gp_categories'      => '',
    ), $atts));
    if($gp_categories !== ''){
        $gp_categories = explode(',', $gp_categories);
    }else{
        // Gets all categories if none are selected
        $args = array(
            'post_type' => 'listing',
            'order' => 'ASC',
            'hide_empty' => false,
            'parent' => 0,
        );
        $categories = get_terms('listing-category', $args);
        $value = '';
        $i = 0;
        $len = count($categories);
        foreach($categories as $category){
            $value .= $category->slug;
            if($i !== $len-1){
                $value .= ',';
            }
            $i++;
        }
        $gp_categories = explode(',', $value);
    }

    ob_start(); ?>

    <div class="gp-categories-masonry">
        <?php $i = 1; $j = 0; $len = count($gp_categories); foreach($gp_categories as $slug){
            $args = array(
                'post_type' => 'listing',
                'hide_empty' => false,
                'slug' => $slug
            );
            $category = get_terms('listing-category', $args);
            $id = $category[0]->term_id;

            // Ensures the loop continues if a category is invalid
            if(!$id){
                $j++; $i++;
                continue;
            }
            $image = listingpro_get_term_meta($id, 'lp_category_banner');
            
            $col = 'col-sm-4';
            if($i === 11){
                $i = 1;
            }

            if($i === 1 || $i === 7){
                $col = 'col-sm-8';
            }

            $rowStart = false;
            if($i === 1 || $i === 3 || $i === 6 || $i === 8){
                $rowStart = true;
            }

            $rowEnd = false;
            if($i === 2 || $i === 5 || $i === 7 || $i === 10 || $j === $len-1 ){
                $rowEnd = true;
            }
        ?>
            <?php if($rowStart){ ?><div class="row"><?php } ?>
            <div class="<?php echo $col; ?> gp-masonry-col">
                <a href="<?php echo site_url() . '/listing-category/' . $slug . '/' ?>">
                    <div class="content" style="background-image: url('<?php echo $image; ?>')">
                        <div class="table">
                            <div class="cell-center">
                                <div class="darken"></div>
                                <h3><?php echo $category[0]->name; ?></h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php if($rowEnd){echo '</div>';} $i++; $j++; } ?>
    </div>

    <?php return ob_get_clean();
}
add_shortcode('gp_categories', 'gp_shortcode_categories');