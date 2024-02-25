<?php 
    include_once('./../config/mysql.php');
    include_once('./../varriable.php');
    include_once('./../function.php');

    // la liste d'élève
    $listeSearch=$listeEleves;

    // le nombre total d'élèves
    $students=count($listeSearch);

    // le nombre de classes
    $classes=count($listeClasses);

    // le nombre total de garçons
    $boys=numberSexe($listeSearch,'M');

    // le nombre de filles dans la classes
    $girls=numberSexe($listeSearch,'F');

    // le traitement du formulaire de recherche
    if(isset($_POST['nom'],$_POST['prenom'],$_POST['sexe'],$_POST['classe'],$_POST['lieu_naiss'])){
        
        $classe=trim($_POST['classe']);
        $classe=" classe_id LIKE '%$classe%'";
        $sexe=trim($_POST['sexe']);
        $sexe=" sexe LIKE '%$sexe%'";
        $lieu=trim($_POST['lieu_naiss']);
        $lieu=" lieu_naiss LIKE '%$lieu%'";
        $prenom=trim($_POST['prenom']);
        $prenom=" prenom LIKE '%$prenom%'";
        $nom=trim($_POST['nom']);
        $nom=" nom LIKE '%$nom%'";

       $mySchoolStatement= $mySchool->prepare("SELECT * FROM eleve  WHERE $classe
       AND $sexe  AND $lieu AND $prenom AND $nom
         ");
        $mySchoolStatement->execute();
        $mySchoolStatement->setFetchMode(PDO::FETCH_ASSOC);
        $listeSearch=$mySchoolStatement->fetchAll();
        $students=count($listeSearch);
        
    }else exit('Vous êtes des imbeciles');

    
?>

<!-- l'affichage du resultat de la recherche -->
<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead class="">
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
                        <img src="./../icon/eye-with-thick-outline-variant.png" style="width: 20px;" alt="" srcset="">
                    </button>
                </td>
                <td>
                    <button class="btn btn-warning" onclick="modify(<?php echo $eleve['eleve_id']?>,'./update.php')">

                        <i class="bi bi-arrow-counterclockwise"></i>
                    </button>
                    <button class="btn btn-danger" onclick="deleteEleve(<?php echo $eleve['eleve_id']?>,'show')">
                        <i class="bi bi-trash3"></i>
                    </button>

                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
        <caption class="<?php echo ($students>=1)?'text-success':'text-danger'?>">
            <i class="bi bi-person-fill"></i>
            <?php if(isset($students)):?>
            <?php echo ($students>1)? $students.' élèves retrouvés':$students.' élève retrouvé' ?>
            dans la recherche
            <?php else : ?>
            <span class="text-success"> <i class="bi bi-person-fill"></i> Vous avez <?php echo count($listeélèves)  ?>
                élèves dans
                votre école</span>
            <?php endif?>
        </caption>

    </table>
</div>