<?php get_header(); ?>

<div class="container">
    <?php if (have_posts()) : ?>
        <header class="archive__header">
            <h1 class="archive__header-title"><?php single_term_title(); ?></h1>
            <p><?php echo term_description(); ?></p>
        </header>

        <div class="archive__book-listing">
            <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $args = array(
                'post_type' => 'books',
                'posts_per_page' => 5,
                'paged' => $paged,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'genre',
                        'field'    => 'slug',
                        'terms'    => get_queried_object()->slug,
                    ),
                ),
            );

            $query = new WP_Query($args);
            while ($query->have_posts()) : $query->the_post();
               get_template_part('templates/single-book', 'content', $args = array( 'post_id' => get_the_ID()));
           endwhile; ?>
        </div>

        <div class="pagination">
            <?php
            echo paginate_links(array(
                'total' => $query->max_num_pages,
                'prev_text' => __('« Previous'),
                'next_text' => __('Next »'),
            ));
            ?>
        </div>

        <?php wp_reset_postdata(); ?>

    <?php else : ?>
        <p><?php _e('No books found in this genre.', TEXT_DOMAIN); ?></p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
