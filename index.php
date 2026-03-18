<?php
/**
 * Index — fallback template
 * Redirects to front page if set, otherwise shows basic loop
 */

get_header();
?>

<main class="site-main">
    <div class="container" style="padding: 8rem 1.5rem 4rem;">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <article>
                    <h2 class="font-serif" style="font-size: 2rem; margin-bottom: 1rem;">
                        <a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html( get_the_title() ); ?></a>
                    </h2>
                    <div><?php the_excerpt(); ?></div>
                </article>
            <?php endwhile; ?>
        <?php else : ?>
            <p><?php esc_html_e( 'Nothing found.', 'smooth-theme' ); ?></p>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
