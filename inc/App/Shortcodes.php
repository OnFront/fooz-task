<?php

class Shortcodes {
    public function __construct() {
        add_shortcode('recent_book_title', array($this, 'recent_book_title_shortcode'));
        add_shortcode('books', array($this, 'books_from_genre_shortcode'));
    }

    public function recent_book_title_shortcode() {
        $args = array(
            'post_type'      => 'books',
            'posts_per_page' => 1,
            'orderby'        => 'date',
            'order'          => 'DESC',
        );

        $query = new WP_Query($args);
        $title = '';

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $title .= '<h2 class="recent-book">' . get_the_title() . '</h2>';
            }
            wp_reset_postdata();
        }

        return $title ? $title : __('No books available.', TEXT_DOMAIN);
    }


    public function books_from_genre_shortcode($atts) {
        $shortcode_atts = shortcode_atts(array(
            'term_id' => '',
        ), $atts, 'books');

        if (empty($shortcode_atts['term_id'])) {
            return __('Please specify a genre term ID.', TEXT_DOMAIN);
        }
  
        $args = array(
            'post_type'      => 'books',
            'posts_per_page' => 5,
            'orderby'        => 'title',
            'order'          => 'ASC',
            'tax_query'      => array(
                array(
                    'taxonomy' => 'genre',
                    'field'    => 'term_id',
                    'terms'    => intval($shortcode_atts['term_id']),
                ),
            ),
        );
    
        $query = new WP_Query($args);
        $output = '<ul>';
    
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $output .= '<li>' . get_the_title() . '</li>';
            }
            wp_reset_postdata();
        } else {
            $output .= '<li>' . __('No books found.', TEXT_DOMAIN) . '</li>';
        }
    
        $output .= '</ul>';
    
        return $output;

    }
}

new Shortcodes();



