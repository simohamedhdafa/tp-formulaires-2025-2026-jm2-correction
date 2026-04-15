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

        <?php if (empty($erreurs) && $_SERVER['REQUEST_METHOD'] === 'POST'): ?>

            <!-- Fiche de confirmation ici (étape 7.b) -->
            <h1>Candidature reçue !</h1>
            <ul>
                <li><?php echo "$nom $prenom"; ?></li>
                <li><?php echo $email; ?></li>
                <li><?php echo $age; ?></li>
                <li><?php echo $filiere; ?></li>
                <li>
                    <p><?php echo $motivation; ?></p>
                </li>
                <p>Votre candidature a bien été enregistrée. Nous vous contacterons à l'adresse indiquée.</p>
            </ul>
            <a href="candidature.php">Nouvelle candidature</a>

        <?php else: ?>
            <?php if($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
                <?php if (!empty($erreurs)): ?>
                    <ul class="erreurs">
                        <?php foreach ($erreurs as $e): ?>
                            <li><?php echo $e; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            <?php endif; ?>
            <!-- Formulaire (étape 2) -->
            <form action="candidature.php" method="post">
                <label>Prénom</label>
                <input type="text" name="prenom" value="<?php echo $prenom; ?>">
                <label>Nom</label>
                <input type="text" name="nom" value="<?php echo $nom; ?>">
                <label>Adresse email</label>
                <input type="email" name="email" value="<?php echo $email; ?>">
                <label>Âge</label>
                <input type="number" name="age" value="<?php echo $age; ?>">
                <label>Filière souhaitée</label>
                <select name="filiere">
                    <option value="">--Choisir--</option>
                    <option value="mathematiques"<?php echo ($filiere === 'mathematiques') ? 'selected' : ''; ?>>Mathématiques</option>
                    <option value="informatique" <?php echo ($filiere === 'informatique') ? 'selected' : ''; ?>>Informatique</option>
                    <option value="electronique" <?php echo ($filiere === 'electronique') ? 'selected' : ''; ?>>Electronique</option>
                    <option value="mecanique" <?php echo ($filiere === 'mecanique') ? 'selected' : ''; ?>>Mécanique</option>
                    <option value="autre" <?php echo ($filiere === 'autre') ? 'selected' : ''; ?>>Autre</option>
                </select>
                <label>Lettre de motivation</label>
                <textarea name="motivation"><?php echo $motivation; ?></textarea>
                <label>J'ai lu et j'accepte le règlement du club.</label>
                <input type="checkbox" name="reglement" value="1" <?php echo $reglement ? 'checked' : ''; ?>>
                <input type="submit" value="Envoyer ma candidature">
            </form>

        <?php endif; ?>

    </div>
    
</body>
</html>