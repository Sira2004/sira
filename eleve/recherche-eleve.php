<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My-School/Rechercher-Eleve</title>
    <link rel="stylesheet" href="./../css/bootstrap.css" />
    <link rel="shortcut icon" href="./../icon/graduating-student.png" type="image/x-icon" />
    <style>
    #search {
        background-color: var(--dashbordColor);
        color: var(--textDashbordColor) !important;
    }

    table {
        table-layout: fixed;
    }


    td,
    th {
        white-space: nowrap;
        width: 100px;
    }
    </style>
</head>

<body onload="searchEleves()">
    <?php include_once('./../header.php')?>

    <main style="min-height: 100vh;">

        <!-- le filtrage de la liste -->
        <section class=" m-auto container-fluid shadow shadow-sm d-flex justify-content-start overflow-auto">
            <form class="text-body my-4" style="white-space: nowrap;" method="get">
                <!-- le filtrage à travers la classe -->
                <div class="d-inline-block px-1">
                    <label class="form-label " for="classe">Classe</label>
                    <select class="form-select" name="classe" id="classe" onchange="searchEleves()">

                        <option value=""></option>
                        <?php foreach($listeClasses as $classe): ?>
                        <option value="<?php echo $classe['classe_id']?>">
                            <?php echo $classe['classe']?>
                        </option>
                        <?php endforeach?>

                    </select>
                </div>

                <!-- le filtrage à travers le sexe -->
                <div class="d-inline-block px-1">
                    <label class="form-label " for="sexe">Sexe</label>
                    <select class="form-select" name="sexe" id="sexe" onchange="searchEleves()">
                        <option value=""></option>
                        <option value="M">M</option>
                        <option value="F">F</option>
                    </select>
                </div>

                <!-- le filtrage à travers le lieu de naissance -->
                <div class="d-inline-block px-1">
                    <label class="form-label " for="lieu_naiss">Lieu Naiss</label>
                    <input type="text" class="form-control" name="lieu_naiss" id="lieu_naiss" oninput="searchEleves()">
                </div>

                <!-- le filtrage à travers le prenom -->
                <div class="d-inline-block px-1">
                    <label class="form-label " for="prenom">Prenom</label>
                    <input type="text" class="form-control" name="prenom" id="prenom" oninput="searchEleves()">
                </div>

                <!-- le filtrage à travers le nom -->
                <div class="d-inline-block px-1">
                    <label class="form-label " for="nom">Nom</label>
                    <input type="text" class="form-control" name="nom" id="nom" oninput="searchEleves()">
                </div>

            </form>
        </section>

        <!-- la liste des élèves -->
        <section class="container-fluid w-100 m-auto mt-5">
            <div class="title p-1 text-center h3 shadow rounded-bottom rounded-circle"
                style="background-color:var(--dashbordColor) ;color:var(--textDashbordColor);">
                Liste De Recherche
                <div class="containter text-start">

                    <a href="<?php echo $rootUrl?>eleve/inscription_eleve.php" class=" btn btn-success">
                        <i class="bi bi-file-plus"></i> Ajouter
                    </a>
                </div>
            </div>
            <div id="listeEleves" class="container overflow-auto">

            </div>
        </section>
        <!-- le resultat des actions -->
        <section id="details" style="display: none;"></section>
    </main>
    <script src="./eleve.js"></script>
    <script src=" ./../js/bootstrap.js"></script>
    <script src="./../jquery-3.7.1.min.js"></script>


</body>

</html>