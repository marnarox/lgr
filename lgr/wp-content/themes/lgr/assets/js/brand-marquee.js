/* Bandeau infini : garder deux groupes identiques, même si le contenu enregistré
 * ne contient qu’une seule série. La copie est purement visuelle et ne se sauvegarde
 * pas dans Gutenberg ; modifier le premier groupe reste la source de référence.
 */
(() => {
  document.querySelectorAll('.lgr-brand-marquee .brand-marquee-track').forEach(track => {
    const groups = [...track.children].filter(child => child.classList.contains('brand-marquee-group'));
    const source = groups[0];
    if (!source) return;

    // Une copie exacte garantit le raccord de translateX(-50%), quelle que soit
    // la largeur de l’écran. Le min-width CSS couvre au moins un viewport.
    groups.slice(1).forEach(group => group.remove());
    const copy = source.cloneNode(true);
    copy.setAttribute('aria-hidden', 'true');
    // Éviter de dupliquer d’éventuels identifiants ajoutés pendant l’édition.
    copy.removeAttribute('id');
    copy.querySelectorAll('[id]').forEach(element => element.removeAttribute('id'));
    track.append(copy);
  });
})();
