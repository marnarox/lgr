# Theme Les goûts retrouvés

Theme WordPress de blocs personnalise, dossier `lgr`, actif sur le site local.
Le header reprend les liens et les espacements de la maquette Figma 308:4827.
Le fichier LGR logo.svg fourni par Maxime remplace le logo precedent, sans modification, dans `assets/logo/Logo_GoutRetrouve.svg`. Il conserve sa largeur de 100 px et ses proportions SVG.

Le menu propose Les marques, Nos produits, Points de vente et Professionnels.
Sur mobile, il utilise le menu responsive du bloc Navigation WordPress.
Les trois premieres entrees pointent vers les sections de l'accueil et la
derniere vers `/espace-pro/`. Polices et couleurs sont chargees localement.

L'accueil (page WordPress 8) contient seulement les sections et titres demandes.
Espace pro (page 10) est public et contient uniquement son titre.
Le footer Figma est realise ; les autres sections, images et contenus restent a composer.

La configuration precedente est conservee dans l'option WordPress
`lgr_previous_setup` : theme twentytwentyfive, accueil par articles,
page_on_front 0 et accueil LGR en brouillon. Aucun contenu existant n'a ete efface.

## Gutenberg et code

La composition « Grille de produits LGR » utilise un groupe en disposition
Grille et des blocs Image natifs. Elle est insérée sous Le goût retrouvé.
Les images se remplacent via Remplacer ; leur occupation en colonnes et rangées
se règle dans la disposition du bloc Image. Activer « Styles responsive » dans
Voir pour changer les portées ou le nombre de colonnes sur un viewport précis.
Breakpoints natifs du thème : mobile jusqu'à 599 px, tablette jusqu'à 1279 px.
La grille utilise 1 / 4 / 5 colonnes ; rangées tablette de 160 px, desktop de
210 px, gap natif de 20 px. Le CSS technique des hauteurs est dans
assets/css/components/product-grid.css. Les colonnes, portées, ordre des blocs
et gap restent des réglages Gutenberg. Les images du placeholder réutilisent
une seule pièce jointe de la médiathèque.
La grille contient désormais cinq photos sur desktop. La cinquième utilise le
réglage natif de visibilité pour être masquée sur mobile et tablette. Les images
utilisent le mode de mise à l'échelle « Couvrir » (cover), avec recadrage et sans
déformation. La grande photo occupe deux colonnes ; la cinquième occupe la
dernière colonne sur les deux rangées.

La largeur de contenu globale est de 1920 px, centrée par les dispositions
contraintes Gutenberg. Pour ajouter une section avec un fond pleine largeur,
utiliser la composition « Section LGR — fond pleine largeur, contenu centré ».
Ses groupes, couleurs et contenu se modifient directement dans le FSE.

Les consignes Gutenberg/FSE validées sont dans le fichier `AGENTS.md` à la racine
du dépôt. Elles doivent être suivies pour les prochaines modifications du thème
et du contenu WordPress.

Ouvrir Apparence > Editeur pour modifier les modeles et le Header LGR.
Les titres et sections des pages se modifient dans Pages > Modifier.
La palette et les trois familles de polices sont disponibles dans les styles.
Le pied de page utilise le pattern lgr/footer, modifiable dans Gutenberg.

- `theme.json` : palette, typographie et reglages Gutenberg.
- `templates/` : modeles HTML avec blocs WordPress (accueil, pages, index, 404).
- `parts/` : elements de modele header et footer.
- `patterns/header.php` : composition initiale du header, URLs generees en PHP.
- `style.css` : metadonnees obligatoires du theme WordPress.
- `functions.php` : chargement des ressources dans le site et l'editeur.

Les changements enregistres dans l'editeur de site sont stockes dans la base de
donnees et prennent priorite sur les fichiers du theme. Pour les partager via Git,
exporter le theme depuis l'editeur et reporter les modeles, elements de modele
et styles exportes dans le depot. Sauvegarder aussi la base pour les pages et menus.
Avant de modifier un modele en code, verifier s'il possede une personnalisation
dans Gutenberg ; ne pas effacer cette personnalisation sans la sauvegarder.

Validation : theme de blocs reconnu sans erreur, quatre modeles et deux elements
de modele trouves, cinq couleurs et trois polices reconnues, syntaxe PHP,
reponse HTTP 200, logo charge, quatre liens desktop, menu mobile ouvert a 375 px
sans debordement et navigation vers Espace pro.

## Organisation CSS

- assets/css/base.css : regles globales et accessibilite.
- assets/css/layout.css : largeur du contenu et espacement des sections.
- assets/css/components/header.css : logo et structure du header.
- assets/css/components/navigation.css : liens, burger et animations.

Chaque fichier regroupe ses styles desktop, mobile et reduction des animations.
Les futurs composants vont dans components/ et les sections propres a une page
dans assets/css/sections/ (exemple : nos-marques.css), au moment de leur creation.
Ajouter chaque nouveau fichier a la liste styles dans functions.php, dans l'ordre
de chargement souhaite. Les CSS sont charges dans le site et Gutenberg via
enqueue_block_assets ; filemtime actualise leur version pour eviter le cache.
Les couleurs et tailles globales restent dans theme.json et design-tokens.

## Hero de l'accueil

