<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/profil.css" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profil</title>
</head>
<body class="nom">
    <!--include du header-->
<?php include "header.php";?>

<?php
//Connexion à la BDD
session_start();
if (isset($_SESSION['user_name'])) {
    $bdd = new PDO('mysql:host=localhost;dbname=cesi_bde;charset=utf8', 'root', '');
    $email = (array) $_SESSION['email'];
//Requête et exécution
    $requete = $bdd->prepare("CALL profil(:email)");
    $requete->bindValue(':email', $email['email'], PDO::PARAM_STR);
    $requete->execute();
    $profil = $requete->fetchAll();
    $a = 2;
//Affiche les données de ton profil stockées dans la BDD
    foreach ($profil as $profil_content) {
        echo '<h1>' . $profil_content['Prenom'] . ' ' . $profil_content['Nom'] . '</h1>';
        //Affiche les différentes possibilités en fonction de ton rôle
        while ($a < 6) {
            echo $profil_content[$a];
            $a += 1;
            if ($a < 6) {
                echo ' | ';
            }
        }
        switch ($profil_content['role']) {
            case "etudiant":
                break;
            case "membre du BDE":
                echo '
                <div class="btn-toolbar barre" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-group mr-2" role="group" aria-label="First group">
                        <a class="btn btn-secondary" href="delevent.php?var=" role="button">Supprimer evenement</a>
                        <a class="btn btn-secondary" href="createevent.php?var=" role="button">Creer evenement</a>
                        <a class="btn btn-secondary" href="updateevent.php?var=" role="button">Modifier evenement</a>
                        <a class="btn btn-secondary" href="pastevent.php?var=" role="button">Mettre un evenement passé</a>
                        <a class="btn btn-secondary" href="liste_participant.php" role="button">Liste des participants</a>
                        <a class="btn btn-secondary" href="delArticle.php" role="button">Supprimer un article</a>
                        <a class="btn btn-secondary" href="addArticle.php" role="button">Ajoutez un article</a>
                    </div>';
                break;
            case "membre du personnel":
                echo '
                <div class="btn-toolbar barre" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-group mr-2" role="group" aria-label="First group">
                        <a class="btn btn-secondary" href="change_statut.php?var=" role="button">Rendre un evenement privé</a>
                        <a class="btn btn-secondary" href="telecharger_photo.php" role="button">Telecharger photo</a>
                        <a class="btn btn-secondary" href="delArticle.php" role="button">Supprimer un article</a>
                        <a class="btn btn-secondary" href="addArticle.php" role="button">Ajoutez un article</a>
                    </div>';
                break;
        }
    }
    #affiche un lien vers la page profil et la page deconnexion
    echo '
        <div class="btn-group deconnexion" role="group" aria-label="Second group">
            <a class="btn btn-secondary" href="/www/assets/php/deconnexion.php" role="button">Deconnexion</a>
        </div>
    </div>';
} else {
    #affiche un lien vers la page de connexion et d'inscription
    echo '
    <div class="btn-toolbar barre" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group mr-2" role="group" aria-label="First group">
            <a class="btn btn-secondary" href="/www/assets/php/connexion.php?var=" role="button">Connexion</a>
            <a class="btn btn-secondary" href="/www/assets/php/inscription.php?var=" role="button">Inscription</a>
        </div>
    </div>';
}
#include du footer
?>

    <footer class="bot">
        <?php include "./footer.php";?>
    </footer>
</body>
</html>