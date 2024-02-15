<?php 
    include_once('./../../config/mysql.php');
    include_once('./../../varriable.php');
    include_once('./../../function.php');
   

    if (isset($_POST['valider'])) {
       
        if(!empty($_POST['nom']) && !empty($_POST['niveau'])) 
        {
            if (!isExisteMatiere($listeMatiere , $_POST)) {
                $query=" INSERT INTO matiere (nom,niveau) VALUE (:nom,:niveau)";
                $mySchoolStatement=$mySchool->prepare($query);
                $mySchoolStatement->execute(array(
                    'nom'=>htmlspecialchars($_POST['nom']),
                    'niveau'=>htmlspecialchars($_POST['niveau'])
                ));
                $success=true;
            }else $error=1;
        }
        else
            $error=0;
        
    }

?>



<!DOCTYPE html>
<html lang="fr">


<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My-School/Creer_une_classe</title>
    <link rel="stylesheet" href="./../../css/bootstrap.css" />
    <link rel="shortcut icon" href="./../../icon/graduating-student.png" type="image/x-icon">

    <style>
    .formulaire {
        width: 400px;
        border-radius: 20px;
        padding: 40px;
    }

    .form-group {
        margin-bottom: 10px;
    }
    </style>
</head>

<body class="bg-ligth" onload="getMatieres()">
    <?php 
         include_once("./../../header.php");
    ?>
    <main>
        <section class="result">
            <?php if(isset($error)):?>

            <?php if($error==0):?>
            <div class="alert alert-warning alert-dismissible fade show position-absolute top-25" role="alert">
                <strong><img src="./../../icon/failure.png" style="width: 20px;"> Echec : </strong>
                veuillez verifier les données du formulaire
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif?>

            <?php if($error==1):?>
            <div class="alert alert-warning alert-dismissible fade show position-absolute top-25" role="alert">
                <strong><img src="./../../icon/failure.png" style="width: 20px;"> Echec:
                </strong>
                la matière <?php echo $_POST['nom']?> existe dejà
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif?>

            <?php endif?>
            <?php if(isset($success) && isset($_POST['valider'])):?>
            <div class="alert alert-warning alert-dismissible fade show position-absolute top-25" role="alert">
                <strong><img src="./../../icon/check.png" style="width: 20px;"> Succès: la matière
                    <?php echo @$_POST['nom']?> a été crée avec succès
                </strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif?>
        </section>
        <section id="actionResult" style="display: none;"></section>
        <section class=" container-fluid formulaire shadow shadow-lg w-50" id="formulaire"
            style="color:var(--dashbordColor);">
            <div class="title p-3 text-center h3 shadow rounded-bottom rounded-circle"
                style="background-color:var(--dashbordColor);color:var(--textDashbordColor);">
                Création De Matière
            </div>
            <form action="#" class="form row" method="post" onsubmit="getMatieres()">
                <div class="form-group">
                    <label for="nom">Nom de la Matiere</label>
                    <input type="text" class="form-control" name="nom" required value="<?php echo @$_POST['nom']?>" />
                </div>
                <div class="form-group">
                    <label for="niveau">Niveau D'Apprentissage</label>
                    <select name="niveau" class="form-select">
                        <option value="EXTRAT DIFICILLE"
                            <?php  echo (@$_POST['niveau']=="EXTRAT DIFICILLE")?'selected':''?>>EXTRAT DIFICILLE
                        </option>
                        <option value="DIFICILLE" <?php  echo (@$_POST['niveau']=="DIFICILLE")?'selected':''?>>DIFICILLE
                        </option>
                        <option value="MOYENNE" <?php  echo (@$_POST['niveau']=="MOYENNE")?'selected':''?>>MOYENNE
                        </option>
                        <option value="FACILLE" <?php  echo (@$_POST['niveau']=="FACILLE")?'selected':''?>>
                            FACILLE</option>

                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary m-10 border-0" name="valider"
                        style="width: 40%; background-color:var(--dashbordColor);color:var(--textDashbordColor);">Valider
                    </button>
                </div>
            </form>
        </section>
        <!-- la liste des classe -->
        <section class="liste mt-5">
            <div class="container" id="listeMatieres" style="color: var(--dashbordColor);">

            </div>
        </section>

    </main>

    <script src="./../../js/bootstrap.js"></script>
    <script src="./../../jquery-3.7.1.min.js"></script>
    <script src="./matiere.js"></script>
</body>

</html>