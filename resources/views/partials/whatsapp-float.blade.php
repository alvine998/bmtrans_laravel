@php
  $waNumber = \App\Models\SiteSetting::getValue('contact.whatsapp', '6281234567890');
  $cleanNumber = preg_replace('/[^0-9]/', '', $waNumber);
  $msg = rawurlencode('Halo BMTrans, saya mau tanya penawaran pengiriman. Bisa dibantu?');
  $waLink = "https://wa.me/{$cleanNumber}?text={$msg}";
@endphp

<div id="wa-float" class="fixed bottom-5 right-5 md:bottom-7 md:right-7 z-[9999] flex items-center gap-3 pointer-events-none" style="isolation:isolate; transform: translateZ(0);">
  {{-- Label pill — shows on hover/desktop, hidden on very small --}}
  <div id="wa-label" class="pointer-events-auto hidden sm:flex items-center gap-2 bg-bm-black border border-white/10 rounded-full pl-4 pr-3 py-2 shadow-[0_8px_24px_rgba(0,0,0,0.5)] translate-x-3 opacity-0 will-change-transform">
    <span class="w-2 h-2 bg-[#25D366] rounded-full animate-pulse"></span>
    <span class="font-mono text-[10px] uppercase tracking-widest text-bm-gray-light leading-none hidden lg:inline">Dispatch 24/7 •</span>
    <span class="font-display font-bold uppercase text-[12px] tracking-wide text-bm-white whitespace-nowrap">Chat Admin — Balas &lt; 5 Menit</span>
    <span class="ml-1 w-6 h-6 bg-bm-yellow text-bm-black rounded-full flex items-center justify-center text-[12px] font-bold">!</span>
  </div>

  {{-- Button --}}
  <a href="{{ $waLink }}" target="_blank" rel="noopener noreferrer"
     aria-label="Chat WhatsApp PT Berkah Makmur Transport"
     class="wa-btn pointer-events-auto group relative w-14 h-14 md:w-[60px] md:h-[60px] rounded-full bg-bm-black border-2 border-bm-yellow flex items-center justify-center shadow-[0_12px_32px_rgba(0,0,0,0.45),0_0_0_6px_rgba(244,196,48,0.12)] hover:shadow-[0_16px_40px_rgba(0,0,0,0.6),0_0_0_8px_rgba(244,196,48,0.2)] hover:border-white hover:-translate-y-0.5 transition-all duration-300">
    {{-- hazard tick ring --}}
    <span class="absolute -inset-2 rounded-full opacity-60 group-hover:opacity-100 transition-opacity"
          style="background: repeating-conic-gradient(from 0deg, #F4C430 0 8deg, #0B0B0C 8deg 16deg); -webkit-mask: radial-gradient(circle, transparent 30px, black 31px 36px, transparent 37px); mask: radial-gradient(circle, transparent 30px, black 31px 36px, transparent 37px);"></span>

    {{-- ping --}}
    <span class="absolute inset-0 rounded-full border border-bm-yellow/40 animate-ping [animation-duration:2.5s]"></span>
    <span class="absolute -top-1 -right-1 w-3 h-3 bg-bm-red border-2 border-bm-black rounded-full animate-pulse"></span>

    {{-- WhatsApp icon — self-hosted SVG, no external lib --}}
    <svg class="relative w-7 h-7 text-bm-yellow group-hover:text-white transition-colors" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
      <path d="M12 0C5.373 0 0 5.007 0 11.18c0 2.064.602 4.065 1.74 5.798L0 24l7.29-1.908a11.54 11.54 0 0 0 4.71.988h.001c6.627 0 12-5.007 12-11.18C24 5.007 18.627 0 12 0Zm0 20.327a9.18 9.18 0 0 1-4.688-1.276l-.337-.2-4.323 1.13 1.154-4.202-.22-.345a9.18 9.18 0 0 1-1.413-4.954c0-5.054 4.409-9.166 9.828-9.166 2.624 0 5.091.956 6.947 2.691a8.974 8.974 0 0 1 2.88 6.476c0 5.054-4.408 9.146-9.828 9.146Zm5.39-6.86c-.295-.148-1.748-.863-2.02-.961-.272-.1-.47-.148-.669.148-.197.295-.77.962-.943 1.16-.173.196-.347.222-.641.073-.296-.147-1.248-.46-2.376-1.467-.878-.783-1.47-1.75-1.642-2.045-.173-.296-.018-.455.13-.603.133-.132.296-.346.443-.52.148-.173.197-.296.296-.493.098-.197.05-.37-.025-.518-.074-.147-.669-1.611-.916-2.206-.241-.58-.486-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.37s-1.04 1.016-1.04 2.48 1.065 2.876 1.213 3.074c.148.197 2.095 3.2 5.076 4.487.71.306 1.263.49 1.695.626.712.227 1.36.195 1.872.118.571-.085 1.748-.714 1.994-1.405.247-.691.247-1.283.173-1.405-.074-.122-.272-.197-.567-.345Z"/>
    </svg>
  </a>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
  const float = document.getElementById('wa-float');
  const label = document.getElementById('wa-label');
  if (!float || !label) return;

  const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // Entrance animation — industrial reveal
  if (!reduced && typeof gsap !== 'undefined') {
    gsap.set(float, { autoAlpha: 0 });
    gsap.to(float, { autoAlpha: 1, duration: 0.4, ease: 'power2.out', delay: 1.2 });
    gsap.fromTo(label, { x: 20, autoAlpha: 0 }, { x: 0, autoAlpha: 1, duration: 0.6, ease: 'power3.out', delay: 1.6 });
    gsap.fromTo(float.querySelector('.wa-btn'), { scale: 0.8, rotate: -10 }, { scale: 1, rotate: 0, duration: 0.7, ease: 'back.out(1.8)', delay: 1.2 });
  } else {
    float.style.opacity = '1';
    label.classList.remove('translate-x-3','opacity-0');
  }

  // Desktop: show label after 2.5s, hide on scroll down a bit then re-show on idle
  let idleTimer;
  const showLabel = () => { if(window.innerWidth >= 640){ label.classList.remove('translate-x-3','opacity-0'); label.classList.add('translate-x-0','opacity-100','transition-all','duration-300'); } };
  const hideLabel = () => { label.classList.add('translate-x-3','opacity-0'); };

  if (!reduced) setTimeout(showLabel, 2800);

  // Previously hid on bg-bm-red CTA — that caused disappearance under Artikel/CTA section.
  // Keep visible always; no IntersectionObserver hiding.

  // Dismiss label on click of label itself (close)
  float.addEventListener('click', (e) => {
    if (e.target.closest('#wa-label') && !e.target.closest('a')) {
      hideLabel();
      e.preventDefault();
    }
  });

  // Re-show label when user idle 4s on desktop
  if (!reduced) {
    ['mousemove','scroll','keydown'].forEach(ev => {
      window.addEventListener(ev, () => {
        clearTimeout(idleTimer);
        idleTimer = setTimeout(() => { if(window.innerWidth >= 640) showLabel(); }, 4000);
      }, { passive: true });
    });
  }
});
</script>
@endpush
