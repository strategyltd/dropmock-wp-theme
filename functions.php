<?php


error_reporting(E_ERROR | E_PARSE);

// define('DM_API_URL', 'http://localhost:8000');
define('DM_API_URL', 'https://app.dropmock.com');
define('DM_CLOUDFRONT_DOMAIN', 'https://d5mnuqe4gnb1i.cloudfront.net');
define('DM_RENDER_URL', 'http://createmy.video');
define('WEBSITE_URL',get_site_url());
define( 'O2_DIRECTORY', get_template_directory() . '/inc/o2/' );
define( 'O2_DIRECTORY_URI', get_template_directory_uri() . '/inc/o2/' );
define('DM_STORE_DIRECTORY', get_theme_root() . '/' . basename(dirname(__FILE__)) . '/');
define('DM_STORE_PARENT_URL', get_theme_root_uri() . '/' . basename(dirname(__FILE__)) . '/');
// define( 'O2_DIRECTORY_URI', get_template_directory_uri() . '/inc/o2/' );


require_once(ABSPATH . "wp-admin" . '/includes/media.php');
require_once(ABSPATH . "wp-admin" . '/includes/file.php');
require_once(ABSPATH . "wp-admin" . '/includes/image.php');
require_once ('class-tgm-plugin-activation.php');


if ( class_exists( 'WooCommerce' ) ) {
    setThemeDefaultSettings();
}



function setThemeDefaultSettings(){
    require_once ('background/example-plugin.php');
    createDefaultNavBar();
    createDefaultPages();
}





add_action('tgmpa_register','register_required_plugins');

function register_required_plugins() {
    $plugins = array(

    // This is an example of how to include a plugin pre-packaged with a theme.
    array(
        'name' => 'WP Pusher', // The plugin name.
        'slug' => 'wppusher', // The plugin slug (typically the folder name).
        'source' => DM_STORE_DIRECTORY . '/plugins/wppusher.zip', // The plugin source.
        'required' => true, // If false, the plugin is only 'recommended' instead of required.
        'version' =>'', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
        'force_activation' => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
        'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
        'external_url' => '', // If set, overrides default API URL and points to an external URL.
        )

    );

    /**
    * Array of configuration settings. Amend each line as needed.
    * If you want the default strings to be available under your own theme domain,
    * leave the strings uncommented.
    * Some of the strings are added into a sprintf, so see the comments at the
    * end of each line for what each argument will be.
    */
    $config = array(
    'default_path' =>'', // Default absolute path to pre-packaged plugins.
    'menu' => 'tgmpa-install-plugins', // Menu slug.
    'has_notices' => true, // Show admin notices or not.
    'dismissable' => true, // If false, a user cannot dismiss the nag message.
    'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
    'is_automatic' => false, // Automatically activate plugins after installation or not.
    'message' =>'', // Message to output right before the plugins table.
    'strings' => array(
    'page_title' => __( 'Install Required Plugins', 'tgmpa' ),
    'menu_title' => __( 'Install Plugins', 'tgmpa' ),
    'installing' => __( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
    'oops' => __( 'Something went wrong with the plugin API.', 'tgmpa' ),
    'notice_can_install_required' => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s).
    'notice_can_install_recommended' => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s).
    'notice_cannot_install' => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s).
    'notice_can_activate_required' => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
    'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
    'notice_cannot_activate' => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s).
    'notice_ask_to_update' => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s).
    'notice_cannot_update' => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s).
    'install_link' => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
    'activate_link' => _n_noop( 'Begin activating plugin', 'Begin activating plugins' ),
    'return' => __( 'Return to Required Plugins Installer', 'tgmpa' ),
    'plugin_activated' => __( 'Plugin activated successfully.', 'tgmpa' ),
    'complete' => __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
    'nag_type' => 'updated' // Determines admin notice type – can only be 'updated', 'update-nag' or 'error'.
    )
    );

    tgmpa( $plugins, $config );
}



/*
    CREATE NAVIGATION MENU HOME - ABOUT - CONTACT - BLOG - SEARCH - CART-----START
*/
function createDefaultNavBar(){
    $menu_name = 'Navigation Menu';
    $menu_exists = wp_get_nav_menu_object( $menu_name );

    // If it doesn't exist, let's create it.
    if( !$menu_exists){
        $menu_id = wp_create_nav_menu($menu_name);

        // Set up default menu items
        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' =>  __('Home'),
            'menu-item-classes' => 'home',
            'menu-item-url' => home_url( '/' ), 
            'menu-item-status' => 'publish'));

        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' =>  __('Shop'),
            'menu-item-classes' => 'shop',
            'menu-item-url' => home_url( '/shop/' ), 
            'menu-item-status' => 'publish'));

        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' =>  __('About'),
            'menu-item-classes' => 'about',
            'menu-item-url' => home_url( '/about/' ), 
            'menu-item-status' => 'publish'));

        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' =>  __('Contact'),
            'menu-item-classes' => 'contact',
            'menu-item-url' => home_url( '/contact/' ), 
            'menu-item-status' => 'publish'));

        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' =>  __('Blog'),
            'menu-item-url' => home_url( '/blog/' ), 
            'menu-item-status' => 'publish'));

        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' =>  __('Cart'),
            'menu-item-classes' => 'fa fa fa-cart-plus',
            'menu-item-url' => get_permalink( wc_get_page_id( 'cart' ) ), 
            'menu-item-status' => 'publish'));
    }

    add_option( 'navigation_menu_id',wp_get_nav_menu_object( $menu_name )->term_id , '', 'yes' );
}


/*
    ----------------------CREATING DEFAULT PAGES--------------------------------START
*/
function createDefaultPages(){
    $default_pages_is_created = get_option('default_pages_is_created');
    if($default_pages_is_created != '1'){

        $pictures = [
                        'About' => get_template_directory_uri().'/inc/assets/img/about_pic.jpg'
                       ,'Contact' => get_template_directory_uri().'/inc/assets/img/contact_pic.jpg'
                    ];

        $default_pages = ['About','Contact','Blog'];
        $about_content = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";
        foreach ($default_pages as $page) {
             $check = get_page_by_title($page);
             if($check == null || $check->post_status == 'trash'){
                $new_page = array(
                 'post_title' => $page,
                 'post_content' => ($page == 'About')? $about_content : '' ,
                 'post_status' => 'publish',
                 'post_author' => get_current_user_id(),
                 'post_type' => 'page'
                 );

                 $page_id = wp_insert_post($new_page);
                 $template_file_name = 'page-'.strtolower($page).'.php';
                 update_post_meta( $page_id, '_wp_page_template', $template_file_name );
                 if($page == 'About' || 'Contact')
                    agencytheme_attachImg($pictures[$page], $page_id);
             }   
             
        }
        add_option('default_pages_is_created','1','','yes');
    }
}






