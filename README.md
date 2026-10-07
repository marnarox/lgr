# Projets WordPress

## Depot Git LGR

Le depot suit la configuration commune et les fichiers LGR. Dingding Club et les
donnees locales sont exclus. Voir [lgr/README.md](lgr/README.md) pour installer LGR
sur une autre station et transferer les pages, reglages et medias.
Le fichier `.env.example` sert de modele ; conserver le `.env` actuel sur ce PC.

Ouvrir Docker Desktop, attendre le moteur, puis double-cliquer sur Demarrer.cmd.
Site : http://dingding.localhost
Arreter.cmd arrete les conteneurs sans supprimer les donnees.
Les lanceurs trouvent Docker meme s'il n'est pas dans le PATH.
Le port 80 doit etre libre.

## Organisation

- docker-compose.yml : fichier commun a tous les projets.
- proxy/Caddyfile : correspondance entre adresses locales et services WordPress.
- dingding-club/wp-content : fichiers existants du site, deplaces depuis wp-content.
- php.ini : configuration PHP existante partagee.
- .env : identifiants historiques conserves pour compatibilite avec une ancienne base.
- backups/configuration-* : sauvegarde de l'ancien Compose et de php.ini.

Les services wordpress et db, ainsi que les volumes wp_data et db_data, conservent
leurs noms historiques. Garder le meme dossier racine pour retrouver les anciens
volumes Compose. Les ports web sont limites a ce PC ; la base ne publie aucun port.
Le port historique 8081 reste disponible, mais WordPress utilise dingding.localhost
comme adresse canonique.

## Etat de la restauration

Les fichiers et le theme DingDing Club sont presents. Le 7 octobre 2026, Docker
a ete verifie : les services WordPress, LGR et proxy sont demarres et les deux
bases sont saines. L'execution de Docker exige des permissions hors bac a sable.
Si WordPress affiche son assistant d'installation, recuperer la
sauvegarde SQL ou complete de l'ancien site pour restaurer ses pages et reglages.
Les fichiers wp-content seuls ne restaurent pas la base de donnees.
Ne pas utiliser docker compose down -v : cette option efface les volumes.
Pour une sauvegarde complete, exporter aussi la base de donnees.

## Commandes

Depuis ce dossier, avec Docker accessible dans le PATH :

    docker compose up -d
    docker compose ps
    docker compose logs --tail 100
    docker compose stop

Ou utiliser wordpress.ps1 avec start, stop, status ou logs.
Pour lancer uniquement Dingding et sa base : docker compose up -d proxy wordpress
Les autres sites deja demarres restent actifs jusqu'a leur arret explicite.

## Ajouter un site

Dans le meme Compose, dupliquer les services wordpress et db sous des noms uniques
(exemple : portfolio et portfolio-db), puis :

1. Creer portfolio/wp-content et utiliser ce chemin dans le montage WordPress.
2. Donner deux volumes propres au site (portfolio_wp et portfolio_db), declares
   dans la section volumes existante.
3. Creer le reseau portfolio-db avec internal: true ; y connecter uniquement
   sa base et son WordPress. Connecter aussi WordPress au reseau frontend.
4. Adapter depends_on et WORDPRESS_DB_HOST a portfolio-db.
5. Ajouter des mots de passe distincts dans .env et les referencer dans les deux services.
6. Remplacer les deux URL par http://portfolio.localhost et supprimer le bloc
   ports du nouveau WordPress (le proxy assure l'acces).
7. Ajouter dans proxy/Caddyfile :

    http://portfolio.localhost {
        reverse_proxy portfolio:80
    }

Relancer Demarrer.cmd puis docker compose restart proxy pour appliquer son fichier.
Tous les sites restent dans un seul Compose, chacun avec sa base et ses volumes.

Documentation : https://hub.docker.com/_/wordpress
Docker Desktop : https://docs.docker.com/desktop/setup/install/windows-install/
