<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Association SPA - Connexion</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Flaticon Font -->
    <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <?php
        $mysqli = new mysqli(''); // Connexion BDD
        if ($mysqli->connect_errno)
        {
        // Affichage d'un message d'erreur
        echo "Error: Problème de connexion à la BDD \n";
        echo "Errno: " . $mysqli->connect_errno . "\n";
        echo "Error: " . $mysqli->connect_error . "\n";
        // Arrêt du chargement de la page
        exit();
        }
        // Instructions PHP à ajouter pour l'encodage utf8 du jeu de caractères
        if (!$mysqli->set_charset("utf8")) {
            printf("Pb de chargement du jeu de car. utf8 : %s\n", $mysqli->error);
            exit();
        }
	
    ?>

    <?php
        //Ouverture d'une session
        session_start();
        /*Affectation dans des variables du pseudo/mot de passe s'ils existent,
        affichage d'un message sinon*/
        if ($_POST["pseudo"]){
            $pseudo=$_POST["pseudo"];
            $sql='SELECT * FROM t_profil_pro WHERE com_pseudo="'.$pseudo.'";';
            echo($sql);
            /* Exécution de la requête pour vérifier si le compte (=pseudo+mdp) existe !*/
            $resultat = $mysqli->query($sql);
            if ($resultat==false) {
                // La requête a echoué
                echo "Error: Problème d'accès à la base \n";
                exit();
            }
            else {
                /* A NOTER : si on a complété la requête n° 1) proposée, on peut aussi
                récupérer et tester la validité du profil, en faisant, par exemple :*/
                $ligne=$resultat->fetch_assoc();
                
                /* Dans le cas de la requête n° 1) non complétée ou n° 1bis), on teste si
                une ligne de résultat a été renvoyée, c'est à dire si le compte
                existe bien (n° 1)) et est activé (n° 1bis)) :
                */
                if($resultat->num_rows == 1) {
                    //Mise à jour des données de la session
                    /* A prévoir et finaliser : récupérer puis vérifier
                    le rôle du profil dans la base MariaDB,
                    puis affecter la valeur du rôle à $_SESSION['role']*/
                    if ($ligne['pro_validite']=='A'){
                        $role = 'D';
                    }else{
                        $role = 'A';
                    }
                    $requete2 = 'UPDATE t_profil_pro set pro_validite ="'.$role.'" WHERE com_pseudo="'.$pseudo.'";';
                    $result2 = $mysqli->query($requete2);
                    if ($result2 == false) //Erreur lors de l’exécution de la requête
                    { // La requête a echoué
                        echo "Error: La requête a echoué \n";
                        echo "Errno: " . $mysqli->errno . "\n";
                        echo "Error: " . $mysqli->error . "\n";
                        exit();
                    }
                    
                    /* Redirection vers la page autorisée à cet utilisateur
                    ATTENTION !! Ne pas mettre d'appel d'echo() / de balise HTML
                    au-dessus de header() dans cette condition */
                    header("Location:admin_accueil.php");
                }
                else{
                    // aucune ligne retournée
                    // => le compte n'existe pas ou n'est pas valide
                    echo("Erreur");
                    echo "<br /><a href=\"./admin_accueil.php\">Cliquez ici pour réafficher
                    le formulaire</a>";
                }
                //Fermeture de la communication avec la base MariaDB
                $mysqli->close();   
            }
        }
    ?>
</body>

</html>