<?php 
    
    // la liste des èlèves
    $mySchoolStatement=$mySchool->prepare(" SELECT * FROM eleve");
    $mySchoolStatement->execute();
    $mySchoolStatement->setFetchMode(PDO::FETCH_ASSOC);
    $listeEleves=$mySchoolStatement->fetchAll();

      // la liste des professeurs
      $mySchoolStatement=$mySchool->prepare(" SELECT * FROM professeur");
      $mySchoolStatement->execute();
      $mySchoolStatement->setFetchMode(PDO::FETCH_ASSOC);
      $listeProfesseurs=$mySchoolStatement->fetchAll();
  
     // la liste des classes
    $mySchoolStatement=$mySchool->prepare(" SELECT * FROM classe");
    $mySchoolStatement->execute();
    $mySchoolStatement->setFetchMode(PDO::FETCH_ASSOC);
    $listeClasses=$mySchoolStatement->fetchAll();
        
    // la liste des èlèves en jointures avec leurs classes
    $mySchoolStatement=$mySchool->prepare(" SELECT * FROM eleve INNER JOIN classe ON (eleve.classe_id=classe.classe_id)");
    $mySchoolStatement->execute();
    $mySchoolStatement->setFetchMode(PDO::FETCH_ASSOC);
    $listeElevesClasses=$mySchoolStatement->fetchAll();

     // la liste des classes
     $mySchoolStatement=$mySchool->prepare("SELECT * FROM matiere");
     $mySchoolStatement->execute();
     $mySchoolStatement->setFetchMode(PDO::FETCH_ASSOC);
     $listeMatiere=$mySchoolStatement->fetchAll();
    
     // la liste des cours
     $mySchoolStatement=$mySchool->prepare("SELECT * FROM cour");
     $mySchoolStatement->execute();
     $mySchoolStatement->setFetchMode(PDO::FETCH_ASSOC);
     $listeCours=$mySchoolStatement->fetchAll();

      // la liste des trimsestres
     $mySchoolStatement=$mySchool->prepare("SELECT * FROM trimestre");
     $mySchoolStatement->execute();
     $mySchoolStatement->setFetchMode(PDO::FETCH_ASSOC);
     $listeTrimestres=$mySchoolStatement->fetchAll();

    // la liste des notes
     $mySchoolStatement=$mySchool->prepare("SELECT * FROM note");
     $mySchoolStatement->execute();
     $mySchoolStatement->setFetchMode(PDO::FETCH_ASSOC);
     $listeNotes=$mySchoolStatement->fetchAll();



    $rootPath = $_SERVER['DOCUMENT_ROOT'].'/mySchool/';
    $rootUrl = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/mySchool/';
?>