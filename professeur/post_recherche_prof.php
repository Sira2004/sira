<?php 
    include_once('./../config/mysql.php');
    include_once('./../varriable.php');
    include_once('./../function.php');
    
    // la liste d'élève
    $listeSearch=$listeProfesseurs;

   
    // le traitement du formulaire de recherche
    if(isset($_GET['chercher'])){

        $diplome=trim($_GET['diplome']);
        $diplome=" diplome LIKE '%$diplome%'";
        $specialite=trim($_GET['specialite']);
        $specialite=" specialite_id LIKE '%$specialite%'";
        $prenom=trim($_GET['prenom']);
        $prenom=" prenom LIKE '%$prenom%'";
        $nom=trim($_GET['nom']);
        $nom=" nom LIKE '%$nom%'";
       
       
        
       $mySchoolStatement= $mySchool->prepare("SELECT * FROM professeur  WHERE $diplome
       AND $specialite  AND $prenom AND $nom
         ");
        $mySchoolStatement->execute();
        $mySchoolStatement->setFetchMode(PDO::FETCH_ASSOC);
        $listeSearch=$mySchoolStatement->fetchAll();
        $profs=count($listeSearch);
        
    }

    
?>