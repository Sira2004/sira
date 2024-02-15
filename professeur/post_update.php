<?php
    include_once('./../config/mysql.php');
    include_once('./../varriable.php');
    include_once('./../function.php');

   if(isset($_POST['professeur_id'])){
            // la recuperation de données
            @ $prenom=$_POST['prenom'];
            @ $nom=$_POST['nom'];
            @ $datNaiss=$_POST['dt_naiss'];
            @ $lieuNaiss=$_POST['lieu_naiss'];
            @ $sexe=$_POST['sexe'];
            @ $diplome=$_POST['diplome'];
            @ $specialite=$_POST['specialite'];
            @ $num=$_POST['num'];
            @ $professeur_id=$_POST['professeur_id'];

              // la verification de donnée
              if(empty(trim($prenom)) || empty(trim($nom)) ||empty(trim($datNaiss)) || empty(trim($lieuNaiss)) || empty(trim($diplome)) || empty(trim($specialite)) ||  !is_numeric(trim($num)) ){
                  $error=0;
              }
              // le traitement de l'image
                    $photo=$_POST['imagePath'];
                    $imageType=$_POST['imageType'];
                    $imageValid=isValidImage('photo');

                    if($imageValid=='valid'){
                      $extention=pathinfo($_FILES['photo']['name'])['extension'];
                      $name=$prenomE.time()/5000;
                      $photo=$rootPath.'professeur/imagesprofesseurs/'.$name.'.'.$extention;
                      $imageType=$_FILES['photo']['type'];
                      if(!move_uploaded_file($_FILES['photo']['tmp_name'],$photo)){
                        $photo=$_POST['imagePath'];
                        $imageType=$_POST['imageType'];
                        echo "La photo n'as pas pu être changer ho ho";
                      }
                      else{
                          if(file_exists($_POST['imagePath'])){
                            if(!unlink($_POST['imagePath'])){
                              echo'Votre ancien image est toujours present dans la base de donnée';
                            }
                          }else{
                            echo 'la photo est introuvable';
                          }
                      }
                   } 
                  // la verification si la personne existe deja
                  if(!isExisteProf($listeProfesseurs,$_POST) || !isExisteImage($listeProfesseurs,$photo))
                  {
                    // la modification des donnée dans la base de donnée

                  // la verification si l'id existe dans la base de donnée
                    $mySchoolStatement=$mySchool->prepare("SELECT * FROM professeur WHERE professeur_id=$professeur_id");
                   $mySchoolStatement->execute();
                   if($mySchoolStatement->fetch()){
                      $mySchoolStatement=$mySchool->prepare("UPDATE professeur SET prenom=:prenom,nom=:nom,
                      dat_naiss=:datNaiss,lieu_naiss=:lieuNaiss,sexe=:sexe,diplome=:diplome, specialite_id=:specialite,
                      numero=:numero,photo=:photo ,imageType=:imageType WHERE professeur_id=$professeur_id");
                        $mySchoolStatement->execute(array(
                          'prenom'=> htmlspecialchars($prenom),
                          'nom'=> htmlspecialchars($nom),
                          'datNaiss'=> htmlspecialchars($datNaiss),
                          'lieuNaiss'=> htmlspecialchars($lieuNaiss),
                          'sexe'=> htmlspecialchars($sexe),
                          'diplome'=> htmlspecialchars($diplome),
                          'specialite'=> htmlspecialchars($specialite),
                          'numero'=> htmlspecialchars($num),
                          'photo'=>$photo,
                          'imageType'=> $imageType
                        ));
                        $success=true;
                        global $prenom;
                        $prenom=$prenomE;
                        global $nom;
                        $nom=$nomE;
                   }

      }
      else{
        $error=1;
      }

  }


?>