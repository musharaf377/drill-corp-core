
(function ($) {
  'use strict'

  $(document).ready(function () {



    /* =====================
        Hero Slider area
     ======================= */
    let heroSliderWrapper = $('.hero-slider');

    let heroSliderSetting = heroSliderWrapper.attr('data-settings');
    let sliderSettings = JSON.parse(heroSliderSetting);

    let loop = sliderSettings.loop;
    let autoplay = sliderSettings.autoplay;
    let speed = sliderSettings.speed;

    var thumb = new Swiper(".hero-slider-thumb", {
      loop: loop,
      spaceBetween: 10,
      slidesPerView: 2,
      freeMode: true,
      watchSlidesProgress: true,
    });

    var heroSlider = new Swiper(".hero-slider", {
      loop: loop,
      spaceBetween: 10,
      autoplay: autoplay,
      speed: speed,
      thumbs: {
        swiper: thumb,
      },
    });


  })
})(jQuery);