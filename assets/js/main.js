
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
      let heroSliderLoop = sliderSettings.loop !== undefined ? sliderSettings.loop : true;
      let heroSliderAutoplay = sliderSettings.autoplay !== undefined ? sliderSettings.autoplay : true;
      let heroSliderAutoplayDelay = sliderSettings.speed !== undefined ? sliderSettings.speed : 3000;
      let heroSliderTransitionSpeed = 500;
      let heroSliderEffect = sliderSettings.effect !== undefined ? sliderSettings.effect : 'slide';

      // Fade effect with loop can cause autoplay issues - disable loop for fade effect
      if (heroSliderEffect === 'fade' && heroSliderLoop) {
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
                        'transition': 'width ' + heroSliderAutoplayDelay + 'ms linear',
                        'width': '100%'
                     });
                  }, 50);
               }
            }
         });
      }


      // Initialize main hero slider
      var heroSlider = new Swiper(".hero-slider", {
         loop: heroSliderEffect === 'fade' ? false : heroSliderLoop, // Disable loop for fade effect to prevent autoplay issues
         spaceBetween: 0,
         autoplay: heroSliderAutoplay ? {
            delay: heroSliderAutoplayDelay,
            disableOnInteraction: false,
         } : false,
         effect: heroSliderEffect,
         fadeEffect: heroSliderEffect === 'fade' ? {
            crossFade: true
         } : undefined,
         speed: heroSliderTransitionSpeed,

         on: {
            init: function () {
               updateProgressBars(this.realIndex, heroSliderAutoplay);
            },

            slideChange: function () {
               updateProgressBars(this.realIndex, heroSliderAutoplay && this.autoplay.running);
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


      /* ========================
       *  Testimonial Slider
       =========================*/
      let testimonialSliderWrapper = $('.testimonial-slider');
      let testimonialSliderSetting = testimonialSliderWrapper.attr('data-settings');
      let testimonialSettings = testimonialSliderSetting ? JSON.parse(testimonialSliderSetting) : {};

      // Extract settings
      let testimonialLoop = testimonialSettings.loop !== undefined ? testimonialSettings.loop : true;
      let testimonialAutoplay = testimonialSettings.autoplay !== undefined ? testimonialSettings.autoplay : true;
      let testimonialAutoplayDelay = testimonialSettings.speed !== undefined ? testimonialSettings.speed : 3000;
      let testimonialTransitionSpeed = 500;


      // Initialize main hero slider
      var testimonialSlider = new Swiper(".testimonial-slider", {
         loop: testimonialLoop,
         spaceBetween: 16,
         slidePerView: 1,
         autoplay: testimonialAutoplay ? {
            delay: testimonialAutoplayDelay,
            disableOnInteraction: false,
         } : false,
         navigation: {
            nextEl: '.testimonial-nav-next',
            prevEl: '.testimonial-nav-prev',
         },
         speed: testimonialTransitionSpeed,

         breakpoints: {
            768: {
               slidesPerView: 2,
               spaceBetween: 20,
            },
            992: {
               spaceBetween: 24,
               slidesPerView: 2.3,
            }
         }
      });



      /* ========================
       *  Services Slider
       =========================*/
      $('.services-slider').each(function () {
         let $slider = $(this);
         let servicesSliderSetting = $slider.attr('data-settings');
         let servicesSettings = servicesSliderSetting ? JSON.parse(servicesSliderSetting) : {};

         // Extract settings
         let servicesLoop = servicesSettings.loop !== undefined ? servicesSettings.loop : true;
         let servicesAutoplay = servicesSettings.autoplay !== undefined ? servicesSettings.autoplay : true;
         let servicesAutoplayDelay = servicesSettings.speed !== undefined ? servicesSettings.speed : 3000;
         let servicesTransitionSpeed = 500;
         

         // Initialize slider
         new Swiper($slider[0], {
            loop: servicesLoop,
            spaceBetween: 16,
            slidesPerView: 1,
            autoplay: servicesAutoplay ? {
               delay: servicesAutoplayDelay,
               disableOnInteraction: false,
            } : false,
            navigation: {
               nextEl: '.services-nav-next',
               prevEl: '.services-nav-prev',
            },
            speed: servicesTransitionSpeed,
            breakpoints: {
               768: {
                  slidesPerView: 1,
                  spaceBetween: 20,
               },
               992: {
                  spaceBetween: 24,
                  slidesPerView: 1.1,
               }
            }
         });
      });


      /* ========================
       *  FAQ Accordion
       =========================*/
      $(document).on('click', '.faq-card-header', function(e) {
         e.preventDefault();
         e.stopPropagation();
         
         var $card = $(this).closest('.faq-card');
         var $wrapper = $card.closest('.faq-accordion-wrapper');
         var $body = $card.find('.faq-card-body');
         var isActive = $card.hasClass('active');
         
         // Close all other cards in this wrapper
         $wrapper.find('.faq-card').each(function() {
            var $thisCard = $(this);
            if ($thisCard[0] !== $card[0]) {
               $thisCard.removeClass('active');
               $thisCard.find('.faq-card-header').attr('aria-expanded', 'false');
               $thisCard.find('.faq-card-body').slideUp(300);
            }
         });
         
         // Toggle current card
         if (isActive) {
            $card.removeClass('active');
            $(this).attr('aria-expanded', 'false');
            $body.slideUp(300);
         } else {
            $card.addClass('active');
            $(this).attr('aria-expanded', 'true');
            $body.slideDown(300);
         }
      });
      
      // Keyboard support - Enter and Space keys
      $(document).on('keydown', '.faq-card-header', function(e) {
         if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            $(this).trigger('click');
         }
      });


   });



})(jQuery);