# Theme Les goûts retrouvés

Theme WordPress de blocs personnalise, dossier `lgr`, actif sur le site local.
Le header reprend les liens et les espacements de la maquette Figma 308:4827.
Le SVG fourni est copie sans modification dans `assets/Logo_GoutRetrouve.svg`.
Il est affiche entier, y compris la signature Artisan confiturier, ce qui donne
une hauteur differente du logo recadre de la maquette.

Le menu propose Les marques, Nos produits, Points de vente et Professionnels.
Sur mobile, il utilise le menu responsive du bloc Navigation WordPress.
Les trois premieres entrees pointent vers les sections de l'accueil et la
derniere vers `/espace-pro/`. Polices et couleurs sont chargees localement.

L'accueil (page WordPress 8) contient seulement les sections et titres demandes.
Espace pro (page 10) est public et contient uniquement son titre.
Le reste du design, les images, les contenus et le footer restent a realiser.

La configuration precedente est conservee dans l'option WordPress
`lgr_previous_setup` : theme twentytwentyfive, accueil par articles,
page_on_front 0 et accueil LGR en brouillon. Aucun contenu existant n'a ete efface.

## Gutenberg et code

Ouvrir Apparence > Editeur pour modifier les modeles et le Header LGR.
Les titres et sections des pages se modifient dans Pages > Modifier.
La palette et les trois familles de polices sont disponibles dans les styles.
Le pied de page est un element de modele vide, pret a etre compose plus tard.

- `theme.json` : palette, typographie et reglages Gutenberg.
- `templates/` : modeles HTML avec blocs WordPress (accueil, pages, index, 404).
- `parts/` : elements de modele header et footer.
- `patterns/header.php` : composition initiale du header, URLs generees en PHP.
- `style.css` : CSS technique et adaptations responsives.
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
