/**
 * Smooth Studio — Main JS
 * Navbar scroll, mobile menu, FAQ accordion
 */
(function () {
  'use strict';

  /* --- Navbar scroll effect --- */
  var navbar = document.querySelector('.navbar');
  if (navbar) {
    var onScroll = function () {
      navbar.classList.toggle('scrolled', window.scrollY > 20);
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  /* --- Mobile menu --- */
  var overlay = document.querySelector('.mobile-overlay');
  var menuOpen = document.querySelector('.btn-menu');
  var menuClose = document.querySelector('.mobile-close');

  function openMenu() {
    if (!overlay) return;
    overlay.classList.add('active');
    overlay.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
    // Анимация гамбургера
    if (menuOpen) menuOpen.classList.add('open');
    // Перемещаем фокус на первую ссылку меню
    var firstLink = overlay.querySelector('.mobile-nav a');
    if (firstLink) firstLink.focus();
  }

  function closeMenu() {
    if (!overlay) return;
    overlay.classList.remove('active');
    overlay.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
    // Анимация гамбургера
    if (menuOpen) menuOpen.classList.remove('open');
    // Возвращаем фокус на кнопку открытия меню
    if (menuOpen) menuOpen.focus();
  }

  if (menuOpen) menuOpen.addEventListener('click', openMenu);
  if (menuClose) menuClose.addEventListener('click', closeMenu);
  if (overlay) {
    overlay.addEventListener('click', function (e) {
      if (e.target === overlay) closeMenu();
    });
  }

  // Close mobile menu on link click
  document.querySelectorAll('.mobile-nav a').forEach(function (link) {
    link.addEventListener('click', closeMenu);
  });

  // Close mobile menu on Escape key
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && overlay && overlay.classList.contains('active')) {
      closeMenu();
    }
  });

  // Close mobile menu on window resize past mobile breakpoint
  var resizeTimer;
  window.addEventListener('resize', function () {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(function () {
      if (window.innerWidth >= 768 && overlay && overlay.classList.contains('active')) {
        closeMenu();
      }
    }, 300);
  });

  /* --- FAQ Accordion --- */
  var prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  var faqItems = document.querySelectorAll('.faq-item');
  faqItems.forEach(function (item) {
    var question = item.querySelector('.faq-question');
    var answer = item.querySelector('.faq-answer');

    function toggleFaq(el, open) {
      var q = el.querySelector('.faq-question');
      var a = el.querySelector('.faq-answer');
      el.classList.toggle('active', open);
      if (q) q.setAttribute('aria-expanded', open ? 'true' : 'false');
      if (a) a.setAttribute('aria-hidden', open ? 'false' : 'true');
    }

    item.addEventListener('click', function () {
      var wasActive = this.classList.contains('active');
      // Закрываем все элементы
      faqItems.forEach(function (el) {
        toggleFaq(el, false);
      });
      // Открываем кликнутый если он был закрыт
      if (!wasActive) {
        toggleFaq(this, true);
        // Убираем анимацию если пользователь предпочитает reduced motion
        if (prefersReducedMotion && answer) {
          answer.style.transition = 'none';
        }
      }
    });

    // Поддержка клавиатуры: Enter и Space на role=button
    if (question) {
      question.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' || e.key === ' ') {
          e.preventDefault();
          item.click();
        }
      });
    }
  });

  /* --- Smooth scroll for anchor links --- */
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
})();
