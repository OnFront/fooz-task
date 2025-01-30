<?php
$post_id = isset($args['post_id']) ? $args['post_id'] : null;

if($post_id): ?>
    <article id="post-<?php $post_id; ?>" <?php post_class('archive__article'); ?>>
        <?php echo get_the_post_thumbnail($post_id, array(200, 300)); ?>
        <h2 class="archive__article-title"><a href="<?php the_permalink($post_id); ?>"><?php echo get_the_title($post_id); ?></a></h2>
    </article>
<?php endif; ?>