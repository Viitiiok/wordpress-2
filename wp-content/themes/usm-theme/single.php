<?php get_header(); ?>

            <main id="main-content" class="main-content" role="main">

                <?php while ( have_posts() ) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class('single-post-wrapper'); ?>>

                    <header class="entry-header">
                        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                        <div class="entry-meta">
                            <?php usm_post_meta(); ?>
                            <span class="comments-link">
                                <a href="<?php comments_link(); ?>">
                                    <?php comments_number(
                                        __('0 comentarii', 'usm-theme'),
                                        __('1 comentariu', 'usm-theme'),
                                        __('% comentarii', 'usm-theme')
                                    ); ?>
                                </a>
                            </span>
                        </div>
                    </header>

                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="entry-featured-image">
                            <?php the_post_thumbnail('usm-featured'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="entry-content">
                        <?php
                        the_content( sprintf(
                            wp_kses(
                                __( 'Continuă să citești %s <span class="meta-nav">&rarr;</span>', 'usm-theme' ),
                                array( 'span' => array( 'class' => array() ) )
                            ),
                            the_title( '<span class="screen-reader-text">"', '"</span>', false )
                        ) );

                        wp_link_pages( array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pagini:', 'usm-theme' ),
                            'after'  => '</div>',
                        ) );
                        ?>
                    </div>

                    <footer class="entry-footer">
                        <?php usm_post_taxonomy(); ?>
                    </footer>

                </article>

                <nav class="post-navigation" role="navigation" aria-label="<?php esc_attr_e('Navigare postări', 'usm-theme'); ?>">
                    <div class="nav-previous">
                        <?php previous_post_link( '%link', '&larr; ' . esc_html__('Postarea anterioară', 'usm-theme') ); ?>
                    </div>
                    <div class="nav-next">
                        <?php next_post_link( '%link', esc_html__('Postarea următoare', 'usm-theme') . ' &rarr;' ); ?>
                    </div>
                </nav>

                <?php
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;
                ?>

                <?php endwhile; ?>

            </main><!-- #main-content -->

            <?php get_sidebar( 'single' ); ?>

<?php get_footer(); ?>
