<!DOCTYPE html>

<head>
    <!--Boostrap Library CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!--Logos Library-->
    <script src="https://kit.fontawesome.com/8d098236d7.js" crossorigin="anonymous"></script>
    <!--JQuery Library-->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!--Boostrap Library JS-->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/navbar.css?v=1">
</head>

<body>

    <div class="container">
        <div class="row">
            <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
                <!--  Show this only on mobile to medium screens  -->
                <a class="nav-link d-lg-none" href="#" id="titre"><img class="img-responsive" src="images/LogoEPA.png">Ensemble Pour l'Afrique</a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span><i class="fas fa-grip-lines" style="color:white "></i></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#"> <i class="fas fa-home"> </i>Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Forum_Accueil.php"><i class="fas fa-comments"></i>Forum</a>
                        </li>
                    </ul>

                    <!--   Show this only lg screens and up   -->

                    <img class="img-responsive d-lg-block d-md-none d-sm-none d-sx-none" src="images/LogoEPA.png">

                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fas fa-sign-in-alt"></i> Connexion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fas fa-user-plus"></i>S'engager</a>
                        </li>

                    </ul>
                </div>
            </nav>
        </div>
    </div>
</body>

</html>