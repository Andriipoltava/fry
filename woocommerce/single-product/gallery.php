<?php
global $product;

?>

<section class="product_additional_info w-100">

    <div class="container-fluid g-4">
        <?php
        wc_get_template('single-product/tabs/gallery.php'); ?>
    </div>

</section>

<div class="modal fade" id="galleryModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
     tabindex="-1">
    <div class="modal-dialog modal-fullscreen ">
        <div class="modal-content">
            <div class="modal-header border-0 position-absolute top-0 start-0 w-100 z-index-111">

                <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-0">
                    <div class="col-lg-auto d-lg-block d-none position-fixed top-50 translate-middle-y">
                        <div id="list-gallery" class="list-group border-end border-dark p-2 border-5">
                            <?php
                            $attachment_ids = array();
                            $image_id = $product->get_image_id();
                            $attachment_ids = array_merge([$image_id], $product->get_gallery_image_ids());
                            foreach ($attachment_ids as $attachment_id) {
                                ?>
                                <a class="list-group-item list-group-item-action p-0 overflow-hidden my-3  rounded item-list-<?php echo $attachment_id; ?>"
                                   id="m-list-<?php echo $attachment_id; ?>"
                                   href="#image-<?php echo $attachment_id; ?>">
                                    <?php
                                    echo wp_get_attachment_image($attachment_id, [50, 50], null, ['class' => '']);
                                    ?>
                                </a>
                                <?php
                            }; ?>
                        </div>
                    </div>
                    <div data-bs-spy="scroll" data-bs-target="#list-gallery" data-bs-smooth-scroll="true"
                         class="scrollspy-example col-12" tabindex="0">
                        <?php


                        foreach ($attachment_ids as $attachment_id) {
                            ?>
                            <div class="pb-sm-4 pb-3 pb-lg-5" id="image-<?php echo $attachment_id; ?>">
                                <?php
                                echo wp_get_attachment_image($attachment_id, 'full', null, ['class' => 'w-100']);
                                ?>
                            </div>
                            <?php
                        }; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

