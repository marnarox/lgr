(() => {
  const hero = document.querySelector('.lgr-hero');
  if (!hero) return;
  const motion = matchMedia('(prefers-reduced-motion: no-preference)');
  const desktop = matchMedia('(min-width: 1280px)');
  const finish = () => {
    hero.classList.add('hero-motion-done');
    hero.classList.remove('hero-motion-running');
  };
  const start = async () => {
    // Allow the browser to restore the previous scroll position before deciding.
    await new Promise(resolve => requestAnimationFrame(() => requestAnimationFrame(resolve)));
    if (!motion.matches || window.scrollY > 8 || location.hash) return finish();
    const image = hero.querySelector(desktop.matches ? '.hero-photo-portrait img' : '.hero-photo-horizontal img') || hero.querySelector('.hero-photo img');
    try { if (image) await image.decode(); } catch { /* Keep content available if the image fails. */ }
    if (!motion.matches || window.scrollY > 8) return finish();
    hero.classList.add('hero-motion-running');
    const onEnd = event => {
      if (event.target.matches('.hero-photo') && event.pseudoElement === '::before' && event.animationName.startsWith('lgr-hero-uncover-')) {
        hero.removeEventListener('animationend', onEnd);
        finish();
      }
    };
    hero.addEventListener('animationend', onEnd);
  };
  desktop.addEventListener('change', finish);
  motion.addEventListener('change', finish);
  window.addEventListener('pageshow', event => { if (event.persisted) finish(); });
  if (document.readyState === 'complete') start();
  else window.addEventListener('load', start, { once: true });
})();
