<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My-School/Rechercher-Professeur</title>
    <link rel="stylesheet" href="./../css/bootstrap.css" />
    <link rel="shortcut icon" href="./../icon/graduating-student.png" type="image/x-icon" />
    <style>
    #note {
        background-color: var(--dashbordColor);
        color: var(--textDashbordColor) !important;
    }

    table {
        table-layout: fixed;
    }


    td,
    th {
        white-space: nowrap;
        width: 130px;
    }
    </style>
</head>

<body onload="load()">
    <?php include_once('./../header.php')?>

    <main class="p-3" >
        <!-- le filtrage de la liste -->
        <section class="my-4 m-auto container-fluid shadow shadow-sm p-1 d-flex justify-content-start overflow-auto">
            <form class="h6" style="white-space: nowrap;">
                <!-- la case de filtrage pour la classe -->
                <div class="d-inline-block">
                    <label class="form-label " for="classe">Classe</label>
                    <select name="classe" id="classe" class="form-select" onchange="getTrimestres()">
                        <?php foreach ($listeClasses as $classe):?>
                        <option value="<?php echo $classe['classe_id']?>"><?php echo $classe['classe']?></option>
                        <?php endforeach?>
                    </select>

                </div>


                <!-- la case de filtrage pour le Trimestre-->
                <div class="d-inline-block">
                    <label class="form-label" for="trimestre">Trimestre</label>
                    <select class="form-select" name="trimestre" id="trimestre" onchange="getEleves()">
                        <option value="0">Seletionner une Classe</option>
                    </select>
                </div>
                <!-- la case de filtrage pour la matière-->
                <div class="d-inline-block">
                    <label class="form-label" for="cour">Cours</label>
                    <select class="form-select" name="cour" id="cour" onchange="getEleves()">
                        <option value="">Seletionner une matiere</option>
                    </select>
                </div>

                <!-- la case de filtrage du nom-->
                <div class="d-inline-block">
                    <label class="form-label" for="nom">Nom</label>
                    <input type="text" name="nom" id="nom" class="form-control">
                </div>

            </form>
        </section>

        <!-- la liste des élèves -->
        <section class="container">
            <div class="container overflow-auto" id="listeEleves">

            </div>
        </section>

    </main>
    <script src="./note.js"></script>
    <script src=" ./../js/bootstrap.js"></script>
    <script src="./../jquery-3.7.1.min.js"></script>
    <script src="./../mask/src/jquery.mask.js"></script>


</body>

</html>