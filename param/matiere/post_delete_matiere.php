<?php 
    include_once('./../../config/mysql.php');
    include_once('./../../varriable.php');
    include_once('./../../function.php');

    if(!isset($_POST['matiere_id'])){
        exit('Imposible de mener modifier cette matiere');
    }
    
    // la recuperation de la matiere avec l'id spécifier
    $matiere_id=$_POST['matiere_id'];
    $mySchoolStatement=$mySchool->prepare("SELECT * FROM matiere WHERE id=$matiere_id LIMIT 1");
    $mySchoolStatement->execute();
    $matiere=$mySchoolStatement->fetch(PDO::FETCH_ASSOC);
    if(!$matiere) exit('Cette dite matiere est introuvable');

?>

<!-- Pour la mis à jour -->
<?php 
    // l'id des cours qui ont la matière
    $mySchoolStatement=$mySchool->prepare("SELECT cour_id FROM cour WHERE $matiere_id=$matiere_id");
    $mySchoolStatement->execute();
    $mySchoolStatement->setFetchMode(PDO::FETCH_ASSOC);
    $coursId=$mySchoolStatement->fetchAll();
    // la supression de la matiere
     $mySchoolStatement=$mySchool->prepare("DELETE FROM matiere WHERE id=$matiere_id");
     $mySchoolStatement->execute();

    //  la supression des cours liés à la matiere
    $mySchoolStatement=$mySchool->prepare("DELETE FROM cour WHERE matiere_id=$matiere_id");
    $mySchoolStatement->execute();
    //  la supression des notes liés à la matiere
    foreach($coursId as $cour){
        $cour_id=$cour['cour_id'];
        $mySchoolStatement=$mySchool->prepare("DELETE FROM note WHERE cour_id=$cour_id");
        $mySchoolStatement->execute();
    }

?>