import SiteHeader from "./theme/header";
import Swiper from 'swiper';
import {Autoplay, Mousewheel, Navigation, Pagination, Scrollbar, Thumbs} from 'swiper/modules';

// configure Swiper to use modules
Swiper.use([Navigation, Pagination, Thumbs, Scrollbar, Mousewheel, Autoplay]);

window.Swiper = Swiper;

new SiteHeader


document.querySelectorAll('.products-slider').forEach(function (item) {

    item.querySelectorAll('.loop-product-column').forEach(e => e.classList.add('swiper-slide'))


    const swiper = new Swiper(item, {

        spaceBetween: 12,

        slidesPerView: 1.2,
        cssMode: true,
        loop: false,
        scrollbar: {
            el: item.closest('.slider')?.querySelector('.swiper-scrollbar'),
            hide: false,
            draggable: true
        },
        navigation: {
            enabled: true,
            prevEl: item.closest('.slider')?.querySelector('.swiper-button-prev-icon'),
            nextEl: item.closest('.slider')?.querySelector('.swiper-button-next-icon')
        },
        breakpoints: {
            768: {
                spaceBetween: 25,
                slidesPerView: 3.2

            }

        },
        pagination: {
            el: '.products-slider-slider',
            clickable: true,

        },


        slideContent: '.swiper-wrapper',
    })
    swiper.on('slideChange', function (e) {
        // console.log(e)
        // document.querySelectorAll(".swiper-pagination-bullet").forEach(e=>e.classList.remove("swiper-pagination-bullet-active"))
        // console.log(swiper.activeIndex)
        // document.querySelector(".swiper-pagination-bullet:nth-child("+ (swiper.activeIndex + 1)+")").classList.add("swiper-pagination-bullet-active");
    });
    const sliderH = () => {
        let h = 0
        item.querySelectorAll('.loop-product-column .loop-product-column__wrap').forEach(e => h = Math.max(e.clientHeight, h))
        item.querySelectorAll('.loop-product-column .loop-product-column__wrap').forEach(e => e.style.height = h + 'px')
    }
    sliderH()
    setTimeout(function () {
        sliderH()
    }, 1000)
    window.addEventListener('resize', function (event) {
        sliderH()
    }, true);

})

jQuery(document).ready(function ($) {

    $('.variation-radios').on('change', function () {
        $('.variation-reset').removeClass('d-none')
    })
    $('.variation-reset .reset_variations').on('click', function () {
        $('.variation-row:not(.d-none) input').each(function () {
            $(this).prop('checked', false)
        })
        $('.variation-reset').addClass('d-none')
    })
    var pswpElement = document.querySelectorAll('.pswp')[0];

    $('body').on('click', 'div.woocommerce-product-gallery__wrapper img', function (e) {
        console.log(e)

        $('body').append('<div class="photoSwipe_innerthumbs"></div>');

        var svi_items = [];

        $('.woocommerce-product-gallery__wrapper >div').each(function (i, v) {    // build items array
            svi_items.push({
                src: $(v).find('a').attr('href'),
                w: 1900,
                h: 1200,
                msrc: $(v).data('data-thumb-srcset'),
                title: $(v).find('img').attr('title')
            });
        });

        // define options (if needed)
        var options = {
            index: 0 // start at first slide
        };
        console.log(svi_items)
        // Initializes and opens PhotoSwipe
        const gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, svi_items, options);

        gallery.init();

// Gallery starts closing
        gallery.listen('close', function () {
            $('.photoSwipe_innerthumbs').remove();
        });

//Clone and append the thumbnail images
        $('ol.flex-control-thumbs img').clone().appendTo("div.photoSwipe_innerthumbs");

//Get current active index and add class to thumb just to fade a bit
        $("div.photoSwipe_innerthumbs img").eq(gallery.getCurrentIndex()).addClass('svifaded');

//Handle the swaping of images
        $('body').on('click', 'div.photoSwipe_innerthumbs img', function (e) {
            $('div.photoSwipe_innerthumbs img').removeClass("svifaded");
            $(this).addClass('svifaded');
            gallery.goTo($("div.photoSwipe_innerthumbs img").index($(this)));
        });
    });

    $('.hide-filter').on('click', function (e) {
        e.preventDefault();
        $(this).toggleClass('b-hide')
        $('.main-content').toggleClass('filter-hidden')
    })

    $('form.cart,.woocommerce td.product-quantity').on('click', 'button.plus, button.minus', function () {

        // Get current quantity values
        var qty = $(this).closest('form.cart').find('.qty');
        var val = parseFloat(qty.val());
        var max = parseFloat(qty.attr('max'));
        var min = parseFloat(qty.attr('min'));
        var step = parseFloat(qty.attr('step'));

        // Change the value if plus or minus
        if ($(this).is('.plus')) {
            if (max && (max <= val)) {
                qty.val(max);
            } else {
                qty.val(val + step);
            }
        } else {
            if (min && (min >= val)) {
                qty.val(min);
            } else if (val > 1) {
                qty.val(val - step);
            }
        }

    });
    $(document).on('change', '.variation-radios input', function () {
        $('.variation-radios input:checked').each(function (index, element) {
            var $el = $(element);
            var thisName = $el.attr('name');
            var thisVal = $el.attr('value');
            $('select[name="' + thisName + '"]').val(thisVal).trigger('change');
        });
    });
    $(document).on('woocommerce_update_variation_values', function () {
        $('.variation-radios input').each(function (index, element) {
            var $el = $(element);
            var thisName = $el.attr('name');
            var thisVal = $el.attr('value');
            $el.removeAttr('disabled');
            $el.next().removeClass('disabled');

            if (!$('select[name="' + thisName + '"] option[value="' + thisVal + '"]').length
                || $('select[name="' + thisName + '"] option[value="' + thisVal + '"]').is(':disabled')) {
                $el.prop('disabled', true);
                $el.next().addClass('disabled');
            }
        });
    });

    var productModal = new understrap.Modal(document.getElementById("productModal"), {});

    $('.single_add_to_cart_button').on('click', function (e) {
        e.preventDefault()
        productModal.show()
    })

});
