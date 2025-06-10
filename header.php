<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Source+Sans+Pro:wght@400;600&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>

<a href="#main-content" class="skip-link"><?php _e('Skip to content', 'heaven-brew-premium'); ?></a>

<body <?php body_class(); ?>>
    
<?php wp_body_open(); ?>
<header class="header">
    <nav class="navbar navbar-expand-lg" role="navigation" aria-label="Main Navigation">
        <div class="container">
            <a class="navbar-brand" href="<?php echo esc_url(home_url()); ?>">
                <img src="<?php echo esc_url(get_theme_mod('heaven-brew-premium_logo', get_theme_file_uri('/img/haven-brew-logo.png'))); ?>" alt="<?php esc_attr_e('Logo', 'heaven-brew-premium'); ?>">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#primary-menu"
                    aria-controls="primary-menu" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'heaven-brew-premium'); ?>">
                <span class="navbar-toggler-icon"></span>
            </button>

            


            <div class="collapse navbar-collapse" id="primary-menu">
            <!-- <div class="collapse navbar-collapse d-flex align-items-center justify-content-end" id="primary-menu"> -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo esc_attr(is_home() || is_front_page() ? 'active' : ''); ?>" href="<?php echo esc_url(home_url('/homepage')); ?>">
                            <?php echo esc_html(__('Home', 'heaven-brew-premium')); ?>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php echo esc_attr(is_page('menu') ? 'active' : ''); ?>" href="<?php echo esc_url(home_url('/menu-elementor')); ?>">
                            <?php echo esc_html(__('Menu', 'heaven-brew-premium')); ?>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php echo esc_attr(is_page('account') ? 'active' : ''); ?>" href="<?php echo esc_url(home_url('/heaven-brew-account')); ?>">
                            <?php echo esc_html(__('Account', 'heaven-brew-premium')); ?>
                        </a>
                    </li>
                </ul>
            </div>


        </div>
    </nav>
</header>

<div id="content" class="site-content">
</div>
<?php wp_footer(); ?>

</body>
</html>
