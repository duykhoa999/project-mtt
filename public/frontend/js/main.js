$(function () {
    $('#banner-slider').owlCarousel({
        items: 1,
        loop: true,
        nav: true,
        navText: ['<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>'],
        dots: true,
        autoplay: true, //auto chay
        autoplayTimeout: 6000, // chay sau 3.5s
        responsive: window,

    });
    // header
    // $(window).scroll(function () {
    //     const position = $(window).scrollTop();
    //     if (position > 100) {
    //         $("header").addClass("fixed");
    //     } else {
    //         $("header").removeClass("fixed");
    //     }
    // });
    //end header
    // totop
    $(window).scroll(function () {
        const totop1 = $(window).scrollTop();
        if (totop1 > 200) {
            $(".totop").addClass("show");
        } else {
            $(".totop").removeClass("show");
        }
    })

    //end totop
});