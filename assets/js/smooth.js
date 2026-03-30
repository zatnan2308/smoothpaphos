/**
 * Smooth Studio — Main JS
 * Hero slider, mobile menu, FAQ accordion, smooth scroll
 */
(function () {
  'use strict';

  /* ══════════════════════════════════════════
     HERO SLIDER
  ══════════════════════════════════════════ */
  var heroSlider = document.querySelector('.hero-slider');
  if (heroSlider) {
    var slides   = heroSlider.querySelectorAll('.slide');
    var pagDots  = heroSlider.querySelectorAll('.pag-dot');
    var prevBtn  = heroSlider.querySelector('.slider-prev');
    var nextBtn  = heroSlider.querySelector('.slider-next');
    var total    = slides.length;
    var current  = 0;
    var autoTimer = null;
    var AUTO_MS  = 5500;

    function goTo(idx) {
      idx = ((idx % total) + total) % total;
      if (idx === current) return;

      slides[current].classList.remove('is-active');
      slides[current].setAttribute('aria-hidden', 'true');
      if (pagDots[current]) {
        pagDots[current].classList.remove('is-active');
        pagDots[current].setAttribute('aria-selected', 'false');
      }

      current = idx;
      slides[current].classList.add('is-active');
      slides[current].setAttribute('aria-hidden', 'false');
      if (pagDots[current]) {
        pagDots[current].classList.add('is-active');
        pagDots[current].setAttribute('aria-selected', 'true');
      }
    }

    function startAuto() {
      clearInterval(autoTimer);
      if (total > 1) autoTimer = setInterval(function () { goTo(current + 1); }, AUTO_MS);
    }

    if (prevBtn) prevBtn.addEventListener('click', function () { goTo(current - 1); startAuto(); });
    if (nextBtn) nextBtn.addEventListener('click', function () { goTo(current + 1); startAuto(); });

    pagDots.forEach(function (dot, i) {
      dot.addEventListener('click', function () { goTo(i); startAuto(); });
    });

    /* Touch / swipe */
    var touchX = 0;
    heroSlider.addEventListener('touchstart', function (e) {
      touchX = e.changedTouches[0].clientX;
    }, { passive: true });
    heroSlider.addEventListener('touchend', function (e) {
      var dx = e.changedTouches[0].clientX - touchX;
      if (Math.abs(dx) > 48) { goTo(dx < 0 ? current + 1 : current - 1); startAuto(); }
    }, { passive: true });

    /* Keyboard */
    heroSlider.setAttribute('tabindex', '0');
    heroSlider.addEventListener('keydown', function (e) {
      if (e.key === 'ArrowLeft')  { goTo(current - 1); startAuto(); }
      if (e.key === 'ArrowRight') { goTo(current + 1); startAuto(); }
    });

    startAuto();
  }

  /* ══════════════════════════════════════════
     NAVBAR SCROLL — toggle .scrolled class
  ══════════════════════════════════════════ */
  var navbar = document.querySelector('.navbar');
  if (navbar) {
    function onScroll() {
      navbar.classList.toggle('scrolled', window.scrollY > 50);
    }
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll(); // apply on load in case page is already scrolled
  }

  /* ══════════════════════════════════════════
     MOBILE MENU
  ══════════════════════════════════════════ */
  var overlay   = document.querySelector('.mobile-overlay');
  var menuOpen  = document.querySelector('.navbar-burger');
  var menuClose = document.querySelector('.mobile-close');

  function openMenu() {
    if (!overlay) return;
    overlay.classList.add('active');
    overlay.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
    if (menuOpen) menuOpen.setAttribute('aria-expanded', 'true');
    var firstLink = overlay.querySelector('.mobile-nav a');
    if (firstLink) firstLink.focus();
  }

  function closeMenu() {
    if (!overlay) return;
    overlay.classList.remove('active');
    overlay.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
    if (menuOpen) menuOpen.setAttribute('aria-expanded', 'false');
    if (menuOpen) menuOpen.focus();
  }

  if (menuOpen)  menuOpen.addEventListener('click', openMenu);
  if (menuClose) menuClose.addEventListener('click', closeMenu);
  if (overlay) {
    overlay.addEventListener('click', function (e) {
      if (e.target === overlay) closeMenu();
    });
  }

  document.querySelectorAll('.mobile-nav a').forEach(function (link) {
    link.addEventListener('click', closeMenu);
  });

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && overlay && overlay.classList.contains('active')) closeMenu();
  });

  var resizeTimer;
  window.addEventListener('resize', function () {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(function () {
      /* Бургер скрывается при ≥ 1024px — закрываем меню именно при этом breakpoint,
         а не при 768px (планшет), иначе меню оставалось открытым при невидимом бургере */
      if (window.innerWidth >= 1024 && overlay && overlay.classList.contains('active')) closeMenu();
    }, 300);
  });

  /* ══════════════════════════════════════════
     FAQ ACCORDION
  ══════════════════════════════════════════ */
  var prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var faqItems = document.querySelectorAll('.faq-item');

  faqItems.forEach(function (item) {
    var question = item.querySelector('.faq-question');
    var answer   = item.querySelector('.faq-answer');

    function toggleFaq(el, open) {
      var q = el.querySelector('.faq-question');
      var a = el.querySelector('.faq-answer');
      el.classList.toggle('active', open);
      if (q) q.setAttribute('aria-expanded', open ? 'true' : 'false');
      if (a) a.setAttribute('aria-hidden',   open ? 'false' : 'true');
    }

    item.addEventListener('click', function () {
      var wasActive = this.classList.contains('active');
      faqItems.forEach(function (el) { toggleFaq(el, false); });
      if (!wasActive) {
        toggleFaq(this, true);
        if (prefersReducedMotion && answer) answer.style.transition = 'none';
      }
    });

    if (question) {
      question.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); item.click(); }
      });
    }
  });

  /* ══════════════════════════════════════════
     SMOOTH SCROLL — anchor links
  ══════════════════════════════════════════ */
  document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
    anchor.addEventListener('click', function (e) {
      var targetId = this.getAttribute('href');
      if (targetId === '#') return;
      var target = document.querySelector(targetId);
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });

  /* ══════════════════════════════════════════
     MEGA MENU — hover + touch/click
  ══════════════════════════════════════════ */
  var megaWrappers = document.querySelectorAll('.mega-wrapper');

  megaWrappers.forEach(function (wrapper) {
    var closeTimer;

    function openMega() {
      clearTimeout(closeTimer);
      /* Закрываем остальные мегаменю */
      megaWrappers.forEach(function (w) {
        if (w !== wrapper) w.classList.remove('is-open');
      });
      wrapper.classList.add('is-open');
    }

    function closeMega() {
      closeTimer = setTimeout(function () {
        wrapper.classList.remove('is-open');
      }, 180);
    }

    /* Ховер для десктопа */
    wrapper.addEventListener('mouseenter', openMega);
    wrapper.addEventListener('mouseleave', closeMega);

    /* Тап/клик для тачскрина: первый клик — открыть, второй — перейти */
    var trigger = wrapper.querySelector('.nav-link');
    if (trigger) {
      trigger.addEventListener('click', function (e) {
        if (!wrapper.classList.contains('is-open')) {
          e.preventDefault();
          openMega();
        }
        /* если уже открыто — дать браузеру перейти по ссылке */
      });
    }
  });

  /* Закрыть при клике вне мегаменю */
  document.addEventListener('click', function (e) {
    megaWrappers.forEach(function (wrapper) {
      if (!wrapper.contains(e.target)) {
        wrapper.classList.remove('is-open');
      }
    });
  });

  /* Закрыть по Escape */
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
      megaWrappers.forEach(function (w) { w.classList.remove('is-open'); });
    }
  });


})();

