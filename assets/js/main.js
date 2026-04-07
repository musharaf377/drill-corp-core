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


      // Initialize testimonial slider
      var testimonialSlider = new Swiper(".testimonial-slider", {
         loop: testimonialLoop,
         spaceBetween: 16,
         slidesPerView: 1,
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
      $(document).on('click', '.faq-card-header', function (e) {
         e.preventDefault();
         e.stopPropagation();

         var $card = $(this).closest('.faq-card');
         var $wrapper = $card.closest('.faq-accordion-wrapper');
         var $body = $card.find('.faq-card-body');
         var isActive = $card.hasClass('active');

         // Close all other cards in this wrapper
         $wrapper.find('.faq-card').each(function () {
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
      $(document).on('keydown', '.faq-card-header', function (e) {
         if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            $(this).trigger('click');
         }
      });


      /** =============================
       * Services Card Sticky Animation
       ================================ */
      const serviceCards = document.querySelectorAll('.services-list-content');
      
      if (serviceCards.length > 0) {
         // Set initial positions and sticky behavior
         serviceCards.forEach((card, i) => {
            card.style.position = 'sticky';
            card.style.top = '0px';
            card.style.transform = 'translateY(0px)'; // Start at natural position
            card.style.zIndex = serviceCards.length + i; // First card has highest z-index
            card.style.opacity = '1';
            card.style.transition = 'opacity 0.5s cubic-bezier(0.4, 0, 0.2, 1), transform 0.5s cubic-bezier(0.4, 0, 0.2, 1)';
            card.style.willChange = 'opacity, transform'; // GPU acceleration
         });

         // Scroll-based opacity and position animation
         function updateCardAnimation() {
            const viewportHeight = window.innerHeight;
            
            serviceCards.forEach((card, i) => {
               const cardRect = card.getBoundingClientRect();
               
               // Count how many cards are currently visible (opacity > 0)
               let visibleCardsBeforeThis = 0;
               
               for (let j = 0; j < i; j++) {
                  const prevCardRect = serviceCards[j].getBoundingClientRect();
                  // Count cards that are still visible (not faded out)
                  if (prevCardRect.top < viewportHeight && parseFloat(serviceCards[j].style.opacity) > 0) {
                     visibleCardsBeforeThis++;
                  }
               }
               
               // Count how many cards have entered viewport after this one
               let cardsAfterCount = 0;
               for (let j = i + 1; j < serviceCards.length; j++) {
                  const nextCardRect = serviceCards[j].getBoundingClientRect();
                  // If next card has entered viewport
                  if (nextCardRect.top < viewportHeight) {
                     cardsAfterCount++;
                  }
               }
               
               // When 3 or more cards come after, this card should fade
               if (cardsAfterCount >= 3) {
                  card.style.opacity = '0';
                  card.style.pointerEvents = 'none';
                  card.style.transform = 'translateY(100px) scale(0.95)'; // Scale down slightly
               } else {
                  card.style.opacity = '1';
                  card.style.pointerEvents = 'auto';
                  
                  // Adjust position based on how many visible cards are before this one
                  if (visibleCardsBeforeThis === 0) {
                     card.style.transform = 'translateY(100px)'; // First visible card position
                     card.style.transitionDelay = '0ms'; // Immediate
                  } else if (visibleCardsBeforeThis === 1) {
                     card.style.transform = 'translateY(200px)'; // Second visible card position
                     card.style.transitionDelay = '80ms'; // Slight delay
                  } else if (visibleCardsBeforeThis === 2) {
                     card.style.transform = 'translateY(300px)'; // Third visible card position
                     card.style.transitionDelay = '160ms'; // More delay
                  }
               }
            });
         }

         // Throttle scroll event for better performance
         let ticking = false;
         window.addEventListener('scroll', function() {
            if (!ticking) {
               window.requestAnimationFrame(function() {
                  updateCardAnimation();
                  ticking = false;
               });
               ticking = true;
            }
         });

         // Initial call
         updateCardAnimation();
      }

      /* ========================
       *  Blog List Tab
       =========================*/
      const blogTabWraps = document.querySelectorAll('.blog-list-tab-wrap');
      
      blogTabWraps.forEach(function(tabWrap) {
         const tabs = tabWrap.querySelectorAll('.blog-list-tab-nav-item');
         const blogList = tabWrap.querySelector('.blog-list');
         
         if (!tabs.length || !blogList) return;
         
         tabs.forEach(function(tab) {
            tab.addEventListener('click', function(e) {
               e.preventDefault();
               
               // Remove active class from all tabs
               tabs.forEach(t => t.classList.remove('active'));
               
               // Add active class to clicked tab
               this.classList.add('active');
               
               const selectedCategory = this.getAttribute('data-category');
               
               // Filter posts
               const posts = blogList.querySelectorAll('.blog-list-item');
               
               posts.forEach(function(post) {
                  const postCategories = post.getAttribute('data-categories');
                  
                  if (!postCategories) {
                     post.style.display = '';
                     return;
                  }
                  
                  const categoriesArray = postCategories.split(',');
                  
                  if (selectedCategory === 'all' || categoriesArray.includes(selectedCategory)) {
                     post.style.display = '';
                  } else {
                     post.style.display = 'none';
                  }
               });
            });
         });
      });





   });

})(jQuery);
