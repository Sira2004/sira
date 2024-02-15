<?php 
   include_once('./../config/mysql.php');
   include_once('./../varriable.php');
   include_once('./../function.php');

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My-School/liste-des-cours</title>

</head>

<body onload="getCours('','')">
    <?php include_once('./../header.php')?>
    <main>

        <section id="actionResult" style="display: none;"></section>
        <!-- le filtrage de la liste -->
        <section class="m-auto container-fluid shadow shadow-sm p-4 d-flex justify-content-start">
            <form class="row row-cols-2 row-cols-md-auto h6">
                <!-- la case de filtrage pour la classe -->
                <div class="col">
                    <label class="form-label " for="classe">Classe</label>
                    <select name="classe" id="classe" class="form-select" onchange="filterClass()">
                        <option value="">Seletionner une classe</option>
                        <?php foreach ($listeClasses as $classe):?>
                        <option value="<?php echo $classe['classe_id']?>"><?php echo $classe['classe']?></option>
                        <?php endforeach?>
                    </select>

                </div>


                <!-- la case de filtrage pour le Professeur-->
                <div class="col">
                    <label class="form-label" for="prof">Professeurs</label>
                    <select class="form-select" name="prof" id="prof" onchange="filterProf()">
                        <option value="">Seletionner un prof</option>
                        <?php foreach ($listeProfesseurs as $prof):?>
                        <option value="<?php echo $prof['professeur_id']?>">
                            <?php echo getProf($prof['professeur_id'],$listeProfesseurs)?>
                        </option>
                        <?php endforeach?>
                    </select>
                </div>
                <!-- la case de filtrage pour la matiere-->
                <div class="col">
                    <label class="form-label" for="matiere">Matiere</label>
                    <select class="form-select" name="matiere" id="matiere" onchange="filterMatiere()">
                        <option value="">Seletionner une matiere</option>
                        <?php foreach ($listeMatiere as $matiere):?>
                        <option value="<?php echo $matiere['id']?>"><?php echo $matiere['nom']?></option>
                        <?php endforeach?>
                    </select>
                </div>

            </form>
        </section>
        <!-- la liste des classe -->
        <section class=" liste">
            <div class="container pt-5" id="listeCours">

            </div>
        </section>
    </main>

</body>
<script src="./../js/bootstrap.js"></script>
<script src="./../jquery-3.7.1.min.js"></script>
<script src="./cours.js"></script>

</html>