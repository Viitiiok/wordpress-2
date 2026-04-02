<?php
if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-section">

    <?php if ( have_comments() ) : ?>

        <h2 class="comments-title">
            <?php
            $comment_count = get_comments_number();
            if ( '1' === $comment_count ) {
                printf(
                    esc_html__( 'Un comentariu la &ldquo;%1$s&rdquo;', 'usm-theme' ),
                    '<span>' . wp_kses_post( get_the_title() ) . '</span>'
                );
            } else {
                printf(
                    esc_html( _n(
                        '%1$s comentariu la &ldquo;%2$s&rdquo;',
                        '%1$s comentarii la &ldquo;%2$s&rdquo;',
                        $comment_count,
                        'usm-theme'
                    ) ),
                    number_format_i18n( $comment_count ),
                    '<span>' . wp_kses_post( get_the_title() ) . '</span>'
                );
            }
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments( array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 48,
                'callback'    => 'usm_comment_template',
            ) );
            ?>
        </ol>

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
            <nav class="comment-navigation" role="navigation" aria-label="<?php esc_attr_e('Navigare comentarii', 'usm-theme'); ?>">
                <div class="nav-previous">
                    <?php previous_comments_link( esc_html__( '&larr; Comentarii mai vechi', 'usm-theme' ) ); ?>
                </div>
                <div class="nav-next">
                    <?php next_comments_link( esc_html__( 'Comentarii mai noi &rarr;', 'usm-theme' ) ); ?>
                </div>
            </nav>
        <?php endif; ?>

    <?php endif; ?>

    <?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
        <p class="no-comments"><?php esc_html_e( 'Comentariile sunt închise.', 'usm-theme' ); ?></p>
    <?php endif; ?>

    <?php
    comment_form( array(
        'title_reply'          => esc_html__( 'Lasă un comentariu', 'usm-theme' ),
        'title_reply_to'       => esc_html__( 'Răspunde lui %s', 'usm-theme' ),
        'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title">',
        'title_reply_after'    => '</h3>',
        'comment_notes_before' => '<p class="comment-notes">' . esc_html__( 'Adresa ta de email nu va fi publicată. Câmpurile obligatorii sunt marcate cu *', 'usm-theme' ) . '</p>',
        'fields'               => array(
            'author' => '<div class="comment-form-fields"><p class="comment-form-author">
                <label for="author">' . esc_html__( 'Nume', 'usm-theme' ) . ' <span class="required">*</span></label>
                <input id="author" name="author" type="text" size="30" maxlength="245" autocomplete="name" required /></p>',
            'email'  => '<p class="comment-form-email">
                <label for="email">' . esc_html__( 'Email', 'usm-theme' ) . ' <span class="required">*</span></label>
                <input id="email" name="email" type="email" size="30" maxlength="100" autocomplete="email" required /></p></div>',
            'url'    => '<p class="comment-form-url">
                <label for="url">' . esc_html__( 'Website', 'usm-theme' ) . '</label>
                <input id="url" name="url" type="url" size="30" maxlength="200" autocomplete="url" /></p>',
        ),
        'comment_field'        => '<p class="comment-form-comment">
            <label for="comment">' . esc_html__( 'Comentariu', 'usm-theme' ) . ' <span class="required">*</span></label>
            <textarea id="comment" name="comment" cols="45" rows="5" maxlength="65525" required></textarea>
            </p>',
        'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',
        'submit_label'         => esc_html__( 'Publică comentariul', 'usm-theme' ),
        'class_submit'         => 'submit',
        'id_submit'            => 'submit',
        'class_form'           => 'comment-form',
        'id_form'              => 'commentform',
    ) );
    ?>

</div><!-- #comments -->

<?php
/**
 * Template personalizat pentru fiecare comentariu individual.
 */
function usm_comment_template( $comment, $args, $depth ) {
    $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
    ?>
    <<?php echo esc_attr( $tag ); ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $args['has_children'] ? 'parent' : '', $comment ); ?>>
        <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">

            <div class="comment-author-avatar">
                <?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
            </div>

            <div class="comment-content">
                <p class="comment-author-name">
                    <?php comment_author_link( $comment ); ?>
                </p>
                <p class="comment-date">
                    <a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
                        <time datetime="<?php comment_time( 'c' ); ?>">
                            <?php
                            printf(
                                esc_html__( '%1$s la %2$s', 'usm-theme' ),
                                get_comment_date( '', $comment ),
                                get_comment_time()
                            );
                            ?>
                        </time>
                    </a>
                    <?php edit_comment_link( esc_html__( '(Editează)', 'usm-theme' ), ' ', '' ); ?>
                </p>

                <?php if ( '0' === $comment->comment_approved ) : ?>
                    <p class="comment-awaiting-moderation">
                        <?php esc_html_e( 'Comentariul tău este în așteptarea moderării.', 'usm-theme' ); ?>
                    </p>
                <?php endif; ?>

                <div class="comment-body-text">
                    <?php comment_text(); ?>
                </div>

                <?php
                comment_reply_link( array_merge( $args, array(
                    'add_below' => 'div-comment',
                    'depth'     => $depth,
                    'max_depth' => $args['max_depth'],
                    'before'    => '<div class="reply">',
                    'after'     => '</div>',
                ) ) );
                ?>
            </div>

        </article>
    <?php
}
