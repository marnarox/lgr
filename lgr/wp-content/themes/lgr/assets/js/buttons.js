(() => {
  const selector = '.wp-block-button:is(.is-style-ripple-charcoal, .is-style-ripple-rose, .is-style-ripple-vert, .is-style-ripple-brun) > .wp-block-button__link, .btn-ripple';
  const desktop = window.matchMedia('(min-width: 600px) and (hover: hover) and (pointer: fine)');
  const setOrigin = (event) => {
    if (!desktop.matches || event.pointerType !== 'mouse') return;
    const button = event.target.closest(selector);
    if (!button || (event.relatedTarget instanceof Node && button.contains(event.relatedTarget))) return;
    const rect = button.getBoundingClientRect();
    // Offset by the border so the origin matches the pointer inside the padding box.
    button.style.setProperty('--x', `${event.clientX - rect.left - button.clientLeft}px`);
    button.style.setProperty('--y', `${event.clientY - rect.top - button.clientTop}px`);
    // Covers even the opposite corner when entering at an edge.
    button.style.setProperty('--ripple-size', `${2 * Math.hypot(rect.width, rect.height)}px`);
  };
  document.addEventListener('pointerover', setOrigin);
  document.addEventListener('pointerout', setOrigin);
})();
