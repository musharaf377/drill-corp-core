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

      if (heroSliderEffect === 'fade' && heroSliderLoop) {
         console.warn('Fade effect with loop enabled may cause autoplay issues. Consider using slide effect for more than 3 slides.');
      }

      // Get all progress bars
      const progressBars = $(".progress-bar");
      progressBars.css('cursor', 'pointer');

      // Make progress bars clickable and keyboard accessible
      $(document).on('click', '.progress-container', function (e) {
         e.preventDefault();

         const targetIndex = parseInt($(this).find('.progress-bar').attr('data-slide-index'));
         if (isNaN(targetIndex) || typeof heroSlider === 'undefined') {
            return;
         }

         if (heroSlider.params.loop && typeof heroSlider.slideToLoop === 'function') {
            heroSlider.slideToLoop(targetIndex, heroSliderTransitionSpeed, true);
         } else if (typeof heroSlider.slideTo === 'function') {
            heroSlider.slideTo(targetIndex, heroSliderTransitionSpeed, true);
         }
         // activateHeroSlide fires via slideChange event
      });

      $(document).on('keydown', '.progress-container', function (e) {
         if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            $(this).trigger('click');
         }
      });

      // duration: ms to animate the active progress bar (matches video length or fallback delay)
      function updateProgressBars(realIndex, isAutoplay, duration) {
         if (duration === undefined) duration = heroSliderAutoplayDelay;
         progressBars.each(function () {
            const bar = $(this);
            const slideIndex = parseInt(bar.attr('data-slide-index'));

            bar.removeClass('active completed');
            bar.css({ 'transition': 'none', 'width': '0%' });

            if (slideIndex < realIndex) {
               bar.addClass('completed');
               bar.css('width', '100%');
            } else if (slideIndex === realIndex) {
               bar.addClass('active');
               if (isAutoplay) {
                  setTimeout(function () {
                     bar.css({
                        'transition': 'width ' + duration + 'ms linear',
                        'width': '100%'
                     });
                  }, 50);
               }
            }
         });
      }

      let slideVideoTimer = null;

      function getActiveSlideVideo(swiper) {
         const activeSlide = swiper.slides[swiper.activeIndex];
         if (!activeSlide) return null;
         const isMobile = window.innerWidth < 768;
         let video = isMobile
            ? activeSlide.querySelector('.hero-mobile-video')
            : activeSlide.querySelector('.hero-desktop-video');
         if (!video) video = activeSlide.querySelector('video');
         return video;
      }

      function stopAllHeroVideos() {
         document.querySelectorAll('.hero-slider video').forEach(function (v) {
            v.pause();
            v.currentTime = 0;
         });
      }

      function advanceHeroSlider(swiper) {
         if (swiper.params.loop) {
            swiper.slideNext(heroSliderTransitionSpeed);
         } else if (swiper.isEnd) {
            swiper.slideTo(0, heroSliderTransitionSpeed);
         } else {
            swiper.slideNext(heroSliderTransitionSpeed);
         }
      }

      function activateHeroSlide(swiper) {
         stopAllHeroVideos();
         clearTimeout(slideVideoTimer);

         const video = getActiveSlideVideo(swiper);

         if (!heroSliderAutoplay) {
            updateProgressBars(swiper.realIndex, false);
            return;
         }

         if (video) {
            // Show progress bar immediately with fallback duration; update once metadata arrives
            updateProgressBars(swiper.realIndex, true, heroSliderAutoplayDelay);

            if (video.readyState >= 1 && isFinite(video.duration)) {
               updateProgressBars(swiper.realIndex, true, video.duration * 1000);
            } else {
               video.addEventListener('loadedmetadata', function () {
                  if (isFinite(video.duration)) {
                     updateProgressBars(swiper.realIndex, true, video.duration * 1000);
                  }
               }, { once: true });
            }

            // Freeze progress bar while buffering, resume from current position on playing
            video.addEventListener('waiting', function () {
               const bar = progressBars.filter('[data-slide-index="' + swiper.realIndex + '"]');
               const barEl = bar[0];
               if (!barEl) return;
               const currentWidth = barEl.getBoundingClientRect().width;
               const containerWidth = barEl.closest('.progress-container').getBoundingClientRect().width;
               const currentPercent = containerWidth > 0 ? (currentWidth / containerWidth * 100) : 0;
               bar.css({ 'transition': 'none', 'width': currentPercent + '%' });
            });

            video.addEventListener('playing', function () {
               const bar = progressBars.filter('[data-slide-index="' + swiper.realIndex + '"]');
               if (!bar.length || !isFinite(video.duration)) return;
               const remainingMs = (video.duration - video.currentTime) * 1000;
               bar.css({ 'transition': 'width ' + remainingMs + 'ms linear', 'width': '100%' });
            });

            // Play immediately — browsers handle play() before metadata is ready
            video.play().catch(function () {
               // Autoplay blocked — fall back to configured delay timer
               slideVideoTimer = setTimeout(function () {
                  advanceHeroSlider(swiper);
               }, heroSliderAutoplayDelay);
            });

            video.addEventListener('ended', function () {
               advanceHeroSlider(swiper);
            }, { once: true });

         } else {
            // No video on this slide — use configured delay
            updateProgressBars(swiper.realIndex, true, heroSliderAutoplayDelay);
            slideVideoTimer = setTimeout(function () {
               advanceHeroSlider(swiper);
            }, heroSliderAutoplayDelay);
         }
      }

      // Initialize main hero slider — timing is driven by video duration, not Swiper autoplay
      var heroSlider = new Swiper(".hero-slider", {
         loop: heroSliderEffect === 'fade' ? false : heroSliderLoop,
         spaceBetween: 0,
         autoplay: false,
         effect: heroSliderEffect,
         fadeEffect: heroSliderEffect === 'fade' ? {
            crossFade: true
         } : undefined,
         speed: heroSliderTransitionSpeed,

         on: {
            init: function () {
               activateHeroSlide(this);
            },

            slideChange: function () {
               activateHeroSlide(this);
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
      const serviceLists = document.querySelectorAll('.services-list-area');

      serviceLists.forEach(function (serviceListArea) {
         // Skip if animation is disabled
         if (serviceListArea.classList.contains('no-animation')) {
            const staticCards = serviceListArea.querySelectorAll('.services-list-content');
            staticCards.forEach(card => {
               card.style.position = 'static';
               card.style.transform = 'none';
               card.style.opacity = '1';
            });
            return;
         }

         const serviceCards = serviceListArea.querySelectorAll('.services-list-content');

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
            window.addEventListener('scroll', function () {
               if (!ticking) {
                  window.requestAnimationFrame(function () {
                     updateCardAnimation();
                     ticking = false;
                  });
                  ticking = true;
               }
            });

            // Initial call
            updateCardAnimation();
         }
      });

      /* ========================
       *  Blog List Tab
       =========================*/
      const blogTabWraps = document.querySelectorAll('.blog-list-tab-wrap');

      blogTabWraps.forEach(function (tabWrap) {
         const tabs = tabWrap.querySelectorAll('.blog-list-tab-nav-item');
         const blogList = tabWrap.querySelector('.blog-list');

         if (!tabs.length || !blogList) return;

         tabs.forEach(function (tab) {
            tab.addEventListener('click', function (e) {
               e.preventDefault();

               // Remove active class from all tabs
               tabs.forEach(t => t.classList.remove('active'));

               // Add active class to clicked tab
               this.classList.add('active');

               const selectedCategory = this.getAttribute('data-category');

               // Filter posts
               const posts = blogList.querySelectorAll('.blog-list-item');

               posts.forEach(function (post) {
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

      /* ========================
       *  Career List Tab
       =========================*/
      const careerTabWraps = document.querySelectorAll('.career-list-tab-wrap');

      careerTabWraps.forEach(function (tabWrap) {
         const tabs = tabWrap.querySelectorAll('.career-list-tab-nav-item');
         const careerList = tabWrap.querySelector('.career-list');
         const loadMoreBtn = tabWrap.querySelector('.career-load-more-container');
         const $tabWrapJQ = $(tabWrap);

         if (!tabs.length || !careerList) return;

         tabs.forEach(function (tab) {
            tab.addEventListener('click', function (e) {
               e.preventDefault();

               // Remove active class from all tabs
               tabs.forEach(t => t.classList.remove('active'));

               // Add active class to clicked tab
               this.classList.add('active');

               const selectedCategory = this.getAttribute('data-category');
               const $this = $(this);
               const categoryTotalPosts = parseInt($this.data('total-posts'));
               const postsPerPage = parseInt($tabWrapJQ.data('posts-per-page'));
               const orderby = $tabWrapJQ.data('orderby');
               const order = $tabWrapJQ.data('order');
               const nonce = $tabWrapJQ.data('nonce');

               // If it's 'all' tab, check if Load More was previously clicked
               if (selectedCategory === 'all') {
                  const totalPosts = parseInt($tabWrapJQ.data('total-posts'));
                  const loadMoreWasClicked = $tabWrapJQ.data('loadMoreWasClicked') || false;

                  // Determine how many posts to load
                  let postsToLoad = postsPerPage; // Default: load only page 1
                  if (loadMoreWasClicked) {
                     postsToLoad = totalPosts; // Load all posts if Load More was clicked
                  }

                  // Reload posts for 'all' tab
                  $.ajax({
                     url: drillcorpAjax.ajaxurl,
                     type: 'POST',
                     data: {
                        action: 'load_more_career_posts',
                        nonce: nonce,
                        page: 1,
                        posts_per_page: postsToLoad,
                        orderby: orderby,
                        order: order,
                        category: 'all'
                     },
                     beforeSend: function () {
                        careerList.innerHTML = '<p class="loading-message">Loading...</p>';
                     },
                     success: function (response) {
                        if (response.success && response.data.html) {
                           // Replace all posts
                           careerList.innerHTML = response.data.html;

                           // Show/hide load more button based on state
                           if (loadMoreBtn) {
                              if (!loadMoreWasClicked && totalPosts > postsPerPage) {
                                 // Load More was NOT clicked and there are more posts - show button
                                 loadMoreBtn.style.display = '';
                                 const $loadMoreBtn = $(loadMoreBtn).find('.career-load-more-btn');
                                 $loadMoreBtn.data('page', 2).attr('data-page', 2);
                                 $loadMoreBtn.data('category', 'all').attr('data-category', 'all');
                              } else {
                                 // Load More was clicked OR no more posts - hide button
                                 loadMoreBtn.style.display = 'none';
                              }
                           }
                        } else {
                           careerList.innerHTML = '<p>No posts found.</p>';
                           if (loadMoreBtn) {
                              loadMoreBtn.style.display = 'none';
                           }
                        }
                     },
                     error: function (xhr, status, error) {
                        careerList.innerHTML = '<p>Error loading posts.</p>';
                        if (loadMoreBtn) {
                           loadMoreBtn.style.display = 'none';
                        }
                     }
                  });
               } else {
                  // For category tabs, load all posts via AJAX
                  $.ajax({
                     url: drillcorpAjax.ajaxurl,
                     type: 'POST',
                     data: {
                        action: 'load_more_career_posts',
                        nonce: nonce,
                        page: 1,
                        posts_per_page: categoryTotalPosts, // Load all posts for this category
                        orderby: orderby,
                        order: order,
                        category: selectedCategory
                     },
                     success: function (response) {
                        if (response.success && response.data.html) {
                           // Replace all posts with filtered posts
                           careerList.innerHTML = response.data.html;

                           // Hide load more button for category tabs
                           if (loadMoreBtn) {
                              loadMoreBtn.style.display = 'none';
                           }
                        } else {
                           // No posts found
                           careerList.innerHTML = '<p>No posts found in this category.</p>';
                           if (loadMoreBtn) {
                              loadMoreBtn.style.display = 'none';
                           }
                        }
                     },
                     error: function (xhr, status, error) {
                        careerList.innerHTML = '<p>Error loading posts.</p>';
                        if (loadMoreBtn) {
                           loadMoreBtn.style.display = 'none';
                        }
                     }
                  });
               }
            });
         });
      });

      /* ========================
       *  Career Load More
       =========================*/
      $(document).on('click', '.career-load-more-btn', function (e) {
         e.preventDefault();

         const $button = $(this);
         const $spinner = $button.find('.load-more-spinner');
         const $text = $button.find('.load-more-text');
         const $tabWrap = $button.closest('.career-list-tab-wrap');
         const $careerList = $tabWrap.find('.career-list');
         const loadMoreContainer = $tabWrap.find('.career-load-more-container');

         // Get settings from data attributes
         const widgetId = $button.data('widget-id');
         let currentPage = parseInt($button.data('page')) || 2;
         let currentCategory = $button.data('category') || 'all';
         const postsPerPage = parseInt($tabWrap.data('posts-per-page')) || 10;
         const orderby = $tabWrap.data('orderby') || 'date';
         const order = $tabWrap.data('order') || 'DESC';
         const nonce = $tabWrap.data('nonce');

         // Don't proceed if already loading
         if ($button.hasClass('loading')) {
            return;
         }

         // Show spinner and hide text
         $button.addClass('loading');
         $text.hide();
         $spinner.show();

         // AJAX request
         $.ajax({
            url: drillcorpAjax.ajaxurl,
            type: 'POST',
            data: {
               action: 'load_more_career_posts',
               nonce: nonce,
               page: currentPage,
               posts_per_page: postsPerPage,
               orderby: orderby,
               order: order,
               category: currentCategory
            },
            success: function (response) {
               if (response.success && response.data.html) {
                  // Append new posts
                  $careerList.append(response.data.html);

                  // Mark that Load More was clicked (store on wrapper element)
                  $tabWrap.data('loadMoreWasClicked', true);

                  // Update page number
                  $button.data('page', response.data.page).attr('data-page', response.data.page);

                  // If no more posts, hide button
                  if (!response.data.hasMore) {
                     loadMoreContainer.fadeOut(300, function () {
                        $(this).remove();
                     });
                  }
               } else {
                  // No more posts
                  loadMoreContainer.fadeOut(300, function () {
                     $(this).remove();
                  });
               }
            },
            error: function (xhr, status, error) {
               $text.text('Error loading posts');
            },
            complete: function () {
               // Hide spinner and show text
               $button.removeClass('loading');
               $spinner.hide();
               $text.show();
            }
         });
      });

      /**
       * ----------------------------------------
       * Table Of Content
       * ----------------------------------------
       */
      function drillcorpGenerateTOC(containerSelector, tocContainerSelector) {
         const $contentContainer = $(containerSelector);
         const $tocContainer = $(tocContainerSelector);

         if (!$contentContainer.length || !$tocContainer.length) return;

         // Track used IDs to prevent duplicates
         const usedIds = {};

         // Find h2 headings only
         const headings = $contentContainer.find("h2");

         if (!headings.length) return;

         let tocHTML = '<ul class="toc-widget">';

         headings.each(function (i) {
            const $heading = $(this);
            let title = $heading.text().trim();

            if (!title) return; // Skip empty headings

            let headingID = title
               .toLowerCase()
               .replace(/<\/?(strong|b|br)>/gi, "")
               .replace(/[^a-z0-9]+/g, "-")
               .replace(/^-+|-+$/g, "");

            // Prevent duplicate IDs
            if (usedIds[headingID]) {
               usedIds[headingID]++;
               headingID = headingID + "-" + usedIds[headingID];
            } else {
               usedIds[headingID] = 1;
            }

            if (!$heading.attr("id") || $heading.attr("id") === "") {
               $heading.attr("id", headingID);
            }

            tocHTML += `<li><a href="#${headingID}" class="arrow-link">${title}</a></li>`;
         });

         tocHTML += "</ul>";

         $tocContainer.html(tocHTML);
      }

      // Initialize TOC
      if ($(".toc-container").length) {
         if ($(".entry-content").length) {
            drillcorpGenerateTOC(".entry-content", ".toc-container");
         } else if ($(".blog-left-content-wrap").length) {
            drillcorpGenerateTOC(".blog-left-content-wrap", ".toc-container");
         } else if ($(".drillcorp-post-content").length) {
            drillcorpGenerateTOC(".drillcorp-post-content", ".toc-container");
         }
      }

      /*
       * TOC link active state
       */
      function isInViewport(element) {
         const elementTop = element.offset().top;
         const elementBottom = elementTop + element.outerHeight();

         const viewportTop = $(window).scrollTop() + 100; // Offset for better UX
         const viewportBottom = viewportTop + $(window).height() - 100;

         return elementBottom > viewportTop && elementTop < viewportBottom;
      }

      function updateActiveTocLink() {
         let current = "";

         $(".entry-content h2, .blog-left-content-wrap h2, .drillcorp-post-content h2").each(function () {
            if (isInViewport($(this))) {
               current = $(this).attr("id");
               return false; // stop loop on first visible heading
            }
         });

         $(".toc-widget a").removeClass("active");

         if (current) {
            $(".toc-widget a[href='#" + current + "']").addClass("active");
         }
      }

      updateActiveTocLink();

      $(window).on("scroll resize", function () {
         updateActiveTocLink();
      });

      /* ================================
       *  Contact Widget Fixed on Scroll
       =================================*/
      // Force hide immediately before anything runs
      const btn = document.querySelector('.fixed-contact-button');
      if (btn) {
         btn.style.opacity = '0';
         btn.style.visibility = 'hidden';
         btn.style.pointerEvents = 'none';
         btn.style.transition = 'opacity 0.3s ease, visibility 0.3s ease';
      }

      function initObserver() {
         const contactSection = document.querySelector('.fixed-contact-section');
         const contactButton = document.querySelector('.fixed-contact-button');

         if (!contactSection || !contactButton) {
            setTimeout(initObserver, 500);
            return;
         }

         contactButton.style.transition = 'opacity 0.3s ease, visibility 0.3s ease';

         function showButton() {
            contactButton.style.opacity = '1';
            contactButton.style.visibility = 'visible';
            contactButton.style.pointerEvents = 'auto';
         }

         function hideButton() {
            contactButton.style.opacity = '0';
            contactButton.style.visibility = 'hidden';
            contactButton.style.pointerEvents = 'none';
         }

         const observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
               if (entry.isIntersecting) {
                  // Section is visible — hide fixed button
                  hideButton();
               } else {
                  // Section is out of view — check if we scrolled PAST it (below it)
                  const rect = contactSection.getBoundingClientRect();
                  if (rect.bottom < 0) {
                     // Scrolled past the section — show button
                     showButton();
                  } else {
                     // Section is below viewport (not yet reached) — hide button
                     hideButton();
                  }
               }
            });
         }, { threshold: 0 });

         observer.observe(contactSection);
      }

      if (document.readyState === 'loading') {
         document.addEventListener('DOMContentLoaded', initObserver);
      } else {
         initObserver();
      }



      /* ========================
       *  Contact Info Toggle
       =========================*/
      $(document).on('click', '.contact-us-link', function (e) {
         e.preventDefault();
         e.stopPropagation();

         const $link = $(this);
         const $widget = $link.closest('.contact-information');
         const $wrapper = $widget.find('.contact-information-wrapper');
         const isFixed = $widget.hasClass('contact-widget-fixed');

         if ($wrapper.is(':visible')) {
            // Step 1: Hide the wrapper
            $wrapper.slideUp(400, function () {
               // Step 2: Smoothly shrink button to natural width
               $link.find('svg, i').css('transform', 'rotate(0deg)');

               const expandedWidth = $link.outerWidth();
               $link.css('width', '');
               const naturalWidth = $link.outerWidth();
               $link.css('width', expandedWidth + 'px');

               // Use CSS transition for smooth animation
               $link.css('transition', 'width 0.4s cubic-bezier(0.4, 0, 0.2, 1)');

               requestAnimationFrame(function () {
                  requestAnimationFrame(function () {
                     $link.css('width', naturalWidth + 'px');
                  });
               });

               // Cleanup
               setTimeout(function () {
                  $link.css({ width: '', transition: '' });
               }, 500);
            });
         } else {
            // Get target width from wrapper (temporarily measure without showing)
            $wrapper.css({ visibility: 'hidden', display: 'block' });
            const targetWidth = $wrapper.outerWidth();
            $wrapper.hide().css('visibility', '');

            // Capture current width as starting point
            const startWidth = $link.outerWidth();
            $link.css('width', startWidth + 'px');

            // Step 1: Expand button to match wrapper width with smooth transition
            $link.css('transition', 'width 0.4s cubic-bezier(0.4, 0, 0.2, 1)');

            requestAnimationFrame(function () {
               requestAnimationFrame(function () {
                  $link.css('width', targetWidth + 'px');
               });
            });

            // Step 2: After button reaches full width, reveal the card
            setTimeout(function () {
               $link.css('transition', '');
               $wrapper.slideDown(400);
            }, 450);

            $link.find('svg, i').css('transform', 'rotate(180deg)');
         }

         // If widget is fixed, the right anchor is already set
         // Width changes via animation will naturally expand/contract leftward
      });

      // Initially hide the contact information wrapper
      $('.contact-information-wrapper').hide();



      /* =================================
       *  fixed button show/hide on scroll
       ==================================*/
      
      // Single page hero area observer - show fixed button after crossing hero (only on mobile/tablet)
      if (document.querySelector('.blog-details-hero-area') && window.innerWidth <= 991) {
         const heroArea = document.querySelector('.blog-details-hero-area');
         const fixedButton = document.querySelector('.single-post .fixed-contact-button');
         
         if (heroArea && fixedButton) {
            // Initially hide the button
            fixedButton.style.opacity = '0';
            fixedButton.style.visibility = 'hidden';
            fixedButton.style.pointerEvents = 'none';
            fixedButton.style.transition = 'opacity 0.3s ease, visibility 0.3s ease';
            
            const heroObserver = new IntersectionObserver(function (entries) {
               entries.forEach(function (entry) {
                  if (entry.isIntersecting) {
                     // Hero area is visible - hide button
                     fixedButton.style.opacity = '0';
                     fixedButton.style.visibility = 'hidden';
                     fixedButton.style.pointerEvents = 'none';
                  } else {
                     // Hero area is not visible (scrolled past) - show button
                     fixedButton.style.opacity = '1';
                     fixedButton.style.visibility = 'visible';
                     fixedButton.style.pointerEvents = 'auto';
                  }
               });
            }, { threshold: 0 });
            
            heroObserver.observe(heroArea);
            
            // Check initial state - if hero is not in view on page load, show button immediately
            const initialRect = heroArea.getBoundingClientRect();
            if (initialRect.bottom < 0) {
               fixedButton.style.opacity = '1';
               fixedButton.style.visibility = 'visible';
               fixedButton.style.pointerEvents = 'auto';
            }
         }
      }
     

   });

})(jQuery);
