<?php if ( have_comments() ) : ?>
    <h2 class="comments-title">
        <?php
            printf( _nx( 'One comment', '%1$s comments', get_comments_number(), 'comments title', 'heaven-brew-premium' ),
                number_format_i18n( get_comments_number() ) );
        ?>
    </h2>
    <ol class="comment-list">
        <?php
            wp_list_comments( array(
                'style' => 'ol',
                'short_ping' => true,
            ) );
        ?>
    </ol>

    <?php
        paginate_comments_links();  
    ?>
<?php endif; ?>
