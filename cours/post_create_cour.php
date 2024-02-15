<?php 
    include_once('./../config/mysql.php');
    include_once('./../varriable.php');
    include_once('./../function.php');

    if (isset($_POST['valider'])) {
       
        if(!empty($_POST['classe']) && !empty($_POST['matiere']) && !empty($_POST['prof']) && !empty($_POST['coeficient'])
        && is_numeric($_POST['coeficient']) && $_POST['coeficient']>0 && $_POST['coeficient']<=10) 
        {
            if (!is_numeric($_POST['classe'])) {
                $error=2;
                return;
            }
            if(!isExisteCour($listeCours , $_POST)){
                $query=" INSERT INTO cour (classe_id,matiere_id,professeur_id,coeficient) 
                VALUE (:classe,:matiere,:professeur,:coeficient)";
                $mySchoolStatement=$mySchool->prepare($query);
                $mySchoolStatement->execute(array(
                    'classe'=>htmlspecialchars($_POST['classe']),
                    'matiere'=>htmlspecialchars($_POST['matiere']),
                    'professeur'=>htmlspecialchars($_POST['prof']),
                    'coeficient'=>htmlspecialchars($_POST['coeficient']),
                ));

                  //  la mis à jour du coéficient de tous les trimestres qui on ce cour
                $classe_id=$_POST['classe'];
                $cours=getCours($classe_id,$listeCours);
                $coefTotal=getTotalCoeficient($cours)+$_POST['coeficient'];
                $mySchoolStatement=$mySchool->prepare("UPDATE trimestre SET totalCoeficient=:total WHERE classe_id=$classe_id");
                $mySchoolStatement->execute(array(
                    'total'=>$coefTotal
                ));
                $success=true;
            }else $error=1;
        }
        else
            $error=0;
        
    }
?>