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
        if($_POST['atelierADD_nom'] && $_POST['atelierADD_texte'] && $_POST['atelierADD_etat'] && $_POST['atelierADD_id']){
            $requete4 = 'INSERT INTO t_atelier_ate (
                            VALUES(NULL, "'.$_POST['atelierADD_nom'].'", CURDATE(), "'.$_POST['atelierADD_texte'].'",
                             "'.$_POST['atelierADD_etat'].'", '.$_POST['atelierADD_id'].'));';
            $result4 = $mysqli->query($requete4);
            if ($result4 == false) //Erreur lors de l’exécution de la requête
            { // La requête a echoué
                echo "Error: La requête a echoué \n";
                echo "Errno: " . $mysqli->errno . "\n";
                echo "Error: " . $mysqli->error . "\n";
                exit();
            }
            header("Location:admin_ateliers.php");
        }else{
            echo("Veuillez Remplir les champs nécessaires.");
            echo "<br /><a href=\"./admin_ateliers.php\">Cliquez ici pour retourner sur la page d'administration des Pads.</a>";
        }
        //Fermeture de la communication avec la base MariaDB  
        $mysqli->close(); 
    ?>
</body>

</html>