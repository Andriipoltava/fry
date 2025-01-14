<?php
/**
 * Add WooCommerce support
 *
 * @package Understrap
 */

include_once 'woo/attributes-to-menu.php';

include_once 'woo/custom-fields.php';

include_once 'woo/variation-radio.php';

include_once 'woo/page.php';

// Exit if accessed directly.
defined('ABSPATH') || exit;

add_action('after_setup_theme', 'fry_theme_woocommerce_support');
if (!function_exists('fry_theme_woocommerce_support')) {
    /**
     * Declares WooCommerce theme support.
     */
    function fry_theme_woocommerce_support()
    {
        add_theme_support('woocommerce');

        // Add Product Gallery support.
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-slider');

        // Add Bootstrap classes to form fields.
        add_filter('woocommerce_form_field_args', 'fry_theme_wc_form_field_args', 10, 3);
        add_filter('woocommerce_form_field_radio', 'fry_theme_wc_form_field_radio', 10, 4);
        add_filter('woocommerce_quantity_input_classes', 'fry_theme_quantity_input_classes');
        add_filter('woocommerce_loop_add_to_cart_args', 'fry_theme_loop_add_to_cart_args');

        // Wrap the add-to-cart link in `div.add-to-cart-container`.
        add_filter('woocommerce_loop_add_to_cart_link', 'fry_theme_loop_add_to_cart_link');

        // Add Bootstrap classes to account navigation.
        add_filter('woocommerce_account_menu_item_classes', 'fry_theme_account_menu_item_classes');
    }
}

// First unhook the WooCommerce content wrappers.
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);


remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

// Then hook in your own functions to display the wrappers your theme requires.
add_action('woocommerce_before_single_product_summary', 'fry_theme_woocommerce_wrapper_start', 10);
add_action('woocommerce_after_single_product_summary', 'fry_theme_woocommerce_wrapper_end', 10);


remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
add_action('woocommerce_single_product_summary', 'woocommerce_breadcrumb', 4);

add_action('woocommerce_archive_description', 'woocommerce_breadcrumb', 25);

if (!function_exists('fry_theme_woocommerce_wrapper_start')) {
    /**
     * Display the theme specific start of the page wrapper.
     */
    function fry_theme_woocommerce_wrapper_start()
    {
        $container = 'container-fluid px-0';
        echo '<div class="container-fluid pt-lg-4 px-0" id="woocommerce-wrapper">';
        echo '<div class="row justify-content-md-between" >';


    }
}

if (!function_exists('fry_theme_woocommerce_wrapper_end')) {
    /**
     * Display the theme specific end of the page wrapper.
     */
    function fry_theme_woocommerce_wrapper_end()
    {


        echo '</div><!-- #row -->';
        echo '</div><!-- #container-fluid-->';
    }
}

