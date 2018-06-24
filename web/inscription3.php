<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Formulaire de saisie d'un nouvel emprunteur</title>
  </head>
  <body>
    <?php
    if (isset($_POST['soumettre'])) {

//***************************
// Bouton "Valider" de valeur name="soumettre" et pas bouton "Corriger le formulaire" de valeur name="corriger"
// Traitement du formulaire
      // la variable $errormsg contiendra l'éventuel message d'erreur à afficher
      $errormsg = "";

      // version 1 : affichage du contenu brut de $_POST
      echo "<hr>\n";
      echo "    Contenu de \$_POST :\n    <ul>\n";
      foreach ($_POST as $key => $value) {
        echo "      <li>\$_POST['$key'] : $value</li>\n";
      }
      echo "    </ul>\n    <hr>\n";

      // version 2 : "filtrage" du contenu de $_POST et assignation à des variables locales
      // htmlspecialchars() : Convertit les caractères spéciaux en entités HTML
      // trim() : Supprime les espaces (ou d'autres caractères) en début et fin de chaîne
      // nl2br() : Insère un retour à la ligne HTML à chaque nouvelle ligne

      $nom = trim(htmlspecialchars($_POST['nom']));
      $prenom = trim(htmlspecialchars($_POST['prenom']));
      $mail = htmlspecialchars($_POST['mail']);
      $pseudo = htmlspecialchars($_POST['pseudo']);
      $passe1 = trim(htmlspecialchars($_POST['passe1']));
      $passe2 = trim(htmlspecialchars($_POST['passe2']));

      // On vérifie si tous les inputs sont valides 

      if (empty($nom)) {
        $errormsg .= "    Le champ nom est obligatoire<br>\n";
      } elseif (strlen($nom) > 100 || strlen($nom) < 2) {
        $errormsg .= "    Le nom doit être composé de 2 à 100 caractères<br>\n";
      } elseif (!preg_match('/^([[:alpha:]]|-|[[:space:]]|\')*$/u', $nom)) {
        // [[:alpha:]] : caractères alphabétique
        // [[:space:]] : espace blanc
        $errormsg .= "    Le nom ne doit comporter que des lettres<br>\n";
      }

      if (empty($prenom)) {
        $errormsg .= "    Le champ prenom est obligatoire<br>\n";
      } elseif (strlen($prenom) > 100 || strlen($prenom) < 2) {
        $errormsg .= "    Le prénom doit être composé de 2 à 100 caractères<br>\n";
      } elseif (!preg_match('/^([[:alpha:]]|-|[[:space:]]|\')*$/u', $prenom)) {
        $errormsg .= "    Le prénom ne doit comporter que des lettres<br>\n";
      }

      if (empty($mail)) {
        $errormsg .= "    Le champ mail est obligatoire<br>\n";
      } elseif (strlen($mail) > 250) {
        $errormsg .= "    Le champ mail doit être inférieur à 250 caractères<br>\n";
      } elseif (!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i', $mail)) {
        $errormsg .= "    Le champ mail doit être valide mail@domaine.fr<br>\n";
      }

      if (empty($pseudo)) {
        $errormsg .= "    Le champ pseudo est obligatoire<br>\n";
      } elseif (strlen($pseudo) > 10 || strlen($pseudo) < 6) {
        $errormsg .= "    Le pseudo doit être composé de 2 à 10 caractères<br>\n";
      } elseif (!preg_match('/^[a-zA-Z0-9]*$/u', $pseudo)) {
        $errormsg .= "    Le pseudo ne doit comporter que des lettres non accentuées ou des chiffres et pas d'espaces<br>\n";
      }

      if (empty($passe1)) {
        $errormsg .= "    Le mot de passe est obligatoire<br>\n";
      } elseif (strlen($passe1) < 8) {
        $errormsg .= "    Le mot de passe doit contenir au moins 8 caractères<br>\n";
      } elseif (!preg_match('/^[[:graph:]]*$/u', $passe1)) {
        // [[:graph:]] : tous les caractères imprimables sauf l'espace
        $errormsg .= "    Le mot de passe ne doit pas comporter d'espaces<br>\n";
      }

      if (strcmp($passe1, $passe2) != 0) {
        $errormsg .= "    Les mots de passe sont différents<br>\n";
      }

      // on vérifie si la case "Abonnement à la newsletter" a été cochée
      if (isset($_POST['newsletter'])) {
        $newsletter = 1;
      } else {
        $newsletter = 0;
      }

      // on vérifie que la zone de texte "Commentaire" n'est pas vide
      if (!empty($_POST['commentaire'])) {
        $commentaire = nl2br(htmlspecialchars($_POST['commentaire']));
      } else {
        $commentaire = "Aucun";
      }

      // Affiche un message d'erreur ou de confirmation 
      if (strcmp($errormsg, "") == 0) {
        // Affiche un message de confirmation ainsi que les valeurs saisies
        echo "    <p>Nous avons pris en compte votre inscription.</p>\n";
        echo "    Voici les données qui ont été saisies :\n    <ul>\n";
        echo "      <li>Nom : " . $nom . "</li>\n";
        echo "      <li>Prénom : " . $prenom . "</li>\n";
        echo "      <li>Mail : " . $mail . "</li>\n";
        echo "      <li>Pseudo : " . $pseudo . "</li>\n";
        echo "      <li>Mot de passe : " . $passe2 . "</li>\n";
        // le mot de passe est chiffré
        $passe1 = password_hash($passe1, PASSWORD_DEFAULT);
        echo "      <li>Mot de passe chiffré : " . $passe1 . "</li>\n";

        echo "      <li>Inscription à la newsletter : ";
        if ($newsletter == 1) {
          echo "Oui</li>\n";
        } else {
          echo "Non</li>\n";
        }

        echo "      <li>Commentaire : ";
        if ($commentaire == "Aucun") {
          echo "Aucun</li>\n";
        } else {
          echo "<br>" . $commentaire . "</li>\n";
        }
        echo "    </ul>\n<hr>\n";
      } else {
        // affiche un message d'erreur et transmets les valeurs saisies pour un réaffichage du formaulaire rempli
        echo $errormsg . "    <br>\n";

        // passage simple des valeurs grâce à un formulaire caché
        echo "    <form action=\"inscription3.php\" method=\"POST\">\n";
        foreach ($_POST as $key => $value) {
          // les mots de passe "passe1" et "passe2" et le bouton "soumettre" ne sont pas transmis
          if (strcmp($key, "soumettre") != 0 && strcmp($key, "passe1") != 0 && strcmp($key, "passe2") != 0) {
            echo "      <input type=\"hidden\" name=\"" . $key . "\" value=\"" . $value . "\">\n";
          }
        }
        echo "      <input type=\"submit\" name=\"corriger\" value=\"Corriger le formulaire\">&nbsp;<br>\n";
        echo "    </form>\n";
        echo "    <hr><a href=\"inscription3.php\">Retour au formulaire vide</a>";
      }
    } else {
      ?> 

      <!-- *************************** -->
      <!--  Affichage du Formulaire    -->

      <form action="inscription3.php" method="POST">  <!-- ajouter novalidate pour éviter la validation du formulaire -->

        <label for="edit-nom">Nom : </label>
        <input type="text" id="edit-nom" name="nom" value="<?php $name = "nom"; if (isset($_POST["$name"])) echo htmlspecialchars($_POST["$name"]); ?>" minlength=2 maxlength=100 required><br>&nbsp;<br>

        <label for="edit-prenom">Prénom : </label>
        <input type="text" id="edit-prenom" name="prenom" value="<?php $name = "prenom"; if (isset($_POST["$name"])) echo htmlspecialchars($_POST["$name"]); ?>" minlength=2 maxlength=100 required><br> &nbsp;<br>

        <label for="edit-mail">Adresse Mail : </label>
        <input type="text" id="edit-mail" name="mail" value="<?php $name = "mail"; if (isset($_POST["$name"])) echo htmlspecialchars($_POST["$name"]); ?>" maxlength=250 required pattern="^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$"><br> &nbsp;<br>

        <label for="edit-pseudo">Pseudo : </label>
        <input type="text" id="edit-pseudo" name="pseudo" value="<?php $name = "pseudo"; if (isset($_POST["$name"])) echo htmlspecialchars($_POST["$name"]); ?>" minlength=6 maxlength=10 required pattern="^[a-zA-Z0-9]*$"><br> &nbsp;<br>

        <label for="edit-passe1">Mot de passe : </label>
        <input type="password" id="edit-passe1" name="passe1" value="" minlength=8 required><br> &nbsp;<br>

        <label for="edit-passe2">Confirmer mot de passe : </label>
        <input type="password" id="edit-passe2" name="passe2" value="" minlength=8 required><br> &nbsp;<br>

        <label for="edit-newsletter">Abonnement à la newsletter : </label>
        <input type="checkbox" id="edit-newsletter" name="newsletter" value="" <?php $name = "newsletter"; if (isset($_POST["$name"])) echo "checked"; ?>><br>&nbsp;<br>

        <label for="edit-commentaire">Commentaire : </label>
        <textarea id="edit-commentaire" name="commentaire" placeholder="Laissez un commentaire" value="" size="60"><?php $name = "commentaire"; if (isset($_POST["$name"])) echo htmlspecialchars($_POST["$name"]); ?></textarea><br>&nbsp;<br>

        <input type="submit" name="soumettre" value="Valider">&nbsp;<input type="reset" value="Annuler"> &nbsp;<br>
      </form>

<?php }
?> 
    <br><a href="index.php">Retour à l'accueil</a>
  </body>
</html>
