# Consignes du projet LGR

Consignes validées par Maxime le 12 octobre 2026. Elles s'appliquent aux
modifications du site WordPress LGR dans `lgr/`.

## Priorité : maintenance sans code dans le FSE

Le site sera maintenu par des personnes qui ne font pas de code. Le FSE et
Gutenberg sont leur interface de maintenance, pas un simple aperçu du frontend.
Avant de créer du CSS, du HTML ou un composant personnalisé, vérifier si les blocs
et réglages natifs WordPress couvrent le besoin et les utiliser en priorité.
Les textes, images, liens, couleurs, espacements et alignements destinés à être
maintenus doivent être modifiables dans l'éditeur sans toucher aux fichiers.
Le CSS complète les blocs pour les animations et contraintes techniques ; il ne
doit pas imposer ou écraser les réglages éditables de Gutenberg. Les valeurs de
design par défaut peuvent être fournies par theme.json, les styles de blocs et
les compositions natives, sans verrouiller la personnalisation.
Ne pas considérer une fonctionnalité terminée sur la seule base de sa présence
ou de sa validation dans l'éditeur : vérifier aussi que ses paramètres utiles
sont réellement éditables et que les changements sont conservés sur le site.
Une solution exigeant du code pour la maintenance courante doit être expliquée
à Maxime et validée avant son implémentation.

1. **Concevoir pour Gutenberg dès le départ.** Utiliser des blocs natifs pour
   les textes, images, boutons et groupes afin qu'ils restent facilement modifiables.
2. **Garder un rendu fidèle dans le FSE.** À largeur équivalente, respecter les
   proportions, couleurs, typographie et espacements du site public. Seules les
   animations et interactions qui gênent l'édition peuvent être désactivées.
3. **Adapter les styles au canevas de l'éditeur.** Tenir compte des wrappers
   Gutenberg et de la largeur disponible. Ne pas dépendre uniquement des classes
   du site public telles que `body.home`.
   Pour les sections, utiliser une classe de bloc commune au site et à l'éditeur,
   plutôt qu'un sélecteur basé uniquement sur l'ancre HTML : Gutenberg peut
   remplacer l'identifiant du bloc par son identifiant interne. Utiliser les
   réglages natifs de couleur et d'alignement quand ils couvrent le besoin.
4. **Respecter le HTML attendu par WordPress.** Ne pas ajouter manuellement
   d'attributs incompatibles avec la sauvegarde des blocs. Vérifier qu'aucun bloc
   ne signale de contenu invalide, avec le parseur de la version WordPress utilisée
   lorsque des blocs sont générés ou modifiés en code. Valider le contenu relu
   depuis la base après l'enregistrement, pas seulement la chaîne avant sauvegarde.
   Avec wp_update_post, passer le contenu sérialisé via wp_slash pour préserver
   les échappements JSON des commentaires de blocs.
5. **Vérifier le site et le véritable éditeur.** Un aperçu HTML séparé ne suffit
   pas. Contrôler le rendu public et Gutenberg/FSE avant d'annoncer la modification
   terminée. Si une vérification est impossible, préciser ce qui reste non vérifié
   et ne pas présenter un aperçu isolé comme une validation du FSE.
6. **Préserver les modifications de Maxime.** Inspecter les personnalisations
   enregistrées en base et sauvegarder le contenu concerné avant toute modification
   de structure. Ne pas écraser les personnalisations avec les fichiers du thème.
7. **Limiter le HTML personnalisé.** Le réserver aux besoins que les blocs natifs
   ne couvrent pas correctement. Expliquer à Maxime les conséquences sur l'édition
   avant de choisir cette approche.
8. **Distinguer l'interface de l'éditeur du contenu réel.** Vérifier notamment
   l'option « Afficher le modèle » avant de modifier le site pour corriger un
   élément propre à l'interface WordPress.

## Largeur des sections

Le contenu des sections est centré et limité à 1920 px par défaut. Utiliser le
réglage natif global `settings.layout.contentSize` de theme.json, et un groupe
intérieur en disposition contrainte pour les sections à fond pleine largeur.
La composition `lgr/section` fournit cette structure éditable pour les nouvelles
sections. Les fonds peuvent se prolonger au-delà de 1920 px avec un groupe
extérieur en alignement pleine largeur. Ne pas réintroduire une limite de
1080 px en CSS pour les sections non personnalisées.
Les marges intérieures horizontales par défaut sont de 16 px sous 600 px,
24 px de 600 à 1279 px, 100 px de 1280 à 2019 px, puis 0 dès 2020 px.
Utiliser le preset Gutenberg « Marge de section responsive » dans les réglages
natifs de padding des groupes. Le contenu reste limité à 1920 px et centré.
Le padding vertical des sections est de 24 px sur mobile, 32 px dès 600 px
et 40 px dès 1280 px, via le preset natif « Padding vertical de section ».
Ce padding concerne les grandes sections, pas les sous-sections des marques
dans « Nos produits ». La hero conserve les espacements de sa composition
spécifique, sans lui appliquer automatiquement ce preset.

## Environnement de travail

- Dépôt : `C:/Users/Maxime/Documents/lgr` ; thème : `lgr/wp-content/themes/lgr`.
- Docker Desktop et Docker Compose ; site local : `http://lgr.localhost/`.
- Respecter le périmètre demandé ; ne pas développer d'autres sections sans demande.
