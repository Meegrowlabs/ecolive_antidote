/**
 * EcoLive WaterWise — client-side behaviour.
 *
 * - mobile menu toggle
 * - glass-nav shadow on scroll
 * - reading-progress bar on single posts
 * - scroll-reveal for marketing sections
 * - copy-link buttons on the single-post share row
 * - demo form handler (placeholder when Contact Form 7 is not wired up)
 */
(function () {
  'use strict';

  function ready(fn) {
    if (document.readyState !== 'loading') { fn(); return; }
    document.addEventListener('DOMContentLoaded', fn);
  }

  ready(function () {
    // Mobile menu
    var btn  = document.getElementById('mobile-menu-btn');
    var menu = document.getElementById('mobile-menu');
    if (btn && menu) {
      var setIcon = function (open) {
        var icon = btn.querySelector('.material-symbols-outlined');
        if (icon) { icon.textContent = open ? 'close' : 'menu'; }
      };
      btn.addEventListener('click', function () {
        var open = menu.classList.toggle('hidden') === false;
        setIcon(open);
      });
      menu.querySelectorAll('a').forEach(function (a) {
        a.addEventListener('click', function () {
          menu.classList.add('hidden');
          setIcon(false);
        });
      });
    }

    // Nav shadow + reading progress
    var nav = document.querySelector('nav');
    var bar = document.getElementById('reading-progress');
    function onScroll() {
      if (nav) { nav.classList.toggle('shadow-xl', window.scrollY > 50); }
      if (bar) {
        var h = document.documentElement;
        var max = h.scrollHeight - h.clientHeight;
        bar.style.width = (max > 0 ? (h.scrollTop / max) * 100 : 0) + '%';
      }
    }
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    // Scroll-reveal (only marks body so CSS hides elements when JS is present)
    var reveals = document.querySelectorAll('.reveal-on-scroll');
    if (reveals.length && 'IntersectionObserver' in window) {
      document.body.classList.add('js-reveal');
      var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            entry.target.classList.add('is-visible');
            io.unobserve(entry.target);
          }
        });
      }, { threshold: 0.12 });
      reveals.forEach(function (el) { io.observe(el); });
    }

    // Copy-link buttons
    document.querySelectorAll('[data-copy]').forEach(function (btn) {
      btn.addEventListener('click', function (e) {
        e.preventDefault();
        var url = btn.getAttribute('data-copy');
        if (!url || !navigator.clipboard) { return; }
        navigator.clipboard.writeText(url).then(function () {
          var icon = btn.querySelector('.material-symbols-outlined');
          if (icon) {
            var prev = icon.textContent;
            icon.textContent = 'check';
            setTimeout(function () { icon.textContent = prev; }, 1400);
          }
        });
      });
    });

    // Demo form fallback (no backend) — replaced by Contact Form 7 when configured
    document.querySelectorAll('form[data-demo-form]').forEach(function (form) {
      form.addEventListener('submit', function (event) {
        event.preventDefault();
        var status = form.querySelector("[role='status']");
        if (status) {
          status.textContent = 'Thank you. Connect this form to Contact Form 7 or your CRM to receive submissions.';
          status.classList.remove('hidden');
        }
        form.reset();
      });
    });
  });
})();
