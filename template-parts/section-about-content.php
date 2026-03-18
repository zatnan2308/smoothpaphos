<?php
/**
 * Template Part: About Page Content
 */
if ( \! defined( 'ABSPATH' ) ) {
    exit;
}

// --- Story section ---
$story_label   = get_field( 'story_label' ) ?: 'Our Story';
$story_title   = get_field( 'story_title' ) ?: 'Born from a love of touch and healing';
$story_content = get_field( 'story_content' ) ?: '<p>Smooth Studio was founded in Paphos, Cyprus, with one simple belief: every person deserves a massage that is truly their own. Diana — the heart and hands behind the studio — brings over five years of professional experience and a genuine passion for wellbeing.</p><p>From the first conversation to the last breath of the session, every detail is considered. The ambience, the technique, the pressure — all shaped around you.</p>';
$story_image   = get_field( 'story_image' );

// --- Values section ---
$values_label = get_field( 'values_label' ) ?: 'What We Stand For';
$values_title = get_field( 'values_title' ) ?: 'Our values';
$values       = get_field( 'values_items' );

if ( empty( $values ) ) {
    $values = array(
        array( 'icon' => 'heart',   'title' => 'Individual care',     'text' => 'Every session is crafted around you — your body, mood and goals.' ),
        array( 'icon' => 'star',    'title' => 'Excellence',          'text' => 'We use only premium oils and linens, and stay current with the latest techniques.' ),
        array( 'icon' => 'shield',  'title' => 'Trust & safety',     'text' => 'Your comfort and privacy are our top priority in every session.' ),
        array( 'icon' => 'leaf',    'title' => 'Holistic approach',  'text' => 'We consider the whole person — body, mind and spirit — not just the symptom.' ),
        array( 'icon' => 'clock',   'title' => 'Respect for time',   'text' => 'Sessions start and end on time, every time. Your schedule matters.' ),
        array( 'icon' => 'smile',   'title' => 'Genuine warmth',     'text' => 'We create a space where you feel welcome, heard and at ease from the moment you arrive.' ),
    );
}

// --- CTA section ---
$cta_title    = get_field( 'about_cta_title' ) ?: 'Ready to experience the difference?';
$cta_desc     = get_field( 'about_cta_desc' ) ?: '<p>Book your first session today and discover what a truly personalised massage feels like.</p>';
$cta_btn_text = get_field( 'about_cta_btn_text' ) ?: 'Book via Instagram';
$cta_btn_link = get_field( 'about_cta_btn_link' ) ?: get_field( 'instagram', 'option' ) ?: 'https://instagram.com/smoothstudio.paphos';
?>
<div class="about-content">

    <section class="about-story">
        <div class="container">
            <div class="about-story-grid">
                <div class="about-story-text">
                    <span class="section-label"><?php echo esc_html( $story_label ); ?></span>
                    <?php if ( $story_title ) : ?>
                        <h2 class="about-story-title font-serif">
                            <?php echo smooth_heading( $story_title ); ?>
                        </h2>
                    <?php endif; ?>
                    <?php if ( $story_content ) : ?>
                        <div class="about-story-content wysiwyg-content">
                            <?php echo smooth_wysiwyg( $story_content ); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <?php if ( $story_image ) : ?>
                    <div class="about-story-image">
                        <img src="<?php echo esc_url( $story_image['url'] ); ?>"
                             alt="<?php echo esc_attr( $story_image['alt'] ?: $story_title ); ?>"
                             width="<?php echo esc_attr( $story_image['width'] ?? '' ); ?>"
                             height="<?php echo esc_attr( $story_image['height'] ?? '' ); ?>"
                             loading="lazy"
                             decoding="async">
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="about-values">
        <div class="container">
            <div class="about-values-header">
                <span class="section-label"><?php echo esc_html( $values_label ); ?></span>
                <?php if ( $values_title ) : ?>
                    <h2 class="about-values-title font-serif">
                        <?php echo smooth_heading( $values_title ); ?>
                    </h2>
                <?php endif; ?>
            </div>
            <?php if ( is_array( $values ) && ! empty( $values ) ) : ?>
                <div class="values-grid">
                    <?php foreach ( $values as $val ) : ?>
                        <div class="value-card">
                            <div class="value-icon">
                                <?php echo smooth_icon( $val['icon'] ?: 'star', 24 ); ?>
                            </div>
                            <?php if ( ! empty( $val['title'] ) ) : ?>
                                <h3 class="value-title"><?php echo esc_html( $val['title'] ); ?></h3>
                            <?php endif; ?>
                            <?php if ( ! empty( $val['text'] ) ) : ?>
                                <p class="value-text"><?php echo esc_html( $val['text'] ); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="about-cta">
        <div class="container">
            <div class="about-cta-inner">
                <?php if ( $cta_title ) : ?>
                    <h2 class="about-cta-title font-serif"><?php echo smooth_heading( $cta_title ); ?></h2>
                <?php endif; ?>
                <?php if ( $cta_desc ) : ?>
                    <div class="about-cta-desc wysiwyg-content">
                        <?php echo smooth_wysiwyg( $cta_desc ); ?>
                    </div>
                <?php endif; ?>
                <?php if ( $cta_btn_text ) : ?>
                    <a href="<?php echo esc_url( $cta_btn_link ); ?>" class="btn-primary" target="_blank" rel="noopener noreferrer">
                        <?php echo esc_html( $cta_btn_text ); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </section>

</div>