if ( ! function_exists( 'wp_bootstrap_starter_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wp_bootstrap_starter_setup() {
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on WP Bootstrap Starter, use a find and replace
     * to change 'wp-bootstrap-starter' to the name of your theme in all the template files.
     */
    load_theme_textdomain( 'wp-bootstrap-starter', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );



    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support( 'post-thumbnails' );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary', 'wp-bootstrap-starter' ),
    ) );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
        'comment-form',
        'comment-list',
        'caption',
    ) );

    // Set up the WordPress core custom background feature.
    add_theme_support( 'custom-background', apply_filters( 'wp_bootstrap_starter_custom_background_args', array(
        'default-color' => 'ffffff',
        'default-image' => '',
    ) ) );

    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );

    function wp_boostrap_starter_add_editor_styles() {
        add_editor_style( 'custom-editor-style.css' );
    }
    add_action( 'admin_init', 'wp_boostrap_starter_add_editor_styles' );

}
endif;
add_action( 'after_setup_theme', 'wp_bootstrap_starter_setup' );


/**
 * Add Welcome message to dashboard
 */
function wp_bootstrap_starter_reminder(){
        $theme_page_url = 'https://afterimagedesigns.com/wp-bootstrap-starter/?dashboard=1';

            if(!get_option( 'triggered_welcomet')){
                $message = sprintf(__( 'Welcome to DropMock Store Theme! Before diving in to your new theme, Please make sure you have reviewed all tutorials needed to start selling on your store.
                    <a style="color:white" target="_blank" href="https://dropmock.com/fusionstore-tutorial/">Watch Here</a>', 'wp-bootstrap-starter' ),
                    esc_url( $theme_page_url )
                );

                printf(
                    '<div class="notice is-dismissible" style="background-color: #6C2EB9; color: #fff; border-left: none;">
                        <p>%1$s</p>
                    </div>',
                    $message
                );
                add_option( 'triggered_welcomet', '1', '', 'yes' );
            }

}
add_action( 'admin_notices', 'wp_bootstrap_starter_reminder' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wp_bootstrap_starter_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'wp_bootstrap_starter_content_width', 1170 );
}
add_action( 'after_setup_theme', 'wp_bootstrap_starter_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wp_bootstrap_starter_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'wp-bootstrap-starter' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here.', 'wp-bootstrap-starter' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer 1', 'wp-bootstrap-starter' ),
        'id'            => 'footer-1',
        'description'   => esc_html__( 'Add widgets here.', 'wp-bootstrap-starter' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer 2', 'wp-bootstrap-starter' ),
        'id'            => 'footer-2',
        'description'   => esc_html__( 'Add widgets here.', 'wp-bootstrap-starter' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer 3', 'wp-bootstrap-starter' ),
        'id'            => 'footer-3',
        'description'   => esc_html__( 'Add widgets here.', 'wp-bootstrap-starter' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'wp_bootstrap_starter_widgets_init' );



/**
 * Enqueue scripts for the admin dashboard.
 */
add_action('admin_head', 'my_custom_fonts');
function my_custom_fonts() {
  echo '<style>
   .loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 5px;
  height: 5px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.dd-selected-icon{
    font-size:20px !important;
}
  </style>';
}


/**
 * Add theme settings in the customizer
 */
add_action('customize_register', function ($wp_customize) {
    

    if( 'DropMock MarketPlace Theme' != get_current_theme())
        return;


    include('icon_customizer.php');


    $wp_customize->remove_control('woocommerce_catalog_columns');

    // ADD SECTION - FOOTER SECTION
    $wp_customize->add_section('ad_section', array(
        'title' => __('Advertisement Section', 'wpdmmp_theme'),
        'priority' => 31,
    ));

    // ADD SECTION - SOCIAL LINKS SECTION
    $wp_customize->add_section('social_links_section', array(
        'title' => __('Social Links', 'wpdmmp_theme'),
        'priority' => 31,
    ));

    // ADD SECTION - CONTACT INFO SECTION
    $wp_customize->add_section('contact_info_section', array(
        'title' => __('Contact Info', 'wpdmmp_theme'),
        'priority' => 31,
    ));

    // AD SPACE SETTING
    $wp_customize->add_setting('footer_ad_space', array(
        'default' => '',
        'transport' => 'refresh',
    ));

    // AD SPACE SETTING
    $wp_customize->add_setting('footer_ad_height', array(
        'default' => '',
        'transport' => 'refresh',
    ));

    // AD SPACE SETTING
    $wp_customize->add_setting('footer_ad_width', array(
        'default' => '',
        'transport' => 'refresh',
    ));

    //SOCIAL LINKS
    $wp_customize->add_setting('social_facebook_link', array('default' => 'http://facebook.com','transport' => 'refresh',));
    $wp_customize->add_setting('social_instagram_link', array('default' => 'http://instagram.com','transport' => 'refresh',));
    $wp_customize->add_setting('social_twitter_link', array('default' => 'https://twitter.com','transport' => 'refresh',));
    $wp_customize->add_setting('social_linkedin_link', array('default' => 'https://www.linkedin.com','transport' => 'refresh',));
    
    //CONTACT INFO
    $wp_customize->add_setting('contact_info_phone_1', array('default' => 'phone1','transport' => 'refresh'));
    $wp_customize->add_setting('contact_info_phone_2', array('' => 'refresh','default' => 'phone2'));
    $wp_customize->add_setting('contact_info_address_1', array('' => 'refresh','default' => 'Address Line 1 '));
    $wp_customize->add_setting('contact_info_address_2', array('' => 'refresh','default' => 'Address Line 2'));
    $wp_customize->add_setting('contact_info_email', array('' => 'refresh','default' => 'Email'));

    // AD SPACE CONTROL
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'footer_ad_space',
            array(
                'label' => __('Upload an image to be used as AD', 'wpdmmp_theme'),
                'section' => 'ad_section',
                'settings' => 'footer_ad_space',
                'priority' =>12
            )
        )
    );

    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'footer_ad_width', array(
        'label' => __( 'Width in %', 'wp-bootstrap-starter' ),
        'section'    => 'ad_section',
        'settings'   => 'footer_ad_width',
        'type' => 'text',
        'priority' =>10,
    )));

    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'footer_ad_height', array(
        'label' => __( 'Height in Pixels', 'wp-bootstrap-starter' ),
        'section'    => 'ad_section',
        'settings'   => 'footer_ad_height',
        'type' => 'text',
        'priority' =>10,
    )));


    /*
        ---------------SOCIAL LINKS CONTROLS-----------------START
    */
    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'social_facebook_link', array(
        'label' => __( 'Facebook Link', 'wp-bootstrap-starter' ),
        'section'    => 'social_links_section',
        'settings'   => 'social_facebook_link',
        'type' => 'text',
        'priority' =>10,
    )));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'social_instagram_link', array(
        'label' => __( 'Instagram Link', 'wp-bootstrap-starter' ),
        'section'    => 'social_links_section',
        'settings'   => 'social_instagram_link',
        'type' => 'text',
        'priority' =>10,
    )));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'social_twitter_link', array(
        'label' => __( 'Twitter Link', 'wp-bootstrap-starter' ),
        'section'    => 'social_links_section',
        'settings'   => 'social_twitter_link',
        'type' => 'text',
        'priority' =>10,
    )));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'social_linkedin_link', array(
        'label' => __( 'Linkedin Link', 'wp-bootstrap-starter' ),
        'section'    => 'social_links_section',
        'settings'   => 'social_linkedin_link',
        'type' => 'text',
        'priority' =>10,
    )));
    /*
        ---------------SOCIAL LINKS CONTROLS-----------------END
    */


     /*
        ---------------CONTACT INFO CONTROLS-----------------START
    */
    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'contact_info_phone_1', array(
        'label' => __( 'Phone Line 1', 'wp-bootstrap-starter' ),
        'section'    => 'contact_info_section',
        'settings'   => 'contact_info_phone_1',
        'type' => 'text',
        'priority' =>10,
    )));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'contact_info_phone_2', array(
        'label' => __( 'Phone Line 2', 'wp-bootstrap-starter' ),
        'section'    => 'contact_info_section',
        'settings'   => 'contact_info_phone_2',
        'type' => 'text',
        'priority' =>10,
    )));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'contact_info_address_1', array(
        'label' => __( 'Address Line 1', 'wp-bootstrap-starter' ),
        'section'    => 'contact_info_section',
        'settings'   => 'contact_info_address_1',
        'type' => 'text',
        'priority' =>10,
    )));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'contact_info_address_2', array(
        'label' => __( 'Address Line 2', 'wp-bootstrap-starter' ),
        'section'    => 'contact_info_section',
        'settings'   => 'contact_info_address_2',
        'type' => 'text',
        'priority' =>10,
    )));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'contact_info_email', array(
        'label' => __( 'Email', 'wp-bootstrap-starter' ),
        'section'    => 'contact_info_section',
        'settings'   => 'contact_info_email',
        'type' => 'text',
        'priority' =>10,
    )));
    /*
        ---------------CONTACT INFO CONTROLS-----------------END
    */


    // HEADER CALL TO ACTION BUTTON 
    $wp_customize->add_setting( 'header_banner_button_setting', array(
        'default' => __( 'Shop Now','wp-bootstrap-starter' ),
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    ) );
    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'header_banner_button_setting', array(
        'label' => __( 'Button To Action Text', 'wp-bootstrap-starter' ),
        'section'    => 'header_image',
        'settings'   => 'header_banner_button_setting',
        'type' => 'text',
        'priority' =>30,

    )));


    //LEFT HEADER SUB-SECTION ICON
    $wp_customize->add_setting( 'header_subsection_left_icon', array(
        'default' => 'fa-angellist',
        'capability' => 'edit_theme_options'
    ));
    $wp_customize->add_control(
        new O2_Customizer_Icon_Picker_Control(
            $wp_customize,
            'header_subsection_left_icon'
            , array(
                    'label' => __('Left Sub Section', 'textdomain'),
                    'description' => __('Choose an icon', 'textdomain'),
                    'iconset' => 'fa',
                    'section' => 'header_image',
                    'priority' => 40,
                    'settings' => 'header_subsection_left_icon'
                )
            )
    );

    //LEFT HEADER SUB-SECTION TEXT
    $wp_customize->add_setting( 'header_subsection_left_text', array(
        'default' => __( 'Easy to-use platform','wp-bootstrap-starter' ),
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'header_subsection_left_text', array(
        // 'label' => __( 'Button To Action Text', 'wp-bootstrap-starter' ),
        'section'    => 'header_image',
        'settings'   => 'header_subsection_left_text',
        'type' => 'text',
        'priority' =>41,

    )));




    //MIDDLE HEADER SUB-SECTION ICON
    $wp_customize->add_setting( 'header_subsection_middle_icon', array(
        'default' => 'fa-angellist',
        'capability' => 'edit_theme_options'
    ));
    $wp_customize->add_control(
        new O2_Customizer_Icon_Picker_Control(
            $wp_customize,
            'header_subsection_middle_icon'
            , array(
                    'label' => __('Middle Sub Section', 'textdomain'),
                    'description' => __('Choose an icon', 'textdomain'),
                    'iconset' => 'fa',
                    'section' => 'header_image',
                    'priority' => 42,
                    'settings' => 'header_subsection_middle_icon'
                )
            )
    );

    //MIDDLE HEADER SUB-SECTION TEXT
    $wp_customize->add_setting( 'header_subsection_middle_text', array(
        // 'default' => __( 'Easy to-use platform','wp-bootstrap-starter' ),
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    ) );
    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'header_subsection_middle_text', array(
        // 'label' => __( 'Button To Action Text', 'wp-bootstrap-starter' ),
        'section'    => 'header_image',
        'settings'   => 'header_subsection_middle_text',
        'type' => 'text',
        'priority' =>42,

    ) ) );



    //RIGHT HEADER SUB-SECTION ICON
    $wp_customize->add_setting( 'header_subsection_right_icon', array(
        'default' => 'fa-asterisk',
        'capability' => 'edit_theme_options'
    ));
    $wp_customize->add_control(
        new O2_Customizer_Icon_Picker_Control(
            $wp_customize,
            'header_subsection_right_icon'
            , array(
                    'label' => __('Right Sub Section', 'textdomain'),
                    'description' => __('Choose an icon', 'textdomain'),
                    'iconset' => 'fa',
                    'section' => 'header_image',
                    'priority' => 42,
                    'settings' => 'header_subsection_right_icon'
                )
            )
    );

    //RIGHT HEADER SUB-SECTION TEXT
    $wp_customize->add_setting( 'header_subsection_right_text', array(
        // 'default' => __( 'Easy to-use platform','wp-bootstrap-starter' ),
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    ) );
    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'header_subsection_right_text', array(
        // 'label' => __( 'Button To Action Text', 'wp-bootstrap-starter' ),
        'section'    => 'header_image',
        'settings'   => 'header_subsection_right_text',
        'type' => 'text',
        'priority' =>42,

    ) ) );




    //RIGHT HEADER SUB-SECTION TEXT
    $wp_customize->add_setting( 'homepage_main_heading', array(
        'default' => __( 'Templates','wp-bootstrap-starter' ),
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    ) );
    $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'homepage_main_heading', array(
        'label' => __( 'Homepage Main Heading ', 'wp-bootstrap-starter' ),
        'section'    => 'header_image',
        'settings'   => 'homepage_main_heading',
        'type' => 'text',
        'priority' =>43,

    ) ) );


});


