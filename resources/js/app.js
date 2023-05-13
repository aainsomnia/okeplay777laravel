require('./bootstrap');

  // import Swiper bundle with all modules installed
  import Swiper from 'swiper/bundle';

  // import styles bundle
  import 'swiper/css/bundle';

  // init Swiper:
  const swiper = new Swiper('.swiper',{
        autoplay: {
            delay: 3000,
        },
        loop: true,
        loopFillGroupWithBlank: true,
        slidesPerView: 4,
        spaceBetween: 10,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".btn-next",
            prevEl: ".btn-prev",
        },
        breakpoints: {
            920: {
                slidesPerView: 4,
                loop: true,
            },
            0: {
                slidesPerView: 2,
                loop: true,
            }
        }
    });
