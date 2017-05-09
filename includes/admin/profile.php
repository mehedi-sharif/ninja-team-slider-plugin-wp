<?php 

function socila_media_bio($methods) {
	$methods['twitter'] = __('twitter','furioustheme'); 
	$methods['facebook'] = __('facebook','furioustheme'); 
	$methods['linkedin'] = __('linkedin','furioustheme'); 
	$methods['sona chachr'] = __('sona chach','furioustheme'); 
	return $methods;
}
add_filter('user_contactmethods','socila_media_bio');