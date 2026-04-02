<?php get_header(); ?>

            <main id="main-content" class="main-content" role="main">

                <?php if ( have_posts() ) : ?>

                    <div class="posts-list">
                        <?php
                        $home_query = new WP_Query( array(
                            'posts_per_page' => 5,
                            'post_status'    => 'publish',
                        ) );

                        while ( $home_query->have_posts() ) :
                            $home_query->the_post();
                        ?>

                        <article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>

                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="post-card-thumbnail">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('large'); ?>
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
                                    <?php
                                    $categories = get_the_category();
                                    if ( $categories ) :
                                    ?>
                                    <span class="post-categories">
                                        <?php esc_html_e('Categorie:', 'usm-theme'); ?>
                                        <?php
                                        foreach ( $categories as $cat ) {
                                            echo '<a href="' . esc_url( get_category_link( $cat->term_id ) ) . '">' . esc_html( $cat->name ) . '</a> ';
                                        }
                                        ?>
                                    </span>
                                    <?php endif; ?>
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

                        <?php
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </div>

                    <nav class="pagination" role="navigation" aria-label="<?php esc_attr_e('Navigare postări', 'usm-theme'); ?>">
                        <?php
                        echo paginate_links( array(
                            'total'   => $home_query->max_num_pages,
                            'current' => max( 1, get_query_var('paged') ),
                        ) );
                        ?>
                    </nav>

                <?php else : ?>

                    <div class="no-results-wrapper">
                        <h1><?php esc_html_e('Nicio postare găsită', 'usm-theme'); ?></h1>
                        <p><?php esc_html_e('Nu există postări de afișat momentan. Revino mai târziu!', 'usm-theme'); ?></p>
                    </div>

                <?php endif; ?>

            </main><!-- #main-content -->

            <?php get_sidebar(); ?>

<?php get_footer(); ?>
