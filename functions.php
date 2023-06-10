<?php

function launcher_setup_theme() {
	load_theme_textdomain( 'launcher' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
}

add_action( 'after_setup_theme', 'launcher_setup_theme' );

function launcher_assets() {

	if ( is_page() ) {
		$launcher_template_name = basename( get_page_template() );
		if ( $launcher_template_name == 'launcher.php' ) {
			wp_enqueue_style( 'animate', get_theme_file_uri( '/assets/css/animate.css' ) );
			wp_enqueue_style( 'icomoon', get_theme_file_uri( '/assets/css/icomoon.css' ) );
			wp_enqueue_style( 'bootstrap', get_theme_file_uri( '/assets/css/bootstrap.css' ) );
			wp_enqueue_style( 'theme-style', get_theme_file_uri( '/assets/css/style.css' ) );
			wp_enqueue_style( 'launcher', get_stylesheet_uri() );

			wp_enqueue_script( 'jquery-easing', get_template_directory_uri() . '/assets/js/jquery.easing.1.3.js', array( 'jquery' ), null, true );
			wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ), null, true );
			wp_enqueue_script( 'waypoints', get_template_directory_uri() . '/assets/js/jquery.waypoints.min.js', array( 'jquery' ), null, true );
			wp_enqueue_script( 'countdown', get_template_directory_uri() . '/assets/js/simplyCountdown.js', array( 'jquery' ), null, true );
			wp_enqueue_script( 'main-js', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), null, true );

			$launcher_year  = get_post_meta( get_the_ID(), 'year', true );
			$launcher_month = get_post_meta( get_the_ID(), 'month', true );
			$launcher_day   = get_post_meta( get_the_ID(), 'day', true );

			wp_localize_script( 'main-js', 'datedata', array(
				"year"  => $launcher_year,
				"month" => $launcher_month,
				"day"   => $launcher_day,
			) );
		} else {
			wp_enqueue_style( 'bootstrap', get_theme_file_uri( '/assets/css/bootstrap.css' ) );
			wp_enqueue_style( 'launcher', get_stylesheet_uri() );
			wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ), null, true );


		}
	}


}

add_action( 'wp_enqueue_scripts', 'launcher_assets' );


function launcher_widgets() {
	register_sidebar( array(
		'name'          => __( 'Footer Left', 'launcher' ),
		'id'            => 'footer-left',
		'description'   => __( 'Footer left widget', 'launcher' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Right', 'launcher' ),
		'id'            => 'footer-right',
		'description'   => __( 'Footer right widget', 'launcher' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}

add_action( 'widgets_init', 'launcher_widgets' );

function launcher_custom_styles() {
	if ( is_page() ) {
		$thumbnail_url = get_the_post_thumbnail_url( null, "large" );
		?>
        <style>
            .home-side {
                background-image: url(<?php echo $thumbnail_url; ?>);
            }
        </style>
		<?php
	}
}

add_action( 'wp_head', 'launcher_custom_styles' );