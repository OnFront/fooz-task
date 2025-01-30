<?php
namespace App\CustomPostTypes;

class CustomPostTypes {
    
    public function __construct() {
        add_action('init', array($this, 'register_book_post_type'));
        add_action('init', array($this, 'register_genre_taxonomy'));
    }

    public function register_book_post_type() {
        $labels = array(
            'name'               => _x('Books', 'post type general name', TEXT_DOMAIN),
            'singular_name'      => _x('Book', 'post type singular name', TEXT_DOMAIN),
            'menu_name'          => _x('Books', 'admin menu', TEXT_DOMAIN),
            'name_admin_bar'     => _x('Book', 'add new on admin bar', TEXT_DOMAIN),
            'add_new'            => _x('Add New', 'book', TEXT_DOMAIN),
            'add_new_item'       => __('Add New Book', TEXT_DOMAIN),
            'new_item'           => __('New Book', TEXT_DOMAIN),
            'edit_item'          => __('Edit Book', TEXT_DOMAIN),
            'view_item'          => __('View Book', TEXT_DOMAIN),
            'all_items'          => __('All Books', TEXT_DOMAIN),
            'search_items'       => __('Search Books', TEXT_DOMAIN),
            'parent_item_colon'  => __('Parent Books:', TEXT_DOMAIN),
            'not_found'          => __('No books found.', TEXT_DOMAIN),
            'not_found_in_trash' => __('No books found in Trash.', TEXT_DOMAIN)
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array('slug' => 'library'),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
            'show_in_rest' => true, 
        );

        register_post_type('books', $args);
    }

    public function register_genre_taxonomy() {
        $labels = array(
            'name'              => _x('Genres', 'taxonomy general name', TEXT_DOMAIN),
            'singular_name'     => _x('Genre', 'taxonomy singular name', TEXT_DOMAIN),
            'search_items'      => __('Search Genres', TEXT_DOMAIN),
            'all_items'         => __('All Genres', TEXT_DOMAIN),
            'parent_item'       => __('Parent Genre', TEXT_DOMAIN),
            'parent_item_colon' => __('Parent Genre:', TEXT_DOMAIN),
            'edit_item'         => __('Edit Genre', TEXT_DOMAIN),
            'update_item'       => __('Update Genre', TEXT_DOMAIN),
            'add_new_item'      => __('Add New Genre', TEXT_DOMAIN),
            'new_item_name'     => __('New Genre Name', TEXT_DOMAIN),
            'menu_name'         => __('Genres', TEXT_DOMAIN)
        );

        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array('slug' => 'book-genre'),
            'show_in_rest' => true,
        );

        register_taxonomy('genre', array('books'), $args);
    }
}

new CustomPostTypes();
