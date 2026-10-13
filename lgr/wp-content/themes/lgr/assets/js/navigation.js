(() => {
  const mobile = matchMedia('(max-width: 991px)');
  const reducedMotion = matchMedia('(prefers-reduced-motion: reduce)');
  let replaying = false;

  function closeAfterAnimation(menu, finish) {
    if (menu.classList.contains('is-closing')) return;
    menu.classList.add('is-closing');
    let done = false;
    const complete = () => {
      if (done) return;
      done = true;
      clearTimeout(timer);
      menu.removeEventListener('animationend', onEnd);
      replaying = true;
      try { finish(); } finally { replaying = false; }
      setTimeout(() => menu.classList.remove('is-closing'), 0);
    };
    const onEnd = (event) => {
      if (event.target === menu && event.animationName === 'lgr-menu-exit') complete();
    };
    menu.addEventListener('animationend', onEnd);
    const timer = setTimeout(complete, 400);
  }

  document.addEventListener('click', (event) => {
    if (replaying || !mobile.matches || reducedMotion.matches) return;
    const close = event.target.closest('.primary-nav .wp-block-navigation__responsive-container-close');
    const link = event.target.closest('.primary-nav .is-menu-open a[href]');
    const trigger = close || link;
    const menu = trigger?.closest('.wp-block-navigation__responsive-container.is-menu-open');
    if (!menu || event.ctrlKey || event.metaKey || event.shiftKey || event.altKey || event.button !== 0) return;
    event.preventDefault();
    event.stopImmediatePropagation();
    closeAfterAnimation(menu, () => {
      if (link) menu.querySelector('.wp-block-navigation__responsive-container-close')?.click();
      trigger.click();
    });
  }, true);

  document.addEventListener('keydown', (event) => {
    if (replaying || event.key !== 'Escape' || !mobile.matches || reducedMotion.matches) return;
    const menu = document.querySelector('.primary-nav .wp-block-navigation__responsive-container.is-menu-open');
    if (!menu) return;
    event.preventDefault();
    event.stopImmediatePropagation();
    closeAfterAnimation(menu, () => menu.querySelector('.wp-block-navigation__responsive-container-close')?.click());
  }, true);
})();