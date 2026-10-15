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

Le formulaire utilise l'extension Gutena Forms, installée depuis WordPress.org.
Les champs, libellés, choix du commerce et réglages de notification se modifient
dans Gutenberg en sélectionnant le bloc Form du groupe Contact pro.
Les notifications administrateur et utilisateur sont désactivées.
Le destinataire `configuration-requise@example.invalid` est un emplacement
provisoire, nécessaire au rendu du bouton par l'extension ; aucun e-mail n'est envoyé.
Pour connecter le formulaire : remplacer ce destinataire dans Notifications,
activer la notification administrateur, adapter le message de confirmation et
vérifier la réception réelle avec le transport mail de l'hébergement.
L'adresse affichée dans les coordonnées reste distincte du destinataire du formulaire.
