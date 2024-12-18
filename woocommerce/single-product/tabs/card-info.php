<?php
?>
<?php if (have_rows('top_card_info')): ?>

    <div class="product_features">
        <?php while (have_rows('top_card_info')): the_row();
            $image = get_sub_field('icon');
            ?>
            <div class="product_feature--item">
                <div class="feature_item--image">
                    <?php echo wp_get_attachment_image( $image['id'], 'full' ); ?>

                </div>
                <h3 class="feature_item--title"><?php echo acf_esc_html( get_sub_field('title') ); ?></h3>
                <p class="feature_item--descr"><?php echo acf_esc_html( get_sub_field('content') ); ?></p>
            </div>
        <?php endwhile; ?>
    </div>
<?php endif; ?>