/**
 * Enqueue scripts and styles.
 */
function wp_bootstrap_starter_scripts() {
    // load bootstrap css
    wp_enqueue_style( 'wp-bootstrap-starter-bootstrap-css', get_template_directory_uri() . '/inc/assets/css/bootstrap.min.css' );
    // load bootstrap css
    // load AItheme styles
    // load WP Bootstrap Starter styles
    wp_enqueue_style( 'wp-bootstrap-starter-style', get_stylesheet_uri() );
    
    if(get_theme_mod( 'theme_option_setting' ) && get_theme_mod( 'theme_option_setting' ) !== 'default') {
        wp_enqueue_style( 'wp-bootstrap-starter-'.get_theme_mod( 'theme_option_setting' ), get_template_directory_uri() . '/inc/assets/css/presets/theme-option/'.get_theme_mod( 'theme_option_setting' ).'.css', false, '' );
    }

    if(get_theme_mod( 'preset_style_setting' ) === 'poppins-lora') {
        wp_enqueue_style( 'wp-bootstrap-starter-poppins-lora-font', '//fonts.googleapis.com/css?family=Lora:400,400i,700,700i|Poppins:300,400,500,600,700' );
    }
    if(get_theme_mod( 'preset_style_setting' ) === 'montserrat-merriweather') {
        wp_enqueue_style( 'wp-bootstrap-starter-montserrat-merriweather-font', '//fonts.googleapis.com/css?family=Merriweather:300,400,400i,700,900|Montserrat:300,400,400i,500,700,800' );
    }
    if(get_theme_mod( 'preset_style_setting' ) === 'poppins-poppins') {
        wp_enqueue_style( 'wp-bootstrap-starter-poppins-font', '//fonts.googleapis.com/css?family=Poppins:300,400,500,600,700' );
    }
    if(get_theme_mod( 'preset_style_setting' ) === 'roboto-roboto') {
        wp_enqueue_style( 'wp-bootstrap-starter-roboto-font', '//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i' );
    }
    if(get_theme_mod( 'preset_style_setting' ) === 'arbutusslab-opensans') {
        wp_enqueue_style( 'wp-bootstrap-starter-arbutusslab-opensans-font', '//fonts.googleapis.com/css?family=Arbutus+Slab|Open+Sans:300,300i,400,400i,600,600i,700,800' );
    }
    if(get_theme_mod( 'preset_style_setting' ) === 'oswald-muli') {
        wp_enqueue_style( 'wp-bootstrap-starter-oswald-muli-font', '//fonts.googleapis.com/css?family=Muli:300,400,600,700,800|Oswald:300,400,500,600,700' );
    }
    if(get_theme_mod( 'preset_style_setting' ) === 'montserrat-opensans') {
        wp_enqueue_style( 'wp-bootstrap-starter-montserrat-opensans-font', '//fonts.googleapis.com/css?family=Montserrat|Open+Sans:300,300i,400,400i,600,600i,700,800' );
    }
    if(get_theme_mod( 'preset_style_setting' ) === 'robotoslab-roboto') {
        wp_enqueue_style( 'wp-bootstrap-starter-robotoslab-roboto', '//fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,700|Roboto:300,300i,400,400i,500,700,700i' );
    }
    if(get_theme_mod( 'preset_style_setting' ) && get_theme_mod( 'preset_style_setting' ) !== 'default') {
        wp_enqueue_style( 'wp-bootstrap-starter-'.get_theme_mod( 'preset_style_setting' ), get_template_directory_uri() . '/inc/assets/css/presets/typography/'.get_theme_mod( 'preset_style_setting' ).'.css', false, '' );
    }
    //Color Scheme
    /*if(get_theme_mod( 'preset_color_scheme_setting' ) && get_theme_mod( 'preset_color_scheme_setting' ) !== 'default') {
        wp_enqueue_style( 'wp-bootstrap-starter-'.get_theme_mod( 'preset_color_scheme_setting' ), get_template_directory_uri() . '/inc/assets/css/presets/color-scheme/'.get_theme_mod( 'preset_color_scheme_setting' ).'.css', false, '' );
    }else {
        wp_enqueue_style( 'wp-bootstrap-starter-default', get_template_directory_uri() . '/inc/assets/css/presets/color-scheme/blue.css', false, '' );
    }*/

    wp_enqueue_script('jquery');

    // Internet Explorer HTML5 support
    wp_enqueue_script( 'html5hiv',get_template_directory_uri().'/inc/assets/js/html5.js', array(), '3.7.0', false );
    wp_script_add_data( 'html5hiv', 'conditional', 'lt IE 9' );

    // load bootstrap js
    wp_enqueue_script('wp-bootstrap-starter-fontawesome', get_template_directory_uri() . '/inc/assets/js/fontawesome/fontawesome-all.min.js', array(), '', true );
    wp_enqueue_script('wp-bootstrap-starter-fontawesome-v4', get_template_directory_uri() . '/inc/assets/js/fontawesome/fa-v4-shims.min.js', array(), '', true );
    wp_enqueue_script('wp-bootstrap-starter-popper', get_template_directory_uri() . '/inc/assets/js/popper.min.js', array(), '', true );
    wp_enqueue_script('wp-bootstrap-starter-bootstrapjs', get_template_directory_uri() . '/inc/assets/js/bootstrap.min.js', array(), '', true );
    wp_enqueue_script('wp-bootstrap-starter-themejs', get_template_directory_uri() . '/inc/assets/js/theme-script.min.js', array(), '', true );
    wp_enqueue_script( 'wp-bootstrap-starter-skip-link-focus-fix', get_template_directory_uri() . '/inc/assets/js/skip-link-focus-fix.min.js', array(), '20151215', true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'wp_bootstrap_starter_scripts' );


function wp_bootstrap_starter_password_form() {
    global $post;
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    $o = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
    <div class="d-block mb-3">' . __( "To view this protected post, enter the password below:", "wp-bootstrap-starter" ) . '</div>
    <div class="form-group form-inline"><label for="' . $label . '" class="mr-2">' . __( "Password:", "wp-bootstrap-starter" ) . ' </label><input name="post_password" id="' . $label . '" type="password" size="20" maxlength="20" class="form-control mr-2" /> <input type="submit" name="Submit" value="' . esc_attr__( "Submit", "wp-bootstrap-starter" ) . '" class="btn btn-primary"/></div>
    </form>';
    return $o;
}
add_filter( 'the_password_form', 'wp_bootstrap_starter_password_form' );



/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load plugin compatibility file.
 */
require get_template_directory() . '/inc/plugin-compatibility/plugin-compatibility.php';

/**
 * Load custom WordPress nav walker.
 */
if ( ! class_exists( 'wp_bootstrap_navwalker' )) {
    require_once(get_template_directory() . '/inc/wp_bootstrap_navwalker.php');
}


add_action('admin_notices', function () {
    if (!class_exists('WooCommerce')) {
        echo '<div class="error"><p>Warning: This theme requires <a href="https://wordpress.org/plugins/woocommerce/">WooCommerce</a>. Please install & activate via <a href="' . admin_url('plugin-install.php?tab=search&s=woocommerce') . '">Plugin Admin</a></p></div>';
    }
});


function dmmp_product_categories($atts) {

    global $woocommerce_loop;

    $atts = shortcode_atts(array(
        'number' => null,
        'orderby' => 'name',
        'order' => 'ASC',
        'columns' => '4',
        'hide_empty' => 1,
        'parent' => '',
        'ids' => '',
    ), $atts, 'dmmp_product_categories');



    $ids = array_filter(array_map('trim', explode(',', $atts['ids'])));
    $hide_empty = (true === $atts['hide_empty'] || 'true' === $atts['hide_empty'] || 1 === $atts['hide_empty'] || '1' === $atts['hide_empty']) ? 1 : 0;

    // get terms and workaround WP bug with parents/pad counts
    $args = array(
        'orderby' => $atts['orderby'],
        'order' => $atts['order'],
        'hide_empty' => $hide_empty,
        'include' => $ids,
        'pad_counts' => true,
        'child_of' => $atts['parent'],
    );



    $product_categories = get_terms('product_cat', $args);



    if ('' !== $atts['parent']) {
        $product_categories = wp_list_filter($product_categories, array('parent' => $atts['parent']));
    }

    if ($hide_empty) {
        foreach ($product_categories as $key => $category) {
            if (0 == $category->count) {
                unset($product_categories[$key]);
            }
        }
    }


    if ($atts['number']) {
        $product_categories = array_slice($product_categories, 0, $atts['number']);
    }

    

    ob_start();
    if ($product_categories) {
        foreach ($product_categories as $category) {
            dmmp2_woocommerce_template_loop_category_link_open($category);
            dmmp2_woocommerce_template_loop_category_title($category);
            echo '</a>';
        }
    }
    woocommerce_reset_loop();
    return ob_get_clean();
}

add_shortcode('dmmp_product_categories', 'dmmp_product_categories');



function dmmp2_woocommerce_template_loop_category_link_open($categoryObj) {echo '<a class="ui label" href="' . get_term_link($categoryObj, 'product_cat') . '">';}
function dmmp2_woocommerce_template_loop_category_title($categoryObj) {echo $categoryObj->name;}


function printme($x){
    echo '<pre>';
    echo print_r($x,true);
    echo '</pre>';
}

add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail_dm_mp', 10);


// Add a Menu on Sidebar to Configure DropMock MarketPlace
// Currently we only have one option - Sync Products with DropMock
add_action('admin_menu', function () {
    add_menu_page('DropMock', 'DropMock', 'manage_options', 'dropmock-marketplace-settings', 'dropmockMarketPlaceConfiguration', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH4gUCDTkvWDx0YgAAAwJJREFUOMvVlF9oXFUQxn9z9m5uNmYT1u1NSoJJJanggxIjVA0Yat8UFQRF3aV/bq3KgtTHagpSseuDT5WCVUu6CvYqVPtSnypKC7U0ILbVttZ0m1ZIm2RvdmN2b/dfdu/xIQm1SWPBtw4cDsyc+Wbmm48Dd4XFUplIPOVaS3z/C0tiKTcK+j2Qa6A3gPwEep9jtxXulNybOEZ63/pbAeMpN6ThTdAl4De0voqoZ4DcmdMXR6tz/hugJ9CUQVeAitaS932//8r+DUO3THUgg8S/yHJwS3TRMYDI645t2bGU+3Q+f2PThfNX9ox9/tQIwF7fN2Ymck3tHZHo91/++dHA813HRn8st5YL9Zwgx1HqD1nG54FMOyLbHdva2bnlaFeoseHJ9KfrDwIkM4W3EEa1ZrYlYk4WvdJE5YYMnTtS+jjYqGxgj1oK6GxtmwLd/cr+6yoUMmuIrLlJEA07rfDRbqt5ZHuw4a93Iq3VQAPeoUT7DGiTet1XK/C9WxnBR0EXgTUAL351CoTirvHp8EYRdk/l52uIeC9/dtkAmXO2rUYtl9AUIFdBd6V/HysAawHO/Fzpvzgy3R00zQcXgB5IZgpPiJAPmC1x0D8AywEdu51arVIGeYwTW+vA2d7E8ROgV3f2hA+BvJ90vSMIHVrrX4dWhR20fs6x287Os7Ki2N0d1bK399vE/UWAxOFSy/RE3lq11hjIjtWzKkCrChBAJARkHds6/OyHJzH+Q7dhI2iqWMr9DijPzhYuBUOS/nu8nlZG7dI32zqm//341eEMX7/WdvsOY6mMAbwN8gnaj88LWtQCRUpEBLQCtEZMkGHHtkrASh2KIQrfMNXjKqAulwvaE3WzuK/RZrPc49d01Z/TfX6dEFC67VLmF2OVewbNqDL0ZGefsakpQhGt3cVTzM5dv++R4I5Srj7eM2g+5NhWbjF3RQ7NZnWyd9DsR6Q6/ELr+aXxdZu9a30vNT2M8Msdv6CkW124vXuTrtcI8MHkDADvXhhdjAWTrhflrrN/AJf8PMI6OBrlAAAAAElFTkSuQmCC');
});

function dropmockMarketPlaceConfiguration(){

    if (!current_user_can('manage_options')) {
        wp_die(__w('You do not have sufficient permissions to access this page :(', 'dm_store_theme'));
    }

    if ( !class_exists( 'WooCommerce' ) ) {
        ?>
        <div class="card">
            <h2>Welcome To DropMock Store</h2>
            <div class="error">
                <p>You need to install and activate 
                    <a href="https://wordpress.org/plugins/woocommerce/">WooCommerce</a>
                    before connectiong your store with DropMock.
                </p>
            </div>
        </div>

        <?php
        exit();
    }

    $error = false;
    


    

    $admin_url = WEBSITE_URL.'/wp-admin/admin.php?page=dropmock-marketplace-settings';


    if(isset($_GET['action'])){
        $action = $_GET['action'];

        if($action == 'connect'){   

            $is_curl_enabled = isCurlEnabled();
            if($is_curl_enabled === true){
                $result = dropmockCheckAPIKey($_GET['key']);

                if($result == 'fail')
                    $error = 'API Key entered is not correct, Please try again.';

                if(strlen($result) > 10)
                    $error = $result;
            }else{
                $error = 'Please install and enable Curl on your server to be able to connect with your DropMock Account';
            }
            
        }
    }

    $API_KEY = get_option( 'kinetic_api_key' );
    if($API_KEY){

        $last_check = get_transient('last_api_check');
        if(!$last_check){
            $check = dropmockCheckAPIKey($API_KEY);
            if($check !== 'success'){
                delete_option('kinetic_api_key');
                update_option('elite_user',false);
            }else{
                set_transient( 'last_api_check', 1, 3600);
            }
        }
    }


    $vendors = get_option( 'vendors' );
    if(isset($_GET['vendor']))
        $active_vendor = $_GET['vendor'];
    else
        $active_vendor = $vendors[0];
    ?>
    <div class="wrap">

        <h2>DropMock Marketplace</h2>
        <?php if ($error): ?>
            <div class="notice notice-error">
              <p><b><?= $error ?></b></p>
            </div>
        <?php endif ?>
        <?php


    if($API_KEY === false){
        ?>

        <div class="card">
            <p>Please enter your API key to connect with your DropMock Store</p>
            <form method="get" action="admin.php">
                <input type="hidden" name="page" value="dropmock-marketplace-settings">
                <input type="hidden" name="action" value="connect">
                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row">
                                <label for="key" >API KEY</label>
                            </th>
                            <td>
                                <input name="key" type="text" class="regular-text" required>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <?php if(get_transient('delete_in_progress')): ?>
                    <table>
                        <tr>
                            <td><p class="loader"></p></td>
                            <td>
                                <p style="padding:1%;"><b>Removing products from store, Please wait.</b></p>
                            </td>
                        </tr>
                    </table>
                <?php else: ?>
                    <p class="submit">
                        <input type="submit" class="button button-primary" value="Save API Key">
                    </p>
                <?php endif ?>
            </form>
        </div>

        <?php
    }else{

        if($action == 'vendors_update'){
            updateMyVendors();
        }

        if($action == 'update'){
           ?>
           <div class="card">
                <p style="padding:2%;border-left:3px solid red;">
                    Please be aware that this will <b>DELETE</b> all the products on your store.

                    </br>
                    <b>Are you sure ?</b>
                </p>
                <!-- <a href="<?= WEBSITE_URL.'/wp-admin/admin.php?page=dropmock-marketplace-settings&action=confirm_update'; ?>" class="button button-primary"> Confirm</a> -->
                <a href="<?= wp_nonce_url( admin_url( '?process=update_api&'), 'process' ) ?>" class="button button-primary">Confirm</a>
                
                
                <a href="<?= WEBSITE_URL.'/wp-admin/admin.php?page=dropmock-marketplace-settings'; ?>" class="button">Cancel</a>
           </div>
           <?php
           exit();
        }

        if($action == 'sync'){
            ?>
            <div class="card">
                <p style="padding:2%;border-left:3px solid #ffb900;">
                    Please be aware that you are about to supercharge your online store. 
                    This process might take some time depending on your server speed.
                    </br>
                    <b>Are you sure?</b>
                </p>
                <a href="<?= wp_nonce_url( admin_url( '?process=sync&vendor='.$active_vendor), 'process' ) ?>" class="button button-primary"> Start Syncing</a>
                <a href="<?= WEBSITE_URL.'/wp-admin/admin.php?page=dropmock-marketplace-settings&vendor='.$_GET['vendor']; ?>" class="button">Cancel</a>
           </div>
            <?php
            exit();
        }
        

        $user_name = get_option( 'kinetic_api_name' );
        $products_count = dropmockMarketPlaceCountProducts($active_vendor);
        $isEliteUser = get_option( 'elite_user' );
        $vendors = get_option( 'vendors' );
        ?>

        <style type="text/css">
            .nav-tab-active{
                background-color: white;
            }
        </style>
        <div class="card" style="max-width:94%;clear:both;">

            <h1 style="font-size:150%;" class="wp-heading-inline">Welcome <?= ucfirst($user_name);  ?></h1>
            <a class="page-title-action hide-if-no-customize" href="<?= WEBSITE_URL.'/wp-admin/admin.php?page=dropmock-marketplace-settings&action=update'; ?>">
                Update API Key
            </a>
            <a class="page-title-action hide-if-no-customize" href="<?= WEBSITE_URL.'/wp-admin/admin.php?page=dropmock-marketplace-settings&action=vendors_update'; ?>">
                Update My Vendors
            </a>
            <?php if ($isEliteUser): ?>
                        <span style=" background-color: #5cb85c;display: inline;
                    padding: .2em .6em .3em;
                    font-size:90%;
                    font-weight: 700;
                    line-height: 1;
                    color: #fff;
                    text-align: center;
                    white-space: nowrap;
                    vertical-align: baseline;
                    border-radius: .25em;float:right">ELITE USER</span>
            <?php endif ?>
            
        </div>

        <div class="card" style="max-width:94%;min-height:300px;">
            <h3><p>Choose Your Vendor and Sync Your Products</p></h3>
            <h2 class="nav-tab-wrapper wp-clearfix">
                <?php foreach ($vendors as $vendor): ?>
                    <?php if ($vendor == $active_vendor): ?>
                        <a href="<?= $admin_url.'&vendor='.$vendor?>" class="nav-tab nav-tab-active">
                    <?php else: ?>
                         <a href="<?= $admin_url.'&vendor='.$vendor?>" class="nav-tab">
                    <?php endif ?>
                        <?= $vendor ?>
                    </a>
                <?php endforeach ?>
            </h2>

            <div class="container" style="padding:1%;margin-top:2%;font-size:110%;">
                <?php if ($products_count === false && !get_transient('sync_in_progress')): ?>
                    <div style="border-left:3px solid #ffb900;padding:2%;">
                        <b>Oops! No products Found</b>
                    </div>
                <?php else: ?>
                <div style="margin-top:1%;margin-left:2%;">
                    
                <?php endif ?>
                <?php if (get_transient('sync_in_progress')): ?>

                <?php if (get_transient('sync_in_progress_total')): ?>
                    <?php
                        $total = (int)get_transient('sync_in_progress_total');
                        $done = (int)get_transient('sync_in_progress_done');
                        $percent = ($done/$total)*100;
                        $percent = (int)$percent;
                     ?>
                <?php endif ?>
                    <table style="background-color:#ffeaa7;margin-top:2%;padding:2%;">
                        <tr>
                            <td><p class="loader"></p></td>
                            <td>
                                <p style="padding:1%;"> Sync is in progress <b> <span id="progress_span"><?= $percent ?></span>% Done</b></p>
                            </td>
                        </tr>
                    </table>
                <?php else: ?>
                    <div class="subsubsub" style="float:none;">
                    <?php if (is_array($products_count)): ?>
                        <?php foreach ($products_count as $type => $count): ?>
                            <a href="<?= WEBSITE_URL.'/wp-admin/edit.php?s&post_status=all&post_type=product&action=-1&product_cat='.strtolower($type).'&product_type&stock_status&filter_action=Filter&paged=1&action2=-1' ?>" class="current"><?= $type ?> 
                                <span class="count">(<span class="all-count"><?= $count ?></span>)
                                </span>
                            </a>
                            </br>
                        <?php endforeach ?>
                    <?php endif ?>
                    </div>
                    <a style="margin-top:2%;"  href="<?= $admin_url.'&action=sync&vendor='.$active_vendor ?>"  class="button button-primary "> Sync Products</a>
                <?php endif ?>
                </div>
            </div>
        </div>
        <?php
    }

   
    echo ' </div>';
}


add_action('wp_head', 'myplugin_ajaxurl');

function myplugin_ajaxurl() {
    echo '<script type="text/javascript">
           var ajaxurl = "' . admin_url('admin-ajax.php') . '";
         </script>';
}

add_action('wp_ajax_my_action', 'my_action_callback');

function my_action_callback() {
    $total = get_transient('sync_in_progress_total');
    if(get_transient('sync_in_progress_total') && get_transient('sync_in_progress_done')){
        $total = (int)get_transient('sync_in_progress_total');
        $done = (int)get_transient('sync_in_progress_done');
        $percent = ($done/$total)*100;
        $percent = (int)$percent;
        wp_send_json_success($percent);
    }else{
        wp_send_json_success(-1);
    }
    die(); // this is required to return a proper result
}

?>
<?php if (get_transient('sync_in_progress') && $_GET['action'] != 'my_action'): ?>

<script src="<?= get_template_directory_uri(); ?>/inc/assets/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
update_progress();
function update_progress(){
    jQuery(document).ready(function($) {
        var data = {
            action: 'my_action',
            dataType: 'json'
        };
        jQuery.get(ajaxurl, data, function(response) {
            console.log(response.data);
            var percent = response.data;
            if(percent == -1)
                location.reload();
            else{
                $("#progress_span").text(percent);
                setTimeout(function(){update_progress();}, 2000);
            }
        });
    });
}
 </script>
<?php endif ?><?php



function isCurlEnabled(){
    if(function_exists('curl_version'))
        return true;
    return false;
}

function getOrderRenderUrls(){

    $key = $_GET['key'];

    if(!$key)
        return false;


    $order_id = (int)wc_get_order_id_by_order_key($key);

    $unique_order_option = 'order_'.$order_id.'_urls';
    $unique_order_option = get_option( $unique_order_option );
    if(is_array($unique_order_option))
        return $unique_order_option;


    $isEliteUser = dropmockCheckEliteStatus();
    if(!$isEliteUser)
        return false;


    $order = new WC_Order( $order_id );
    $items = $order->get_items();
    $render_urls = array();

    foreach ( $items as $item_id => $item_data ) {
        $product    = $item_data->get_product();
        $product_id = $product->get_id();
        $product_name = $product->get_name();
        $product_type = get_post_meta($product_id,'wpdmmp_m_type')[0];
        if(in_array(strtolower($product_type), ['canvas','kinetic'])){
            $uuid = get_post_meta( $product_id, 'wpdmmp_m_uuid' )[0];
            $render_uuid = sendRenderRequestToDropmock($uuid);
            $render_url = DM_RENDER_URL.'/editor#/key/'.$render_uuid;
            $render_urls[$product_name] = $render_url;
        }
    }

    if(empty($render_urls))
        return false;
    
    $unique_order_option = 'order_'.$order_id.'_urls';
    add_option( $unique_order_option, $render_urls);

    return $render_urls;
}


function sendRenderRequestToDropmock($uuid){

    $API_KEY = get_option( 'kinetic_api_key' );
    $store   =  $_SERVER['SERVER_NAME'];
    $key     = time().'-'.mt_rand(); 

    $url = DM_API_URL . "/kinetic/store/";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,
                "template=".$uuid."&store=".$store."&user_api=".$API_KEY."&key=".$key);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec ($ch);
    curl_close ($ch);

    
    if($server_output){
        return $key ;
    }

    return false;
}

function checkIfProductExists($dmProductId) {
    $args = array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'posts_per_page' => 1,
        'order' => 'DESC',
        'orderby' => 'post_date',
        'meta_key' => 'dm_product_id',
        'meta_value' => $dmProductId,
    );

    $product = get_posts($args);

    return count($product) > 0;
}   


