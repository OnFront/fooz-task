<?php

class BooksAjaxHandler {

    public function __construct() {
        add_action('wp_ajax_get_books', [$this, 'get_books_callback']);
        add_action('wp_ajax_nopriv_get_books', [$this, 'get_books_callback']);
    }

    public function get_books_callback() {
        $args = [
            'post_type' => 'books',
            'posts_per_page' => 20,
        ];

        $query = new WP_Query($args);
        $books = [];

        if ($query->have_posts()) {

            while ($query->have_posts()) {
                $query->the_post();
                
                $genres = wp_get_post_terms(get_the_ID(), 'genre', ['fields' => 'names']);

                $books[] = [
                    'name' => get_the_title(),
                    'date' => get_the_date('Y-m-d'),
                    'genre' => !empty($genres) ? $genres[0] : 'no genre specified',
                    'excerpt' => get_the_excerpt(),
                ];
            }
            wp_reset_postdata();
        }

        wp_send_json($books);
    }
}

new BooksAjaxHandler();