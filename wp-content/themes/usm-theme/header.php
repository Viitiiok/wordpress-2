<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">

    <header id="site-header" role="banner">
        <div class="header-inner">
            <div class="site-branding">
                <?php if ( has_custom_logo() ) : ?>
                    <div class="site-logo"><?php the_custom_logo(); ?></div>
                <?php endif; ?>
                <p class="site-title">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                        <?php bloginfo('name'); ?>
                    </a>
                </p>
                <?php
                $description = get_bloginfo('description', 'display');
                if ( $description ) : ?>
                    <p class="site-description"><?php echo esc_html( $description ); ?></p>
                <?php endif; ?>
            </div>

            <nav id="site-navigation" class="main-navigation" role="navigation"
                 aria-label="<?php esc_attr_e('Meniu principal', 'usm-theme'); ?>">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'fallback_cb'    => function() {
                        echo '<ul id="primary-menu">';
                        echo '<li><a href="' . esc_url( home_url('/') ) . '">' . __('Acasă', 'usm-theme') . '</a></li>';
                        wp_list_pages( array(
                            'title_li' => '',
                            'depth'    => 1,
                            'echo'     => true,
                        ) );
                        echo '</ul>';
                    },
                ) );
                ?>
            </nav>
        </div>
    </header>

    <div class="site-wrapper">
        <div class="site-content-area">
