//==============================================================
// CUSTOM SCRIPTS
// Author: Sampression Themes  (https://sampression.com)
// 2013
// =============================================================
(function ($) {

// this fixes post spacing issue  when image is set to 100%
    setTimeout(function () {
        $(window).resize()
    }, 2000); // This triggers window resize 1 second after dom is ready

// For Primary Navigation	
    var minHt = 28; // Minimum height for Navigation
    var ulHt = getTotalHt($('#primary-nav').find('ul')) || 28; // Getting the height of Navigation

//show the sneak peek of all categories
    if (minHt < ulHt) {
        $('#btn-nav-opt').show();
        $('#primary-nav .twelve')
            .animate({'height': ulHt}, 300, function () {
                $('#btn-nav-opt').addClass('up');

            })
            .delay(300)
            .animate({'height': minHt}, 1000, function () {
                $('#btn-nav-opt').removeClass('up');

            });
    }

    /**
     * Do not submit search form if empty
     */
    $(document).on('click', '.search-submit', function () {
        var search = $(this).prev('.search-field');
        if (search.val() == '') {
            search.focus();
            return false;
        }
    });

     /**
     * Superfish
     */
    if ($(window).width() > 767) {

        $('.top-menu').superfish({
            delay: 0
        });

        $('span.sf-sub-indicator').remove();

    }

//==============================================================
// Toggle Height of the Primary Navigation
// =============================================================
    $('#btn-nav-opt').click(function () {
        if ($(this).hasClass('up')) {
            $('#primary-nav .twelve').animate({'height': minHt});
            $(this).removeClass('up');
            $('#primary-nav .twelve').removeClass('nav-open');
        } else {
            $('#primary-nav .twelve').animate({'height': ulHt});
            $(this).addClass('up');
            $('#primary-nav .twelve').addClass('nav-open');
        }
        return false;
    });

    var bodywidth = $(window).width();
    if (bodywidth < 479) {
        $('#primary-nav ul li a').click(function () {
            $('#primary-nav .twelve').animate({'height': minHt});
            $('#btn-nav-opt').removeClass('up');

        });
    }


//==============================================================
// WordPress specialist:
// get Widget title as a widget class
// ==============================================================

    $('.widget').each(function () {
        var widgetTitle = $(this).find('.widget-title').text();
        var widgetTitleSlug = widgetTitle.replace(/ /gi, "-");
        widgetTitleSlug = widgetTitleSlug.toLowerCase();
        widgetTitleSlug = "widget-" + widgetTitleSlug;
        $(this).addClass(widgetTitleSlug);
    });


//==============================================================
// get Sticky menu
// ==============================================================
    if (bodywidth > 768) {

        if ($('body').hasClass('home')) { 	// enable sticky menu only on homepage
            $(window).scroll(function () {
                if ($(window).scrollTop() > getTotalHt('#header')) {
                    $('#primary-nav').addClass('fixed');
                    $('.btn-top').addClass('fixed');
                    $('#content-wrapper').css('padding-top', minHt + 30);

                } else {
                    $('#primary-nav').removeClass('fixed');
                    $('.btn-top').removeClass('fixed');
                    $('#content-wrapper').css('padding-top', '20px');
                }
            });
        }

    }


    $('.menu-primary-menu-container select').change(function () {
        var currentpage = $(this).val();
        $(location).attr('href', '?page_id=' + currentpage);
    });

    $('.menu-item').hover(
        function (e) {
            e.stopPropagation();
            $(this).children('ul').fadeIn();
        },
        function (e) {
            e.stopPropagation();
            $(this).children('ul').delay(100).fadeOut();
        }
    );

    // Create the label 'Menu:'
    $("#top-nav-mobile").append($("<div />", {"class": "nav-label"}));

    // Create the dropdown select element
    $("<select />", {"class": "top-menu-nav"}).insertAfter("#top-nav-mobile .nav-label");

    // Create default option "Go to"
    $("<option />", {
        "selected": "selected",
        "value": "",
        "text": "Menu"
    }).appendTo(" #top-nav-mobile select");

    // Populate dropdown with menu items
    recursiveDropdown($("nav#top-nav > ul ").children('li'), '');

    // Recursive function for multilevel menu
    function recursiveDropdown(elem, dash) {
        elem.each(function () {
            var el = $(this), anchor = $('> a', this);
            var sl = $("<option />", {
                "value": anchor.attr("href"),
                "text": dash + anchor.text()
            });
            if (el.children('ul').length > 0) {  //contains next level
                $("#top-nav-mobile select").append(sl);
                recursiveDropdown(el.children('ul').children('li'), dash + '-'); //grab them
            } else {
                $("#top-nav-mobile select").append(sl);
            }
        });
    }

    // To make dropdown actually work
    $("select.top-menu-nav").change(function () {
        window.location = $(this).find("option:selected").val();
    });

    $('#page_id').change(function () {
        var currentpage = $(this).val();
        $(location).attr('href', '?page_id=' + currentpage);
    });
//==============================================================
//Redirect url on change of select for ios devices
//==============================================================

    $("#get-cat-ios").change(function () {
        window.location = $(this).find("option:selected").val();
    });

//==============================================================
//Responsive Video
//==============================================================

    (function ($) {
        $.fn.responsiveVideo = function () {
            // Add CSS to head
            $('head').append('<style type="text/css">.responsive-video-wrapper{width:100%;position:relative;padding:0 ;margin-bottom:25px;}.responsive-video-wrapper iframe,.responsive-video-wrapper object,.responsive-video-wrapper embed{position:absolute;top:0;left:0;width:100%;height:100%}</style>');
            // Gather all videos
            var $all_videos = $(this).find('iframe[src*="player.vimeo.com"], iframe[src*="youtube.com"], iframe[src*="youtube-nocookie.com"], iframe[src*="dailymotion.com"], iframe[src*="kickstarter.com"][src*="video.html"], object, embed');
            // Cycle through each video and add wrapper div with appropriate aspect ratio if required
            $all_videos.not('object object').each(function () {
                var $video = $(this);
                if ($video.parents('object').length)
                    return;
                if (!$video.prop('id'))
                    $video.attr('id', 'rvw' + Math.floor(Math.random() * 999999));
                $video
                    .wrap('<div class="responsive-video-wrapper" style="padding-top: ' + ($video.attr('height') / $video.attr('width') * 100) + '%" />')

                    .removeAttr('height')
                    .removeAttr('width');
            });
        };
    })(jQuery);
    $('body').responsiveVideo();


})(jQuery);
// end ready function here.

