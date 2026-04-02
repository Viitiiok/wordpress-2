        </div><!-- .site-content-area -->
    </div><!-- .site-wrapper -->

    <footer id="site-footer" role="contentinfo">
        <div class="footer-inner">
            <div class="footer-widget">
                <h3><?php bloginfo('name'); ?></h3>
                <p>
                    <?php
                    $description = get_bloginfo('description', 'display');
                    if ( $description ) {
                        echo esc_html( $description );
                    } else {
                        esc_html_e('Un site WordPress creat cu tema USM Theme.', 'usm-theme');
                    }
                    ?>
                </p>
            </div>

            <div class="footer-widget">
                <h3><?php esc_html_e('Pagini', 'usm-theme'); ?></h3>
                <ul>
                    <?php
                    wp_list_pages( array(
                        'title_li' => '',
                        'depth'    => 1,
                        'echo'     => true,
                    ) );
                    ?>
                </ul>
            </div>

            <div class="footer-widget">
                <h3><?php esc_html_e('Categorii', 'usm-theme'); ?></h3>
                <ul>
                    <?php
                    wp_list_categories( array(
                        'title_li'   => '',
                        'show_count' => true,
                        'orderby'    => 'count',
                        'order'      => 'DESC',
                        'number'     => 6,
                    ) );
                    ?>
                </ul>
            </div>

            <div class="footer-widget">
                <h3><?php esc_html_e('Postări recente', 'usm-theme'); ?></h3>
                <ul>
                    <?php
                    $recent_posts = wp_get_recent_posts( array(
                        'numberposts' => 5,
                        'post_status' => 'publish',
                    ) );
                    foreach ( $recent_posts as $post ) :
                        ?>
                        <li>
                            <a href="<?php echo esc_url( get_permalink( $post['ID'] ) ); ?>">
                                <?php echo esc_html( $post['post_title'] ); ?>
                            </a>
                        </li>
                    <?php endforeach;
                    wp_reset_postdata(); ?>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>
                &copy; <?php echo esc_html( date('Y') ); ?>
                <a href="<?php echo esc_url( home_url('/') ); ?>"><?php bloginfo('name'); ?></a>.
                <?php esc_html_e('Toate drepturile rezervate.', 'usm-theme'); ?>
                &mdash;
                <?php
                printf(
                    esc_html__('Powered by %s', 'usm-theme'),
                    '<a href="https://wordpress.org" target="_blank" rel="noopener noreferrer">WordPress</a>'
                );
                ?>
                &mdash; <?php esc_html_e('Temă: USM Theme', 'usm-theme'); ?>
            </p>
        </div>
    </footer>

</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
