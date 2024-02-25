<?php 
    include_once('./../config/mysql.php');
    include_once('./../varriable.php');
    include_once('./../function.php');
    
    // la liste d'élève
    $listeSearch=$listeProfesseurs;

   
    // le traitement du formulaire de recherche
    if(isset($_POST['nom'],$_POST['prenom'],$_POST['diplome'],$_POST['specialite'])){

        $diplome=trim($_POST['diplome']);
        $diplome=" diplome LIKE '%$diplome%'";
        $specialite=trim($_POST['specialite']);
        $specialite=" specialite_id LIKE '%$specialite%'";
        $prenom=trim($_POST['prenom']);
        $prenom=" prenom LIKE '%$prenom%'";
        $nom=trim($_POST['nom']);
        $nom=" nom LIKE '%$nom%'";

       $mySchoolStatement= $mySchool->prepare("SELECT * FROM professeur  WHERE $diplome
       AND $specialite  AND $prenom AND $nom
         ");
        $mySchoolStatement->execute();
        $mySchoolStatement->setFetchMode(PDO::FETCH_ASSOC);
        $listeSearch=$mySchoolStatement->fetchAll();
        $profs=count($listeSearch);
        
    }

    
?>

<!-- le resulat de la recherche -->
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
                    <img src="./../icon/eye-with-thick-outline-variant.png" style="width: 20px;" alt="" srcset="">
                </button>
            </td>
            <td>
                <button class="btn btn-warning"
                    onclick="modify(<?php echo $professeur['professeur_id']?>,'./update.php')">
                    <i class="bi bi-arrow-counterclockwise"></i>
                </button>
            </td>


        </tr>
        <?php endforeach ?>
    </tbody>

    <caption class="<?php echo ($profs>=1)?'text-success':'text-danger'?>">
        <i class="bi bi-person-fill"></i>
        <?php if(isset($profs)):?>
        <?php echo ($profs>1)? $profs.'  professeurs retrouvés':$profs.'  professeur retrouvé' ?>
        dans la recherche
        <?php else : ?>
        <span class="text-success"><i class="bi bi-person-fill"></i> Vous avez <?php echo count($listeProfesseurs)  ?>
            professeurs dans
            votre école</span>
        <?php endif?>
    </caption>

</table>