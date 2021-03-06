<?php
/*
Plugin Name: FP Team Slider
Plugin URI:  https://developer.wordpress.org/plugins/the-basics/
Description: Most advanced team slider on the universe to display team members.
Version:     1.0
Author:      furiousplugin
Author URI:  furiousplugin.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

//include CMB2 Metabox
if ( file_exists( __DIR__ . '/cmb2/init.php' ) ) {
  require_once __DIR__ . '/cmb2/init.php';
} elseif ( file_exists(  __DIR__ . '/CMB2/init.php' ) ) {
  require_once __DIR__ . '/CMB2/init.php';
}

//include plugin function

if ( is_admin() ){
	require_once dirname(__FILE__) . '/includes/functions.php';
}



function fp_team_slider_shortcode($atts,$content = null){
	ob_start();
    ?>
    <?php
// The Query
    $ntp_query = new WP_Query( array (
        'post_type' => 'fp_team_slider',
        'posts_per_page' => -1
    ) );
//* The Loop
    if ( $ntp_query->have_posts() ) { ?>
        <div id="fp-team-slider" class="owl-carousel fp-logo-slider">
            <?php while ( $ntp_query->have_posts() ): $ntp_query->the_post(); ?>
            <?php $entries = get_post_meta( get_the_ID(), 'fp_team_group', true );
                foreach ($entries as $entry ) : ?>

                    <div class="fp-member-item">
                        <div class="member_thumb"><img src="<?php  echo $entry['member_image']; ?>" alt=""></div>
                        <h4 class="member-title"><?php  echo $entry['member_name']; ?></h4>
                        <p class="member-designation"><?php  echo $entry['member_designation']; ?></p>
                        <p class="member-description"><?php  echo $entry['member_description']; ?></p>
                    </div>
                    <?php endforeach; ?>
                <!-- CMB2 Repeat END -->
            <?php endwhile; ?>
        </div>
        <?php wp_reset_postdata(); }  ?>

    <?php
    return ob_get_clean();
}
add_shortcode('fp_team_slider','fp_team_slider_shortcode');


// Add plugin js and css files
function ntp_enqueue_scripts(){
// Add plugin js and css files
wp_enqueue_style('main-style', plugins_url('assets/css/fp-team-style.css', __FILE__ ), '1.0', false);
wp_enqueue_style('owl.css', plugins_url('assets/css/owl.carousel.css', __FILE__ ), '1.0', false);
wp_enqueue_style('owl.transitions.css', plugins_url('assets/css/owl.transitions.css', __FILE__ ), '1.0', false);
wp_enqueue_style('owl.theme.css', plugins_url('assets/css/owl.theme.css', __FILE__ ),'1.0', false);
wp_enqueue_script('owl-js', plugins_url('assets/js/owl.carousel.min.js', __FILE__ ), array('jquery'),'1.0', true);

wp_enqueue_script('main-js', plugins_url('assets/js/fp-team-plugin.js', __FILE__ ), array('jquery'),'1.0', true);
}
add_action('wp_enqueue_scripts','ntp_enqueue_scripts');