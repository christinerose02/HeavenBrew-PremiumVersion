<div class="footer-container">
    <footer class="site-footer">
        <p class="footer-text">&copy; <?php echo date('Y'); ?> 
            <?php echo esc_html(get_theme_mod('heaven-brew_footer_text', get_bloginfo('name') . '. ' . __('All Rights Reserved.', 'heaven-brew-premium'))); ?>
        </p>
        <p>
            <a class="nav-link <?php echo esc_attr(is_page('privacy-policy') ? 'active' : ''); ?>" 
                href="<?php echo esc_url(home_url('/heaven-brew-privacy-policy')); ?>">
                <?php _e('Privacy Policy', 'heaven-brew-premium'); ?>
            </a>
        </p>
    </footer>
</div>
