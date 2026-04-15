<?php
    $prenom    = '';
    $nom       = '';
    $email     = '';
    $age       = '';
    $filiere   = '';
    $motivation = '';
    $erreurs   = [];

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        /*
        echo '<pre>';
        print_r($_POST);
        echo '</pre>';
        */
        $prenom     = $_POST['prenom']     ?? '';
        $nom        = $_POST['nom']        ?? '';
        $email      = $_POST['email']      ?? '';
        $age        = $_POST['age']        ?? '';
        $filiere    = $_POST['filiere']    ?? '';
        $motivation = $_POST['motivation'] ?? '';
        $reglement = isset($_POST['reglement']);
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Correction TP formulaires</title>
</head>
<body>
    <div class="container">
        <form action="candidature.php" method="post">
            <label>Prénom</label>
            <input type="text" name="prenom">
            <label>Nom</label>
            <input type="text" name="nom">
            <label>Adresse email</label>
            <input type="email" name="email">
            <label>Âge</label>
            <input type="number" name="age">
            <label>Filière souhaitée</label>
            <select name="filiere">
                <option value="">--Choisir--</option>
                <option value="mathematiques">Mathématiques</option>
                <option value="informatique">Informatique</option>
                <option value="electronique">Electronique</option>
                <option value="mecanique">Mécanique</option>
                <option value="autre">Autre</option>
            </select>
            <label>Lettre de motivation</label>
            <textarea name="motivation"></textarea>
            <label>J'ai lu et j'accepte le règlement du club.</label>
            <input type="checkbox" name="reglement" value="1">
            <input type="submit" value="Envoyer ma candidature">
        </form>
    </div>
    
</body>
</html>