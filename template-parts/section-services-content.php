<?php
/**
 * Template Part: Services Page Content
 */
if ( \! defined( 'ABSPATH' ) ) {
    exit;
}

// --- Intro section ---
$intro_label   = get_field( 'services_intro_label' ) ?: 'Our Services';
$intro_title   = get_field( 'services_intro_title' ) ?: 'Tailored for every need';
$intro_content = get_field( 'services_intro_content' ) ?: '<p>At Smooth Studio we offer a wide range of massage, beauty and wellness services. Every treatment is personalised — adapted to your body, mood and goals.</p>';

// --- Categories section ---
$categories_label = get_field( 'services_categories_label' ) ?: 'What We Offer';
$categories_title = get_field( 'services_categories_title' ) ?: 'Service categories';
$categories       = get_field( 'services_categories' );

if ( empty( $categories ) ) {
    $categories = array(
        array(
            'icon'  => 'hand',
            'title' => 'Massage',
            'text'  => 'From classic relaxation to deep tissue and lymphatic drainage. Over ten techniques available.',
            'link'  => '#prices',
        ),
        array(
            'icon'  => 'sparkles',
            'title' => 'Sugaring – Waxing',
            'text'  => 'Gentle and effective hair removal for all areas. Comfortable, precise and long-lasting.',
            'link'  => '#prices',
        ),
        array(
            'icon'  => 'gem',
            'title' => 'Nails',
            'text'  => 'Manicure and pedicure with or without gel polish. Nail art available on request.',
            'link'  => '#prices',
        ),
        array(
            'icon'  => 'scissors',
            'title' => 'Hair Treatments',
            'text'  => 'Haircuts, blowouts, colouring, highlights, keratin treatments and more.',
            'link'  => '#prices',
        ),
    );
}?>

<div class="services-content">

    <section class="services-intro">
        <div class="container">
            <div class="services-intro-inner">
                <span class="section-label"><?php echo esc_html( $intro_label ); ?></span>
                <?php if ( $intro_title ) : ?>
                    <h2 class="services-intro-title font-serif">
                        <?php echo smooth_heading( $intro_title ); ?>
                    </h2>
                <?php endif; ?>
                <?php if ( $intro_content ) : ?>
                    <div class="services-intro-content wysiwyg-content">
                        <?php echo smooth_wysiwyg( $intro_content ); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="services-categories">
        <div class="container">
            <div class="services-categories-header">
                <span class="section-label"><?php echo esc_html( $categories_label ); ?></span>
                <?php if ( $categories_title ) : ?>
                    <h2 class="services-categories-title font-serif">
                        <?php echo smooth_heading( $categories_title ); ?>
                    </h2>
                <?php endif; ?>
            </div>
            <?php if ( is_array( $categories ) && ! empty( $categories ) ) : ?>
                <div class="services-categories-grid">
                    <?php foreach ( $categories as $cat ) : ?>
                        <div class="service-card">
                            <?php if ( ! empty( $cat['icon'] ) ) : ?>
                                <div class="service-card-icon">
                                    <?php echo smooth_icon( $cat['icon'], 32 ); ?>
                                </div>
                            <?php endif; ?>
                            <?php if ( ! empty( $cat['title'] ) ) : ?>
                                <h3 class="service-card-title"><?php echo esc_html( $cat['title'] ); ?></h3>
                            <?php endif; ?>
                            <?php if ( ! empty( $cat['text'] ) ) : ?>
                                <p class="service-card-text"><?php echo esc_html( $cat['text'] ); ?></p>
                            <?php endif; ?>
                            <?php if ( ! empty( $cat['link'] ) ) : ?>
                                <a href="<?php echo esc_url( $cat['link'] ); ?>" class="service-card-link">
                                    See prices <?php echo smooth_icon( 'arrow-right', 14 ); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

</div>