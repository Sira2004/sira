<?php 
    include_once('./../config/mysql.php');
    include_once('./../varriable.php');
    include_once('./../function.php');
?>






<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My-School/Confuguration-Elèves</title>
    <link rel="stylesheet" href="./css/eleve.css" />
    <link rel="shortcut icon" href="./../icon/graduating-student.png" type="image/x-icon" />
</head>

<body>
    <?php include_once('./../header.php')?>
    <main class="p-3 p-md-5">
        <section class="container">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 gy-3 gy-lg-5">
                <!-- le lien de création de professeur -->
                <div class="col">
                    <div class="card m-auto text-center card1" style="width: 15rem">
                        <img src="../icon/graduate-avatar.png" class="card-img-top mt-1" alt="..." />
                        <div class="card-body">
                            <p class="card-text">Création De Professeur</p>
                            <a href="./create_prefesseur.php" class="btn btn-outline-primary">Création De Prof</a>
                        </div>
                    </div>
                </div>

                <!-- le lien de recherche -->

                <div class="col">
                    <div class="card m-auto text-center card2" style="width: 15rem">
                        <img src="../icon/magnifying-glass.png" class="card-img-top mt-1" alt="..." />
                        <div class="card-body">
                            <p class="card-text">Recherche De Professeur</p>
                            <a href="./recherche_prof.php" class="btn btn-outline-info">RECHERCHER</a>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </main>
    <footer></footer>
    <script src="../js/bootstrap.js"></script>
</body>

</html>