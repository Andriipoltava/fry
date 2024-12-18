<?php
?>
<?php if (get_field('instructions_content')) { ?>
    <details open class="info_block">
        <summary class="info_block--title">instructions
            <img class="arrow" src="<?php echo get_stylesheet_directory_uri()?>/images/arrow.svg" alt="arrow">
        </summary>
        <div class="details_list">

            <?php echo get_field('instructions_content'); ?>
        </div>

    </details>
<?php }; ?>
