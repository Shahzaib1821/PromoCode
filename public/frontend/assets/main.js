const items = document.querySelectorAll(".accordion button");

function toggleAccordion() {
    const itemToggle = this.getAttribute("aria-expanded");

    for (i = 0; i < items.length; i++) {
        items[i].setAttribute("aria-expanded", "false");
    }

    if (itemToggle == "false") {
        this.setAttribute("aria-expanded", "true");
    }
}

items.forEach((item) => item.addEventListener("click", toggleAccordion));

$(document).ready(function () {
    $("#bannerSlider").slick({
        dots: false,
        autoplay: true,
        infinite: true,
        dots: false,
        slidesToShow: 1,
        slideswToScroll: 1,
        arrows: true,
        prevArrow: $(".custom-prev"),
        nextArrow: $(".custom-next"),
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const alphabetLinks = document.querySelectorAll(".store-alphabets a");
    const storeEntries = document.querySelectorAll(".store-entry");

    alphabetLinks.forEach(function (link) {
        link.addEventListener("click", function (e) {
            e.preventDefault();
            const letter = this.innerText;
            let foundEntries = false;
            storeEntries.forEach(function (entry) {
                if (
                    entry.getAttribute("data-letter") === letter ||
                    letter === "ALL"
                ) {
                    entry.style.display = "block";
                    foundEntries = true;
                } else {
                    entry.style.display = "none";
                }
            });
            if (!foundEntries) {
                document.getElementById("noDataFound").style.display = "block";
            } else {
                document.getElementById("noDataFound").style.display = "none";
            }
        });
    });
});

// Make sure to include Swiper library before this script
document.addEventListener("DOMContentLoaded", function () {
    // var swiper = new Swiper('.product-slider', {
    //   spaceBetween: 30,
    //   effect: 'fade',
    //   loop: false,
    //   navigation: {
    //     nextEl: '.next',
    //     prevEl: '.prev'
    //   },
    //   mousewheel: {
    //         invert: false
    //     },
    //   on: {
    //     init: function(){
    //       var index = this.activeIndex;
    //       var target = document.querySelector('.product-slider__item:nth-child(' + (index + 1) + ')').getAttribute('data-target');
    //       document.querySelectorAll('.product-img__item').forEach(function(el) {
    //         el.classList.remove('active');
    //       });
    //       if (target) {
    //         document.querySelector('.product-img__item#' + target).classList.add('active');
    //       }
    //     }
    //   }
    // });

    // swiper.on('slideChange', function () {
    //   var index = this.activeIndex;
    //   var target = document.querySelector('.product-slider__item:nth-child(' + (index + 1) + ')').getAttribute('data-target');
    //   document.querySelectorAll('.product-img__item').forEach(function(el) {
    //     el.classList.remove('active');
    //   });
    //   if (target) {
    //     document.querySelector('.product-img__item#' + target).classList.add('active');
    //   }

    //   if(swiper.isEnd) {
    //     document.querySelector('.prev').classList.remove('disabled');
    //     document.querySelector('.next').classList.add('disabled');
    //   } else {
    //     document.querySelector('.next').classList.remove('disabled');
    //   }

    //   if(swiper.isBeginning) {
    //     document.querySelector('.prev').classList.add('disabled');
    //   } else {
    //     document.querySelector('.prev').classList.remove('disabled');
    //   }
    // });

    // document.querySelectorAll(".js-fav").forEach(function(el) {
    //   el.addEventListener("click", function() {
    //     this.querySelector('.heart').classList.toggle("is-active");
    //   });
    // });
    var swiper = new Swiper(".product-slider", {
        spaceBetween: 30,
        effect: "fade",
        // initialSlide: 2,
        loop: true,
        navigation: {
            nextEl: ".next",
            prevEl: ".prev",
        },

        mousewheel: {
            // invert: false
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
            dynamicBullets: true,
        },
        on: {
            init: function () {
                var index = this.activeIndex;

                var target = $(".product-slider__item")
                    .eq(index)
                    .data("target");

                console.log(target);

                $(".product-img__item").removeClass("active");
                $(".product-img__item#" + target).addClass("active");
            },
        },
    });

    swiper.on("slideChange", function () {
        var index = this.activeIndex;

        var target = $(".product-slider__item").eq(index).data("target");

        console.log(target);

        $(".product-img__item").removeClass("active");
        $(".product-img__item#" + target).addClass("active");

        // if (swiper.isEnd) {
        //   $('.prev').removeClass('disabled');
        //   $('.next').addClass('disabled');
        // } else {
        //   $('.next').removeClass('disabled');
        // }

        // if (swiper.isBeginning) {
        //   $('.prev').addClass('disabled');
        // } else {
        //   $('.prev').removeClass('disabled');
        // }
    });

    $(".js-fav").on("click", function () {
        $(this).find(".heart").toggleClass("is-active");
    });
});
