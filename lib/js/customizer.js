/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

function google_web_fonts_id(font) {
    font = font.split('=');
    var colon = '';
    if (font[0].indexOf(':') == -1) {
        colon = ':';
    }
    return font[0] + colon + ':latin';
}

function google_web_fonts() {
    var font_script = document.getElementById('sampression-fonts-css');//sampression-google-fonts
    if (typeof(font_script) != 'undefined' && font_script != null) {
        font_script.parentNode.removeChild(font_script);
    }

    var google_fonts = Array();
    google_fonts.push(google_web_fonts_id(wp.customize._value.title_font()));
    google_fonts.push(google_web_fonts_id(wp.customize._value.body_font()));

    google_fonts = jQuery.unique(google_fonts);
    //console.log(google_fonts);
    var fonts_ = google_fonts.join('|');

    var wf = document.createElement('link');
    wf.setAttribute("id", "sampression-fonts-css");
    wf.setAttribute("media", "all");
    wf.setAttribute("type", "text/css");
    wf.setAttribute("href", "//fonts.googleapis.com/css?family=" + fonts_);
    wf.setAttribute("rel", "stylesheet");
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);

}

function font_family(to) {
    var font_ = '', font = '', style_ = '', style = '';
    if (to.indexOf(':') === -1) {
        font_ = to.split('=');
        font = font_[0].replace('+', ' ');
        style = font_[1];
    } else {
        font_ = to.split(':');
        font = font_[0].replace('+', ' ');
        style_ = font_[1].split('=');
        style = style_[1];
    }
    return '"' + font + '", ' + style;
}

function font_family(to) {
    var font_ = '', font = '', style_ = '', style = '';
    if (to.indexOf(':') === -1) {
        font_ = to.split('=');
        font = font_[0].replace('+', ' ');
        style = font_[1];
    } else {
        font_ = to.split(':');
        font = font_[0].replace('+', ' ');
        style_ = font_[1].split('=');
        style = style_[1];
    }
    return '"' + font + '", ' + style;
}


(function ($) {

    function sampression_font_family(target, to) {
        google_web_fonts();
        var family = font_family(to);
        $(target).css({
            'font-family': family
        });
    }

    // Site title and description.
    wp.customize('blogname', function (value) {
        value.bind(function (to) {
            $('.site-title a').text(to);
        });
    });
    wp.customize('blogdescription', function (value) {
        value.bind(function (to) {
            $('#site-description').text(to);
        });
    });
    // Body background cover
    wp.customize('sampression_background_cover', function (value) {
        value.bind(function (to) {
            if (to == true) {
                $('#content-wrapper').css('background-size', 'cover');
            } else {
                $('#content-wrapper').css('background-size', 'initial');
            }
        });
    });

    // Header text font.
    wp.customize('title_font', function (value) {
        value.bind(function (to) {
            sampression_font_family('#site-title a, article.post .post-title a, body.single article.post .post-title, body.page article.post .post-title, h1, h2, h3, h4, h5, h6', to);
        });
    });

    // Header text color.
    wp.customize('title_textcolor', function (value) {
        value.bind(function (to) {
            //console.log(to);
            $('#site-title a, article.post .post-title a, body.single article.post .post-title, body.page article.post .post-title, h1, h2, h3, h4, h5, h6').not('#site-description').css({
                'color': to
            });
        });
    });

    // Body text font.
    wp.customize('body_font', function (value) {
        value.bind(function (to) {
            sampression_font_family('body, p, #site-description', to);
        });
    });

    // Body text color.
    wp.customize('body_textcolor', function (value) {
        value.bind(function (to) {
            //console.log(to);
            $('body, #site-description').css({
                'color': to
            });
        });
    });
    //Link color
    wp.customize('link_color', function (value) {
        value.bind(function (to) {
            //console.log(to);
            $('a:link, a:visited, .meta, .meta a, #top-nav ul a:link, #top-nav ul a:visited, #primary-nav ul.nav-listing li a, #top-nav ul li li a, #top-nav ul li.current-menu-item li a, #top-nav ul li.current-menu-parent li a, #top-nav ul li.current-menu-ancestor li a, #top-nav ul li li.current-menu-item li a, #top-nav ul li li.current-menu-parent li a, #top-nav ul li li.current-menu-parent li.current-menu-item a, #top-nav .sub-menu li a, #top-nav .sub-menu .sub-menu li a, #top-nav .sub-menu li:last-child > .sub-menu li a, #top-nav .sub-menu li:last-child > .sub-menu li:last-child > .sub-menu li a, #top-nav .sub-menu li:last-child > .sub-menu li:last-child > .sub-menu li:last-child > .sub-menu li a').not('#site-title a, article.post .post-title a, .sm-top a').css({'color': to});
            $('#primary-nav ul.nav-listing li a span').css({'backgroundColor': to});

        });
    });

})(jQuery);
