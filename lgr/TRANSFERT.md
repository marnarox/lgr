# Retrouver LGR sur le portable Windows

Git transfere le code ; la sauvegarde transfere les pages, comptes WordPress,
menus, reglages et modifications Gutenberg, ainsi que les fichiers uploads.
La sauvegarde contient des donnees privees : la transferer directement entre
les deux PC (cle USB ou espace personnel), sans la publier dans Git.

## Sur le PC source

Enregistrer les changements de code avec git commit et git push, puis depuis
la racine du depot, sans modifier le site pendant lexport :

```powershell
powershell -NoProfile -ExecutionPolicy Bypass -File .\lgr\tools\transfer.ps1 backup
```

Copier le dossier de sauvegarde indique par la commande sur le portable.
Il contient database.sql, manifest.json et uploads.zip si des medias existent.
Compress-Archive impose une limite de 2 Go par fichier media et ignore les
fichiers caches ; ce flux convient aux medias WordPress ordinaires.

## Sur le portable

Installer Git et Docker Desktop, configurer sa propre cle SSH, puis :

```powershell
git clone git@github.com:marnarox/lgr.git
cd lgr
Copy-Item .env.example .env
notepad .env
```

Remplacer les quatre mots de passe dexemple par des valeurs distinctes. Garder
ces mots de passe pour les demarrages suivants. La base importee utilisera les
identifiants Docker de cette nouvelle station ; le compte WordPress reste celui
du site source. Le domaine local reste identique, sans remplacement dURL.

Ouvrir Docker Desktop, puis restaurer en remplacant le chemin dexemple :

```powershell
powershell -NoProfile -ExecutionPolicy Bypass -File .\lgr\tools\transfer.ps1 restore -BackupPath 'C:\chemin\lgr-AAAAMMJJ-HHMMSS'
```

La commande demande de taper RESTAURER, car elle remplace les tables LGR de cette
station. Elle ne restaure pas Dingding Club. Elle demarre les services LGR et le
proxy. Les medias sont copies avec remplacement des fichiers de meme nom, sans
supprimer les fichiers supplementaires deja presents sur la station cible.

Ouvrir http://lgr.localhost et http://lgr.localhost/wp-admin pour travailler.

## Pour les changements de station suivants

Sur le PC quittant : git commit, git push, puis nouvelle sauvegarde.
Sur le PC reprenant : git pull, sauvegarder son etat si besoin, puis restaurer la
nouvelle sauvegarde. Travailler sur une seule copie a la fois pour eviter que les
modifications WordPress des deux PC se remplacent.
Ne jamais supprimer les volumes Docker pour effectuer un simple transfert.
