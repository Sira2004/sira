<?php 
    include_once('./../../config/mysql.php');
    include_once('./../../varriable.php');
    include_once('./../../function.php');
?>

<!-- la recuperation des classes  -->
<table class="table table-bordered">
    <thead>
        <tr>
            <th>
                Nom
            </th>
            <th>Eleve Inscrits</th>
            <th>Place Maximale</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>

        <?php foreach($listeClasses as $classe): ?>
        <tr>

            <td><?php echo $classe['classe'] ?></td>
            <td><?php echo getNumberInscrits($classe['classe_id'],$listeEleves)?>
            </td>
            <td><?php echo $classe['nombreEleve'] ?></td>
            <td>
                <button class="btn btn-warning" id="update"
                    onclick="afficherAction('update',<?php echo $classe['classe_id']?>)"><i
                        class="bi bi-arrow-counterclockwise"></i></button>
                <button class="btn btn-danger" onclick="afficherAction('del',<?php echo $classe['classe_id']?>)"><i
                        class="bi bi-trash3"></i></button>

            </td>
        </tr>
        <?php endforeach?>
    </tbody>
</table>