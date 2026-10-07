# Polices LGR

Les six fichiers WOFF2 sont des polices variables officielles, en styles droit
et italique. Tous les caracteres fournis par les sources sont conserves ; les
accents francais et les ligatures oe ont ete verifies.

| Famille | Axe wght |
| --- | --- |
| Cormorant | 300 a 700 |
| Montserrat | 100 a 900 |
| Montserrat Alternates | 100 a 900 |

Cormorant vient de google/fonts (TTF convertis en WOFF2 avec FontTools).
Montserrat et Montserrat Alternates viennent du depot officiel
JulietaUla/Montserrat (sources WOFF2 variables). Les fichiers OFL accompagnent
chaque famille. `sources.json` contient les URL sources, revisions et empreintes.

`fonts.css` contient les six declarations @font-face pour un hebergement local.
Il est charge localement par le theme LGR.
Chemin public : http://lgr.localhost/wp-content/fonts/fonts.css

Pour telecharger a nouveau depuis les sources officielles : installer
`fonttools[woff]`, puis executer `python lgr/tools/download-fonts.py` depuis la
racine. Le script valide le format WOFF2, l'axe variable et les accents.
