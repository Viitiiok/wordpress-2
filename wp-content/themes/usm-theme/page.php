<?php get_header(); ?>

            <main id="main-content" class="main-content" role="main">

                <?php while ( have_posts() ) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class('page-wrapper'); ?>>

                    <header class="entry-header">
                        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                    </header>

                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="entry-featured-image">
                            <?php the_post_thumbnail('usm-featured'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="entry-content">
                        <?php
                        the_content();

                        wp_link_pages( array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pagini:', 'usm-theme' ),
                            'after'  => '</div>',
                        ) );
                        ?>
                    </div>

                    <?php if ( get_edit_post_link() ) : ?>
                        <footer class="entry-footer">
                            <?php
                            edit_post_link(
                                sprintf(
                                    wp_kses(
                                        __( 'Editează <span class="screen-reader-text">%s</span>', 'usm-theme' ),
                                        array( 'span' => array( 'class' => array() ) )
                                    ),
                                    wp_kses_post( get_the_title() )
                                ),
                                '<span class="edit-link">',
                                '</span>'
                            );
                            ?>
                        </footer>
                    <?php endif; ?>

                </article>

                <?php
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;
                ?>

                <?php endwhile; ?>

            </main><!-- #main-content -->

            <?php get_sidebar(); ?>

<?php get_footer(); ?>
