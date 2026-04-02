<?php get_header(); ?>

            <main id="main-content" class="main-content" role="main">

                <?php if ( have_posts() ) : ?>

                    <header class="archive-header">
                        <?php
                        the_archive_title( '<h1 class="archive-title">', '</h1>' );
                        the_archive_description( '<div class="archive-description">', '</div>' );
                        ?>
                    </header>

                    <div class="posts-list">
                        <?php while ( have_posts() ) : the_post(); ?>

                        <article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>

                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="post-card-thumbnail">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('usm-thumbnail'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <div class="post-card-body">
                                <div class="post-card-meta">
                                    <span class="post-date">
                                        <time datetime="<?php echo esc_attr( get_the_date('c') ); ?>">
                                            <?php echo esc_html( get_the_date() ); ?>
                                        </time>
                                    </span>
                                    <span class="post-author">
                                        <?php esc_html_e('De:', 'usm-theme'); ?>
                                        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta('ID') ) ); ?>">
                                            <?php the_author(); ?>
                                        </a>
                                    </span>
                                    <span class="post-comments">
                                        <a href="<?php comments_link(); ?>">
                                            <?php comments_number(
                                                __('0 comentarii', 'usm-theme'),
                                                __('1 comentariu', 'usm-theme'),
                                                __('% comentarii', 'usm-theme')
                                            ); ?>
                                        </a>
                                    </span>
                                </div>

                                <h2 class="post-card-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>

                                <div class="post-card-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>

                                <a href="<?php the_permalink(); ?>" class="read-more-btn">
                                    <?php esc_html_e('Citește mai mult &rarr;', 'usm-theme'); ?>
                                </a>
                            </div>

                        </article>

                        <?php endwhile; ?>
                    </div>

                    <nav class="pagination" role="navigation" aria-label="<?php esc_attr_e('Navigare arhivă', 'usm-theme'); ?>">
                        <?php
                        the_posts_pagination( array(
                            'mid_size'  => 2,
                            'prev_text' => esc_html__( '&larr; Anterior', 'usm-theme' ),
                            'next_text' => esc_html__( 'Următor &rarr;', 'usm-theme' ),
                        ) );
                        ?>
                    </nav>

                <?php else : ?>

                    <div class="no-results-wrapper">
                        <h1><?php esc_html_e('Nicio postare găsită', 'usm-theme'); ?></h1>
                        <p><?php esc_html_e('Nu există postări în această arhivă.', 'usm-theme'); ?></p>
                    </div>

                <?php endif; ?>

            </main><!-- #main-content -->

            <?php get_sidebar(); ?>

<?php get_footer(); ?>
