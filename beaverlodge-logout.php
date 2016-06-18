<?php
/*
Plugin Name: Beaverlodge Logout Menu
Plugin URI: https://beaverlodgehq.com
Description: Add a Login/Logout Link to your menu
Version: 1.0.0
Author: Beaverlodge
Author URI: https://beaverlodgehq.com
Text Domain: beaverlodge
*/


function beaverlodge_loginout_link( $items, $args ) {
    $menu = get_theme_mod( 'logout_menu', 'bar' );
    if (is_user_logged_in() && $args->theme_location == $menu) {
        $items .= '<li><a href="'. wp_logout_url() .'">Log Out</a></li>';
    }
    elseif (!is_user_logged_in() && $args->theme_location == $menu) {
        $items .= '<li><a href="'. site_url('wp-login.php') .'">Log In</a></li>';
    }
    return $items;
}
add_filter( 'wp_nav_menu_items', 'beaverlodge_loginout_link', 10, 2 );

function beaverlodge_logout_register( $wp_customize ) {
    $wp_customize->add_setting( 
        'logout_menu', array(
        'default' => 'bar',
    ) );
    $wp_customize->add_control( 
        'logout_menu', array(
            'type' => 'select',
            'section' => 'menu_locations',
            'label' => __( 'Login/Logout Menu' ),
            'choices' => get_registered_nav_menus(),
            'description' => __( 'Choose the menu to have the logout/login link display' ),
    ) );
}
add_action( 'customize_register', 'beaverlodge_logout_register' );