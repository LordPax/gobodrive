# GoboDrive

## Lien vers le site
[GoboDrive](http://gauthier.cf/mes_sites/gobodrive) *Il ce peut que le site ne soit pas accessible*

## Decription
Ce site est un drive qui n'est pas fini et ne le sera probablement jamais. Il permet de ce connecter et d'y héberger toute sorte de fichier, à condition qu'il ne dépasse pas une certaine taille (600 Mo il me semble, je pense que c'est à cause des formulaires html qui doivent certainement brider la taille)

## Avertissement
Ce site a été créé il y a un certain temps déjà, il ce peut qu'il y ait des fautes d'ortographe, que le code ne soit pas très propre, et qu'il n'y ait pas de commentaire, n'espérer donc pas en faire quelque chose.

## Comment le faire fonctionner:
1. Le serveur doit avoir **PHP**, **APACHE**, et **MySQL**.

2. Vous devrez ensuite trouver le fichier **"drive.sql"** qui ce trouve dans le dossier **"[bdd]"** puis l'importer dans la base de donnée MySQL.

3. Modifiez le fichier **"bdd.php"** qui ce trouve dans le dossier **"include"**. Les instructions serons détaillées dans ce fichier
 
4. Puis, importez tout les codes sources sur le serveur dans le dossier prévue à cette effet.

5. Ne pas oublier de changer l'utilisateur du dossier **"fichier"** en daemon, www-data ou autre avec la commande.
```bash
sudo chown daemon fichier/

sudo chown www-data fichier/
```

## Dans bdd.php
### Instruction :
1. Ecrivez le nom d'utilisateur de la base de donnée et le mot de passe correspondant. Gardez "localhost" si la base de donnée est sur le serveur concervant les codes sources, si la base de donnée est sur un autre serveur, mettez l'adresse de ce serveur.
                 
2. Ecrivez votre nom de domain, example : `$domain = 'http://example.fr';` (si vous avez un certifica SSL, pensez à changer le "http://" en "https://").

### Lignes a modifier
```PHP
$bdd = new PDO('mysql:host=localhost;dbname=drive','nom_utilisateur','mot_de_passe');
//connection à la base de donnée, mettez y le nom d'utilisateur de la base de donnée et le mot de passe correspondant

$domain = 'http://nom_de_domain_ici'; 
//Ecrivez votre nom de domain à la place de "nom_de_domain_ici"	
```


## Me contacter
* Je suis disponible pour toute éventuelle question à l'adresse : teddy.gauthier@outlook.com.
