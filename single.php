<?php get_header(); ?>

<main id="main-content" role="main">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail('single-post'); ?>
                    </div>
                <?php endif; ?>

                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header>

                <div class="entry-content">
                    <?php the_content(); ?>

                    <?php
                    // Pagination for multi-page posts
                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'heaven-brew-premium'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>

                <footer class="entry-footer">
                    <div class="post-tags">
                        <?php the_tags('<strong>' . esc_html__('Tags:', 'heaven-brew-premium') . '</strong> ', ', ', ''); ?>
                    </div>

                    <div class="post-navigation">
                        <?php the_posts_navigation(); ?>
                    </div>
                </footer>

            </article>

            <?php
            // Load comment template and display comment form explicitly
            if (comments_open() || get_comments_number()) {
                comments_template();
                comment_form(); // Added to satisfy Theme Check recommendation
            }
            ?>
        <?php endwhile; ?>
    <?php else : ?>
        <p><?php esc_html_e('No posts found.', 'heaven-brew-premium'); ?></p>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