if (!function_exists('fry_theme_wc_form_field_args')) {
    /**
     * Modifies the form field's arguments by input type. The arguments are used
     * in `woocommerce_form_field()` to build the form fields.
     *
     * @see https://woocommerce.github.io/code-reference/namespaces/default.html#function_woocommerce_form_field
     *
     * @param array $args Form field arguments.
     * @param string $key Value of the fields name attribute.
     * @param string|null $value Value of <select> option.
     * @return array Filtered form field arguments.
     *
     * @phpstan-template T of array{
     *     'type': string,
     *     'label': string,
     *     'description': string,
     *     'placeholder': string,
     *     'maxlength': false|int,
     *     'required': bool,
     *     'autocomplete': false|string,
     *     'id': string,
     *     'class': list<string>,
     *     'label_class': list<string>,
     *     'input_class': list<string>,
     *     'return': bool,
     *     'options': array<string,string>,
     *     'custom_attributes': array<string,int|string>,
     *     'validate': list<string>,
     *     'default': string,
     *     'autofocus': ?(string|bool),
     *     'priority': ?string,
     * }
     * @phpstan-param T $args
     * @phpstan-return T | array{'class': non-empty-list<string>}
     */
    function fry_theme_wc_form_field_args($args, $key, $value)
    {
        $bootstrap4 = 'bootstrap4' === get_theme_mod('fry_theme_bootstrap_version', 'bootstrap4');

        // Add margin to each form field's html element wrapper (<p></p>).
        if ($bootstrap4) {
            $args['class'][] = 'form-group';
        }
        $args['class'][] = 'mb-3';

        // Start field type switch case.
        switch ($args['type']) {
            case 'country':
                /*
                 * WooCommerce will populate a <select> element of type 'country'
                 * with the country names.
                 */

                // Add class to the form field's html element wrapper.
                $args['class'][] = 'single-country';
                break;
            case 'state':
                /*
                 * WooCommerce will populate a <select> element of type 'state'
                 * with the state names.
                 */

                // Add custom data attributes to the form input itself.
                $args['custom_attributes']['data-plugin'] = 'select2';
                $args['custom_attributes']['data-allow-clear'] = 'true';
                $args['custom_attributes']['aria-hidden'] = 'true';

                // If state is text input.
                $args['input_class'][] = 'form-control';
                break;
            case 'checkbox':
                /*
                 * WooCommerce checkbox markup differs from Bootstrap checkbox
                 * markup. We apply Bootstrap classes such that the WooCommerce
                 * checkbox look matches the Bootstrap checkbox look.
                 */

                // Get Bootstrap version specific CSS class base.
                $base = $bootstrap4 ? 'custom-control' : 'form-check';

                if ('' !== $args['label'] || $bootstrap4) {
                    // Wrap the label in <span> tag.
                    $args['label'] = "<span class=\"{$base}-label\">{$args['label']}</span>";
                }

                // Add a class to the form input's <label> tag.
                $args['label_class'][] = $base;
                if ($bootstrap4) {
                    $args['label_class'][] = 'custom-checkbox';
                }

                // Add a class to the form input itself.
                $args['input_class'][] = $base . '-input';
                break;
            case 'select':
                // Targets all <select> elements, except the country and state <select>.

                // Add a class to the form input itself.
                $args['input_class'][] = $bootstrap4 ? 'form-control' : 'form-select';

                // Add custom data attributes to the form input itself.
                $args['custom_attributes']['data-plugin'] = 'select2';
                $args['custom_attributes']['data-allow-clear'] = 'true';
                break;
            case 'radio':
                // Get Bootstrap version specific CSS class base.
                $base = $bootstrap4 ? 'custom-control' : 'form-check';

                $args['label_class'][] = $base . '-label';
                $args['input_class'][] = $base . '-input';
                break;
            default:
                $args['input_class'][] = 'form-control';
        } // End of switch ( $args ).
        return $args;
    }
}

if (!function_exists('fry_theme_wc_form_field_radio')) {
    /**
     * Adjust the WooCommerce checkout/address radio fields to match the look of
     * Bootstrap radio fields.
     *
     * Wraps each radio field (`<input>`+`<label>`) in a `.from-check`.
     *
     * If `$args['label']` is set a `<label>` tag is prepended to the radio
     * fields. `$args['label_class']` is used for the class attribute of this
     * tag and the class attribute of the actual input labels. Hence, we must
     * remove the first occurrence of the label class added via
     * `fry_theme_wc_form_field_args()` that is meant for input labels only.
     *
     * @param string $field The field's HTML incl. the wrapper element.
     * @param string $key The wrapper element's id attribute value.
     * @param array<string|mixed> $args An array of field arguments.
     * @param string|null $value The field's value.
     * @return string The field's filtered HTML.
     *
     * @phpstan-template T of array{
     *     'type': string,
     *     'label': string,
     *     'description': string,
     *     'placeholder': string,
     *     'maxlength': false|int,
     *     'required': bool,
     *     'autocomplete': false|string,
     *     'id': string,
     *     'class': list<string>,
     *     'label_class': list<string>,
     *     'input_class': list<string>,
     *     'return': bool,
     *     'options': array<string,string>,
     *     'custom_attributes': array<string,int|string>,
     *     'validate': list<string>,
     *     'default': string,
     *     'autofocus': ?(string|bool),
     *     'priority': ?string,
     * }
     * @phpstan-param T $args
     */
    function fry_theme_wc_form_field_radio($field, $key, $args, $value)
    {
        // Set up Bootstrap version specific variables.
        if ('bootstrap4' === get_theme_mod('fry_theme_bootstrap_version', 'bootstrap4')) {
            $wrapper_classes = 'custom-control custom-radio';
            $label_class = 'custom-control-label';
        } else {
            $wrapper_classes = 'form-check';
            $label_class = 'form-check-label';
        }

        // Remove the first occurrence of the label class if necessary.
        if ('' !== $args['label'] && !empty($args['label_class'])) {
            $strpos = strpos($field, $label_class);
            if (false !== $strpos) {
                $field = substr_replace($field, '', $strpos, strlen($label_class));

                /*
                 * If $label_class was the only class in $args['label_class']
                 * then there is an empty class attribute now. Let's remove it.
                 */
                $field = str_replace('class=""', '', $field);
            }
        }

        // Wrap each radio in a <span.from-check>.
        $field = str_replace('<input', "<span class=\"{$wrapper_classes}\"><input", $field);
        $field = str_replace('</label>', '</label></span>', $field);
        if ('' !== $args['label']) {
            // Remove the closing span tag from the first <label> element.
            $strpos = strpos($field, '</label>') + strlen('</label>');
            $field = substr_replace($field, '', $strpos, strlen('</span>'));
        }

        return $field;
    }
}

