<?php
/*
Plugin Name: Ninja Team Slider/Showcase
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




function ntp_team_slider($atts,$content = null){
    ob_start();
    ?>
    <?php
//* The Query
    $ntp_query = new WP_Query( array (
        'post_type' => 'team_slider',
        'posts_per_page' => -1
    ) );
//* The Loop
    if ( $ntp_query->have_posts() ) { ?>
        <div id="ntp-slider" class="owl-carousel ntp-logo-slider">
            <?php while ( $ntp_query->have_posts() ): $ntp_query->the_post(); ?>
                <!-- CMB2 Repeat Start -->
                <?php
                $entries = get_post_meta( get_the_ID(), 'ntp_team_group', true );
                foreach ( (array) $entries as $key => $entry ) {
                    $img = $team_member = $company_url = $member_description = $member_name = '';
                    if ( isset( $entry['team_member'] ) ) {
                        $team_member = esc_html( $entry['team_member'] );
                    }
                    if ( isset( $entry['member_designation'] ) ) {
                        $member_designation= esc_html( $entry['member_designation'] );
                    }
                    if ( isset( $entry['member_description'] ) ) {
                        $member_description= esc_html( $entry['member_description'] );
                    }
                    if ( isset( $entry['member_name'] ) ) {
                        $member_name = esc_html( $entry['member_name'] );
                    }
                    if ( isset( $entry['company_url'] ) ) {
                        $company_url = esc_html( $entry['company_url'] );
                    }
                    if ( isset( $entry['image_id'] ) ) {
                        $img = wp_get_attachment_image( $entry['image_id'], 'share-pick', null, array(
                            'class' => 'thumb',
                        ) );
                    }
                    $caption = isset( $entry['image_caption'] ) ? wpautop( $entry['image_caption'] ) : '';
                    echo <<< EOT
                <div class="member-item">
                    <div class="member_thumb">$img</div>
                    <h4 class="member-title">$member_name</h4>
                    <p class="member-designation">$member_designation</p>
                    <p class="member-description">$member_description</p>
                    <ul class="member-social-icons">
                        <li>
                            <a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        </li>
                    </ul>
                </div>
EOT;
                }
                ?>
                <!-- CMB2 Repeat END -->
            <?php endwhile; ?>
        </div>
        <?php wp_reset_postdata(); }  ?>

    <?php
    return ob_get_clean();
}
add_shortcode('team_slider','ntp_team_slider');


// Add plugin js and css files
function ntp_enqueue_scripts(){
wp_enqueue_style('main-style', plugins_url('assets/css/ntp-style.css', __FILE__ ), '1.0', false);
wp_enqueue_style('owl.css', plugins_url('assets/css/owl.carousel.css', __FILE__ ), '1.0', false);
wp_enqueue_style('owl.transitions.css', plugins_url('assets/css/owl.transitions.css', __FILE__ ), '1.0', false);
wp_enqueue_style('owl.theme.css', plugins_url('assets/css/owl.theme.css', __FILE__ ),'1.0', false);
wp_enqueue_script('owl-js', plugins_url('assets/js/owl.carousel.min.js', __FILE__ ), array('jquery'),'1.0', true);
wp_enqueue_script('main-js', plugins_url('assets/js/ntp-plugin.js', __FILE__ ), array('jquery'),'1.0', true);
}
add_action('wp_enqueue_scripts','ntp_enqueue_scripts');





