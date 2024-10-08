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

                // console.log(target);

                $(".product-img__item").removeClass("active");
                $(".product-img__item#" + target).addClass("active");
            },
        },
    });

    swiper.on("slideChange", function () {
        var index = this.activeIndex;

        var target = $(".product-slider__item").eq(index).data("target");

        // console.log(target);

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


document.addEventListener('DOMContentLoaded', function() {
    var deleteButtons = document.querySelectorAll('.btn-soft-danger[type="submit"]');

    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();

            var form = this.closest('form');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
