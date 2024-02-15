<?php 
    include_once('./../../config/mysql.php');
    include_once('./../../varriable.php');
    include_once('./../../function.php');
   
    $my= $mySchool->prepare("SELECT COUNT(*)  FROM eleve AS 'nombre' WHERE classe_id = :classe");

    if (isset($_POST['valider'])) {
       
        if(!empty($_POST['classe'] && !empty($_POST['nombreEleve'])) && is_numeric($_POST['nombreEleve']) && $_POST['nombreEleve']>0 && $_POST['nombreEleve']<80)
        {
            if (!isExisteClasse($listeClasses , $_POST)) {
                $query=" INSERT INTO classe (classe,nombreEleve) VALUE (:classe,:nombre)";
                $mySchoolStatement=$mySchool->prepare($query);
                $mySchoolStatement->execute(array(
                    'classe'=>htmlspecialchars($_POST['classe']),
                    'nombre'=>htmlspecialchars($_POST['nombreEleve'])
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

    #actionResult {
        display: none;
    }
    </style>
</head>

<body class="bg-ligth" onload="getClasses()">
    <?php 
        include_once("./../../header.php");
    ?>
    <main>
        <section class="result" id="validation">
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
                la classe <?php echo $_POST['classe']?> existe dejà
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif?>

            <?php endif?>
            <?php if(isset($success) && isset($_POST['valider'])):?>
            <div class="alert alert-warning alert-dismissible fade show position-absolute top-25" role="alert">
                <strong><img src="./../../icon/check.png" style="width: 20px;"> Succès: la classe
                    <?php echo $_POST['classe']?> a été crée avec succès
                </strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif?>
        </section>
        <section id="actionResult"> </section>
        <section class="container-fluid formulaire shadow shadow-lg w-50 w-sm-100" id="formulaire">
            <div class="title p-3 text-center h3 shadow rounded-bottom rounded-circle"
                style="background-color:var(--dashbordColor);color:var(--textDashbordColor);">
                Création De Classe
            </div>
            <form action=" #" class="form row" method="post" onsubmit="getClasses()">
                <div class="form-group">
                    <label for="classe">Nom de la Classe</label>
                    <input type="text" class="form-control" name="classe" required
                        value="<?php echo @$_POST['classe']?>" />
                </div>
                <div class="form-group">
                    <label for="nombreEleve">Nombre d'élèves</label>
                    <input type="number" class="form-control" name="nombreEleve" required
                        value="<?php echo @$_POST['nombreEleve']?>" />
                </div>

                <div class="form-group">
                    <button type="submit" class="btn pt-2 m-10 h5" name="valider"
                        style="width: 40%; background-color:var(--dashbordColor);color:var(--textDashbordColor);">Valider
                    </button>
                </div>
            </form>
        </section>
        <!-- la liste des classe -->
        <section class="liste mt-5">
            <div class="container" id="listeClasses" style="color: var(--dashbordColor);">

            </div>
        </section>
        <section id="actionResult"> </section>
    </main>

    <script src="./../../js/bootstrap.js"></script>
    <script src="./../../jquery-3.7.1.min.js"></script>
    <script src="./classe.js"></script>
</body>

</html>