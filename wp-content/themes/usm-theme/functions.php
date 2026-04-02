<?php
/**
 * USM Theme - functions.php
 *
 * Funcțiile principale ale temei: suport pentru caracteristici WordPress,
 * înregistrarea meniurilor, widget-urilor și încărcarea stilurilor/scripturilor.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'USM_THEME_VERSION', '1.0.0' );
define( 'USM_THEME_DIR', get_template_directory() );
define( 'USM_THEME_URI', get_template_directory_uri() );

/**
 * Configurarea caracteristicilor temei.
 */
function usm_theme_setup() {
    load_theme_textdomain( 'usm-theme', USM_THEME_DIR . '/languages' );

    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );
    add_theme_support( 'customize-selective-refresh-widgets' );
    add_theme_support( 'custom-logo', array(
        'height'      => 60,
        'width'       => 200,
        'flex-width'  => true,
        'flex-height' => true,
    ) );
    add_theme_support( 'post-formats', array(
        'aside',
        'image',
        'video',
        'quote',
        'link',
        'gallery',
    ) );

    register_nav_menus( array(
        'primary' => esc_html__( 'Meniu principal', 'usm-theme' ),
        'footer'  => esc_html__( 'Meniu subsol', 'usm-theme' ),
    ) );

    add_image_size( 'usm-featured', 800, 450, true );
    add_image_size( 'usm-thumbnail', 400, 250, true );
}
add_action( 'after_setup_theme', 'usm_theme_setup' );

/**
 * Setarea lățimii conținutului.
 */
function usm_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'usm_content_width', 800 );
}
add_action( 'after_setup_theme', 'usm_content_width', 0 );

/**
 * Înregistrarea zonelor de widget-uri (sidebar-uri).
 */
function usm_theme_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Bara laterală principală', 'usm-theme' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Adaugă widget-uri în bara laterală.', 'usm-theme' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Bara laterală postare singulară', 'usm-theme' ),
        'id'            => 'sidebar-single',
        'description'   => esc_html__( 'Bara laterală afișată pe paginile de postare individuală.', 'usm-theme' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Subsol - Coloana 1', 'usm-theme' ),
        'id'            => 'footer-1',
        'description'   => esc_html__( 'Prima coloană din subsol.', 'usm-theme' ),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'usm_theme_widgets_init' );

/**
 * Încărcarea stilurilor și scripturilor temei.
 */
function usm_theme_scripts() {
    wp_enqueue_style(
        'usm-theme-style',
        get_stylesheet_uri(),
        array(),
        USM_THEME_VERSION
    );

    wp_enqueue_style(
        'usm-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap',
        array(),
        null
    );

    wp_enqueue_script(
        'usm-theme-navigation',
        USM_THEME_URI . '/js/navigation.js',
        array(),
        USM_THEME_VERSION,
        true
    );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'usm_theme_scripts' );

/**
 * Funcție helper: afișează metadatele postării.
 */
function usm_post_meta() {
    $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';

    $time_string = sprintf(
        $time_string,
        esc_attr( get_the_date( DATE_W3C ) ),
        esc_html( get_the_date() )
    );

    echo '<span class="posted-on">' . $time_string . '</span>';
    echo '<span class="byline"> ' . esc_html__( 'de', 'usm-theme' ) . ' ';
    echo '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span></span>';
}

/**
 * Funcție helper: afișează categoriile și etichetele postării.
 */
function usm_post_taxonomy() {
    $categories = get_the_category();
    if ( $categories ) {
        echo '<span class="cat-links">' . esc_html__( 'Categorii: ', 'usm-theme' );
        foreach ( $categories as $cat ) {
            echo '<a href="' . esc_url( get_category_link( $cat->term_id ) ) . '">' . esc_html( $cat->name ) . '</a> ';
        }
        echo '</span>';
    }

    $tags = get_the_tags();
    if ( $tags ) {
        echo '<span class="tags-links">' . esc_html__( 'Etichete: ', 'usm-theme' );
        foreach ( $tags as $tag ) {
            echo '<a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '">' . esc_html( $tag->name ) . '</a> ';
        }
        echo '</span>';
    }
}

/**
 * Modificarea lungimii rezumatului automat.
 */
function usm_excerpt_length( $length ) {
    return 25;
}
add_filter( 'excerpt_length', 'usm_excerpt_length', 999 );

/**
 * Modificarea textului „citește mai mult" din rezumat.
 */
function usm_excerpt_more( $more ) {
    return '&hellip;';
}
add_filter( 'excerpt_more', 'usm_excerpt_more' );
