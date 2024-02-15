<?php
    include_once('./../config/mysql.php');
    include_once('./../varriable.php');
    include_once('./../function.php');

   if(isset($_POST['valider']) && strtoupper($_SERVER['REQUEST_METHOD'])==="POST"){
            // la recuperation de données
            @ $prenomE=$_POST['prenom'];
            @ $nomE=$_POST['nom'];
            @ $datNaissE=$_POST['dt_naiss'];
            @ $lieuNaissE=$_POST['lieu_naiss'];
            @ $sexeE=$_POST['sexe'];
            @ $classeE=$_POST['classe'];
            @ $numE=$_POST['num'];
            @ $nomP=$_POST['nomP'];
            @ $prenomP=$_POST['prenomP'];
            @ $numP=$_POST['numP'];

              // la verification de donnée
              if(empty(trim($prenomE)) || empty(trim($nomE)) || empty(trim($lieuNaissE)) || empty(trim($classeE)) || !is_numeric(trim($numE)) || empty(trim($prenomP)) || empty(trim($nomP)) || !is_numeric(trim($numP)) || !isset(($prenomE)) || !isset(($nomE)) || !isset(($lieuNaissE)) || !isset(($classeE)) || !isset(($numE)) || !isset(($prenomP)) || !isset(($nomP)) || !isset(($numP))){
                  $error=0;
              }

                  // la verification si la personne existe deja
                  if(!isExisteEleve($listeEleves,$_POST))
                  {
                    $photo=($sexeE!='M')?$rootPath.'eleve/imagesEleve/female-student.png':$rootPath.'eleve/imagesEleve/boy-student.png';
                    $imageType='image/png';
                    $imageValid=isValidImage('photo');
                    if($imageValid=='valid'){
                      $extention=pathinfo($_FILES['photo']['name'])['extension'];
                      $name=$prenomE.time()/5000;
                      $photo=$rootPath.'eleve/imagesEleve/'.$name.'.'.$extention;
                      $imageType=$_FILES['photo']['type'];
                      if(!move_uploaded_file($_FILES['photo']['tmp_name'],$photo)) exit("Echec de l'inscription");
                      
                    }
                    
                    
                   
                    // l'inclusion des donnée dans la base de donnée
                    $mySchoolStatement=$mySchool->prepare("INSERT INTO eleve (prenom,nom,dat_naiss,lieu_naiss,sexe,classe_id,numero,nomP,prenomP,numeroP,photo,imageType) VALUE (
                      :prenomE,:nomE,:datNaissE,:lieuNaissE,:sexeE,:classeE,:numeroE,:nomP,:prenomP,:numeroP,:photo,:imageType)");
                      $mySchoolStatement->execute(array(
                    'prenomE'=> htmlspecialchars($prenomE),
                    'nomE'=> htmlspecialchars($nomE),
                    'datNaissE'=> htmlspecialchars($datNaissE),
                    'lieuNaissE'=> htmlspecialchars($lieuNaissE),
                    'sexeE'=> htmlspecialchars($sexeE),
                    'classeE'=> htmlspecialchars($classeE),
                    'numeroE'=> htmlspecialchars($numE),
                    'nomP'=> htmlspecialchars($nomP),
                    'prenomP'=> htmlspecialchars($prenomP),
                    'numeroP'=> htmlspecialchars($numP),
                    'photo'=>$photo,
                    'imageType'=> $imageType
                    
                  ));
                $success=true;
                global $prenom;
                $prenom=$prenomE;
                global $nom;
                $nom=$nomE;
                global $path;
                $path=$photo;
               

      }
      else{
        $error=1;
      }

  }


?>