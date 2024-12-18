<?php

//Change ACF Local JSON save location to /acf folder inside this plugin
add_filter('acf/settings/save_json', function () {
    return get_stylesheet_directory() . '/acf-json';
});

//Include the /acf folder in the places to look for ACF Local JSON files
add_filter('acf/settings/load_json', function () {
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
});

/**
 * We use WordPress's init hook to make sure
 * our blocks are registered early in the loading
 * process.
 *
 * @link https://developer.wordpress.org/reference/hooks/init/
 */
function fry_register_acf_blocks()
{
    /**
     * We register our block's with WordPress's handy
     * register_block_type();
     *
     * @link https://developer.wordpress.org/reference/functions/register_block_type/
     */
//    register_block_type(get_stylesheet_directory() . '/blocks/hero');

}

// Here we call our tt3child_register_acf_block() function on init.
add_action('init', 'fry_register_acf_blocks');