<?php 
    include_once('./post_create_trimestre.php');
?>


<!DOCTYPE html>
<html lang="fr">


<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My-School/Creer_une_classe</title>
    <link rel="stylesheet" href="./../css/bootstrap.css" />
    <link rel="shortcut icon" href="./../icon/graduating-student.png" type="image/x-icon">

    <style>
    .formulaire {

        width: 50%;
        border-radius: 20px;
        padding: 40px;
    }

    .form-group {
        margin-bottom: 10px;
    }

    #addTrimestre {
        background-color: var(--dashbordColor);
        color: var(--textDashbordColor) !important;
    }

    @media screen and (max-width:576px) {
        .formulaire {
            width: 90% !important;
        }
    }
    </style>
</head>

<body class="bg-ligth" onload="getTotals()">
    <?php 
         include_once('./../header.php');
    ?>
    <main>
        <?php if(!empty($listeClasses)):?>
        <section class="result">
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
                Ce trimestre existe dejà en classe de <?php echo getClasse($_POST['classe'],$listeClasses)?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif?>

            <?php if($error==2):?>
            <div class="alert alert-warning alert-dismissible fade show position-absolute top-25" role="alert">
                <strong><img src="./../icon/failure.png" style="width: 20px;"> Echec:
                </strong>
                Aucune matère créee dans la classe de <?php echo getClasse($_POST['classe'],$listeClasses)?>
                <a class="link link-info" href="./../professeur/create_professeur.php">Créer Un Professeur</a>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif?>

            <?php endif?>
            <?php if(isset($success) && isset($_POST['valider'])):?>
            <div class="alert alert-warning alert-dismissible fade show position-absolute top-25" role="alert">
                <strong><img src="./../icon/check.png" style="width: 20px;"> Succès: la matière
                    <?php echo @$_POST['trimestre']?> a été crée avec succès
                </strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif?>
        </section>

        <section class=" m-auto formulaire shadow shadow-lg " style="color:var(--dashbordColor);">
            <div class="title p-3 text-center h3 shadow rounded-bottom rounded-circle"
                style="background-color:var(--dashbordColor);color:var(--textDashbordColor);">
                Création De Trimestre
            </div>
            <form class="form row h6" method="post" action="#">

                <div class="form-group col col-12">
                    <label for="trimestre">Nom Du Trimestre</label>
                    <input class="form-control" type="text" name="trimestre" id="trimestre"
                        value="<?php echo @$_POST['trimestre']?>" required>
                </div>

                <div class="form-group col col-12">
                    <label for="classe">Classe</label>
                    <select name="classe" id="classe" class="form-select" required onchange="getTotals()">
                        <?php foreach ($listeClasses as $classe):?>
                        <option value="<?php echo $classe['classe_id']?>"><?php echo $classe['classe']?></option>
                        <?php endforeach?>
                    </select>
                </div>

                <div class="form-group col col-6">
                    <label for="totalCoeficient">Coéficient Total</label>
                    <input class="form-control" type="number" name="totalCoeficient" id="totalCoeficient">


                </div>

                <div class="form-group col col-6">
                    <label for="totalMatiere">Nombre De Matière</label>
                    <input class="form-control" type="number" name="totalMatiere" id="totalMatiere">

                </div>



                <div class="form-group">
                    <button type="submit" class="btn btn-primary m-10 border-0" name="valider"
                        style="width: 40%; background-color:var(--dashbordColor);color:var(--textDashbordColor);">Valider
                    </button>
                </div>
            </form>
        </section>
        <!-- la liste des classe -->
        <section class=" liste mt-5">
            <div class="container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                Nom
                            </th>
                            <th>
                                Classe
                            </th>
                            <th>
                                Matières Totales
                            </th>
                            <th>
                                Coéficients Totals
                            </th>


                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach($listeTrimestres as $trimestre): ?>
                        <tr>

                            <td><?php echo $trimestre['trimestre']?></td>
                            <td><?php echo getClasse($trimestre['classe_id'],$listeClasses)?></td>
                            <td><?php echo $trimestre['totalMatiere']?></td>
                            <td><?php echo $trimestre['totalCoeficient']?></td>

                        </tr>
                        <?php endforeach?>
                        <tr>
                            <?php  if(isset($success)):?>
                            <td><?php echo $_POST['trimestre']?></td>
                            <td><?php echo getClasse($_POST['classe'],$listeClasses)?></td>
                            <td><?php echo $_POST['totalMatiere']?></td>
                            <td><?php echo $_POST['totalCoeficient']?></td>
                            <?php endif?>

                        </tr>


                    </tbody>
                </table>
            </div>
        </section>

        <!-- si la liste des classes est vide on nous dira de créer d'abord une classe -->


    </main>
    <?php else:?>
    <?php header('location:./../eleve/create_classe.php')?>
    <?php endif?>

    <script src="./../js/bootstrap.js"></script>
    <script src="./../jquery-3.7.1.min.js"></script>
    <script src="./trimestre.js"></script>


    <?php if(isset($success)):?>
    <?php 
    $trimestre=$_POST['trimestre'];
    $classe=$_POST['classe'];
    // la recherche de l'id du trimestre crée
    $mySchoolStatement=$mySchool->prepare("SELECT trimestre_id FROM trimestre WHERE trimestre='$trimestre' AND classe_id=$classe ");
    $mySchoolStatement->execute();
    $trimestre_id=$mySchoolStatement->fetch(PDO::FETCH_ASSOC)['trimestre_id'];

    // l'initialisation des notes
    $cours=getCours($classe,$listeCours);
    $eleves=getEleves($classe,$listeEleves);

    foreach($cours as $cour){
        $cour_id=$cour['cour_id'];
        foreach($eleves as $eleve)
        {
            $eleve_id=$eleve['eleve_id'];
        $query=" INSERT INTO note (eleve_id,classe_id,trimestre_id,cour_id)
        VALUE ($eleve_id,$classe,$trimestre_id,$cour_id)";
        $mySchoolStatement=$mySchool->prepare($query);
        $mySchoolStatement->execute();
        }


    }
    ?>
    <?php endif?>
</body>


</html>