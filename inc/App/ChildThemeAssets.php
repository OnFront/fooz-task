<?php
namespace App\ChildThemeAssets;

class ChildThemeAssets {
    
    public function __construct() {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_styles_and_scripts'));
    }

    public function enqueue_styles_and_scripts() {
        wp_enqueue_style(
            'twentytwentyone-parent-style', 
            get_template_directory_uri() . '/style.css'
        );

        wp_enqueue_style(
            'twentytwentyone-child-style', 
            get_stylesheet_directory_uri() . '/style.css', 
            array('twentytwentyone-parent-style'), 
            wp_get_theme()->get('Version')
        );

        wp_enqueue_script(
            'twentytwentyone-child-scripts',
            get_stylesheet_directory_uri() . '/assets/js/scripts.js', 
            array('jquery'), 
            null, 
            true 
        );

        wp_localize_script('twentytwentyone-child-scripts', 'ajax_obj', [
            'ajax_url' => admin_url('admin-ajax.php'),
        ]);
    }
}

new ChildThemeAssets();