La hero est désormais en mobile first : sous 600 px, grille de 5 colonnes avec
marges et gouttières de 16 px ; de 600 à 1279 px, grille de 9 colonnes avec
marges de 24 px et gouttières de 16 px ; dès 1280 px, grille de 12 colonnes,
marges de 100 px et gouttières de 20 px. Le H1 est « Les goûts retrouvés » partout.
La photo horizontale fournie utilise un bloc Image natif distinct de la photo
portrait desktop. Les images sont sélectionnées par CSS selon la largeur.
Sur mobile, boutons de 12 px avec padding 8 px / 16 px ; tablette et desktop,
boutons de 20 px avec padding 16 px / 32 px. Bandeau de 28 / 40 / 60 px ; la
hero complète l'écran. Sur les écrans peu hauts, une hauteur minimale préserve
la lisibilité, quitte à permettre le défilement.
Les rideaux se retirent horizontalement sous 1280 px (texte vers la gauche,
photo vers la droite) et verticalement au-dessus. Ils conservent les délais
250 / 450 ms, la durée de 1100 ms et la courbe cubic-bezier(.76,0,.24,1).
Les styles de composition sont partagés avec le FSE ; editor.css gère seulement
les wrappers et désactive les animations pendant l'édition.

### Référence desktop initiale

La hero reprend Figma 308:4824 : grille de 12 colonnes, gouttieres de 20 px,
marges desktop de 100 px a 1280 px. Texte Cormorant 85 px et signature
Montserrat Alternates 20 px. Photo fournie dans assets/images/hero-produits.png,
fond rose-bruit.avif et deux boutons vers les produits et points de vente.
La hero et le bandeau de 60 px occupent ensemble 100vh. Sur mobile, la photo
passe sous le texte. Les blocs sont editables dans la page Accueil ; leur source
est conservee dans wp-content/structure/hero.blocks.html. Styles dans
assets/css/sections/hero.css.

## Boutons avec remplissage circulaire

Dans Gutenberg, ajouter un bloc Boutons puis selectionner le bloc Bouton individuel.
Dans Styles, choisir Remplissage — Charcoal, Rose, Vert ou Brun. Le texte et le lien
restent modifiables normalement, sans HTML personnalise ni span supplementaire.
Les reglages de couleur et de dimensions du bloc restent disponibles.

Le composant est dans assets/css/components/buttons.css ; assets/js/buttons.js
place le cercle au point d'entree et de sortie de la souris. Animation de 1250 ms,
changement de couleur du texte retarde de 320 ms au survol. Le texte revient sans
retard a la sortie. L'animation fonctionne sur desktop avec une souris ; le focus
clavier utilise un remplissage immediat et la preference de reduction des animations
est respectee. La classe btn-ripple est aussi disponible pour un lien HTML personnalise.

## Footer

Reference Figma 308:5055. Pattern patterns/footer.php et styles
assets/css/components/footer.css. Trois colonnes sur desktop, empilees sur mobile.
Coordonnees reprises de la maquette, telephone et email cliquables ; annee dynamique.
Instagram et Facebook proposent chacun les trois marques et leurs logos de reseau. Les logos sont regroupes dans assets/logo/. Les mentions
legales, la confidentialite et les conditions generales restent en texte en
attendant les pages publiees et validees. Aucune page legale n'a ete inventee.
Verification visuelle a 1280 et 375 px, sans debordement horizontal.
# Section « Nos valeurs »

La section est composée uniquement de blocs natifs : Groupe, Grille, Image,
Titre et Paragraphe. Dans la Vue en liste du FSE, chaque carte porte le nom de
sa valeur. Les images, textes, couleurs, bordures, paddings et espacements
restent modifiables dans les réglages des blocs.
La grille utilise les réglages responsive WordPress : quatre colonnes sur
desktop, deux sur tablette, une sur mobile. Les cartes Convivialité et
Transmission ont une marge supérieure de 96 px sur desktop et de 0 px sur
tablette/mobile, également enregistrée dans les attributs natifs.
La composition « Nos valeurs LGR » permet de réutiliser cette structure.
# Section « Nos marques »

Les trois cartes sont des groupes natifs nommés dans la Vue en liste :
Le goût retrouvé, Célinette et Aux vraies saveurs. Images (dans la médiathèque),
titres, descriptions, liens, pastilles, couleurs et espacements sont éditables.
La grille native comporte trois colonnes desktop/tablette et une sur mobile.
Les cartes occupent deux lignes partagées pour aligner le bas des images ;
le CSS subgrid complète cette disposition dans le site et l'éditeur.
Les pots utilisent maintenant des AVIF transparents. Dans la Vue en liste,
« Visuel de marque — fond et pot » contient une Image et un Groupe nommé
« Fond de marque — couleur modifiable ». La photo et la couleur du fond se
changent indépendamment dans Gutenberg. Les rectangles sont alignés par le bas
et s'agrandissent une fois au scroll, avec 120 ms de décalage entre les marques.
L'animation est désactivée dans le FSE et en réduction des mouvements.
La composition « Nos marques LGR » permet de réutiliser la section.
# Catalogues de produits

Dans les pages Confitures et Aux vraies saveurs, chaque cellule contient une
carte native (Groupe), une Image, une étiquette de couleur (Groupe), un titre,
une mention de gamme et un bloc Détails « Ingrédients ». Tout ce contenu se
modifie dans la Vue en liste du FSE, sans HTML personnalisé.
Dupliquer une cellule pour ajouter un produit ; déplacer les cellules pour
changer leur ordre. Les grilles utilisent les réglages responsive natifs :
3 colonnes desktop, 2 tablette, 1 mobile. Le décalage (84/48/0 px), l'ouverture
de l'étiquette et les animations sont les compléments techniques du thème.
Sur mobile et écran tactile, les ingrédients se consultent via Détails.
Dans le FSE, sélectionner une carte expose ses champs pour faciliter l'édition.
Les photos actuelles sont provisoires et réutilisent une seule image de la
médiathèque. Les ingrédients non fournis pour Aux vraies saveurs restent
« Ingrédients à renseigner » ; les autres textes viennent du contenu fourni.