//==============================================================
// scroll Particular Point
// ==============================================================
function pageScroll(scrollPoint, time) { // obj: click object, scrollPoint:Location to reach on page scroll
    var divOffset = jQuery(scrollPoint).offset().top;
    jQuery('html,body').delay(time || 0).animate({scrollTop: divOffset}, 500);
}


//==============================================================
// Get Total Height
// ==============================================================

function getTotalHt(obj, addPadding, addMargin, addBorder) {
    if (jQuery(obj).is(':hidden')) return false;

    addPadding = typeof addPadding == 'undefined' ? 1 : addPadding;
    addMargin = typeof addMargin == 'undefined' ? 1 : addMargin;
    addBorder = typeof addBorder == 'undefined' ? 1 : addBorder;

    var totalHt = jQuery(obj).height();
    if (addPadding == 1) {
        totalHt += parseInt(jQuery(obj).css('padding-top'));
        totalHt += parseInt(jQuery(obj).css('padding-bottom'));
    }
    if (addMargin == 1) {
        totalHt += parseInt(jQuery(obj).css('margin-top'));
        totalHt += parseInt(jQuery(obj).css('margin-bottom'));
    }
    if (addBorder == 1) {
        totalHt += parseInt(jQuery(obj).css('borderTopWidth'));
        totalHt += parseInt(jQuery(obj).css('borderBottomWidth'));
    }

    return totalHt;
}

//==============================================================
// Hide the Address Bar in MobileSafari
// =============================================================

addEventListener("load", function () {
    setTimeout(
        hideURLbar, 0);
}, false);

function hideURLbar() {
    window.scrollTo(0, 1);
}