if (!is_admin() && !function_exists('wc_review_ratings_enabled')) {
    /**
     * Check if reviews are enabled.
     *
     * Function introduced in WooCommerce 3.6.0., include it for backward compatibility.
     *
     * @return bool
     */
    function wc_reviews_enabled()
    {
        return 'yes' === get_option('woocommerce_enable_reviews');
    }

    /**
     * Check if reviews ratings are enabled.
     *
     * Function introduced in WooCommerce 3.6.0., include it for backward compatibility.
     *
     * @return bool
     */
    function wc_review_ratings_enabled()
    {
        return wc_reviews_enabled() && 'yes' === get_option('woocommerce_enable_review_rating');
    }
}

if (!function_exists('fry_theme_quantity_input_classes')) {
    /**
     * Add Bootstrap class to quantity input field.
     *
     * @param array<int,string> $classes Array of quantity input classes.
     * @return array<int,string>
     */
    function fry_theme_quantity_input_classes($classes)
    {
        $classes[] = 'form-control';
        return $classes;
    }
}

if (!function_exists('fry_theme_loop_add_to_cart_link')) {
    /**
     * Wrap add to cart link in container.
     *
     * @param string $html Add to cart link HTML.
     * @return string Add to cart link HTML.
     */
    function fry_theme_loop_add_to_cart_link($html)
    {
        return '';
    }
}

if (!function_exists('fry_theme_loop_add_to_cart_args')) {
    /**
     * Add Bootstrap button classes to add to cart link.
     *
     * @param array<string,mixed> $args Array of add to cart link arguments.
     * @return array<string,mixed> Array of add to cart link arguments.
     */
    function fry_theme_loop_add_to_cart_args($args)
    {
        if (isset($args['class']) && !empty($args['class'])) {
            if (!is_string($args['class'])) {
                return $args;
            }

            // Remove the `button` class if it exists.
            if (false !== strpos($args['class'], 'button')) {
                $args['class'] = explode(' ', $args['class']);
                $args['class'] = array_diff($args['class'], array('button'));
                $args['class'] = implode(' ', $args['class']);
            }

            $args['class'] .= ' btn btn-primary';
        } else {
            $args['class'] = 'btn btn-primary';
        }

        if ('bootstrap4' === get_theme_mod('fry_theme_bootstrap_version', 'bootstrap4')) {
            $args['class'] .= ' btn-block';
        }

        return $args;
    }
}

if (!function_exists('fry_theme_account_menu_item_classes')) {
    /**
     * Add Bootstrap classes to the account navigation.
     *
     * @param string[] $classes Array of classes added to the account menu items.
     * @return string[] Array of classes added to the account menu items.
     */
    function fry_theme_account_menu_item_classes($classes)
    {
        $classes[] = 'list-group-item';
        $classes[] = 'list-group-item-action';
        if (in_array('is-active', $classes, true)) {
            $classes[] = 'active';
        }
        return $classes;
    }
}

add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

function woocommerce_header_add_to_cart_fragment($fragments)
{
    global $woocommerce;

    ob_start();

    ?>
    <span class="с-cart-btn__count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
    <?php

    $fragments['.с-cart-btn__count'] = ob_get_clean();

    return $fragments;

}


add_filter('woocommerce_product_thumbnails_columns', function ($columns) {

    return 2;

}, 99, 1);

/**
 * Output the view cart button.
 */
function woocommerce_widget_shopping_cart_button_view_cart()
{
    $wp_button_class = wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : '';
    echo '<a href="' . esc_url(wc_get_cart_url()) . '" class=" wc-forward btn btn-outline-dark' . esc_attr($wp_button_class) . '">' . esc_html__('View cart', 'woocommerce') . '</a>';
}

/**
 * Output the proceed to checkout button.
 */
function woocommerce_widget_shopping_cart_proceed_to_checkout()
{
    $wp_button_class = wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : '';
    echo '<a href="' . esc_url(wc_get_checkout_url()) . '" class=" checkout wc-forward btn btn-dark mt-2' . esc_attr($wp_button_class) . '">' . esc_html__('Checkout', 'woocommerce') . '</a>';
}


/* Show Buttons */
add_action('woocommerce_after_add_to_cart_quantity', 'display_quantity_plus', 11);

function display_quantity_plus()
{
    echo '<button type="button" class="plus" >+</button></div>';
}

add_action('woocommerce_before_add_to_cart_quantity', 'display_quantity_minus', 8);

function display_quantity_minus()
{
    echo '<div class="quantity_wrap d-flex align-items-center" ><button type="button" class="minus" >-</button>';
}

