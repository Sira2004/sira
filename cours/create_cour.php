<?php include_once('./post_create_cour.php')?>

<!DOCTYPE html>
<html lang="fr">


<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My-School/Creer_un-Cour</title>
    <link rel="stylesheet" href="./../css/bootstrap.css" />
    <link rel="shortcut icon" href="./../icon/graduating-student.png" type="image/x-icon">

    <style>
    .formulaire {
        width: 60%;
        border-radius: 20px;
        padding: 40px;
    }

    .form-group {
        margin-bottom: 10px;
    }

    #addMatiere {
        background-color: var(--dashbordColor);
        color: var(--textDashbordColor) !important;
    }

    @media screen and (max-width:768px) {
        .formulaire {
            width: 90% !important;
        }
    }
    </style>
</head>

<body class="bg-ligth" onload="load()">
    <?php 
         include_once('./../header.php');
    ?>
    <main>
        <section class="result" id="validation">
            <?php if(isset($error)):?>


            <?php if($error==0):?>
            <div class="alert alert-warning alert-dismissible fade show position-absolute top-25" role="alert">
                <strong><img src="./../icon/failure.png" style="width: 20px;"> Echec : </strong>
                veuillez verifier les données du formulaire
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif?>

            <?php if($error==1):?>
            <div class="alert alert-warning alert-dismissible fade show position-absolute top-25" role="alert">
                <strong><img src="./../icon/failure.png" style="width: 20px;"> Echec:
                </strong>
                Ce cour existe dejà en classe de <?php echo getClasse($_POST['classe'],$listeClasses)?>
                <a href="./liste_cour.php" class="text-success">Voir La Liste</a>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif?>

            <?php if($error==2):?>
            <div class="alert alert-warning alert-dismissible fade show position-absolute top-25" role="alert">
                <strong><img src="./../icon/failure.png" style="width: 20px;"> Echec:
                </strong>
                Aucun professeur engagé pour la matère <?php echo getMatiere($_POST['matiere'],$listeMatiere)?>
                <a class="link link-info" href="./../professeur/create_professeur.php">Créer Un Professeur</a>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif?>

            <?php endif?>
            <?php if(isset($success) && isset($_POST['valider'])):?>
            <div class="alert alert-warning alert-dismissible fade show position-absolute top-25" role="alert">
                <strong><img src="./../icon/check.png" style="width: 20px;"> Succès: la matière
                    <?php echo @$_POST['nom']?> a été crée avec succès
                    <a href="./liste_cour.php" class="text-success">Voir La Liste</a>
                </strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif?>
        </section>



        <section class=" m-auto formulaire shadow shadow-lg " id="formulaire" style="color:var(--dashbordColor);">
            <div class="title p-3 text-center h3 shadow rounded-bottom rounded-circle"
                style="background-color:var(--dashbordColor);color:var(--textDashbordColor);">
                Création De Cours
            </div>
            <form class="form row h6" method="post" action="#" onsubmit="getCours()">
                <div class="form-group col col-6">
                    <label for="classe">Classe</label>
                    <select name="classe" id="classe" class="form-select">
                        <?php foreach ($listeClasses as $classe):?>
                        <option value="<?php echo $classe['classe_id']?>"><?php echo $classe['classe']?></option>
                        <?php endforeach?>
                    </select>
                </div>
                <div class="form-group col col-6">
                    <label for="matiere">Matière</label>
                    <select name="matiere" id="matiere" class="form-select " onselect="getProfesseur()">
                        <?php foreach ($listeMatiere as $matiere):?>
                        <option value="<?php echo $matiere['id']?>"
                            <?php echo($matiere['id']==@$_POST['matiere'])?'selected':'' ?>>
                            <?php echo $matiere['nom']?>
                        </option>
                        <?php endforeach?>
                    </select>
                </div>

                <div class="form-group col col-6">
                    <label for="prof">Professeur</label>
                    <select name="prof" id="prof" class="form-select ">

                    </select>
                </div>

                <div class="form-group col col-6">
                    <label for="coeficient">Coéficient</label>
                    <input class="form-control" type="number" name="coeficient" id="coeficient" max="10" min="1"
                        required value="<?php echo @$_POST['coeficient']?>" oninput="formatCoeficient()">

                </div>



                <div class="form-group">
                    <button type="submit" class="btn btn-primary m-10 border-0" name="valider"
                        style="width: 40%; background-color:var(--dashbordColor);color:var(--textDashbordColor);">Valider
                    </button>
                </div>
            </form>
        </section>

    </main>

    <script src="./../js/bootstrap.js"></script>
    <script src="./../jquery-3.7.1.min.js"></script>
    <script src="./cours.js"></script>
</body>


</html>