function dropmockMarketDisconnectStore(){
    delete_option('kinetic_api_key');
    delete_option('kinetic_api_name');
}

function dropmockCheckEliteStatus(){
    $API_KEY = get_option('kinetic_api_key');
    $url = DM_API_URL . "/api/v1/check_api?key=" . $API_KEY;
    $ch = curl_init( $url );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    $result = curl_exec( $ch );

    $result = json_decode($result);
    if($result == 'failed' || $result == null)
        return false;

    if($result->is_dropmock_store_elite_user === true)
        return true;

}

function updateMyVendors(){

    $API_KEY = get_option('kinetic_api_key');
    $url = DM_API_URL . "/api/v1/check_api?key=" . $API_KEY.'&domain='.WEBSITE_URL;
    $ch = curl_init( $url );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    $result = curl_exec( $ch );

    if(curl_error($ch))
    {
        return 'Configuration Error Occurred : '.curl_error($ch);
    }

    curl_close ($ch);

    $result = json_decode($result);

    if($result == 'failed' || $result == null)
        return 'fail';

    $vendors = array('DropMock');

    if($result->youzign_key != '' && $result->youzign_token != '')
        $vendors[] = 'Youzign';

    if($result->designpro_key != '')
        $vendors[] = 'DesignoPro';
    
    if(get_option('vendors'))
        update_option('vendors',$vendors);
    else
        add_option( 'vendors', $vendors, '', 'yes' );
}

