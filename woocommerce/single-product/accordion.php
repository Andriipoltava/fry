<?php
$heading = apply_filters('woocommerce_product_description_heading', __('Description', 'woocommerce'));
$features = apply_filters('woocommerce_product_description_features', __('Features', 'woocommerce'));
$features_content = get_field('features')
?>

<div class="accordion mt-4" id="accordionProduct">
    <?php if (get_the_content()) { ?>
        <div class="accordion-item border-top">
            <h2 class="accordion-header mb-0 small" id="headingContent">
                <button class="accordion-button text-s-medium text-uppercase fw-bold" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseProduct"
                        aria-expanded="true" aria-controls="collapseOne">
                    <?php echo $heading; ?>
                </button>
            </h2>
            <div id="collapseProduct" class="accordion-collapse collapse show" aria-labelledby="headingContent"
                 data-bs-parent="#accordionProduct">
                <div class="accordion-body pt-0">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    <?php }; ?>
    <?php if ($features_content) { ?>
        <div class="accordion-item border-top">
            <h2 class="accordion-header mb-0" id="headingFeatures">
                <button class="accordion-button text-s-medium text-uppercase fw-bold" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseFeatures"
                        aria-expanded="true" aria-controls="collapseOne">
                    <?php echo $features; ?>
                </button>
            </h2>
            <div id="collapseFeatures" class="accordion-collapse collapse hide" aria-labelledby="headingFeatures"
                 data-bs-parent="#accordionFeatures">
                <div class="accordion-body pt-0">
                    <?php echo $features_content; ?>
                </div>
            </div>
        </div>
    <?php }; ?>
</div>