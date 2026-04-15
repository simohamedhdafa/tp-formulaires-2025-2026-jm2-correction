<?php
    $prenom    = '';
    $nom       = '';
    $email     = '';
    $age       = '';
    $filiere   = '';
    $motivation = '';
    $reglement = '';
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
    
    // Exemple pour le prénom
    if (empty($prenom)) {
        $erreurs[] = "Le prénom est obligatoire.";
    }

    // Exemple pour le nom
    if (empty($nom)) {
        $erreurs[] = "Le nom est obligatoire.";
    }

    // Exemple pour l'email
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs[] = "L'adresse email est invalide.";
    }

    // À vous d'écrire les 5 règles restantes sur le même modèle
    // l'âge doit être un nombre compris entre 16 et 30
    if(empty($age) || !is_numeric($age) || $age<16 || $age>30){
        $erreurs[] = "L'âge doit être un nombre entre 16 et 30.";
    }

    if(empty($filiere)){ //  !in_array($filiere, ["informatiquie", "mathematiques", ...])
        $erreurs[] = "Veuillez choisir une filière.";
    }

    if(strlen($motivation)<30){
        $erreurs[] = "La motivation doit contenir au moins 30 caractères.";
    }

    if(!$reglement){
        $erreurs[] = "Vous devez accepter le règlement.";
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