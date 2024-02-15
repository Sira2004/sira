<?php 
    include_once('./../../config/mysql.php');
    include_once('./../../varriable.php');
    include_once('./../../function.php');

    if(!isset($_POST['classe_id'],$_POST['classe'],$_POST['nombreEleve']) && $_POST['nombreEleve']>1){
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
     $mySchoolStatement=$mySchool->prepare("UPDATE classe SET classe=:classe , 
     nombreEleve=:nombreEleve WHERE classe_id=$classe_id");
     $mySchoolStatement->execute(array(
        'classe'=>htmlspecialchars($_POST['classe']),
        'nombreEleve'=>htmlspecialchars($_POST['nombreEleve'])
     ));
?>