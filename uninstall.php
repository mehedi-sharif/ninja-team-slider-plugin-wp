<?php 
// if uninstall.php is not called by WordPress, die
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}
 
<<<<<<< HEAD
$option_name = 'ntp-option';
=======
$option_name = 'wporg_option';
>>>>>>> e76fc0643e774b46ec28298ea94f6d7e114fbb53
 
delete_option($option_name);
 
// for site options in Multisite
delete_site_option($option_name);
 
// drop a custom database table
global $wpdb;
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}mytable");