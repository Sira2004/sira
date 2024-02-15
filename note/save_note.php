<?php 
    include_once('./../config/mysql.php');
    include_once('./../varriable.php');
    include_once('./../function.php');

    if (isset($_POST['notes'])) {
        $notes=$_POST['notes'];

        // la modification des notes
        foreach($notes as $note){
          
            $note_id=$note['note_id'];
            $devoir=$note['devoir'];
            $examen=$note['examen'];

            // la recuperation du cour pour calculer le total
            $mySchoolStatement=$mySchool->prepare("SELECT cour_id FROM note WHERE note_id=$note_id");
            $mySchoolStatement->execute();
            $cour_id=$mySchoolStatement->fetch(PDO::FETCH_ASSOC)['cour_id'];

            // la recuperation du coeficient
             // la recuperation du cour pour calculer le total
             $mySchoolStatement=$mySchool->prepare("SELECT coeficient FROM cour WHERE cour_id=$cour_id");
             $mySchoolStatement->execute();
             $coeficient=$mySchoolStatement->fetch(PDO::FETCH_ASSOC)['coeficient'];
             $total=getNoteTotal($devoir,$examen,$coeficient);
            
            $query="UPDATE note SET devoir=:devoir , examen=:examen , total=:total WHERE note_id=$note_id";
            $mySchoolStatement=$mySchool->prepare($query);
            $mySchoolStatement->execute(array(
                'devoir'=>$devoir,
                'examen'=>$examen,
                'total'=>$total
            ));
          
            
        }
        echo "<h2 class='text-success'>Wai Tout à marcher </h2>";
        
    }else{
        echo "<h2 class='text-danger'>Hahhaha ça n'a pas </h2>";
     
    }



?>