<?php include_once('./post_recherche_prof.php');?>

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

<body>
    <?php include_once('./../header.php')?>

    <main class=" p-3">
        <!-- le filtrage de la liste -->
        <section class="my-4 m-auto container-fluid shadow shadow-sm p-1 d-flex justify-content-around">
            <form class="row row-cols-2 row-cols-md-auto text-body" method="get">


                <!-- la case de filtrage pour le prenom -->
                <div class="col">
                    <label class="form-label " for="prenom">Prenom</label>
                    <input type="text" class="form-control" name="prenom" value="<?php echo @$_GET['prenom']?>">
                </div>

                <!-- la case de filtrage pour le nom -->
                <div class="col">
                    <label class="form-label " for="nom">Nom</label>
                    <input type="text" class="form-control" name="nom" value="<?php echo @$_GET['nom']?>">
                </div>


                <!-- la case de filtrage pour le diplôme -->
                <div class="col">
                    <label class="form-label " for="diplome">Diplôme</label>
                    <select name="diplome" id="diplome" class="form-select">
                        <option value=""></option>
                        <option value="DEF" <?php  echo (@$_GET['diplome']=="DEF")?'selected':''?>>DEF</option>
                        <option value="BAC" <?php  echo (@$_GET['diplome']=="BAC")?'selected':''?>>BAC</option>
                        <option value="lICENCE" <?php  echo (@$_GET['diplome']=="LICENCE")?'selected':''?>>LICENCE
                        </option>
                        <option value="MAITRISE" <?php  echo (@$_GET['diplome']=="MAITRISE")?'selected':''?>>
                            MAITRISE</option>
                        <option value="MASTER" <?php  echo (@$_GET['diplome']=="MASTER")?'selected':''?>>MASTER
                        </option>
                        <option value="DOCTORAT" <?php  echo (@$_GET['diplome']=="DOCTORAT")?'selected':''?>>
                            DOCTORAT</option>
                    </select>
                </div>


                <!-- la case de filtrage pour la spécialité -->
                <div class="col">
                    <label class="form-label " for="specialite">Specialité</label>
                    <select class="form-select" name="specialite">

                        <option value=""></option>
                        <?php foreach($listeMatiere as $matiere): ?>
                        <option value="<?php echo $matiere['id']?>">
                            <?php echo $matiere['nom']?>
                        </option>
                        <?php endforeach?>

                    </select>
                </div>

                <!-- le bouton de validation -->
                <div class="col">
                    <label class="form-label disabled">Search</label>
                    <input type="submit" value="Chercher" name="chercher" class="btn btn-outline-dark form-control">
                </div>

            </form>
        </section>

        <!-- la liste des élèves -->
        <section class="container-fluid m-auto mt-5">
            <div class="p-1">
                <h5 class="text-center">Liste de recherche</h5>

            </div>
            <div class="liste">
                <table class="table table-responsive table-striped table-bordered">
                    <thead class="">
                        <tr>

                            <th>Prenom</th>
                            <th>Nom</th>
                            <th>Lieu Naiss</th>
                            <th>Sexe</th>
                            <th>Diplôme</th>
                            <th>Specialité</th>
                            <th> Details </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($listeSearch as $professeur):?>
                        <tr>
                            <td><?php echo $professeur['prenom']?></td>
                            <td><?php echo $professeur['nom']?></td>

                            <td class="display-sm-none"><?php echo $professeur['lieu_naiss']?></td>
                            <td><?php echo $professeur['sexe']?></td>
                            <td><?php echo $professeur['diplome']?> </td>
                            <td><?php echo getMatiere($professeur['specialite_id'],$listeMatiere)?> </td>
                            <td>
                                <button type="button" class="btn btn-outline-light active"
                                    onclick="see('<?php echo $professeur['professeur_id']?>') ">
                                    <img src="./../icon/eye-with-thick-outline-variant.png" style="width: 20px;" alt=""
                                        srcset="">
                                </button>
                            </td>


                        </tr>
                        <?php endforeach ?>
                    </tbody>

                    <caption class="<?php echo ($students>=1)?'text-success':'text-danger'?>">
                        <?php if(isset($profs)):?>
                        <?php echo ($profs>1)? $profs.' professeurs retrouvés':$profs.' professeur retrouvé' ?>
                        dans la recherche
                        <?php else : ?>
                        la liste est vide
                        <?php endif?>
                    </caption>

                </table>
            </div>
        </section>
        <section id="details" style="display: none;">

        </section>

        <script src="./prof.js"></script>
        <script src=" ./../js/bootstrap.js"></script>
        <script src="./../jquery-3.7.1.min.js"></script>


</body>

</html>