function dropmockCheckAPIKey($API_KEY){
    $url = DM_API_URL . "/api/v1/check_api?key=" . $API_KEY.'&domain='.WEBSITE_URL;
    $ch = curl_init( $url );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    $result = curl_exec( $ch );

    if(curl_error($ch))
    {
        return 'Configuration Error Occurred : '.curl_error($ch);
    }

    curl_close ($ch);

    $result = json_decode($result);
    if($result == 'failed' || $result == null)
        return 'fail';

    $vendors = array('DropMock');

    if($result->youzign_key != '' && $result->youzign_token != '')
        $vendors[] = 'Youzign';

    if($result->designpro_key != '')
        $vendors[] = 'DesignoPro';
    
    if(get_option('vendors'))
        update_option('vendors',$vendors);
    else
        add_option( 'vendors', $vendors, '', 'yes' );

    add_option( 'elite_user', false, '', 'yes' );
    if($result->is_dropmock_store_elite_user === true)
        update_option( 'elite_user', $result->is_dropmock_store_elite_user);
    else
        update_option( 'elite_user', false);

    add_option( 'kinetic_api_key', $API_KEY, '', 'yes' );
    add_option( 'kinetic_api_name', $result->name, '', 'yes' );
    
    return 'success';
}

function getProductCategories(){
      $taxonomy     = 'product_cat';
      $orderby      = 'name';  
      $show_count   = 0;      // 1 for yes, 0 for no
      $pad_counts   = 0;      // 1 for yes, 0 for no
      $hierarchical = 1;      // 1 for yes, 0 for no  
      $title        = '';  
      $empty        = 1;

      $args = array(
             'taxonomy'     => $taxonomy,
             'orderby'      => $orderby,
             'show_count'   => $show_count,
             'pad_counts'   => $pad_counts,
             'hierarchical' => $hierarchical,
             'title_li'     => $title,
             'hide_empty'   => $empty
      );
     $all_categories = get_categories( $args );

     return $all_categories;
}


