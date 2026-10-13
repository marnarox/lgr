(() => {
  const desktopHover = matchMedia('(min-width: 600px) and (hover: hover) and (pointer: fine)');
  document.querySelectorAll('.lgr-catalogue-card').forEach(card => {
    const details = card.querySelector('details');
    const name = card.querySelector('.lgr-product-name');
    if (name) {
      const measureName = () => card.style.setProperty('--product-name-height', `${name.offsetHeight}px`);
      const observer = new ResizeObserver(measureName);
      observer.observe(name);
      measureName();
    }
    if (!details) return;
    card.addEventListener('pointerenter', () => { if (desktopHover.matches) details.open = true; });
    card.addEventListener('pointerleave', () => { if (desktopHover.matches && !card.contains(document.activeElement)) details.open = false; });
    card.addEventListener('focusin', () => { if (desktopHover.matches) details.open = true; });
    card.addEventListener('focusout', event => { if (desktopHover.matches && !card.contains(event.relatedTarget) && !card.matches(':hover')) details.open = false; });
  });
})();
