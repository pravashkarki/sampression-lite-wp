jQuery(document).ready(function ($) {
    // init Isotope
    var $container = $('#post-listing'),
        colWidth = function () {
            var w = $container.width(),
                columnNum = 4,
                columnWidth = 0;
            if (w <= 800) {
                columnNum = 2;
            }
            if (w <= 400) {
                columnNum = 1;
            }

            columnWidth = Math.floor(w / columnNum) - 15;
            $container.find('.item').each(function () {
                var $item = $(this),
                    multiplier_w = $item.attr('class').match(/item-w(\d)/),
                    multiplier_h = $item.attr('class').match(/item-h(\d)/),
                    width = multiplier_w ? columnWidth * multiplier_w[1] - 4 : columnWidth - 4,
                    height = multiplier_h ? columnWidth * multiplier_h[1] * 0.5 - 4 : columnWidth * 0.5 - 4;
                $item.css({
                    width: width
                    //height: height
                });
            });

            return columnWidth;
        },
        isotope = function () {
            $container.isotope({
                itemSelector: '.item',
                masonry: {
                    columnWidth: colWidth(),
                    gutter: 20
                }
            });
        };
    isotope();
    $(document).on('change', '#get-cats', function () {
        //debugger;
        var selector = jQuery(this).val();
        $container.isotope({filter: selector});
        pageScroll('#primary-nav-scroll', 700);
    });
    $(window).on('debouncedresize', isotope);
    $('#filter a').on('click', function () {
        var select = $(this).data('filter');
        if (select === '*') {
            $('#filter a').removeClass('selected');
            if (!$(this).hasClass('selected')) {
                $(this).addClass('selected');
            }
        } else {
            $('#filter').find("[data-filter='*']").removeClass('selected');
            $(this).toggleClass('selected', '');
        }
        var selector = Array();
        $('#filter a').each(function () {
            if ($(this).hasClass('selected')) {
                selector.push($(this).data('filter'));
            }
        });
        selector = selector.join(', ');
        if (selector == '') {
            $('#filter').find("[data-filter='*']").addClass('selected');
            selector = '*';
        }

        $container.isotope({
            filter: selector
        });
    });
});