<?php include_once('./post_recherche-eleve.php');?>

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
    </style>
</head>

<body>
    <?php include_once('./../header.php')?>

    <main class="">
        <!-- la section pour les informations generales sur les élèves -->
        <section class="d-flex justify-content-between">
            <div class="container  p-2 mb-2">
                <div class="row row-cols-auto gx-2 gx-lg-4">
                    <!-- le nombre total d'élève -->
                    <div class="col m-auto">
                        <div class="card  mb-3 border-0 shadow" style="width: 12rem">
                            <div class="card-body d-flex justify-content-between bg-white text-info">
                                <img src="./../icon/total-students.png" width="50px" />
                                <p class="card-text text-center d-inline">
                                    <?php echo ($students>1)? $students.' élèves':$students.' élève' ?>
                                </p>
                            </div>
                            <div class="card-footer border-0 bg-info ">
                                <p class="card-text h6">Total d'élève inscris</p>
                            </div>
                        </div>
                    </div>

                    <!-- le nombre total de garçons  -->
                    <div class="col m-auto">
                        <div class="card  mb-3 border-0 shadow" style="width: 12rem">
                            <div class="card-body d-flex justify-content-between bg-white text-info">
                                <img src="./../icon/boy-student.png" width="50px" />
                                <p class="card-text text-center d-inline">
                                    <?php echo ($boys>1)? $boys.' élèves':$boys.' élève' ?></p>
                            </div>
                            <div class="card-footer border-0 bg-info ">
                                <p class="card-text h6">Total garçons inscris</p>
                            </div>
                        </div>
                    </div>
                    <!-- le nombre total de fille -->
                    <div class="col m-auto">
                        <div class="card  mb-3 border-0 shadow" style="width: 12rem">
                            <div class="card-body d-flex justify-content-between bg-white text-info">
                                <img src="./../icon/female-student.png" width="50px" />
                                <p class="card-text text-center d-inline">
                                    <?php echo ($girls>1)? $girls.' élèves':$girls.' élève' ?></p>
                            </div>
                            <div class="card-footer border-0 bg-info ">
                                <p class="card-text h6">Total de filles inscris</p>
                            </div>
                        </div>
                    </div>

                    <!-- le nombre total de classe -->
                    <div class="col m-auto">
                        <div class="card  mb-3 border-0 shadow" style="width: 12rem">
                            <div class="card-body d-flex justify-content-between bg-white text-info">
                                <img src="./../icon/classroom.png" width="50px" />
                                <p class="card-text text-center d-inline">
                                    <?php echo ($classes>1)? $classes.' élèves':$classes.' élève' ?>
                                </p>
                            </div>
                            <div class="card-footer border-0 bg-info ">
                                <p class="card-text h6">Total de classe</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- le filtrage de la liste -->
        <section class="my-4 m-auto container-fluid shadow shadow-sm p-1 d-flex justify-content-around">
            <form class="row row-cols-2 row-cols-md-auto text-body" method="get">
                <!-- le filtrage à travers la classe -->
                <div class="col">
                    <label class="form-label " for="classe">Classe</label>
                    <select class="form-select" name="classe">

                        <option value=""></option>
                        <?php foreach($listeClasses as $classe): ?>
                        <option value="<?php echo $classe['classe_id']?>"
                            <?php  echo ($classe['classe_id']==@$_GET['classe'])?'selected':''?>>
                            <?php echo $classe['classe']?>
                        </option>
                        <?php endforeach?>

                    </select>
                </div>

                <!-- le filtrage à travers le sexe -->
                <div class="col">
                    <label class="form-label " for="sexe">Sexe</label>
                    <select class="form-select" name="sexe">
                        <option value=""></option>
                        <option value="M" <?php  echo (@$_GET['sexe']=="M")?'selected':''?>>M</option>
                        <option value="F" <?php  echo (@$_GET['sexe']=="F")?'selected':''?>>F</option>
                    </select>
                </div>

                <!-- le filtrage à travers le lieu de naissance -->
                <div class="col">
                    <label class="form-label " for="lieu_naiss">Lieu Naiss</label>
                    <input type="text" class="form-control" name="lieu_naiss" value="<?php echo @$_GET['lieu_naiss']?>">
                </div>

                <!-- le filtrage à travers le prenom -->
                <div class="col">
                    <label class="form-label " for="prenom">Prenom</label>
                    <input type="text" class="form-control" name="prenom" value="<?php echo @$_GET['prenom']?>">
                </div>

                <!-- le filtrage à travers le nom -->
                <div class="col">
                    <label class="form-label " for="nom">Nom</label>
                    <input type="text" class="form-control" name="nom" value="<?php echo @$_GET['nom']?>">
                </div>

                <!-- le bouton pour valider le filtrage -->
                <div class="col">
                    <label class="form-label disabled">Search</label>
                    <input type="submit" value="Chercher" name="chercher" class="btn btn-outline-info  form-control">
                </div>

            </form>
        </section>

        <!-- la liste des élèves -->
        <section class="container-fluid m-auto">
            <div class=" shadow-lg p-1 bg-info">
                <h5 class="text-light">Liste des élèves recherchés</h5>
                <h5>Liste des élèves recherchés</h5>
            </div>
            <div class="liste ">
                <table class="table table-responsive table-striped">
                    <thead class="text-info">
                        <tr>

                            <th>Prenom</th>
                            <th>Nom</th>

                            <th>Dt Naiss</th>
                            <th>Lieu Naiss</th>
                            <th>Sexe</th>
                            <th>Classe</th>

                            <th>
                                Details
                            </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($listeSearch as $eleve):?>
                        <tr>
                            <td><?php echo $eleve['prenom']?></td>
                            <td><?php echo $eleve['nom']?></td>
                            <td><?php echo $eleve['dat_naiss']?></td>
                            <td class="display-sm-none"><?php echo $eleve['lieu_naiss']?></td>
                            <td><?php echo $eleve['sexe']?></td>
                            <td><?php echo getClasse($eleve['classe_id'],$listeClasses)?> </td>
                            <td>
                                <button type="button" class="btn btn-outline-light active"
                                    onclick="ajax('<?php echo $eleve['eleve_id']?>') ">
                                    <img src="./../icon/eye-with-thick-outline-variant.png" style="width: 20px;" alt=""
                                        srcset="">
                                </button>
                            </td>


                        </tr>
                        <?php endforeach ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="<?php echo ($students>=1)?'text-success':'text-danger'?>">
                                <?php echo ($students>1)? $students.' élèves retrouvés':$students.' élève retrouvé' ?>
                                dans la recherche
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </section>
        <section id="details" style="display: none;"></section>
    </main>
    <script src="./eleve.js"></script>
    <script src=" ./../js/bootstrap.js"></script>
    <script src="./../jquery-3.7.1.min.js"></script>


</body>

</html>