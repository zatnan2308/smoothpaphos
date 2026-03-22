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

  /* ══════════════════════════════════════════
     BOOKING FORM — multi-step (AJAX via wp_mail)
  ══════════════════════════════════════════ */
  var bForm = document.getElementById('booking-form');

  if (bForm && typeof smoothBooking !== 'undefined') {

    /* ── DOM refs ── */
    var bProgressSteps = bForm.querySelectorAll('.bf-progress-step');
    var bProgressLines = bForm.querySelectorAll('.bf-progress-line');
    var bSteps         = bForm.querySelectorAll('.bf-step');
    var bCatBtns       = bForm.querySelectorAll('.bf-cat');
    var bPanels        = bForm.querySelectorAll('.bf-panel');
    var bDateInput     = bForm.querySelector('#bf-date-input');
    var bNameInput     = bForm.querySelector('#bf-name');
    var bPhoneInput    = bForm.querySelector('#bf-phone');
    var bEmailInput    = bForm.querySelector('#bf-email');
    var bNotesInput    = bForm.querySelector('#bf-notes');
    var bErrorMsg      = bForm.querySelector('#bf-error-msg');
    var bProgressBar   = bForm.querySelector('.bf-progress');
    var bSuccessEl     = bForm.querySelector('.bf-success');
    var bCurrentStep   = 1;

    /* ── Update progress indicator ── */
    function bUpdateProgress(step) {
      bProgressSteps.forEach(function (el, i) {
        var s = i + 1;
        el.classList.toggle('is-active', s === step);
        el.classList.toggle('is-done',   s < step);
      });
      bProgressLines.forEach(function (el, i) {
        el.classList.toggle('is-done', (i + 1) < step);
      });
    }

    /* ── Show step ── */
    function bShowStep(step) {
      bSteps.forEach(function (el) {
        el.classList.toggle('is-active', parseInt(el.dataset.step, 10) === step);
      });
      bUpdateProgress(step);
      bCurrentStep = step;
    }

    /* ── Count total checked services ── */
    function bCheckedCount() {
      return bForm.querySelectorAll('input[type="checkbox"]:checked').length;
    }

    /* ── Refresh category badges + step-1 Continue button ── */
    function bRefreshBadges() {
      /* Read slugs dynamically from badge elements — works with any ACF-driven category list */
      var cats = Array.from( bForm.querySelectorAll('[data-badge]') ).map(function (el) {
        return el.dataset.badge;
      });
      cats.forEach(function (cat) {
        var count = bForm.querySelectorAll('input[data-cat="' + cat + '"]:checked').length;
        var badge = bForm.querySelector('[data-badge="' + cat + '"]');
        if (badge) {
          badge.textContent = count > 0 ? count : '';
          badge.classList.toggle('has-count', count > 0);
        }
      });

      var hint  = bForm.querySelector('.bf-select-hint');
      var s1btn = bForm.querySelector('.bf-next[data-next="2"]');
      var total = bCheckedCount();

      if (s1btn) s1btn.disabled = total === 0;
      if (hint)  hint.textContent = total > 0
        ? 'Selected: ' + total + ' service' + (total > 1 ? 's' : '')
        : 'Select services';
    }

    /* ── Checkbox changes ── */
    bForm.addEventListener('change', function (e) {
      if (e.target && e.target.type === 'checkbox') {
        var svcLabel = e.target.closest('.bf-svc');
        if (svcLabel) svcLabel.classList.toggle('is-checked', e.target.checked);
        bRefreshBadges();
      }
    });

    /* ── Category tab click ── */
    bCatBtns.forEach(function (btn) {
      btn.addEventListener('click', function () {
        var cat = this.dataset.cat;
        bCatBtns.forEach(function (b) { b.classList.remove('is-active'); });
        bPanels.forEach(function  (p) { p.classList.remove('is-active'); });
        this.classList.add('is-active');
        var panel = bForm.querySelector('[data-panel="' + cat + '"]');
        if (panel) panel.classList.add('is-active');
      });
    });

    /* ── Date input → enable step-2 Continue ── */
    if (bDateInput) {
      bDateInput.addEventListener('change', function () {
        var s2btn = bForm.querySelector('.bf-next[data-next="3"]');
        if (s2btn) s2btn.disabled = !this.value;
      });
      bDateInput.addEventListener('input', function () {
        var s2btn = bForm.querySelector('.bf-next[data-next="3"]');
        if (s2btn) s2btn.disabled = !this.value;
      });
    }

    /* ── Next buttons ── */
    bForm.querySelectorAll('.bf-next').forEach(function (btn) {
      btn.addEventListener('click', function () {
        if (this.disabled) return;
        bShowStep(parseInt(this.dataset.next, 10));
      });
    });

    /* ── Back buttons ── */
    bForm.querySelectorAll('.bf-back').forEach(function (btn) {
      btn.addEventListener('click', function () {
        bShowStep(parseInt(this.dataset.back, 10));
      });
    });

    /* ── Error helpers ── */
    function bShowError(msg) {
      if (bErrorMsg) {
        bErrorMsg.textContent = msg;
        bErrorMsg.hidden = false;
        bErrorMsg.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
      }
    }
    function bHideError() {
      if (bErrorMsg) bErrorMsg.hidden = true;
    }

    /* ── Submit ── */
    var bSubmitBtn = bForm.querySelector('.bf-submit');
    if (bSubmitBtn) {
      bSubmitBtn.addEventListener('click', function () {

        var name  = bNameInput  ? bNameInput.value.trim()  : '';
        var phone = bPhoneInput ? bPhoneInput.value.trim() : '';
        var email = bEmailInput ? bEmailInput.value.trim() : '';
        var notes = bNotesInput ? bNotesInput.value.trim() : '';
        var date  = bDateInput  ? bDateInput.value         : '';

        /* Client-side validation */
        if (!name) {
          bShowError('Please enter your name.'); return;
        }
        if (!phone && !email) {
          bShowError('Please enter your phone number or email address.'); return;
        }

        bHideError();
        bSubmitBtn.disabled    = true;
        bSubmitBtn.textContent = 'Sending…';

        /* Collect selected services */
        var checked  = bForm.querySelectorAll('input[type="checkbox"]:checked');
        var services = [];
        checked.forEach(function (cb) { services.push(cb.value); });

        /* Build FormData */
        var fd = new FormData();
        fd.append('action', 'smooth_booking');
        fd.append('nonce',  smoothBooking.nonce);
        services.forEach(function (s) { fd.append('services[]', s); });
        fd.append('date',  date);
        fd.append('name',  name);
        fd.append('phone', phone);
        fd.append('email', email);
        fd.append('notes', notes);

        /* Send via Fetch API */
        fetch(smoothBooking.ajaxUrl, {
          method:      'POST',
          body:        fd,
          credentials: 'same-origin',
        })
        .then(function (r) { return r.json(); })
        .then(function (res) {
          if (res.success) {
            /* Hide progress + all steps, show success screen */
            if (bProgressBar) bProgressBar.style.display = 'none';
            bSteps.forEach(function (s) { s.classList.remove('is-active'); });
            if (bSuccessEl) bSuccessEl.hidden = false;
          } else {
            var msg = (res.data && res.data.message)
              ? res.data.message
              : 'Something went wrong. Please try again or contact us via WhatsApp.';
            bShowError(msg);
            bSubmitBtn.disabled    = false;
            bSubmitBtn.textContent = 'Confirm Booking';
          }
        })
        .catch(function () {
          bShowError('Network error. Please check your connection and try again.');
          bSubmitBtn.disabled    = false;
          bSubmitBtn.textContent = 'Confirm Booking';
        });
      });
    }

    /* Initialise badge state */
    bRefreshBadges();
  }

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
