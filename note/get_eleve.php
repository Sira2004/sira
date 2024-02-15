<?php 
    include_once('./../config/mysql.php');
    include_once('./../varriable.php');
    include_once('./../function.php');
    

    if(isset($_POST['classe_id']) &&  isset($_POST['trimestre_id']) && isset($_POST['cour_id']) ){
        $classe=$_POST['classe_id'];
        $trimestre_id=$_POST['trimestre_id'];
        $cour_id=$_POST['cour_id'];
       
        $eleves=getEleves($_POST['classe_id'],$listeEleves);
        // lorsque la classe est vide
        if(empty($eleves)){
          echo" <h6 class='text-danger text-center'>Aucun élève inscri dans cette classe</h6> 
           <img src='./../illustration/student.svg' alt='on a pas reeusis' style='width:40%; display:block; margin:auto;'>";
           return;
        }

        // lorsqu'il n y a pas de trimestre
        if(empty(getTrimestres($_POST['classe_id'],$listeTrimestres)))
        {
            echo" <h6 class='text-danger text-center'>Aucun trimestre dans cette classe</h6> 
             <img src='./../illustration/exams.svg' alt='on a pas reeusis' sty le='width:40%; display:block; margin:auto;'>";
            return;
        }

        // lorsqu'il n y a pas de cour
        if(!getCourInClasse($cour_id,$cour_id,$listeCours)){
            
            echo" <h6 class='text-danger text-center'>Aucun cour trouvé </h6> 
            <img src='./../illustrationcourses.svg' alt='on a pas reeusis' style='width:40%; display:block; margin:auto;'>";
            return;
        }
    }else{
        exit('Verifier vos information');
        
    }
?>

<h5 class="text-center">Liste des Notes</h5>


<div class="liste ">
    <table class="table table-bordered table-striped" id="notes">
        <thead class="">
            <tr>

                <th>Prenom</th>
                <th>Nom</th>
                <th>Parent</th>
                <th>Devoir(sur 20)</th>
                <th>Examen(sur 20)</th>
                <th>Modifier</th>

            </tr>
        </thead>
        <tbody>


            <?php foreach($eleves as $eleve):?>

            <!-- la recuperation des notes precedentes -->
            <?php 
                    $eleve_id=$eleve['eleve_id'];
                    $mySchoolStatement=$mySchool->prepare("SELECT * FROM note WHERE eleve_id=$eleve_id
                    AND trimestre_id=$trimestre_id AND cour_id=$cour_id LIMIT 1");
                    $mySchoolStatement->execute();
                    $note=$mySchoolStatement->fetch(PDO::FETCH_ASSOC);
                ?>
            < <!-- si la note de l'élève n'a pas été initialiser -->
                <?php if(!$note):?>
                <?php 
                     $query=" INSERT INTO note (eleve_id,classe_id,trimestre_id,cour_id)
                     VALUE ($eleve_id,$classe,$trimestre_id,$cour_id)";
                     $mySchoolStatement=$mySchool->prepare($query);
                     $mySchoolStatement->execute();
                    
                    
                    ?>

                <?php endif?>
                <tr>
                    <td><?php echo $eleve['prenom']?></td>
                    <td><?php echo $eleve['nom']?></td>
                    <td><?php echo $eleve['nomP']?></td>
                    <td><input type="text" name="noteDevoir" id="noteDevoir" class="form-control form-control-sm devoir"
                            min="0" max="20" value="<?php echo @$note['devoir'] ?>"></td>
                    <td><input type="text" name="noteExamen" id="noteExamen" class="form-control form-control-sm examen"
                            min="0" max="40" value="<?php echo @$note['examen'] ?>"></td>
                    <td><input type="checkbox" name="change" id="change" value="<?php echo @$note['note_id']?>"
                            class="form-check-input form-check accept" checked>
                    </td>

                </tr>
                <?php endforeach?>

        </tbody>
        <caption>
            <button type="button" class="btn btn-success" id="save" onclick="saveNotes()">Enregistrer</button>
        </caption>
    </table>