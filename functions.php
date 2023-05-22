<?php

function launcher_setup_theme() {
    load_theme_textdomain( 'launcher' );
    add_theme_support( 'post-thumbnails' );
}

add_action( 'after_setup_theme', 'launcher_setup_theme' );