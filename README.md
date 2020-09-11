## Explorateur de fichiers en PHP.

### Récupérer l'url du répertoire de travail courant et afficher le contenu du dossier.
Pour cela, nous affectons une variable à l'url (exemple: $dir_url) :
```
$dir_url = getcwd();
```
La valeur **getcwd()**, qui est une fonction nous renvoie le répertoire de travail actuel ou *current work directory*, et qui est le dossier qui contient le script. Le résultat donnera donc : **C:\wamp64\www\sergio\files-explorer\start**.

Ensuite, nous affectons à une variable ($dir_list), une fonction **scandir()**, qui nous renvoie un tableau de fichiers et de répertoires du répertoire spécifié :
```
$dir_list = scandir($url);
```
Avec la fonction **scandir()**, on prend comme premier paramètre **(requis)** le répertoire de travail actuel. Et en deuxième paramètre, on spécifie l'ordre de sortie. Par défaut, la sortie est dans l'ordre ascendant. En troisième paramètre, le contexte, qui est un ensemble d'options qui peuvent modifier le comportement d'un flux.

### Le répertoire de départ
L'étape suivante, nous allons vérifier si le nom de fichier spécifié est un répertoire, avec **is_dir()**. Mais avant cela, on affecte le nom du fichier **start** à une variable **$start**.
```
$start= "start";
```
Ensuite, nous utilisons cette variable comme premier paramètre de la fonction **is_dir()**, car c'est le fichier que nous allons vérifié.
```
if(!is_dir($start)){
  mkdir("start");
  chdir(getcwd() . DIRECTORY_SEPARATOR . $start);
}
```
Ici, on vérifie **si le nom de fichier "start" n'existe pas ou n'est pas un répertoire**, et cela grâce à l'ajout d'un **!** avant le fonction. Donc, si la condition est remplie, on créée le répertoire en question avec la fonction **mkdir("start");**. Ensuite, on change de répertoire courant avec **chdir()**, avec comme premier paramètre la fonction **getcwd()** (url du répertoire courant). Après, on y ajoute également la constante prédéfinie **DIRECTORY_SEPARATOR** qui séparera le résultat de la fonction par des anti-slash. Et enfin on renseigne la variable **$start**.

Et si la condition n'est pas remplie, c'est-à-dire que **le nom de fichier "start" existe et est un répertoire"**, on se déplace tout simplement dans ce dernier.
```
chdir(getcwd() . DIRECTORY_SEPARATOR . $start);
```


### Faire en sorte que '.' et '..' n'apparaissent pas
