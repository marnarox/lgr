# Point de sauvegarde du 15 octobre 2026

Le code du thème, Gutena Forms 2.1.1 et les copies des six pages principales
dans `wp-content/structure` sont versionnés dans Git. Ces copies ont été relues
depuis la base WordPress avant le commit pour préserver les modifications FSE.

Validation : syntaxe PHP du thème, syntaxe JavaScript, theme.json et 1 020 blocs
des six pages contrôlés avec le parseur WordPress installé, sans bloc invalide.
Les vérifications visuelles complètes dans le véritable FSE et sur mobile restent
à terminer ; la session du navigateur intégré demandait une reconnexion.
Le formulaire professionnel fonctionne en démonstration : notifications e-mail
désactivées et destinataire provisoire à remplacer dans Gutenberg avant activation.

Git ne contient ni base de données, ni comptes WordPress, ni fichiers uploads,
ni configuration .env. La sauvegarde locale complémentaire se trouve dans
`backups/` et conserve la base et les médias. Voir TRANSFERT.md pour restaurer.
Un clone Git seul ne reconstitue pas les contenus et réglages enregistrés en base.
