  <!--Formulaire checkbox pour afficher les fichiers masqués-->

<?php

  // Création du dossier "start", sauf s'il existe déjà, se déplacer dans ce dernier
  $start= "start";
  if(!is_dir($start)){
    mkdir("start");
  }
  define("DS", DIRECTORY_SEPARATOR);//défini un acronyme pour le constant DIRECTORY_SEPARATOR
  // aller dans le dossier start

//Récupération du current work directory
  if(!isset($_GET['cwd'])){ // Si la variable « $_POST[] » est vide...
    $url_courant = getcwd().DS.$start; // On concatène dans la variable $cwd le chemin du répertoire courant et la chaîne de caractère « start ».
  } else { // Sinon...
    $url_courant = $_GET['cwd']; // On récupère dans la variable $cwd la valeur du bouton sur lequel l'utilisateur a cliqué, composée du chemin du répertoire courant auquel on a concaténé le nom d'un dossier.
  }

  // Formulaire
  echo "<form method='get' id='ch_cwd'></form>";// On crée un formulaire qui va faire passer les informations.
  // Fil d'ariane
  $path = "";
  $breadcrumbs = explode(DS,$url_courant);
    foreach($breadcrumbs/*mettre les valeurs des éléments courants obtenue à chaque itération dans value*/ as $value ){
      $path .= $value.DS; /*ajoute un antislash à la valeur de l'élément courant obtenue à chaque itération, enveloppe cette nouvelle valeur dans path*/
    if (strstr($path, $start))/*affiche la première occurence de la chaine path à partir de start jusqu'à la fin de la chaine*/ {
      echo "<button type='submit' name='cwd' form='ch_cwd' value='".substr($path,0,-1)."'>"/*envoie la valeur de path au formulaire que get vas récupérer pour mettre à jour l'url_courant*/ . $value. /*affiche la valeur de value dans le bouton*/"</button>";
    }
  }
  echo "<br>";
  // lecture des fichiers dans $url_courant
  $dir_list = scandir($url_courant);
  echo "<br>";
  echo "<form action='index.php' method='get' id='hiddenfiles'>
    <label for='hidden'>Afficher les fichiers masqués</label>
    <input type='checkbox' name='checked' value='files'> <!--créer un bouton checkbox avec le nom de variable checked et la valeur files-->
    <input type='submit' name='submit' value='Envoyer'> <!--créer un bouton submit avec le nom de variable submit et la valeur envoyer-->
  </form>";

  // Pour chaque élément du tableau, où '.' et '..' non égale à $value
  //Afficher masquer les fichiers cachés
  $hidden=isset($_GET['checked']);
  foreach ($dir_list as  $files) {
    if ("." !== $files && ".." !== $files){
      if ($hidden == NULL && $files[0] == ".") {
        echo "";
    } else {
      echo "<button type='submit' name='cwd' form='ch_cwd' value='".$url_courant.DS.$files."'>"/*envoie la valeur de path au formulaire que get vas récupérer pour mettre à jour l'url_courant*/ . $files. /*affiche la valeur de value dans le bouton*/"</button><br>";
    }
      }
    }


// création de dossier
    if(isset($_GET['variable1'])){
        mkdir($url_courant.$_GET['variable1']);
      }
    echo "<form action='index.php' method='get'> <input type='text' name='variable1' form='ch_cwd' value=''>
    <button type='submit' name='cwd' form='ch_cwd' value=''>"."Nouveau"."</button> <br>
    ";

?>
