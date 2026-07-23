/* BMTrans — Industrial Logistics - App Shell - Vanilla JS + GSAP + Lenis */

// Respect reduced motion
const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

// Lenis Smooth Scroll
let lenis = null;
if (!prefersReducedMotion && typeof Lenis !== 'undefined') {
  lenis = new Lenis({
    duration: 1.1,
    easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
    smoothWheel: true,
    touchMultiplier: 1.5,
  });

  function raf(time) {
    lenis.raf(time);
    requestAnimationFrame(raf);
  }
  requestAnimationFrame(raf);
}

// GSAP + ScrollTrigger integration
if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined' && !prefersReducedMotion) {
  gsap.registerPlugin(ScrollTrigger);
  if (lenis) {
    lenis.on('scroll', ScrollTrigger.update);
    gsap.ticker.add((time) => {
      lenis.raf(time * 1000);
    });
    gsap.ticker.lagSmoothing(0);
  }

  gsap.utils.toArray('.reveal').forEach((el) => {
    gsap.fromTo(el,
      { y: 60, opacity: 0 },
      {
        y: 0, opacity: 1, duration: 0.8, ease: 'power3.out',
        scrollTrigger: { trigger: el, start: 'top 85%', once: true }
      }
    );
  });

  gsap.utils.toArray('.reveal-clip').forEach((el) => {
    gsap.fromTo(el,
      { clipPath: 'inset(0 100% 0 0)' },
      {
        clipPath: 'inset(0 0% 0 0)', duration: 1.0, ease: 'power4.inOut',
        scrollTrigger: { trigger: el, start: 'top 80%', once: true }
      }
    );
  });

  gsap.utils.toArray('[data-parallax]').forEach((el) => {
    const speed = parseFloat(el.dataset.parallax) || 0.15;
    gsap.to(el, {
      yPercent: speed * -100,
      ease: 'none',
      scrollTrigger: {
        trigger: el.closest('.parallax-container') || el,
        start: 'top bottom',
        end: 'bottom top',
        scrub: true
      }
    });
  });

  gsap.utils.toArray('.stat-number').forEach((el) => {
    const target = parseInt(el.dataset.count || el.textContent, 10);
    if (!isNaN(target)) {
      const obj = { val: 0 };
      ScrollTrigger.create({
        trigger: el,
        start: 'top 85%',
        once: true,
        onEnter: () => {
          gsap.to(obj, {
            val: target,
            duration: 2,
            ease: 'power2.out',
            onUpdate: () => { el.textContent = Math.round(obj.val).toLocaleString('id-ID'); }
          });
        }
      });
    }
  });
}

// Nav + Dropdowns
document.addEventListener('DOMContentLoaded', () => {
  const navToggle = document.getElementById('nav-toggle');
  const navMenu = document.getElementById('nav-menu');

  const layananWrapper = document.getElementById('layanan-dropdown-wrapper');
  const layananToggle = document.getElementById('layanan-toggle');
  const layananMenu = document.getElementById('layanan-dropdown');
  const layananIcon = layananToggle ? layananToggle.querySelector('[data-dropdown-icon]') : null;

  function openLayanan() {
    if (!layananMenu || !layananToggle) return;
    layananMenu.classList.remove('hidden');
    // force reflow for transition
    void layananMenu.offsetWidth;
    layananMenu.classList.remove('opacity-0', 'translate-y-1');
    layananMenu.classList.add('opacity-100', 'translate-y-0');
    layananToggle.setAttribute('aria-expanded', 'true');
    if (layananIcon) layananIcon.style.transform = 'rotate(180deg)';
  }

  function closeLayanan() {
    if (!layananMenu || !layananToggle) return;
    layananMenu.classList.add('opacity-0', 'translate-y-1');
    layananMenu.classList.remove('opacity-100', 'translate-y-0');
    layananToggle.setAttribute('aria-expanded', 'false');
    if (layananIcon) layananIcon.style.transform = 'rotate(0deg)';
    setTimeout(() => {
      // only hide if still closed (not reopened in meantime)
      if (layananToggle.getAttribute('aria-expanded') === 'false') {
        layananMenu.classList.add('hidden');
      }
    }, 200);
  }

  function toggleLayanan() {
    if (!layananMenu) return;
    const isHidden = layananMenu.classList.contains('hidden') || layananMenu.classList.contains('opacity-0');
    if (isHidden) openLayanan();
    else closeLayanan();
  }

  if (layananToggle && layananMenu) {
    layananToggle.addEventListener('click', (e) => {
      e.stopPropagation();
      e.preventDefault();
      toggleLayanan();
    });

    // close when clicking a menu item (allow navigation)
    layananMenu.addEventListener('click', (e) => {
      const isLink = e.target.closest('a');
      if (isLink) closeLayanan();
    });
  }

  // Mobile layanan toggle
  const mobileLayananToggle = document.getElementById('mobile-layanan-toggle');
  const mobileLayananList = document.getElementById('mobile-layanan-list');
  if (mobileLayananToggle && mobileLayananList) {
    mobileLayananToggle.addEventListener('click', (e) => {
      e.stopPropagation();
      const expanded = mobileLayananToggle.getAttribute('aria-expanded') === 'true';
      mobileLayananToggle.setAttribute('aria-expanded', String(!expanded));
      mobileLayananToggle.textContent = expanded ? 'Buka' : 'Tutup';
      mobileLayananList.classList.toggle('hidden');
      mobileLayananList.classList.toggle('flex');
    });
  }

  // Mobile nav toggle
  if (navToggle && navMenu) {
    navToggle.addEventListener('click', (e) => {
      e.stopPropagation();
      const expanded = navToggle.getAttribute('aria-expanded') === 'true';
      navToggle.setAttribute('aria-expanded', String(!expanded));
      navMenu.classList.toggle('hidden');
      navMenu.classList.toggle('flex');
      document.body.classList.toggle('overflow-hidden', !expanded);
      // close dropdown when mobile menu toggles
      closeLayanan();
    });
  }

  // Global close handlers: click outside, ESC
  document.addEventListener('click', (e) => {
    // if click outside layanan wrapper, close
    if (layananWrapper && !layananWrapper.contains(e.target)) {
      closeLayanan();
    }
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      closeLayanan();
      // also close mobile menu on ESC
      if (navMenu && !navMenu.classList.contains('hidden')) {
        navMenu.classList.add('hidden');
        navMenu.classList.remove('flex');
        if (navToggle) navToggle.setAttribute('aria-expanded', 'false');
        document.body.classList.remove('overflow-hidden');
      }
      if (mobileLayananList && !mobileLayananList.classList.contains('hidden')) {
        mobileLayananList.classList.add('hidden');
        mobileLayananList.classList.remove('flex');
        if (mobileLayananToggle) {
          mobileLayananToggle.setAttribute('aria-expanded', 'false');
          mobileLayananToggle.textContent = 'Buka';
        }
      }
    }
  });

  // Keyboard: enter/space on toggle
  if (layananToggle) {
    layananToggle.addEventListener('keydown', (e) => {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        toggleLayanan();
      }
    });
  }

  // Copy year
  const y = document.getElementById('current-year');
  if (y) y.textContent = String(new Date().getFullYear());
});
