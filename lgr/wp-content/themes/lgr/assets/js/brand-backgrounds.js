(() => {
  const motion = matchMedia('(prefers-reduced-motion: no-preference)');
  if (!motion.matches) return;
  const artworks = Array.from(document.querySelectorAll('.lgr-brand-artwork'));
  const reveal = element => {
    element.classList.remove('lgr-brand-bg-pending');
    element.classList.add('lgr-brand-bg-visible');
  };
  const observer = new IntersectionObserver(entries => {
    entries.filter(entry => entry.isIntersecting)
      .sort((a, b) => a.boundingClientRect.left - b.boundingClientRect.left)
      .forEach((entry, index) => {
        entry.target.style.setProperty('--brand-bg-delay', `${index * 120}ms`);
        reveal(entry.target); observer.unobserve(entry.target);
      });
  }, { threshold: 0.15 });
  artworks.forEach(element => { element.classList.add('lgr-brand-bg-pending'); observer.observe(element); });
  motion.addEventListener('change', () => {
    if (!motion.matches) { observer.disconnect(); artworks.forEach(reveal); }
  });
})();