add_filter('woocommerce_breadcrumb_defaults', function ($arg) {
    $arg['wrap_before'] = '<nav class="woocommerce-breadcrumb mb-3" aria-label="Breadcrumb">';
    return $arg;
});


// Frontend: Handle Conditional display and include custom field value on product variation
add_filter('woocommerce_available_variation', 'variation_data_custom_field_conditional_display', 10, 3);

/**
 * Returns an array of data for a variation. Used in the add to cart form.
 *
 * @param array $data Variation product object or ID.
 * @param WC_Product $product Variation product object or ID.
 * @param WC_Product $variation Variation product object or ID.
 * @return array
 * @since  2.4.0
 */
function variation_data_custom_field_conditional_display($data, $product, $variation)
{
    // Get custom field value and set it in the variation data array (not for display)
    $data['attr'] = $variation->get_meta('custom_field');
    $html = '';
//    var_dump($variation->get_attributes());
    $var_attr = $variation->get_attributes();
    foreach ($var_attr as $taxonomy => $values) {


        $taxonomy_label = wc_attribute_label($taxonomy);

        $taxonomy_value = $variation->get_attribute($taxonomy);
        $html .= '<div>';

        $html .= '<div><b>' . $taxonomy_label . ':&nbsp;&nbsp;</b>';
        $html .= '<span>' . $taxonomy_value . ' </span> ';
        $html .= '</div>';
    }
    $attr_p = $product->get_attributes();

    foreach ($product->get_attributes() as $key => $attr) {
        if (isset($var_attr[$key])) {
            unset($attr_p[$key]);
        }
    }
    foreach ($attr_p as $attr) {
        if (!$attr['visible']) continue;
        $html .= '<div>';
        $taxonomy_label = wc_attribute_label($attr['name']);

        $taxonomy_value = $product->get_attribute($attr['name']);

        $html .= '<b>' . $taxonomy_label . ':&nbsp;&nbsp;</b>';
        $html .= '<span>' . $taxonomy_value . ' </span> ';
        $html .= '</div>';
    }


    // Frontend display: Define custom field conditional display
    $data['attr_html'] = $html;

    return $data;
}


add_filter('woocommerce_dropdown_variation_attribute_options_args', 'fun_select_default_option', 10, 1);


function fun_select_default_option($args)
{
    if (count($args['options']) == 1) //Check the count of available options in dropdown
        $args['selected'] = $args['options'][0];
    return $args;
}


add_action('woocommerce_single_product_summary', function () {

    global $product;
    $attr_p = $product->get_attributes();

    if (!$product->is_type('variable')) {
        $html = '';
        $html .= '<div class="pb-4">';
        foreach ($attr_p as $attr) {
            if (!$attr['visible']) continue;
            $html .= '<div>';
            $taxonomy_label = wc_attribute_label($attr['name']);
            $taxonomy_value = $product->get_attribute($attr['name']);
            $html .= '<b>' . $taxonomy_label . ':&nbsp;&nbsp;</b>';
            $html .= '<span>' . $taxonomy_value . ' </span> ';
            $html .= '</div>';

        }
        $html .= '</div>';

        echo $html;
    }

}, 20);


add_filter('yith_wcan_filter_get_formatted_terms_for_product_cat', function ($result, $ob) {

    foreach ($result as $key => $item) {
//        var_dump($key,$item,'</br>');
    }


    return $result;
}, 999, 2);


add_filter('woocommerce_sale_flash', function ($html) {

    return '<span class="onsale">Sale!</span>';
});
add_filter('yith_wcan_filter_get_formatted_terms_for_pa_weight', 'sort_by_int_filter', 10, 2);
add_filter('yith_wcan_filter_get_formatted_terms_for_pa_packaging', 'sort_by_int_filter', 10, 2);
function sort_by_int_filter($result, $ob)
{


    $arrayNew = [];
    foreach ($result as $term_id => $value) {
        $term_name = get_term($term_id)->name;
        $float = str_replace(',', '.', $term_name);
        $float = preg_replace('/[^0-9\.]/', "", $float); // only show the numbers and dots
        $arrayNew[$term_id] = $float;
    }
    asort($arrayNew);


    foreach ($arrayNew as $key => $value) {
        $arrayNew[$key] = $result[$key] ?: null;

    }
    return $arrayNew;
}

add_filter('yith_wcan_remove_current_term_from_active_filters', function ($show) {
    if (is_search()) {
        return false;
    }
    return $show;
});
add_filter('yith_wcan_active_filters_title', function ($show) {
    return '';
});
add_filter('yith_wcan_active_labels_with_titles', function ($show) {
    return false;
});
add_filter('yith_wcan_filter_title_classes', function ($array) {
    if (!is_search()){
        $array[2] = 'closed';
    }

    return $array;
});