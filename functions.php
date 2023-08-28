<?php

/**
 * website-revo functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package website-revo
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function website_revo_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on website-revo, use a find and replace
		* to change 'website-revo' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('website-revo', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'website-revo'),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'website_revo_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'website_revo_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function website_revo_content_width()
{
	$GLOBALS['content_width'] = apply_filters('website_revo_content_width', 640);
}
add_action('after_setup_theme', 'website_revo_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function website_revo_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'website-revo'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'website-revo'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'website_revo_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function website_revo_scripts() {
    // Enqueue styles
    wp_enqueue_style('website-revo-style', get_stylesheet_uri(), array(), _S_VERSION);
    wp_enqueue_style('website-revo-style-vendor', get_stylesheet_directory_uri() . '/assets/css/vendor.css', array(), _S_VERSION);
    wp_enqueue_style('website-revo-style-swiper', 'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css', array(), _S_VERSION);
    wp_enqueue_style('website-revo-style-main', get_stylesheet_directory_uri() . '/assets/css/main.css', array(), _S_VERSION);
    wp_style_add_data('website-revo-style', 'rtl', 'replace');

    // Enqueue scripts
    wp_enqueue_script('website-revo-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), _S_VERSION, true);
    wp_enqueue_script('website-revo-swiper', 'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js', array(), _S_VERSION, true);
    wp_enqueue_script('website-revo-main', get_stylesheet_directory_uri() . '/assets/js/main.js', array('website-revo-swiper'), _S_VERSION, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'website_revo_scripts');


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

if (function_exists("acf_add_options_page")) {
	acf_add_options_page(array(
		"page_title" => "Настройки сайта",
		"menu_title" => "Настройки сайта",
		"menu_slug"  => "theme_settings",
	));
}

function custom_menu_item_attributes($atts, $item, $args)
{
	$atts['data-menu-item'] = 'your-custom-value';
	return $atts;
}
add_filter('nav_menu_link_attributes', 'custom_menu_item_attributes', 10, 3);

class Custom_Menu_Walker extends Walker_Nav_Menu
{
	function start_lvl(&$output, $depth = 0, $args = NULL)
	{
		// Customize the opening <ul> tag for sub-menus
		// depth dependent classes
		$indent = ($depth > 0  ? str_repeat("\t", $depth) : ''); // code indent
		$display_depth = ($depth + 1); // because it counts the first submenu as 0
		$classes = array(
			'sub-menu',
			($display_depth % 2  ? 'menu-odd' : 'menu-even'),
			($display_depth >= 2 ? 'sub-sub-menu' : ''),
			'menu-depth-' . $display_depth
		);
		$class_names = implode(' ', $classes);

		// build html
		$output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
	}


	function start_el(&$output, $data_object, $depth = 0, $args = null, $current_object_id = 0)
	{
		// Customize the <li> tag
		global $wp_query;

		// Restores the more descriptive, specific name for use within this method.
		$item = $data_object;

		$indent = ($depth > 0 ? str_repeat("\t", $depth) : ''); // code indent

		// depth dependent classes
		$depth_classes = array(
			($depth == 0 ? 'main-menu-item' : 'sub-menu-item'),
			($depth >= 2 ? 'sub-sub-menu-item' : ''),
			($depth % 2 ? 'menu-item-odd' : 'menu-item-even'),
			'menu-item-depth-' . $depth
		);
		$depth_class_names = esc_attr(implode(' ', $depth_classes));

		// passed classes
		$classes = empty($item->classes) ? array() : (array) $item->classes;
		$class_names = esc_attr(implode(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item)));

		// build html
		$output .= $indent . '<li data-menu-item id="nav-menu-item-' . $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';

		// link attributes
		$attributes  = !empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) . '"' : '';
		$attributes .= !empty($item->target)     ? ' target="' . esc_attr($item->target) . '"' : '';
		$attributes .= !empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn) . '"' : '';
		$attributes .= !empty($item->url)        ? ' href="'   . esc_attr($item->url) . '"' : '';
		$attributes .= ' class="menu-link ' . ($depth > 0 ? 'sub-menu-link' : 'main-menu-link') . '"';

		$item_output = sprintf(
			'%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
			$args->before,
			$attributes,
			$args->link_before,
			apply_filters('the_title', $item->title, $item->ID),
			$args->link_after,
			$args->after
		);

		// build html
		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
	}

	// function end_el(&$output, $item, $depth = 0, $args = null) {
	//     // Customize the closing </li> tag
	//     $output .= '</li>';
	// }
}

function add_custom_fonts()
{
?>
	<link rel="preload" as="font" type="font/woff2" crossorigin href="<?php echo get_template_directory_uri(); ?>/assets/fonts/Nunito-Bold.woff2">
	<link rel="preload" as="font" type="font/woff2" crossorigin href="<?php echo get_template_directory_uri(); ?>/assets/fonts/Nunito-Light.woff2">
	<link rel="preload" as="font" type="font/woff2" crossorigin href="<?php echo get_template_directory_uri(); ?>/assets/fonts/Nunito-LightItalic.woff2">
	<link rel="preload" as="font" type="font/woff2" crossorigin href="<?php echo get_template_directory_uri(); ?>/assets/fonts/Nunito-SemiBold.woff2">

	<link rel="preload" as="font" type="font/woff2" crossorigin href="<?php echo get_template_directory_uri(); ?>/assets/fonts/OpenSans-Bold.woff2">
	<link rel="preload" as="font" type="font/woff2" crossorigin href="<?php echo get_template_directory_uri(); ?>/assets/fonts/OpenSans-ExtraBold.woff2">
	<link rel="preload" as="font" type="font/woff2" crossorigin href="<?php echo get_template_directory_uri(); ?>/assets/fonts/OpenSans-LightItalic.woff2">
	<link rel="preload" as="font" type="font/woff2" crossorigin href="<?php echo get_template_directory_uri(); ?>/assets/fonts/OpenSans-Regular.woff2">
	<link rel="preload" as="font" type="font/woff2" crossorigin href="<?php echo get_template_directory_uri(); ?>/assets/fonts/OpenSans-SemiBold.woff2">

	<link rel="preload" as="font" type="font/woff2" crossorigin href="<?php echo get_template_directory_uri(); ?>/assets/fonts/Montserrat-Black.woff2">
	<link rel="preload" as="font" type="font/woff2" crossorigin href="<?php echo get_template_directory_uri(); ?>/assets/fonts/Montserrat-Medium.woff2">
<?php
}
add_action('wp_head', 'add_custom_fonts');

function enqueue_icon_font()
{
?>
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" type="image/x-icon">
<?php
}
add_action('wp_enqueue_scripts', 'enqueue_icon_font');





function custom_theme_colors($wp_customize) {
    // Add a new section for colors
    $wp_customize->add_section('colors', array(
        'title' => __('Цвета', 'your-theme-textdomain'),
        'priority' => 30,
    ));

    // Add a setting for the primary color
    $wp_customize->add_setting('primary_color', array(
        'default' => '#3498db', // Default blue color
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    // Add a control for the primary color
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_color', array(
        'label' => __('Primary Color', 'your-theme-textdomain'),
        'section' => 'colors',
        'settings' => 'primary_color',
    )));

    // Add a setting for the secondary color
    $wp_customize->add_setting('secondary_color', array(
        'default' => '#e74c3c', // Default red color
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    // Add a control for the secondary color
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'secondary_color', array(
        'label' => __('Secondary Color', 'your-theme-textdomain'),
        'section' => 'colors',
        'settings' => 'secondary_color',
    )));
}
add_action('customize_register', 'custom_theme_colors');

