<?php 
    include_once('./../config/mysql.php');
    include_once('./../varriable.php');
    include_once('./../function.php');
    
    if (isset($_POST['classe_id'])) {

    // la liste des cours pour une classe
     $totalCours=getCours($_POST['classe_id'],$listeCours);
     $totalMatiere=count($totalCours);
     $totalCoeficient=getTotalCoeficient($totalCours);
 
    }
    $totals=array(
        'totalMatiere'=>$totalMatiere,
        'totalCoeficient'=>$totalCoeficient
    );
    echo json_encode($totals);
?>