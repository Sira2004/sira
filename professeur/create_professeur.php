<?php include_once('./post_create_professeur.php')?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My-School/Creation-Professeur</title>
    <link rel="stylesheet" href="./../css/bootstrap.css" />
    <link rel="shortcut icon" href="./../icon/graduating-student.png" type="image/x-icon">
    <style>
    #addProf {
        background-color: var(--dashbordColor);
        color: var(--textDashbordColor) !important;
    }
    </style>


</head>
<style>
.title {
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    color: #F0F0F0;
}
</style>

<body class="bg-light">
    <!-- le header -->
    <?php include_once('./../header.php')?>
    <?php if(count($listeMatiere)!=0): ?>
    <?php if(isset($error)):?>

    <!-- l'envoi d'un message d'erreur en cas d'erreur dans le formulaire -->
    <?php if($error==0):?>
    <div class="alert alert-warning alert-dismissible fade show position-absolute top-25 start-25 " role="alert"
        style="z-index:20">
        <strong><img src="./../icon/failure.png" style="width: 20px;"> Echec : </strong> Votre inscription a echoué
        veuillez verifier les données du formulaire
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif?>
    <!-- l'envoi d'un message d'erreur lorsqu'on veut enregister deux élèves avec les mêmes infos-->
    <?php if($error==1):?>
    <div class="alert alert-warning alert-dismissible fade show position-absolute top-25 start-25" role="alert"
        style="z-index:20">
        <strong><img src="./../icon/failure.png" style="width: 20px;"> Echec:
        </strong>
        Un prof avec ses mêmes informations exist dejà dans la liste
        <a href="./recherche_prof.php?diplome=<?php echo $_POST['diplome'] ?>&specialite=<?php echo $_POST['specialite'] ?>&prenom=<?php echo $_POST['prenom'] ?>&nom=<?php echo $_POST['nom'] ?>&chercher=Chercher"
            class="link link-primary">voir la liste</a>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif?>

    <?php endif?>

    <!-- l'envoi d'un message de succès en cas de succès -->
    <?php if(isset($success)):?>
    <div class="toast fade show position-absolute top-25 start-25" role="alert" aria-live="assertive" aria-atomic="true"
        style="z-index:20">
        <div class="toast-header">
            <img src="./../param/image.php?path=<?php echo $photo?>&type=<?php echo $imageType?>" style=" width:
            50px; height:50px;" class="rounded-circle">
            <strong class="me-auto">
                <?php echo ($_POST['sexe']=='M')? " M.$prenom $nom ":" Mde.$prenom $nom "?></strong>
            <small>11 mins ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            a été inscris avec succès
            <a href="./recherche_prof.php?diplome=<?php echo $_POST['diplome'] ?>&specialite=<?php echo $_POST['specialite'] ?>&prenom=<?php echo $_POST['prenom'] ?>&nom=<?php echo $_POST['nom'] ?>&chercher=Chercher"
                class="link link-primary">voir la liste</a>
        </div>
    </div>

    <?php endif?>

    <main>

        <!-- linscription -->
        <section class="container ">
            <div class="title  p-3 text-center h3 shadow y rounded-bottom rounded-circle"
                style="background-color:var(--dashbordColor);color:var(--textDashbordColor);">Création De Professeur
            </div>
            <form method="post" name="inscription" class="form border p-2" action="#" enctype="multipart/form-data"
                style="color:var(--dashbordColor);">
                <!-- la section conernant les informations de l'élève -->
                <section class="row g-3">
                    <div class="col-12 text-center">
                        <blockquote class="blockquote">
                            <img src="./../icon/graduate-avatar.png" alt="" style="width: 30px" />
                        </blockquote>
                        <figcaption class="blockquote-footer text-info h3">
                            Information du professeur
                        </figcaption>
                    </div>
                    <!-- le champ de saisis pour le prenom -->
                    <div class="col-md-4 col-sm-auto">
                        <label for="prenom" class="form-label">Prenom</label>
                        <input type="text" class="form-control" id="prenom" required name="prenom"
                            value="<?php echo @$_POST['prenom']?>" />
                    </div>

                    <!-- le champ de saisis pour le nom -->
                    <div class="col-md-4 col-sm-auto">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" required
                            value="<?php echo @$_POST['nom']?>" />

                    </div>
                    <!-- le champ de saisis pour la date de naissance -->
                    <div class="col-md-4 col-sm-auto">
                        <label for="dt_naiss" class="form-label">Date de Naissance</label>

                        <input type="date" class="form-control" id="dt_naiss" name="dt_naiss" required
                            value="<?php echo @$_POST['dt_naiss']?>" />
                    </div>

                    <!-- le champ de saisis pour le lieu de naissance -->
                    <div class="col-md-4 col-sm-auto">
                        <label for="lieu_naiss" class="form-label">Lieu de Naissance</label>
                        <input type="text" class="form-control" id="lieu_naiss" name="lieu_naiss" required
                            value="<?php echo @$_POST['lieu_naiss']?>" />
                    </div>
                    <!-- le champ de saisis pour le sexe -->
                    <div class="col-md-1 col-sm-auto">
                        <label for="sexe" class="form-label">Sexe</label>
                        <select name="sexe" id="sexe" class="form-select">
                            <option value="M" <?php  echo (@$_POST['sexe']=="M")?'selected':''?>>M</option>
                            <option value="F" <?php  echo (@$_POST['sexe']=="F")?'selected':''?>>F</option>
                        </select>
                    </div>
                    <!-- le champ de saisis pour le diplôme-->
                    <div class="col-md-2 col-sm-auto">
                        <label for="diplome" class="form-label">Diplôme</label>
                        <input type="text" class="form-control" name="diplome" id="diplome">
                    </div>
                    <!-- le champ de saisis pour la specialité-->
                    <div class="col-md-2 col-sm-auto">
                        <label for="specialite" class="form-label">Specialité</label>
                        <select name="specialite" id="specialite" class="form-select">
                            <?php foreach ($listeMatiere as $matiere):?>
                            <option value="<?php echo $matiere['id']?>"
                                <?php  echo ($matiere['id']==@$_POST['specialite'])?'selected':''?>>
                                <?php echo $matiere['nom']?>
                            </option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <!-- le champ de saisis pour le numero de telephone -->
                    <div class="col-md-3 col-sm-auto">
                        <label for="num" class="form-label">Numero de Telephone</label>

                        <input type="text" class="form-control num" id="num" name="num"
                            value="<?php echo @$_POST['num']?>" />
                    </div>

                    <!-- le champ pour la selection d'images -->
                    <div class="col-12 row mt-3">
                        <div class="col col-12 col-md-6">
                            <label for="photo" class="form-label">Portrait de l'élève</label>

                            <input type="file" class="form-control" id="photo" name="photo">

                        </div>


                        <div class="col col-12 col-md-4 offset-md-2 m-sm-auto">
                            <img src="./../icon/boy-student.png" alt="Photo de l'élève" id="portrait"
                                class="d-block rounded rounded-2 shadow" style="width: 180px; height:180px; ">
                        </div>
                    </div>


                </section>
                <!--la section de l'information des parents  -->


                <!-- la section validation de donnée -->
                <section class="row my-3">
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit" name="valider">Valider</button>
                    </div>
                </section>
            </form>
        </section>
    </main>

    <script src="./../js/bootstrap.js"></script>
    <script src="./../jquery-3.7.1.min.js"></script>
    <script src="./../mask/src/jquery.mask.js"></script>

    <script>
    $(document).ready(
        // la methode pour changer la photo en cas de selection
        function() {
            $('#photo').on('change', function() {

                let photo = this;
                let img = $('#portrait');
                let reader = new FileReader();
                reader.onload = function(e) {
                    img.attr('src', e.target.result);
                };
                reader.readAsDataURL(photo.files[0]);
            });
            // les methode pour les formats de telephones
            $('#num').mask('00 00 00 00');

        });
    </script>
    <?php else: ?>
    <div class="alert alert-warning alert-dismissible fade show m-auto" role="alert" style="width: 360px;">
        <strong><img src="./../icon/failure.png" style="width: 20px;"> Echec : </strong> Il faut d'abord crée une
        matière
        <a href="./../param/create_matiere.php" class="btn btn-success">Créer Une Classe</a>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <?php endif ?>


</body>

</html>