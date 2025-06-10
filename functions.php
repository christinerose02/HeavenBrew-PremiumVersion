<?php



function heaven_brew_premium_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'automatic-feed-links' );

}
add_action( 'after_setup_theme', 'heaven_brew_premium_setup' );




function heaven_brew_premium_enqueue_scripts() {
    wp_enqueue_style('style', get_stylesheet_uri());  
}
add_action('wp_enqueue_scripts', 'heaven_brew_premium_enqueue_scripts');
add_theme_support('elementor'); 
add_action('after_switch_theme', 'rose_auto_import_templates_and_create_pages');

function rose_auto_import_templates_and_create_pages() {
    if (!did_action('elementor/loaded')) {
        error_log('Elementor is not loaded. Exiting function.');
        return; 
    }

    $template_dir = get_template_directory() . '/elementor-templates/';
    $json_files = glob($template_dir . '*.json');

    foreach ($json_files as $file_path) {
        $json = file_get_contents($file_path);
        $data = json_decode($json, true);

        if (!$data || !isset($data['content'])) {
            continue;
        }

        $template_title = $data['title'] ?? basename($file_path, '.json');
        $page_slug = sanitize_title($template_title);

        if (get_page_by_path($page_slug)) {
            continue;
        }

        $post_id = wp_insert_post([
            'post_title'    => $template_title,
            'post_name'     => $page_slug,
            'post_status'   => 'publish',
            'post_type'     => 'page',
        ]);

        if ($post_id && !is_wp_error($post_id)) {
            update_post_meta($post_id, '_elementor_edit_mode', 'builder');
            update_post_meta($post_id, '_elementor_template_type', 'page');
            update_post_meta($post_id, '_elementor_data', $data['content']);
        }
    }
}





function heaven_brew_theme_support() {
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );
    add_theme_support( 'custom-logo' );
    add_theme_support( 'custom-header' );
    add_theme_support( 'custom-background' );
    add_theme_support( 'align-wide' );
}
add_action( 'after_setup_theme', 'heaven_brew_theme_support' );


// Register block styles
function brew_haven_register_block_styles() {
    register_block_style(
        'core/paragraph',
        array(
            'name'  => 'custom-style',
            'label' => __('Custom Style', 'heaven-brew-premium'),
            'inline_style' => '.wp-block-paragraph.is-style-custom-style { color: red; font-weight: bold; }'
        )
    );
}
add_action('init', 'brew_haven_register_block_styles');

// Register a custom block pattern
function brew_haven_register_block_patterns() {
    if (function_exists('register_block_pattern')) {
        register_block_pattern(
            'heaven-brew-premium/custom-cta',
            array(
                'title'       => __('Custom Call to Action', 'heaven-brew-premium'),
                'description' => __('A simple call-to-action section with a heading, text, and a button.', 'heaven-brew-premium'),
                'content'     => '<!-- wp:group {"align":"full","backgroundColor":"primary","textColor":"white","layout":{"type":"constrained"}} -->
                                <div class="wp-block-group alignfull has-white-color has-primary-background-color has-text-color has-background">
                                    <!-- wp:heading {"textAlign":"center"} -->
                                    <h2 class="has-text-align-center">' . __('Join Us Today!', 'heaven-brew-premium') . '</h2>
                                    <!-- /wp:heading -->

                                    <!-- wp:paragraph {"align":"center"} -->
                                    <p class="has-text-align-center">' . __('Subscribe to our newsletter for exclusive updates and offers.', 'heaven-brew-premium') . '</p>
                                    <!-- /wp:paragraph -->

                                    <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                                    <div class="wp-block-buttons">
                                        <!-- wp:button {"backgroundColor":"secondary","textColor":"white"} -->
                                        <div class="wp-block-button"><a class="wp-block-button__link has-white-color has-secondary-background-color has-text-color has-background">' . __('Subscribe Now', 'heaven-brew-premium') . '</a></div>
                                        <!-- /wp:button -->
                                    </div>
                                    <!-- /wp:buttons -->
                                </div>
                                <!-- /wp:group -->',
                'categories'  => array('custom'),
                'keywords'    => array('cta', 'subscribe', 'call to action'),
            )
        );
    }
}


//post thumbnails
function heaven_brew_theme_setup() {
    add_theme_support( 'post-thumbnails' );
    
    set_post_thumbnail_size( 1200, 9999 ); 

    add_image_size( 'single-post-thumbnail', 800, 600, true ); 
}
add_action( 'after_setup_theme', 'heaven_brew_theme_setup' );


function brew_haven_theme_support() {
    add_theme_support('wp-block-styles'); // Enables block styles
    add_theme_support('responsive-embeds'); // Ensures embedded content is responsive
    add_theme_support('custom-header', array( // Allows custom header images
        'width'       => 1200,
        'height'      => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support('custom-background', array( // Enables custom background colors or images
        'default-color' => 'ffffff',
        'default-image' => '',
    ));
    add_theme_support('align-wide'); // Enables wide/full alignment for blocks
    add_editor_style('editor-style.css'); // Matches the editor styling with the front-end
}
add_action('after_setup_theme', 'brew_haven_theme_support');

//comment-reply
function heaven_brew_enqueue_comment_reply_script() {
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'heaven_brew_enqueue_comment_reply_script' );



//header
function heaven_brew_register_menus() {
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'heaven-brew-premium' ),
    ));
}
add_action( 'after_setup_theme', 'heaven_brew_register_menus' );






//footer
function heaven_brew_register_footer_widgets() {
    register_sidebar(array(
        'name' => 'Footer Widget Area',
        'id' => 'footer-widget-area',
        'before_widget' => '<div class="footer-widget">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="footer-widget-title">',
        'after_title' => '</h2>',
    ));
}
add_action('widgets_init', 'heaven_brew_register_footer_widgets');


function heaven_brew_customize_register($wp_customize) {
    $wp_customize->add_setting('heaven-brew_footer_text', array(
        'default' => get_bloginfo('name') . '. ' . __('All Rights Reserved.', 'heaven-brew-premium'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_section('heaven_brew_footer_section', array(
        'title' => __('Footer Settings', 'heaven-brew-premium'),
        'priority' => 30,
    ));

    $wp_customize->add_control('heaven-brew_footer_text', array(
        'label' => __('Footer Text', 'heaven-brew-premium'),
        'section' => 'heaven_brew_footer_section',
        'type' => 'text',
    ));
}
add_action('customize_register', 'heaven_brew_customize_register');



//bootsrap
function heaven_brew_enqueue_scripts() {
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css');

    wp_enqueue_script('bootstrap-bundle', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'heaven_brew_enqueue_scripts');
function theme_enqueue_bootstrap() {
    wp_enqueue_script( 'bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js', array('jquery'), '5.3.0', true );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_bootstrap' );
function enqueue_bootstrap() {
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js', array(), null, true);
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_bootstrap');






//css
function heaven_brew_enqueue_block_style() {
    wp_register_style(
        'heaven-brew-block-style',
        get_template_directory_uri() . '/style.css'
    );
}
add_action('enqueue_block_assets', 'heaven_brew_enqueue_block_style');

?>
