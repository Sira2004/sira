<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My-School/Rechercher-Professeur</title>
    <link rel="stylesheet" href="./../css/bootstrap.css" />
    <link rel="shortcut icon" href="./../icon/graduating-student.png" type="image/x-icon" />
    <style>
    #searchProf {
        background-color: var(--dashbordColor);
        color: var(--textDashbordColor) !important;
    }
    </style>
</head>

<body onload="searchProfs()">
    <?php include_once('./../header.php')?>

    <main class=" p-3">
        <!-- le filtrage de la liste -->
        <section class="my-4 m-auto container-fluid shadow shadow-sm d-flex justify-content-start">
            <form class="row row-cols-2 row-cols-md-4 text-body" id="searchProfs">


                <!-- la case de filtrage pour le prenom -->
                <div class="col">
                    <label class="form-label " for="prenom">Prenom</label>
                    <input type="text" class="form-control" name="prenom" id="prenom" oninput="searchProfs()">
                </div>

                <!-- la case de filtrage pour le nom -->
                <div class="col">
                    <label class="form-label " for="nom">Nom</label>
                    <input type="text" class="form-control" name="nom" id="nom" oninput="searchProfs()">
                </div>


                <!-- la case de filtrage pour le diplôme -->
                <div class="col">
                    <label class="form-label " for="diplome">Diplôme</label>
                    <input name="diplome" id="diplome" class="form-control" id="diplome" oninput="searchProfs()">



                </div>


                <!-- la case de filtrage pour la spécialité -->
                <div class="col">
                    <label class="form-label " for="specialite">Specialité</label>
                    <select class="form-select" name="specialite" id="specialite" onchange="searchProfs()">
                        <option value=""></option>
                        <?php foreach($listeMatiere as $matiere): ?>
                        <option value="<?php echo $matiere['id']?>">
                            <?php echo $matiere['nom']?>
                        </option>
                        <?php endforeach?>

                    </select>
                </div>



            </form>
        </section>

        <!-- la liste des élèves -->
        <section class="container-fluid m-auto mt-5">
            <div class="title p-1 text-center h3 shadow rounded-bottom rounded-circle"
                style="background-color:var(--dashbordColor) ;color:var(--textDashbordColor);">
                Liste De Recherche
                <div class="containter text-start">

                    <a href="<?php echo $rootUrl?>professeur/create_professeur.php" class=" btn btn-success">
                        <i class="bi bi-file-plus"></i> Ajouter
                    </a>
                </div>
            </div>
            <div id="listeProfs">

            </div>
        </section>
        <section id="details" style="display: none;">

        </section>

        <script src="./prof.js"></script>
        <script src=" ./../js/bootstrap.js"></script>
        <script src="./../jquery-3.7.1.min.js"></script>
        <script src="./../mask/src/jquery.mask.js"></script>



</body>

</html>