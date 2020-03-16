jQuery(function($) {

    $('.grid').masonry({
        // options...
        itemSelector: '.galerija',

    });


    //Slick slider initialize
    $(".sliderx").slick({
        slidesToShow: 3,
        dots: false,
        arrows: false,
        infinite: true,
        centerMode: true,
        focusOnSelect: true,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    centerMode: false,

                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    centerMode: false,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    centerMode: false,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });

    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
        e.target
        e.relatedTarget
        $('.sliderx').slick('setPosition');
    });

    var updateMasonry = function() {
        $('#gallery .tab-pane.active').masonry({
            itemSelector: '.galerija',
        })
    }
    $('#gallery a[data-toggle="tab"]').on('shown.bs.tab', updateMasonry);
    $(window).on('resize load', updateMasonry)
});