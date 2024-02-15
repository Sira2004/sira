<?php 
    include_once('./../../config/mysql.php');
    include_once('./../../varriable.php');
    include_once('./../../function.php');

    if(!isset($_POST['classe_id'])){
        exit('Imposible de mener modifier cette classe');
    }
    
    // la recuperation de la classe avec l'id spécifier
    $classe_id=$_POST['classe_id'];
    $mySchoolStatement=$mySchool->prepare("SELECT * FROM classe WHERE classe_id=$classe_id LIMIT 1");
    $mySchoolStatement->execute();
    $classe=$mySchoolStatement->fetch(PDO::FETCH_ASSOC);
    if(!$classe) exit('Cette dite classe est introuvable');

?>

<!-- Pour la mis à jour -->
<?php 
    // la supression de la classe
     $mySchoolStatement=$mySchool->prepare("DELETE FROM classe WHERE classe_id=$classe_id");
     $mySchoolStatement->execute();
    //  la supression des èlèves liés à la classe
    $mySchoolStatement=$mySchool->prepare("DELETE FROM eleve WHERE classe_id=$classe_id");
    $mySchoolStatement->execute();
    // la supression des trimestre liés à la classe   
    $mySchoolStatement=$mySchool->prepare("DELETE FROM trimestre WHERE classe_id=$classe_id");
    $mySchoolStatement->execute();
    //  la supression des cours liés à la classe
    $mySchoolStatement=$mySchool->prepare("DELETE FROM cour WHERE classe_id=$classe_id");
    $mySchoolStatement->execute();
    //  la supression des cours liés à la classe
    $mySchoolStatement=$mySchool->prepare("DELETE FROM note WHERE classe_id=$classe_id");
    $mySchoolStatement->execute();

?>