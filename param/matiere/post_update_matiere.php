<?php 
    include_once('./../../config/mysql.php');
    include_once('./../../varriable.php');
    include_once('./../../function.php');

    if(!isset($_POST['matiere_id'],$_POST['matiere'],$_POST['niveau']) ){
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
     $mySchoolStatement=$mySchool->prepare("UPDATE matiere SET nom=:matiere , 
     niveau=:niveau WHERE id=$matiere_id");
     $mySchoolStatement->execute(array(
        'matiere'=>htmlspecialchars($_POST['matiere']),
        'niveau'=>htmlspecialchars($_POST['niveau'])
     ));
?>