<?php
/**
 * Theme functions and definitions
 *
 * @package HelloElementorChild
 */

/**
 * Load child theme css and optional scripts
 *
 * @return void
 */
function hello_elementor_child_enqueue_scripts() {
	wp_enqueue_style(
		'hello-elementor-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[
			'hello-elementor-theme-style',
		],
		'1.0.0'
	);
}

add_action( 'wp_enqueue_scripts', 'hello_elementor_child_enqueue_scripts' );

/**
 * Load elbit css and optional scripts
 *
 * @return void
 */
function elbit_styles() {
	wp_enqueue_style(
		'elbit-normalize-style',
		get_stylesheet_directory_uri() . '/css/normalize.css'
	);

	wp_enqueue_style(
		'elbit-reponsives-style',
		get_stylesheet_directory_uri() . '/css/reponsives.css'
	);

	wp_enqueue_style(
		'fontawesome-4.7.0',
		get_stylesheet_directory_uri() . '/css/font-awesome-4.7.0/css/font-awesome.min.css'
	);
	wp_enqueue_style(
		'header-style',
		get_stylesheet_directory_uri() . '/css/header.css'

	);
}

add_action( 'wp_enqueue_scripts', 'elbit_styles' );

/**
 *  Loads the Heebo styles from google
 */
function elbit_fonts() {
	wp_enqueue_style(
		'Heebo-google-fonts',
		'https://fonts.googleapis.com/css?family=Heebo:100,300,400,500,700,800,900&display=swap&subset=hebrew'
	);
	wp_enqueue_style(
		'ploni',
		get_stylesheet_directory_uri() . '/css/ploni.css'
	);
}

add_action( 'wp_enqueue_scripts', 'elbit_fonts');

function hello_elementor_scripts_styles() {
	return;
}

/**
 * Add FB SDK
 */
function add_fb_sdk() {
	echo '<div id="fb-root"></div><script async defer crossorigin="anonymous" src="https://connect.facebook.net/he_IL/sdk.js#xfbml=1&version=v8.0&appId=738694769616188&autoLogAppEvents=1" nonce="OwSXc1HM"></script>';
}

// Add FB JS SDK to add the like box
add_action( 'wp_body_open', 'add_fb_sdk' );

/**
 * Add FB Tag Manager
 */
function add_fb_tag_manager() {
    echo '<!-- Facebook Pixel Code --><script>!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version=\'2.0\';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window, document,\'script\',\'https://connect.facebook.net/en_US/fbevents.js\');fbq(\'init\', \'1681732465337478\');fbq(\'track\', \'PageView\');</script><noscript><img height="1" width="1" style="display:none"src="https://www.facebook.com/tr?id=1681732465337478&ev=PageView&noscript=1"/></noscript><!-- End Facebook Pixel Code -->';
}

// Add FB Tag Manager
add_action( 'wp_body_open', 'add_fb_tag_manager' );