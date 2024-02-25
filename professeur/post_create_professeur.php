<?php
    include_once('./../config/mysql.php');
    include_once('./../varriable.php');
    include_once('./../function.php');

   if(isset($_POST['valider']) && strtoupper($_SERVER['REQUEST_METHOD'])==="POST"){
            // la recuperation de données
            @ $prenom=$_POST['prenom'];
            @ $nom=$_POST['nom'];
            @ $datNaiss=$_POST['dt_naiss'];
            @ $lieuNaiss=$_POST['lieu_naiss'];
            @ $sexe=$_POST['sexe'];
            @ $diplome=$_POST['diplome'];
            @ $num=$_POST['num'];
            @ $specialite=$_POST['specialite'];
              // la verification de donnée
              if(empty(trim($prenom)) || empty(trim($nom)) || empty(trim($lieuNaiss)) || empty(trim($datNaiss)) || !is_numeric(trim($num)) || empty(trim($diplome)) || empty(trim($specialite)) ){
                  $error=0;
              }

                  // la verification si la personne existe deja
                  if(!isExisteProf($listeProfesseurs,$_POST))
                  {
                    $photo=($sexe!='M')?$rootPath.'professeur/imagesProfesseurs/madame.png':$rootPath.'professeur/imagesProfesseurs/monsieur.png';
                    $imageType='image/png';
                    $imageValid=isValidImage('photo');
                    if($imageValid=='valid'){
                      $extention=pathinfo($_FILES['photo']['name'])['extension'];
                      $name=$prenom.time()/5000;
                      $photo=$rootPath.'professeur/imagesProfesseurs/'.$name.'.'.$extention;
                      $imageType=$_FILES['photo']['type'];
                      if(!move_uploaded_file($_FILES['photo']['tmp_name'],$photo)) exit("Echec de l'inscription");
                      
                    }
                    
                    // l'inclusion des donnée dans la base de donnée
                    $mySchoolStatement=$mySchool->prepare("INSERT INTO professeur (prenom,nom,dat_naiss,lieu_naiss,diplome,specialite_id,numero,sexe,photo,imageType) VALUE (
                      :prenom,:nom,:datNaiss,:lieuNaiss,:diplome,:specialite,:numero,:sexe,:photo,:imageType)");
                      $mySchoolStatement->execute(array(
                    'prenom'=> htmlspecialchars($prenom),
                    'nom'=> htmlspecialchars($nom),
                    'datNaiss'=> htmlspecialchars($datNaiss),
                    'lieuNaiss'=> htmlspecialchars($lieuNaiss),
                    'diplome'=> htmlspecialchars($diplome),
                    'specialite'=> htmlspecialchars($specialite),
                    'numero'=> htmlspecialchars($num),
                    'sexe'=> htmlspecialchars($sexe),
                    'photo'=>$photo,
                    'imageType'=> $imageType

                  ));
                  $success=true;
                  global $prenom;
                  $prenom=$prenom;
                  global $nom;
                  $nom=$nom;
                  global $path;
                  $path=$photo;
      }
      else{
        $error=1;
      }

  }


?>