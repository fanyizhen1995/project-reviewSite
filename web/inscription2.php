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
// Bouton "Valider" de valeur name="soumettre"
// Traitement du formulaire
      // version 1 : affichage du contenu brut de $_POST
      echo "<hr>\n";
      echo "Contenu de \$_POST :<ul>\n";
      foreach ($_POST as $key => $value) {
        echo "<li>\$_POST['$key'] : $value</li>\n";
      }
      echo "</ul><hr>\n";

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

      // Affiche les valeurs saisies
      echo "<p>Nous avons pris en compte votre inscription.</p>\n";
      echo "Voici les données qui ont été saisies : <ul>\n";
      echo "<li>Nom : " . $nom . "</li>\n";
      echo "<li>Prénom : " . $prenom . "</li>\n";
      echo "<li>Mail : " . $mail . "</li>\n";
      echo "<li>Pseudo : " . $pseudo . "</li>\n";
      echo "<li>Mot de passe 1 : " . $passe1 . "</li>\n";
      echo "<li>Mot de passe 2 : " . $passe2 . "</li>\n";

      echo "<li>Inscription à la newsletter : ";
      if ($newsletter == 1) {
        echo "Oui</li>\n";
      } else {
        echo "Non</li>\n";
      }

      echo "<li>Commentaire : ";
      if ($commentaire == "Aucun") {
        echo "Aucun</li>\n";
      } else {
        echo "<br>" . $commentaire . "</li>\n";
      }
      echo "</ul><hr>\n";
    } else {
      ?> 

      <!-- *************************** -->
      <!--  Affichage du Formulaire    -->

      <form action="inscription2.php" method="POST">  <!-- ajouter novalidate pour éviter la validation du formulaire -->

        <label for="edit-nom">Nom : </label>
        <input type="text" id="edit-nom" name="nom" value="" minlength=2 maxlength=100 required><br>&nbsp;<br>

        <label for="edit-prenom">Prénom : </label>
        <input type="text" id="edit-prenom" name="prenom" value="" minlength=2 maxlength=100 required><br> &nbsp;<br>

        <label for="edit-mail">Adresse Mail : </label>
        <input type="text" id="edit-mail" name="mail" value="" maxlength=250 required><br> &nbsp;<br>

        <label for="edit-pseudo">Pseudo : </label>
        <input type="text" id="edit-pseudo" name="pseudo" value="" minlength=6 maxlength=10 required><br> &nbsp;<br>

        <label for="edit-passe1">Mot de passe : </label>
        <input type="password" id="edit-passe1" name="passe1" value="" minlength=8 required><br> &nbsp;<br>

        <label for="edit-passe2">Confirmer mot de passe : </label>
        <input type="password" id="edit-passe2" name="passe2" value="" minlength=8 required><br> &nbsp;<br>

        <label for="edit-newsletter">Abonnement à la newsletter : </label>
        <input type="checkbox" id="edit-newsletter" name="newsletter" value=""><br>&nbsp;<br>

        <label for="edit-commentaire">Commentaire : </label>
        <textarea id="edit-commentaire" name="commentaire" placeholder="Laissez un commentaire" value="" size="60"></textarea><br>&nbsp;<br>

        <input type="submit" name="soumettre" value="Valider">&nbsp;<input type="reset" value="Annuler"> &nbsp;<br>
      </form>

    <?php }
    ?> 
    <br><a href="index.php">Retour à l'accueil</a>
  </body>
</html>
