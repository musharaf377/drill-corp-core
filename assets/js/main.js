
(function ($) {
  'use strict'

  $(document).ready(function () {

    /* =====================
        Hero Slider area
     ======================= */
    let heroSliderWrapper = $('.hero-slider');
    let heroSliderSetting = heroSliderWrapper.attr('data-settings');
    let sliderSettings = heroSliderSetting ? JSON.parse(heroSliderSetting) : {};

    // Extract settings
    let loop = sliderSettings.loop !== undefined ? sliderSettings.loop : true;
    let autoplay = sliderSettings.autoplay !== undefined ? sliderSettings.autoplay : true;
    let autoplayDelay = sliderSettings.speed !== undefined ? sliderSettings.speed : 3000;
    let transitionSpeed = 500;
    let effect = sliderSettings.effect !== undefined ? sliderSettings.effect : 'slide';
    
    // Fade effect with loop can cause autoplay issues - disable loop for fade effect
    if (effect === 'fade' && loop) {
      console.warn('Fade effect with loop enabled may cause autoplay issues. Consider using slide effect for more than 3 slides.');
    }

    // Get all progress bars
    const progressBars = $(".progress-bar");

    // Function to update progress bars based on current slide
    function updateProgressBars(realIndex, isAutoplay = true) {
      progressBars.each(function (index) {
        const bar = $(this);
        const slideIndex = parseInt(bar.attr('data-slide-index'));

        // Remove all classes first
        bar.removeClass('active completed');
        bar.css({
          'transition': 'none',
          'width': '0%'
        });

        // Mark completed slides
        if (slideIndex < realIndex) {
          bar.addClass('completed');
          bar.css('width', '100%');
        }
        // Mark active slide
        else if (slideIndex === realIndex) {
          bar.addClass('active');
          if (isAutoplay) {
            // Animate the active progress bar
            setTimeout(function () {
              bar.css({
                'transition': 'width ' + autoplayDelay + 'ms linear',
                'width': '100%'
              });
            }, 50);
          }
        }
      });
    }

 
    // Initialize main hero slider
    var heroSlider = new Swiper(".hero-slider", {
      loop: effect === 'fade' ? false : loop, // Disable loop for fade effect to prevent autoplay issues
      spaceBetween: 0,
      autoplay: autoplay ? {
        delay: autoplayDelay,
        disableOnInteraction: false,
      } : false,
      effect: effect,
      fadeEffect: effect === 'fade' ? {
        crossFade: true
      } : undefined,
      speed: transitionSpeed,

      on: {
        init: function () {
          updateProgressBars(this.realIndex, autoplay);
        },

        slideChange: function () {
          updateProgressBars(this.realIndex, autoplay && this.autoplay.running);
        },

        autoplayStart: function () {
          updateProgressBars(this.realIndex, true);
        },

        autoplayStop: function () {
          progressBars.each(function () {
            $(this).css('transition', 'none');
          });
        }
      }
    });


  })
})(jQuery);