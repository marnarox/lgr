(() => {
  if (document.body.classList.contains('wp-admin')) return;
  const motion = matchMedia('(prefers-reduced-motion: no-preference)');
  const pending = new Set();
  const completed = new WeakSet();
  let frame = 0;

  const reveal = (element, delay = 0) => {
    pending.delete(element);
    completed.add(element);
    element.style.setProperty('--lgr-reveal-delay', `${delay}ms`);
    element.classList.remove('lgr-reveal-pending');
    element.classList.add('lgr-reveal-visible');
  };
  const check = () => {
    frame = 0;
    // Read layout before changing classes. Pending cards are translated by 32px.
    const eligible = Array.from(pending).filter(element => element.getClientRects().length)
      .map(element => {
        const rect = element.getBoundingClientRect();
        return { element, top: rect.top - 32, left: rect.left, bottom: rect.bottom - 32 };
      }).filter(item => item.top < innerHeight * 0.9)
      .sort((a, b) => Math.abs(a.top - b.top) > 2 ? a.top - b.top : a.left - b.left);
    let index = 0;
    for (const item of eligible) {
      // Content above a restored scroll position needs no offscreen cascade.
      reveal(item.element, item.bottom <= 0 ? 0 : index++ * 80);
    }
  };
  const schedule = () => { if (!frame && pending.size) frame = requestAnimationFrame(check); };
  const setup = () => {
    if (!motion.matches) {
      for (const element of pending) reveal(element);
      return;
    }
    const targets = new Set(document.querySelectorAll('.lgr-product-grid > .wp-block-image, .lgr-catalogue-card, .lgr-range-header .wp-block-heading, .lgr-range-header p'));
    document.querySelectorAll('.lgr-products section').forEach(section => {
      // Native heading/paragraph blocks and the brand subtitle. Future format
      // numbers can use lgr-range-format in Gutenberg's Additional CSS classes.
      section.querySelectorAll(':scope > .wp-block-heading, :scope > p, :scope > .lgr-brand-subtitle, :scope > .lgr-range-header > *, :scope > .lgr-range-format')
        .forEach(element => targets.add(element));
    });
    for (const element of targets) {
      if (completed.has(element) || pending.has(element)) continue;
      pending.add(element);
      element.classList.add('lgr-reveal-pending');
    }
    schedule();
  };
  addEventListener('scroll', schedule, { passive: true });
  addEventListener('resize', schedule, { passive: true });
  addEventListener('pageshow', schedule);
  document.addEventListener('focusin', event => {
    for (const element of pending) if (element.contains(event.target)) reveal(element);
  });
  motion.addEventListener('change', setup);
  setup();
  addEventListener('load', schedule, { once: true });
})();
