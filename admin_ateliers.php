<!DOCTYPE html>
<?php
    /* Vérification ci-dessous à faire sur toutes les pages dont l'accès est
    autorisé à un utilisateur connecté. */
    session_start();
    if(!isset($_SESSION['login'])) //A COMPLETER pour tester aussi le rôle...
    {
        //Si la session n'est pas ouverte, redirection vers la page du formulaire
        header("Location:session.php");
    }
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Association SPA - Gestion Pads & Ateliers</title>
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
<style>

    .EspAdmin{
        width: 90%;
        height: auto;
        display: flex;
        flex-direction: column;
        background-color: white;
        align-items: center;
        justify-content: center;
    }
    th, td {
        border: solid;
        border-color: grey;
        width: auto;
        height: 40px;
        text-align: center;
    }
    th{
        background-color: #ED6436;
    }
    h6 {
        font-size: 14pt;
        color: white;
    }
</style>

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
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-2 px-lg-5">
            <div class="col-lg-6 text-center text-lg-left mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center">
                    <a class="text-white pr-3" href="">FAQs</a>
                    <span class="text-white">|</span>
                    <a class="text-white px-3" href="">Aide</a>
                    <span class="text-white">|</span>
                    <a class="text-white pl-3" href="">Support</a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-white px-3" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-white px-3" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-white px-3" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-white px-3" href="">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-white pl-3" href="">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row py-3 px-lg-5">
            <div class="col-lg-4">
                <a href="" class="navbar-brand d-none d-lg-block">
                    <h1 class="m-0 display-5 text-capitalize"><span class="text-primary">Association</span> SPA</h1>
                </a>
            </div>
            <div class="col-lg-8 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <div class="d-inline-flex flex-column text-center pr-3 border-right">
                        <h6>Heure D'ouverture</h6>
                        <p class="m-0">8 heures à 19 heures</p>
                    </div>
                    <div class="d-inline-flex flex-column text-center px-3 border-right">
                        <h6>Envoyez-nous un email</h6>
                        <p class="m-0">SPA@example.com</p>
                    </div>
                    <div class="d-inline-flex flex-column text-center pl-3">
                        <h6>Appelez-Nous</h6>
                        <p class="m-0">+35 2 00 00 00 00</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-lg-5">
            <a href="" class="navbar-brand d-block d-lg-none">
                <h1 class="m-0 display-5 text-capitalize font-italic text-white"><span class="text-primary"><?php echo($asso['con_nom']);?></span></h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                <div class="navbar-nav mr-auto py-0">
                    <a href="admin_accueil.php" class="nav-item nav-link">Accueil & Profil</a>
                    <a href="admin_ateliers.php" class="nav-item nav-link">Gestion Pads & Ateliers</a>
                </div>
            </div>
            <?php
                echo('<form action="deconnection.php">');
                    echo('<button type="submit" class="btn btn-lg btn-primary px-3 d-none d-lg-block">Se Déconnecter</button>');
                echo('</form>');
            ?>
        </nav>
    </div>
    <!-- Navbar End -->


    <!-- Connected Start -->
    <div class="container py-5">
        <div class="row py-5">
            <div class="EspAdmin">
                <h1>ESPACE ADMINISTRATION</h1>
                <br>
                <?php
                    // Supprimer un atelier
                    echo('<div class=Gestion_atelier>');
                        echo('<h4>Suprimer un atelier : </h4>');
                        echo('<form action="admin_ateliers_action_del.php" method="POST">');
                            echo('<input type="text" placeholder="Entrez le nom d'."'".'un atelier" name="atelierSUP"/>');

                            echo('<button type="submit" class="btn btn-default" name="desactive"><h5>Supprimer</h5></button>');
                        echo("</form>");
                    echo('</div>');
                ?>
                <br>
                <?php
                    echo('<div class=Gestion_atelier>');
                        echo('<h4>Ajouter un atelier : </h4>');
                        echo('<form action="admin_ateliers_action_add.php" method="POST">');
                            echo('<h5>L'."'".'intitulé : </h5>');
                            echo('<input type="text" placeholder="Entrez le nom d'."'".'un atelier" name="atelierADD_nom"/>');
                            echo('<br>');
                            echo('<h5>Texte : </h5>');
                            echo('<input type="text" placeholder="Entrez le texte de l'."'".'atelier" name="atelierADD_texte"/>');
                            echo('<br>');
                            echo('<h5>Etat (Publié "P" ou Caché "C") : </h5>');
                            echo('<input type="text" placeholder="Entrez l'."'".'état de l'."'".'atelier" name="atelierADD_etat"/>');
                            echo('<br>');
                            echo('<h5>ID : </h5>');
                            echo('<input type="text" placeholder="Entrez l'."'".'identifiant de l'."'".'atelier" name="atelierADD_id"/>');
                            echo('<br>');
                            echo('<button type="submit" class="btn btn-default" name="desactive"><h5>Ajouter</h5></button>');
                        echo("</form>");
                    echo('</div>');
                ?>
                <br>
                <h4>Listes des Pads et ateliers :</h4>

                <?php
                    $requete3 = 'SELECT * FROM t_pad_activite_pad LEFT OUTER JOIN t_atelier_ate USING (pad_id)
                     LEFT OUTER JOIN t_ressource_res USING (ate_id);';
                    $result3 = $mysqli->query($requete3);
                    if ($result3 == false) //Erreur lors de l’exécution de la requête
                    { // La requête a echoué
                        echo "Error: La requête a echoué \n";
                        echo "Errno: " . $mysqli->errno . "\n";
                        echo "Error: " . $mysqli->error . "\n";
                        exit();
                    }

                    echo('<table class="profilUser">');
                            echo("<tr>");
                                echo("<th><h6>Pad</h6></th>");
                                echo("<th><h6>Animat-eur(s)/trice(s)</h6></th>");
                                echo("<th><h6>Atelier</h6></th>");
                                echo("<th><h6>Ressources</h6></th>");
                            echo('</tr>');
                    while($pad_ate_res = $result3->fetch_assoc()){
                        echo('<tr>');
                            echo("<td>".$pad_ate_res['pad_intitule']."</td>");
                            echo("<td>");
                            
                            $requete4 = 'SELECT * FROM t_associe_asc
                            WHERE pad_id='.$pad_ate_res['pad_id'].';';
                            $result4 = $mysqli->query($requete4);
                            if ($result4 == false) //Erreur lors de l’exécution de la requête
                            { // La requête a echoué
                                echo "Error: La requête a echoué \n";
                                echo "Errno: " . $mysqli->errno . "\n";
                                echo "Error: " . $mysqli->error . "\n";
                                exit();
                            }
                            while($pseudo = $result4->fetch_assoc()){
                                echo($pseudo['com_pseudo']);
                                echo("<br>");
                            }
                            echo("</td>");
                            echo("<td>".$pad_ate_res['ate_intitule']."</td>");
                            echo("<td>".$pad_ate_res['res_titre']."</td>");
                        echo('</tr>');
                    }
                    echo('</table>');
                    $mysqli->close();
                ?>
            </div>
        </div>
    </div>
    <!-- Connected End -->

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white py-5 px-sm-3 px-md-5">
        <div class="row pt-5">
            <div class="col-lg-4 col-md-12 mb-5">
                <h1 class="mb-3 display-5 text-capitalize text-white"><span class="text-primary">Association</span> SPA</h1>
                <p class="m-0">Ipsum amet sed vero et lorem stet eos ut, labore sed sed stet sea est ipsum ut. Volup amet ea sanct ipsum, dolore vero lorem no duo eirmod. Eirmod amet ipsum no ipsum lorem clita ut. Ut sed sit lorem ea lorem sed, amet stet sit sea ea diam tempor kasd kasd. Diam nonumy etsit tempor ut sed diam sed et ea</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="text-primary mb-4">Entrez En Contact</h5>
                        <p><i class="fa fa-map-marker-alt mr-2"></i>16 rue, Rennes, France</p>
                        <p><i class="fa fa-phone-alt mr-2"></i>+35 2 00 00 00 00</p>
                        <p><i class="fa fa-envelope mr-2"></i>SPA@example.com</p>
                        <div class="d-flex justify-content-start mt-4">
                            <a class="btn btn-outline-light rounded-circle text-center mr-2 px-0" style="width: 36px; height: 36px;" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light rounded-circle text-center mr-2 px-0" style="width: 36px; height: 36px;" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light rounded-circle text-center mr-2 px-0" style="width: 36px; height: 36px;" href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-outline-light rounded-circle text-center mr-2 px-0" style="width: 36px; height: 36px;" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-primary mb-4">Liens populaires</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-white mb-2" href="index.html"><i class="fa fa-angle-right mr-2"></i>Accueil</a>
                            <a class="text-white mb-2" href="about.html"><i class="fa fa-angle-right mr-2"></i>À propos de nous</a>
                            <a class="text-white mb-2" href="service.html"><i class="fa fa-angle-right mr-2"></i>Nos services</a>
                            <a class="text-white" href="#"><i class="fa fa-angle-right mr-2"></i>Contactez-nous</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-primary mb-4">Newsletter</h5>
                        <form action="">
                            <div class="form-group">
                                <input type="text" class="form-control border-0" placeholder="Votre Nom" required="required" />
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control border-0" placeholder="Votre Email" required="required" />
                            </div>
                            <div>
                                <button class="btn btn-lg btn-primary btn-block border-0" type="submit">Soumettre</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid text-white py-4 px-sm-3 px-md-5" style="background: #111111;">
        <div class="row">
            <div class="col-md-6 text-center text-md-left mb-3 mb-md-0">
                <p class="m-0 text-white">
                    &copy; <a class="text-white font-weight-bold" href="#">Your Site Name</a>. All Rights Reserved. Designed by
                    <a class="text-white font-weight-bold" href="https://htmlcodex.com">HTML Codex</a>
                </p>
            </div>
            <div class="col-md-6 text-center text-md-right">
                <ul class="nav d-inline-flex">
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">Privacy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">Terms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">FAQs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">Help</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>