function dropmockMarketPlaceCountProducts($vendor) {

    $productsCount = [];
    if(strcasecmp($vendor,'dropmock') === 0)
        $types = ['IMAGES', 'VIDEOS', 'PITCH', 'KINETIC', 'CANVAS', 'FEATURED'];

    if(strcasecmp($vendor,'designopro') === 0)
        $types = ['DesignoPro'];


    if(strcasecmp($vendor,'youzign') === 0)
        $types = ['Youzign'];
        
    foreach ($types as $type) {
        $args = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => 10000,
            'order' => 'DESC',
            'orderby' => 'post_date',
            'meta_key' => 'wpdmmp_m_type',
            'meta_value' => strtolower($type),
        );

        $productsCount[$type] = (int) count(get_posts($args));
    }


    $no_products = true;
    foreach ($productsCount as $count) {
        if($count > 0 )
            $no_products = false;
    }

    if($no_products)
        return false;

    return $productsCount;

}



function dropmockStoreAddProduct($product) {

    if(is_object($product))
        $product = (array) $product;
    // Current user
    $user_id = get_current_user_id();

    $post = array(
        'post_author' => $user_id,
        'post_content' => $product['desc'],
        'post_status' => "publish",
        'post_title' => $product['title'], //$product->part_num,
        'post_parent' => '',
        'post_type' => "product",
    );

    //Create post
    $post_id = wp_insert_post($post);

    if (!$post_id) {
        return false;
    }

    $price = dropmockStoreGetProductPrice($product);

    // Just for our reference so we can wipe + restart if desired
    update_post_meta($post_id, 'is_dm_product', '1');
    update_post_meta($post_id, 'dm_product_id', $product['id']); // This is not actually DM ID but TIMESTAMP of CREATED_AT
    //update_post_meta($post_id, 'wpmvp_hostimgurl', dropmockStorePlaceholderImageUrl($product));
    update_post_meta($post_id, '_downloadable', 'no');
    update_post_meta($post_id, '_virtual', 'yes'); // this is a virtual product
    update_post_meta($post_id, '_visibility', 'visible'); // always visible
    update_post_meta($post_id, '_stock_status', 'instock'); // always in stock
    update_post_meta($post_id, 'total_sales', '0'); // unlimited sales
    update_post_meta($post_id, '_regular_price', dropmockStoreGetProductPrice($product)); // lets set the fair price
    update_post_meta($post_id, '_price', dropmockStoreGetProductPrice($product)); // no discount. user can change this if he wishes
    update_post_meta($post_id, '_purchase_note', "");
    update_post_meta($post_id, '_featured', "no");
    update_post_meta($post_id, '_weight', "");
    update_post_meta($post_id, '_length', "");
    update_post_meta($post_id, '_width', "");
    update_post_meta($post_id, '_height', "");
    update_post_meta($post_id, '_sku', "");
    update_post_meta($post_id, '_product_attributes', []);
    update_post_meta($post_id, '_sale_price_dates_from', "");
    update_post_meta($post_id, '_sale_price_dates_to', "");
    update_post_meta($post_id, '_sold_individually', "yes"); // Stops quantities
    update_post_meta($post_id, '_manage_stock', "no");
    update_post_meta($post_id, '_backorders', "no");
    update_post_meta($post_id, '_stock', "");
    update_post_meta($post_id, '_product_image_gallery', '');

    $category = $product['category'];

    if (!empty($category)) {

        $catTermID = false;
        $catTerm = term_exists($category, 'product_cat'); // array is returned if taxonomy is given
        if ($catTerm !== 0 && $catTerm !== null) {

            if (is_array($catTerm)) {

                if (isset($catTerm['term_id'])) {
                    $catTermID = $catTerm['term_id'];
                }

            } else {

                $catTermID = $catTerm;

            }

        } else {

            $newTerm = wp_insert_term(
                $category, // the term
                'product_cat', // the taxonomy
                array(
                    'description' => $category,
                )
            );

            if (is_array($newTerm)) {

                if (isset($newTerm['term_id'])) {
                    $catTermID = $newTerm['term_id'];
                }

            }

        }

        if (isset($catTermID) && !empty($catTermID) && $catTermID !== false) {

            // https://codex.wordpress.org/Function_Reference/wp_set_object_terms
            wp_set_object_terms($post_id, (int) $catTermID, 'product_cat', true);

        } else {

            exit('Error creating category!: ' . $category);

        }

    }

    if (isset($product['meta']) && is_array($product['meta'])) {
        foreach ($product['meta'] as $metaKey => $metaVal) {
            if ($metaKey === 'preview_url') {
                $val = $metaVal;
            } else {
                $val = $metaVal;
            }

            update_post_meta($post_id, 'wpdmmp_m_' . $metaKey, $val);

        }
    }

    if (isset($product['imgsrc']) && !empty($product['imgsrc'])) {
        agencytheme_attachImg($product['imgsrc'], $post_id);
    }

    return $post_id;

}

