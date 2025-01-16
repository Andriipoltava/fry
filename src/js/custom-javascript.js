import SiteHeader from "./theme/header";
import Swiper from 'swiper';
import {Autoplay, Mousewheel, Navigation, Pagination, Scrollbar, Thumbs} from 'swiper/modules';

// configure Swiper to use modules
Swiper.use([Navigation, Pagination, Thumbs, Scrollbar, Mousewheel, Autoplay]);

window.Swiper = Swiper;

new SiteHeader


document.querySelectorAll('.products-slider').forEach(function (item) {

    item.querySelectorAll('.loop-product-column').forEach(e => e.classList.add('swiper-slide'))
    let mobileCount = item.classList.contains('product')
    let countDesctopMobile = item.dataset.mobile;
    let countDesctop = item.dataset.columns;
    countDesctopMobile = countDesctopMobile + '.2';
    countDesctop = countDesctop + '.2';
    // console.log(countDesctop)

    const swiper = new Swiper(item, {

        spaceBetween: 12,
        slidesPerView:countDesctopMobile,
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
                slidesPerView: countDesctop
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
document.querySelectorAll('.swiper-mobile-product').forEach(function (item) {

    const swiper = new Swiper(item, {
        spaceBetween: 0,
        // freeMode: {
        //     enabled: true,
        //     sticky: true,
        // },
        slidesPerView:1,
        cssMode: true,
        loop: false,

        pagination: {
            el: '.swiper-pagination',
            clickable: true,

        },

        slideContent: '.swiper-wrapper',
    })


})

jQuery(document).ready(function ($) {

    var navbarNavOffcanvas = document.getElementById('navbarNavOffcanvas')
    var offcanvasBlack = document.querySelector('.offcanvas-back ')

    var collapseElementList = [].slice.call(navbarNavOffcanvas.querySelectorAll('.collapse-menu'))


    collapseElementList.map(function (collapseEl) {
        // return new understrap.Collapse(collapseEl)

        collapseEl.addEventListener('show.bs.collapse', function () {

            $('.offcanvas-title').collapse('hide');
            $(offcanvasBlack).collapse('show');

        })
    })
    offcanvasBlack.addEventListener('click', function () {

        $('.offcanvas-title').collapse('show');
        $(offcanvasBlack).collapse('hide');
        var collapseElementListActive = [].slice.call(navbarNavOffcanvas.querySelectorAll('.collapse-menu.show'))

        collapseElementListActive.forEach(function (collapseEl) {
            console.log(collapseEl)
            $(collapseEl).collapse('hide');
        })
    })



    $('.variation-radios').on('change', function () {
        $('.variation-reset').removeClass('d-none')
    })

    $('.variation-reset .reset_variations').on('click', function () {
        $('.variation-row:not(.d-none) input').each(function () {
            $(this).prop('checked', false)
        })
        $('.variation-reset').addClass('d-none')
    })



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


    $('#galleryModalToggle').on('shown.bs.modal', function (e) {
        // jQuery('#galleryModalToggle').modal('show')

        $('.modal-body').scrollspy('refresh');
        if ($(window.location.hash).length) {
            // console.log()
            setTimeout(() => {
                $('.modal-body').animate({
                    scrollTop: $(window.location.hash).offset().top - 130
                }, 200);
            }, 200)

        }

    });


    $('.modal-gallery').on('click', function (e) {
        e.preventDefault();
        window.location.hash = $(this).attr('href')
        $('#galleryModalToggle').modal('show')


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


});
