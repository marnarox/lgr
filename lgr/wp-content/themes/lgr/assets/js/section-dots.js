(() => {
  if (document.body.classList.contains('wp-admin')) return;
  document.querySelectorAll('.lgr-section-dots').forEach(nav => {
    const items = Array.from(nav.querySelectorAll('a[href*="#"]')).map(link => {
      let section;
      try { section = document.getElementById(decodeURIComponent(new URL(link.href).hash.slice(1))); } catch { return null; }
      return section ? { link, section } : null;
    }).filter(Boolean);
    if (!items.length) return;
    let frame = 0;
    const update = () => {
      frame = 0;
      const line = innerHeight * 0.35;
      const active = items.find(({ section }) => {
        const rect = section.getBoundingClientRect();
        return rect.top <= line && rect.bottom > line;
      });
      items.forEach(item => {
        if (item === active) item.link.setAttribute('aria-current', 'location');
        else item.link.removeAttribute('aria-current');
      });
    };
    const schedule = () => { if (!frame) frame = requestAnimationFrame(update); };
    addEventListener('scroll', schedule, { passive: true });
    addEventListener('resize', schedule);
    addEventListener('pageshow', schedule);
    update();
  });
})();
