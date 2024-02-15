<?php 
    include_once('./../config/mysql.php');
    include_once('./../varriable.php');
    include_once('./../function.php');

    if(!isset($_POST['cour_id'])){
        exit('Imposible de mener modifier cette cour');
    }
    
    // la recuperation de la cour avec l'id spécifier
    $cour_id=$_POST['cour_id'];
    $mySchoolStatement=$mySchool->prepare("SELECT * FROM cour WHERE cour_id=$cour_id LIMIT 1");
    $mySchoolStatement->execute();
    $cour=$mySchoolStatement->fetch(PDO::FETCH_ASSOC);
    if(!$cour) exit('Cette dite cour est introuvable');

?>

<!-- Pour la mis à jour -->
<?php 
   
    //  la supression du cour
    $mySchoolStatement=$mySchool->prepare("DELETE FROM cour WHERE cour_id=$cour_id");
    $mySchoolStatement->execute();
    //  la supression des cours liés à la cour
    $mySchoolStatement=$mySchool->prepare("DELETE FROM note WHERE cour_id=$cour_id");
    $mySchoolStatement->execute();

    //  la mis à jour du coéficient de tous les trimestres qui on ce cour
    $classe_id=$cour['classe_id'];
    $cours=getCours($classe_id,$listeCours);
    $coefTotal=getTotalCoeficient($cours)-$cour['coeficient'];
    $mySchoolStatement=$mySchool->prepare("UPDATE trimestre SET totalCoeficient=:total WHERE classe_id=$classe_id");
    $mySchoolStatement->execute(array(
        'total'=>$coefTotal
    ));

?>