function dropmockStoreDeleteProduct($id){

    wp_delete_post($id, true);
}


function dropmockStoreGetProductPrice($item) {
    switch ($item['category']) {
        case 'IMAGES':
            return 47;
        case 'VIDEOS':
            return 67;
        case 'PITCH':
            return 67;
        case 'KINETIC':
            return 97;
        case 'CANVAS':
            return 77;
        default:
            return 147;
    }
}


#http://wordpress.stackexchange.com/questions/100838/how-to-set-featured-image-to-custom-post-from-outside-programmatically
function agencytheme_attachImg($imgURL = '', $attachToPostID = -1) {

    

    // magic sideload image returns an HTML image, not an ID
    $media = media_sideload_image($imgURL, $attachToPostID);

    // therefore we must find it so we can set it as featured ID
    if (!empty($media) && !is_wp_error($media)) {
        $args = array(
            'post_type' => 'attachment',
            'posts_per_page' => -1,
            'post_status' => 'any',
            'post_parent' => $attachToPostID,
        );

        // reference new image to set as featured
        $attachments = get_posts($args);

        if (isset($attachments) && is_array($attachments)) {
            foreach ($attachments as $attachment) {
                // grab source of full size images (so no 300x150 nonsense in path)
                $image = wp_get_attachment_image_src($attachment->ID, 'full');
                // determine if in the $media image we created, the string of the URL exists
                if (strpos($media, $image[0]) !== false) {
                    // if so, we found our image. set it as thumbnail
                    set_post_thumbnail($attachToPostID, $attachment->ID);
                    // only want one image
                    break;
                }
            }
        }
    }
}



