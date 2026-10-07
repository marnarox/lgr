# LGR

Site local : http://lgr.localhost

## Contenu du depot

Le depot a la racine conserve la configuration Docker partagee et les themes et
extensions de `lgr/wp-content`. Le coeur WordPress est fourni par l'image Docker.
Les fichiers Dingding Club, les secrets `.env`, les sauvegardes SQL et les medias
`uploads` sont exclus. Les services Dingding restent dans le Compose existant.

## Installer sur une autre station

1. Installer Git et Docker Desktop, puis cloner le depot.
2. Copier `.env.example` vers `.env` et choisir quatre mots de passe distincts.
   Sur la station actuelle, conserver le `.env` existant.
3. Ouvrir Docker Desktop. Depuis la racine du depot, executer :

   ```console
   docker compose up -d --wait lgr proxy
   ```

4. Ouvrir http://lgr.localhost. Pour retrouver les pages et les reglages existants,
   restaurer aussi une sauvegarde de la base LGR et les fichiers uploads.

Les lanceurs communs `Demarrer.cmd` et `Arreter.cmd` concernent tous les sites.
Sur une station reservee a LGR, utiliser les commandes ciblees ci-dessus.
Docker Desktop doit disposer du port 80 local.

## Changer de station

Avant de partir : enregistrer les fichiers modifies avec `git add`, `git commit`
et `git push`, puis exporter la base LGR et copier `lgr/wp-content/uploads` dans
une sauvegarde separee. Sur l'autre station : `git pull`, restaurer la base dans
le service `lgr-db` et recopier uploads. Utiliser le meme domaine local.

Git seul ne transfere pas les pages, menus, comptes, reglages du theme ou
personnalisations effectuees dans l'editeur WordPress : ils sont dans la base.
Ne pas travailler simultanement sur deux copies de la base sans strategie de
synchronisation. Ne jamais lancer `docker compose down -v` pour un simple arret.

Pour arreter seulement LGR : `docker compose stop lgr lgr-db`.
Sur le PC actuel, garder le dossier racine et les noms de volumes existants.
