<?php 
    include_once('./../config/mysql.php');
    include_once('./../varriable.php');
    include_once('./../function.php');

    if (isset($_POST['valider'])) {
       
        if(!empty($_POST['classe']) && !empty($_POST['trimestre']) && !empty($_POST['totalCoeficient'])
        && is_numeric($_POST['totalCoeficient']) && !empty($_POST['totalMatiere']) && is_numeric($_POST['totalMatiere']) ) 
        {
            if ($_POST['totalMatiere']<1) {
                $error=2;
                return;
            }
            // l'insertion du trimestre dans la base donnée
            if(!isExisteTrimestre($listeTrimestres , $_POST)){
                $query=" INSERT INTO trimestre (trimestre,classe_id,totalMatiere,totalCoeficient) 
                VALUE (:trimestre,:classe,:totalMatiere,:totalCoeficient)";
                $mySchoolStatement=$mySchool->prepare($query);
                $mySchoolStatement->execute(array(
                    'trimestre'=>htmlspecialchars($_POST['trimestre']),
                    'classe'=>htmlspecialchars($_POST['classe']),
                    'totalMatiere'=>htmlspecialchars($_POST['totalMatiere']),
                    'totalCoeficient'=>htmlspecialchars($_POST['totalCoeficient']),
                ));

              

                $success=true;
            }else $error=1;
        }
        else
            $error=0;
        
    }
?>