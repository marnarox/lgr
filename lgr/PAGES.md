# Pages LGR

Structure demandee par Maxime. L'accueil est affiche sur le site local (page 8).
Espace pro est une page publique avec sa hero (page 10).
Les mentions légales (page 12) et la politique de confidentialité (page 3)
sont publiées avec les textes fournis par Maxime.

| Page | URL prevue | Etat |
| --- | --- | --- |
| Accueil (index) | / | Page 8 : sections et titres Figma uniquement, definie comme accueil local |
| Espace pro (page publique pour les professionnels) | /espace-pro/ | Page 10 publique : hero, Nos atouts, Pour qui, Le parcours et Contact pro ; e-mails du formulaire désactivés |
| Mentions legales | /mentions-legales/ | Page 12 publiée : texte fourni par Maxime, blocs Gutenberg éditables |
| Politique de confidentialite | /politique-de-confidentialite/ | Page 3 publiée : texte fourni par Maxime, date de modification native automatique |
| Cookies | /cookies/ | A confirmer selon les outils et cookies du site |

Les liens legaux sont prevus dans le pied de page. La liste exacte et les textes
seront adaptes a l'activite, au pays de l'editeur et aux fonctionnalites du site.
Aucune information legale ou coordonnee ne doit etre inventee.

"Espace pro" est une page publique destinee aux professionnels, accessible
sans connexion ni restriction d'acces, comme confirme par Maxime.

Maquette Espace pro : https://www.figma.com/design/fdUTFy4Fac2zOJF41W7nyM/Les-go%C3%BBts-retrouv%C3%A9s?node-id=410-3185
La hero utilise le fond vert bruité, la photo et les rideaux de l'accueil,
sans marquee. Le bouton cible le formulaire `#contact-pro`.
Textes, images, lien, couleur et image de fond sont des réglages natifs.

## Formulaire Contact pro

Le formulaire utilise Forminator (version gratuite), intégré à la page par son
bloc Gutenberg natif. Dans WordPress : Forminator > Formulaires > Contact
professionnels. Les champs, les options de commerce, le bouton, les couleurs,
les polices, les espacements et les notifications se règlent dans Forminator.
Le groupe extérieur (fond crème et padding) reste éditable dans Gutenberg.

Les cinq champs reprennent le formulaire précédent. Le honeypot est activé.
Les notifications sont vides et l'enregistrement des soumissions est désactivé
pour le mode démonstration ; aucune demande ne doit être considérée comme reçue.
La confirmation indique explicitement qu'aucun e-mail n'a été envoyé.
Pour la mise en service : configurer la notification, son destinataire et le
Reply-To sur email-1 ; connecter le transport mail authentifié et tester la
réception réelle. Adapter la confirmation. Turnstile reste à connecter avec
les clés du compte client ; il n'est pas activé sans ces clés.

L'identifiant local est conservé dans l'option lgr_forminator_contact_id (116
sur cette base). La page et la composition utilisent ce même ID ; un transfert
vers une autre station nécessite la base de données, comme les autres contenus.
Le fichier wp-content/structure/contact-pro.forminator.json est une copie de
repérage des champs et réglages, pas un export d'import garanti par Forminator.
Pour un transfert indépendant, utiliser l'export natif de Forminator.

La page professionnelle a été relue depuis la base et validée avec les scripts
WordPress et Forminator : 82 blocs, aucun invalide. Validation obligatoire et
soumission de démonstration testées ; rendu mobile contrôlé à 375 px.
Le contrôle réel dans Gutenberg et l'éditeur Forminator reste à effectuer après
reconnexion à WordPress.