/* =========================================================================
   Scroll to Top
   ========================================================================= */
(function () {
  var btn = document.getElementById('js-scroll-top');
  if (!btn) return;

  function toggleBtn() {
    btn.classList.toggle('is-visible', window.scrollY > 400);
  }

  window.addEventListener('scroll', toggleBtn, { passive: true });
  toggleBtn(); /* run once on load */

  btn.addEventListener('click', function () {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
})();

/* =========================================================================
   OUR WORK — Modal + Lightbox
   ========================================================================= */
(function () {

  var modal      = document.getElementById('works-modal');
  var grid       = document.getElementById('works-grid');
  var modalTitle = document.getElementById('works-modal-title');
  var modalClose = modal ? modal.querySelector('.works-modal-close') : null;

  var lb         = document.getElementById('works-lb');
  var lbMedia    = document.getElementById('works-lb-media');
  var lbClose    = lb ? lb.querySelector('.works-lb-close') : null;
  var lbPrev     = lb ? lb.querySelector('.works-lb-prev')  : null;
  var lbNext     = lb ? lb.querySelector('.works-lb-next')  : null;

  /* { type: 'photo'|'video', url, alt } — все элементы галереи */
  var lbItems   = [];
  var lbCurrent = 0;

  if (!modal) return;

  /* ── Open modal ── */
  document.querySelectorAll('.svc-work-btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var catIdx = this.dataset.cat;
      var pool   = document.querySelector('.works-pool[data-cat="' + catIdx + '"]');
      if (!pool) return;

      /* Title */
      if (modalTitle) {
        modalTitle.textContent = pool.dataset.title + ' — Our Work';
      }

      /* Build lightbox index — ALL items (photos + videos) */
      lbItems = [];
      pool.querySelectorAll('.works-item').forEach(function (item) {
        if (item.dataset.type === 'video') {
          var vid = item.querySelector('video');
          lbItems.push({ type: 'video', url: vid ? vid.src : '', alt: '' });
        } else {
          var imgEl = item.querySelector('img');
          lbItems.push({
            type: 'photo',
            url:  item.dataset.full || (imgEl ? imgEl.src : ''),
            alt:  imgEl ? imgEl.alt : ''
          });
        }
      });

      /* Clone items into grid */
      if (grid) {
        grid.innerHTML = '';
        var itemIdx = 0;

        pool.querySelectorAll('.works-item').forEach(function (item) {
          var clone = item.cloneNode(true);
          var idx   = itemIdx++;

          if (clone.dataset.type === 'video') {
            var vid = clone.querySelector('video');
            /* Play preview thumbnail on hover */
            clone.addEventListener('mouseenter', function () { if (vid) vid.play(); });
            clone.addEventListener('mouseleave', function () {
              if (vid) { vid.pause(); vid.currentTime = 0; }
            });
          }

          /* All items open lightbox on click */
          clone.addEventListener('click', function () { openLb(idx); });

          grid.appendChild(clone);
        });
      }

      /* Open */
      modal.hidden = false;
      document.body.style.overflow = 'hidden';
    });
  });

  /* ── Close modal ── */
  function closeModal() {
    modal.hidden = true;
    document.body.style.overflow = '';
    if (grid) {
      grid.querySelectorAll('video').forEach(function (v) { v.pause(); });
    }
    closeLb();
  }

  if (modalClose) modalClose.addEventListener('click', closeModal);
  modal.addEventListener('click', function (e) {
    if (e.target === modal) closeModal();
  });

  /* ── Lightbox open ── */
  function openLb(idx) {
    if (!lb || !lbItems.length) return;
    lbCurrent = Math.max(0, Math.min(idx, lbItems.length - 1));
    renderLb();
    lb.hidden = false;
  }

  /* ── Lightbox render ── */
  function renderLb() {
    if (!lbMedia || !lbItems[lbCurrent]) return;

    /* Pause & release any previous video to free memory */
    var oldVid = lbMedia.querySelector('video');
    if (oldVid) { oldVid.pause(); oldVid.removeAttribute('src'); oldVid.load(); }

    var item = lbItems[lbCurrent];
    if (item.type === 'video') {
      lbMedia.innerHTML =
        '<video src="' + item.url + '" controls autoplay playsinline loop></video>';
    } else {
      lbMedia.innerHTML =
        '<img src="' + item.url + '" alt="' + (item.alt || '') + '">';
    }

    /* Counter badge */
    var counter = lb.querySelector('.works-lb-counter');
    if (!counter) {
      counter = document.createElement('span');
      counter.className = 'works-lb-counter';
      lb.appendChild(counter);
    }
    counter.textContent = (lbCurrent + 1) + ' / ' + lbItems.length;

    /* Nav arrows */
    var many = lbItems.length > 1;
    if (lbPrev) lbPrev.style.display = many ? '' : 'none';
    if (lbNext) lbNext.style.display = many ? '' : 'none';
    counter.style.display = many ? '' : 'none';
  }

  /* ── Lightbox close ── */
  function closeLb() {
    if (!lb || lb.hidden) return;
    lb.hidden = true;
    if (lbMedia) {
      var vid = lbMedia.querySelector('video');
      if (vid) { vid.pause(); vid.removeAttribute('src'); vid.load(); }
      lbMedia.innerHTML = '';
    }
  }

  if (lbClose) lbClose.addEventListener('click', closeLb);
  if (lb) lb.addEventListener('click', function (e) {
    if (e.target === lb) closeLb();
  });
  if (lbPrev) lbPrev.addEventListener('click', function () {
    lbCurrent = ((lbCurrent - 1) + lbItems.length) % lbItems.length;
    renderLb();
  });
  if (lbNext) lbNext.addEventListener('click', function () {
    lbCurrent = (lbCurrent + 1) % lbItems.length;
    renderLb();
  });

  /* ── Keyboard navigation ── */
  document.addEventListener('keydown', function (e) {
    if (lb && !lb.hidden) {
      if (e.key === 'Escape')     { closeLb(); return; }
      if (e.key === 'ArrowLeft')  { lbCurrent = ((lbCurrent - 1) + lbItems.length) % lbItems.length; renderLb(); }
      if (e.key === 'ArrowRight') { lbCurrent = (lbCurrent + 1) % lbItems.length; renderLb(); }
      return;
    }
    if (!modal.hidden && e.key === 'Escape') closeModal();
  });

  /* ── Touch swipe for lightbox ── */
  var lbTouchX = 0;
  if (lb) {
    lb.addEventListener('touchstart', function (e) {
      lbTouchX = e.changedTouches[0].clientX;
    }, { passive: true });
    lb.addEventListener('touchend', function (e) {
      var dx = e.changedTouches[0].clientX - lbTouchX;
      if (Math.abs(dx) > 48) {
        if (dx < 0) { lbCurrent = (lbCurrent + 1) % lbItems.length; }
        else        { lbCurrent = ((lbCurrent - 1) + lbItems.length) % lbItems.length; }
        renderLb();
      }
    }, { passive: true });
  }

})();
