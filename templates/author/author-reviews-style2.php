<?php



if( isset($GLOBALS['listID']) )
{
    ?>
    <div class="lp-listing-reviews">
        <?php
        listingpro_get_all_reviews_v2($GLOBALS['listID']);
        ?>
    </div>
    <?php
}
else
{
    $type = 'listing';
    global $paged;
    $args = array(
        'post_type' => $type,
        'post_status' => 'publish',
        'posts_per_page' => 1,
        'order' => 'ASC',
        'author' => $GLOBALS['authorID'],
    );



    $my_query = null;
    $my_query = new WP_Query($args);
    if ($my_query->have_posts()):while ($my_query->have_posts()) : $my_query->the_post();
        ?>
        <div class="lp-listing-reviews">
            <?php
            listingpro_get_all_reviews_v2($post->ID);
            ?>
        </div>
    <?php endwhile;
        wp_reset_postdata(); endif; ?>
    <?php
}
    ?>