add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail_dm_mp', 10);

function woocommerce_template_loop_product_thumbnail_dm_mp() {

    global $dmMpConfig;

    //if (isset($dmMpConfig['videohover']) && $dmMpConfig['videohover'] == "1") {

    global $post;

    $meta = get_post_meta($post->ID);

    $preview_url = $meta['wpdmmp_m_preview_url'][0];
    $type = $meta['wpdmmp_m_type'][0];

    // $preview_url = get_post_meta($post->ID, 'wpdmmp_m_preview_url', true);
    // $postType = get_post_meta($post->ID, 'wmpvp_m_type', true);

    // $videoMetaMP4 = get_post_meta($post->ID, 'wpdmmp_m_demosrcmp4', true);
    // $videoMetaWebM = get_post_meta($post->ID, 'wpdmmp_m_demosrcwebm', true);

    if ($type === 'Images') {
        $imgURL = get_the_post_thumbnail_url($post->ID, apply_filters('single_product_large_thumbnail_size', 'shop_single'));

        echo <<<TEMPLATE
            <div class="dmmp-hover item-image">
                <div class="embed-responsive embed-responsive-16by9">
                    <img style="width:100%" src="$imgURL" class="attachment-shop_single size-shop_single wp-post-image">
                </div>
            </div>
TEMPLATE;
    } else {
        $imgStr = dropmockStorePlaceholderImage(true);
        $imgURL = dropmockStorePlaceholderImage(false);
        dropmockMarketPlaceVideoOnHover($preview_url, $imgStr, $imgURL);
    }

}


function dropmockStorePlaceholderImage($withTag = false) {
    global $post;

    $imgURL = '';
    $imgStr = '';

    $pot = get_post_meta($post->ID, 'wpmvp_hostimgurl', true);

    if (isset($post) && has_post_thumbnail()) {
        $props = wc_get_product_attachment_props(get_post_thumbnail_id(), $post);
        /* this gets whole image
                                    $image            = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
                                      'title'  => "No video playback capabilities, please download the video below", #$props['title'],
                                      'alt'    => $props['alt'],
                                    ) );
        */
        $imgURL = get_the_post_thumbnail_url($post->ID, apply_filters('single_product_large_thumbnail_size', 'shop_single'));
    }

    $imgStr = '<img style="width:100%" src="' . $imgURL . '" class="attachment-shop_single size-shop_single wp-post-image" alt="No Video Playback." title="No video playback capabilities!">';

    if ($withTag) {
        return $imgStr;
    } else {
        return $imgURL;
    }

}

function dropmockStorePlaceholderImageUrl($productDeets) {
    return DM_CLOUDFRONT_DOMAIN . '/default.jpg';
}


function dropmockMarketPlaceVideoOnHover($url, $img = '', $imgURL = '') {
    ?>
      <div class="dmmp-hover item-image">
        <div class="embed-responsive embed-responsive-16by9">
            <video class="mejs__player" width="100%" height="100%" loop="" preload="none" poster="<?php echo $imgURL; ?>">features: ['playpause','progress','current','duration','tracks','volume','fullscreen'],

                <?php if (!empty($url)) {?><source src="<?php echo $url; ?>"><?php }?>

                <!-- fallback image -->
                <?php echo $img; ?>
            </video>
        </div>
      </div>
      <?php

}

?>