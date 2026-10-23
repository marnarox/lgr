(() => {
  const desktopHover = matchMedia('(min-width: 600px) and (hover: hover) and (pointer: fine)');
  document.querySelectorAll('.lgr-catalogue-card').forEach(card => {
    const details = card.querySelector('details');
    const name = card.querySelector('.lgr-product-name');
    if (name) {
      const measureName = () => {
        card.style.setProperty('--product-name-height', `${name.offsetHeight}px`);
        const panel = card.querySelector('.lgr-product-panel');
        if (!panel) return;
        const style = getComputedStyle(panel);
        const top = parseFloat(style.paddingTop) || 0;
        const bottom = parseFloat(style.paddingBottom) || 0;
        card.style.setProperty('--product-label-height', `${name.offsetHeight + top + bottom}px`);
        card.style.setProperty('--product-label-bottom', `${bottom}px`);
        // The panel animates its height; measure against the stable card so text
        // is not repeatedly relaid out inside a growing scroll container.
        card.style.setProperty('--product-ingredients-max-height', `${Math.max(0, card.clientHeight - name.offsetHeight - 84)}px`);
      };
      const observer = new ResizeObserver(measureName);
      observer.observe(name);
      observer.observe(card);
      measureName();
    }
    if (!details) return;
    let closeTimer;
    const open = () => {
      clearTimeout(closeTimer);
      if (desktopHover.matches) details.open = true;
    };
    const close = () => {
      clearTimeout(closeTimer);
      if (!desktopHover.matches) return;
      closeTimer = setTimeout(() => {
        if (!card.matches(':hover') && !card.contains(document.activeElement)) details.open = false;
      }, matchMedia('(prefers-reduced-motion: reduce)').matches ? 0 : 240);
    };
    card.addEventListener('pointerenter', open);
    card.addEventListener('pointerleave', close);
    card.addEventListener('focusin', open);
    card.addEventListener('focusout', event => { if (!card.contains(event.relatedTarget)) close(); });
  });
})();
