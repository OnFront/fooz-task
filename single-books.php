

<?php


get_header(); ?>

<main id="site-content">
    <div class="container">
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('single__article'); ?>>
        
                <header class="single__header">
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

                    <?php 
                        if ( has_post_thumbnail() ) {
                            the_post_thumbnail('large');
                        }
                    ?>
                </header>
                
                <div class="single__content">
                    <?php 
                
                        $publish_date = get_the_date('d F Y');
                        if ( $publish_date ): ?>
                            <p><?php echo esc_html( $publish_date ); ?>
                        <?php endif; ?>
            
                        <?php
                        $genres = wp_get_post_terms( get_the_ID(), 'genre' );
                        if ( ! empty( $genres ) && ! is_wp_error( $genres ) ):
                            $genre_names = wp_list_pluck( $genres, 'name' ); 
                            ?>
                            <p><strong>Genre:</strong>
                                <?php echo esc_html( $genre_names[0] ); ?>
                        <?php endif;
                    ?>
                </div>
        
        </article>
        <?php
            endwhile;
        endif;
        ?>
    </div>
</main>

<?php get_footer(); ?>
