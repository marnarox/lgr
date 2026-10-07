# Design LGR

## Maquette de reference et perimetre actuel

[Les gouts retrouves sur Figma](https://www.figma.com/design/fdUTFy4Fac2zOJF41W7nyM/Les-go%C3%BBts-retrouv%C3%A9s?node-id=308-4823)

Reference fournie par Maxime. La maquette a ete lue via le connecteur Figma.
Instruction actuelle : preparer au maximum les sections et leurs titres, apres
lecture de la maquette. Attendre avant de reproduire le design. Le logo du header
sera fourni par Maxime avant de travailler sur le header.

## Structure de l'accueil

Source : frame Figma 308:4823. Sections dans l'ordre de la maquette :

1. Introduction : Le goût retrouvé (308:4824).
2. Nos marques (308:4856).
3. Nos produits (308:4876), avec Le goût retrouvé, Aux vraies saveurs et Célinette.
4. Nos valeurs (308:4921).
5. Où nous trouver (308:5047).

La structure Gutenberg, avec seulement les titres, est conservee dans
`wp-content/structure/accueil.blocks.html`. Les coquilles "Nos valeur" et
"Où nous trouvez" sont corrigees. Aucun asset ni mise en page n'est integre.
Le logo SVG a ete fourni et copie dans le theme `lgr`. Le header est realise
et le theme actif localement ; le footer sera realise a l'etape de mise en page.

## Palette fournie

| Variable CSS | Couleur |
| --- | --- |
| --lgr-color-charcoal | #1E1E1E |
| --lgr-color-cream | #E9DECE |
| --lgr-color-coral | #D95853 |
| --lgr-color-sage | #AEC1A6 |
| --lgr-color-terra | #B57244 |

Variables dans `wp-content/design-tokens/colors.css`, chargees par le theme LGR.
Le header utilise le fond creme et le texte anthracite. La repartition dans les
autres sections sera definie lors de la reproduction de la maquette.

## Typographie

Cormorant (300-700), Montserrat (100-900), Montserrat Alternates (100-900).
Les versions WOFF2 variables droites et italiques sont dans `wp-content/fonts`.
Les usages typographiques seront definis a partir de la maquette.
