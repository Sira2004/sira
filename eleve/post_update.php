<?php
    include_once('./../config/mysql.php');
    include_once('./../varriable.php');
    include_once('./../function.php');

   if(isset($_POST['eleve_id'])){
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
            @ $eleve_id=$_POST['eleve_id'];

              // la verification de donnée
              if(empty(trim($prenomE)) || empty(trim($nomE)) || empty(trim($lieuNaissE)) || empty(trim($classeE)) || !is_numeric(trim($numE)) || empty(trim($prenomP)) || empty(trim($nomP)) || !is_numeric(trim($numP)) || !isset(($prenomE)) || !isset(($nomE)) || !isset(($lieuNaissE)) || !isset(($classeE)) || !isset(($numE)) || !isset(($prenomP)) || !isset(($nomP)) || !isset(($numP))){
                  $error=0;
              }
              // le traitement de l'image
                    $photo=$_POST['imagePath'];
                    $imageType=$_POST['imageType'];
                    $imageValid=isValidImage('photo');

                    if($imageValid=='valid'){
                      $extention=pathinfo($_FILES['photo']['name'])['extension'];
                      $name=$prenomE.time()/5000;
                      $photo=$rootPath.'eleve/imagesEleve/'.$name.'.'.$extention;
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
                  if(!isExisteEleve($listeEleves,$_POST) || !isExisteImage($listeEleves,$photo))
                  {
                    // la modification des donnée dans la base de donnée

                  // la verification si l'id existe dans la base de donnée
                    $mySchoolStatement=$mySchool->prepare("SELECT * FROM eleve WHERE eleve_id=$eleve_id");
                   $mySchoolStatement->execute();
                   if($mySchoolStatement->fetch()){
                      $mySchoolStatement=$mySchool->prepare("UPDATE eleve SET prenom=:prenomE,nom=:nomE,
                      dat_naiss=:datNaissE,lieu_naiss=:lieuNaissE,sexe=:sexeE,classe_id=:classeE,
                      numero=:numeroE, nomP=:nomP,prenomP=:prenomP,numeroP=:numeroP,photo=:photo,
                      imageType=:imageType WHERE eleve_id=$eleve_id");
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
                   }

      }
      else{
        $error=1;
      }

  }


?>