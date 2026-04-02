<aside id="sidebar" class="widget-area" role="complementary"
       aria-label="<?php esc_attr_e('Bara laterală', 'usm-theme'); ?>">

    <?php
    $sidebar_id = is_singular( 'post' ) ? 'sidebar-single' : 'sidebar-1';

    if ( is_active_sidebar( $sidebar_id ) ) :
        dynamic_sidebar( $sidebar_id );
    else :
    ?>

        <section class="widget widget_recent_entries">
            <h2 class="widget-title"><?php esc_html_e('Postări recente', 'usm-theme'); ?></h2>
            <ul>
                <?php
                $recent = new WP_Query( array(
                    'posts_per_page' => 5,
                    'post_status'    => 'publish',
                ) );
                while ( $recent->have_posts() ) :
                    $recent->the_post();
                    ?>
                    <li>
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        <br>
                        <small><?php echo esc_html( get_the_date() ); ?></small>
                    </li>
                <?php endwhile;
                wp_reset_postdata(); ?>
            </ul>
        </section>

        <section class="widget widget_categories">
            <h2 class="widget-title"><?php esc_html_e('Categorii', 'usm-theme'); ?></h2>
            <ul>
                <?php
                wp_list_categories( array(
                    'title_li'   => '',
                    'show_count' => true,
                    'orderby'    => 'count',
                    'order'      => 'DESC',
                ) );
                ?>
            </ul>
        </section>

        <section class="widget widget_archive">
            <h2 class="widget-title"><?php esc_html_e('Arhivă', 'usm-theme'); ?></h2>
            <ul>
                <?php wp_get_archives( array( 'type' => 'monthly', 'show_post_count' => true ) ); ?>
            </ul>
        </section>

        <section class="widget widget_search">
            <h2 class="widget-title"><?php esc_html_e('Căutare', 'usm-theme'); ?></h2>
            <?php get_search_form(); ?>
        </section>

        <section class="widget widget_tag_cloud">
            <h2 class="widget-title"><?php esc_html_e('Etichete', 'usm-theme'); ?></h2>
            <?php
            wp_tag_cloud( array(
                'smallest' => 11,
                'largest'  => 18,
                'unit'     => 'px',
                'number'   => 20,
                'format'   => 'flat',
                'orderby'  => 'count',
                'order'    => 'DESC',
            ) );
            ?>
        </section>

    <?php endif; ?>

</aside>
