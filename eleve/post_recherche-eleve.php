<?php 
    include_once('./../config/mysql.php');
    include_once('./../varriable.php');
    include_once('./../function.php');

    // la liste d'élève
    $listeSearch=$listeEleves;

    // le nombre total d'élèves
    $students=count($listeSearch);

    // le nombre de classes
    $classes=count($listeClasses);

    // le nombre total de garçons
    $boys=numberSexe($listeSearch,'M');

    // le nombre de filles dans la classes
    $girls=numberSexe($listeSearch,'F');

    // le traitement du formulaire de recherche
    if(isset($_GET['chercher'])){
        
        $classe=trim($_GET['classe']);
        $classe=" classe_id LIKE '%$classe%'";
        $sexe=trim($_GET['sexe']);
        $sexe=" sexe LIKE '%$sexe%'";
        $lieu=trim($_GET['lieu_naiss']);
        $lieu=" lieu_naiss LIKE '%$lieu%'";
        $prenom=trim($_GET['prenom']);
        $prenom=" prenom LIKE '%$prenom%'";
        $nom=trim($_GET['nom']);
        $nom=" nom LIKE '%$nom%'";

       $mySchoolStatement= $mySchool->prepare("SELECT * FROM eleve  WHERE $classe
       AND $sexe  AND $lieu AND $prenom AND $nom
         ");
        $mySchoolStatement->execute();
        $mySchoolStatement->setFetchMode(PDO::FETCH_ASSOC);
        $listeSearch=$mySchoolStatement->fetchAll();
        $students=count($listeSearch);
        
    }

    
?>