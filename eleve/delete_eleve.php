<?php 
    include_once('./../config/mysql.php');
    include_once('./../varriable.php');
    include_once('./../function.php');

    if(!isset($_POST['eleve_id'],$_POST['action'])){
        exit();
    }
    $action=$_POST['action'];
    $eleve_id=$_POST['eleve_id'];
    $mySchoolStatement=$mySchool->prepare("SELECT * FROM eleve WHERE eleve_id=:eleve_id LIMIT 1");
    $mySchoolStatement->execute(array('eleve_id'=>$eleve_id ));
    $eleve=$mySchoolStatement->fetch(PDO::FETCH_ASSOC);
    if(!$eleve){
        exit();
    }
?>


<!-- Si on doit faire l'affichage des données à supprimer -->
<?php if($action=="show"):?>
<div class="alert alert-warning alert-dismissible fade show w-auto position-fixed" role="alert" style="top: 12vh;">
    <div class="pt-3 pe-3">
        <div>
            <p>
                <i class="bi bi-exclamation-triangle text-danger"></i> La supression de l'élève
                <?php echo $eleve['prenom']?> entrenera la supréssion de toutes les notes
                reliès à cet élève
            </p>
            <p class="text-danger">Veuillez confirmer en cliquant sur Supprimer</p>
        </div>
    </div>
    <div class="text-end w-100"><button type="button" class="btn btn-danger" id="del"
            onclick="deleteEleve(<?php echo $eleve_id?>,'delete')">Supprimer</button></div>
    <button type="button" class="btn-close close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif?>

<!-- Si on doit supprimer lélève selectionner -->
<?php 
    if($action=="delete"){
        // la suppresion de l'élève
        $mySchoolStatement=$mySchool->prepare("DELETE FROM eleve WHERE eleve_id=:eleve_id");
        $mySchoolStatement->execute(array('eleve_id'=>$eleve_id));

        // la suppresion des note reliéès à l'élève
        $mySchoolStatement=$mySchool->prepare("DELETE FROM note WHERE eleve_id=:eleve_id");
        $mySchoolStatement->execute(array('eleve_id'=>$eleve_id));

        // la recharge de la page
       

    }
?>