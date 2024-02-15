<?php 
    include_once('./../config/mysql.php');
    include_once('./../varriable.php');
    include_once('./../function.php');

    // la verification si les valeurs ont été enoyé avec succès
    if(!isset($_POST['matiere'],$_POST['classe'],$_POST['prof'],$_POST['coeficient'],$_POST['cour_id']) 
    && $_POST['coeficient']<10  && $_POST['coeficient']>0 )
    {
        exit('Imposible de mener modifier cette cour car des valeurs sont introuvable');
    }

    // la verification si les valeurs envoyées ne sont vides
    if(empty($_POST['classe']) || empty($_POST['matiere']) || empty($_POST['prof']) || empty($_POST['coeficient'])
    || !is_numeric($_POST['coeficient']))  exit('Imposible de mener modifier cette cour car des valeurs sont vides');
    
    // la recuperation de le cour avec l'id spécifier
    $cour_id=$_POST['cour_id'];
    $mySchoolStatement=$mySchool->prepare("SELECT * FROM cour WHERE cour_id=$cour_id LIMIT 1");
    $mySchoolStatement->execute();
    $cour=$mySchoolStatement->fetch(PDO::FETCH_ASSOC);
    if(!$cour) exit('Cette dite cour est introuvable');

    // la verificatio si le cour existe dans la classe 
    if($cour['classe_id']!=$_POST['classe']){
        if(isExisteCour($listeCours ,$_POST)){
            echo" <h6 class='text-danger text-center'>Ce cour existe dejà dans la classe specifiée <button class='btn-close close'></button> </h6> 
            <img src='./../illustration/courses.svg' alt='on a pas reusis' style='width:24%; display:block; margin:auto;'>";
            return;
        }
    }

?>

<!-- Pour la mis à jour du cour -->
<?php 
    $classe=$_POST['classe'];
    $matiere=$_POST['matiere'];
    $prof=$_POST['prof'];
    $coeficient=$_POST['coeficient'];
     $mySchoolStatement=$mySchool->prepare("UPDATE cour SET classe_id=:classe , matiere_id=:matiere 
     , professeur_id=:prof , coeficient=:coeficient WHERE cour_id=$cour_id");
     $mySchoolStatement->execute(array(
        'classe'=>htmlspecialchars($classe),
        'matiere'=>htmlspecialchars($matiere),
        'prof'=>htmlspecialchars($prof),
        'coeficient'=>htmlspecialchars($coeficient)
     ));

    //  la mis à jour du coéficient de tous les trimestres qui on ce cour
    $cours=getCours($_POST['classe'],$listeCours);
    $coefTotal=getTotalCoeficient($cours)-$cour['coeficient']+$coeficient;
    $mySchoolStatement=$mySchool->prepare("UPDATE trimestre SET totalCoeficient=:total WHERE classe_id=$classe");
    $mySchoolStatement->execute(array(
        'total'=>$coefTotal
    ));


?>