<?php 
    include_once('./../../config/mysql.php');
    include_once('./../../varriable.php');
    include_once('./../../function.php');
?>

<!-- la recuperation des matieres  -->
<table class="table table-bordered">
    <thead>
        <tr>
            <th>
                Matière
            </th>
            <th>Niveau</th>
            <th>Action</th>

        </tr>
    </thead>
    <tbody>

        <?php foreach($listeMatiere as $matiere): ?>
        <tr>

            <td><?php echo $matiere['nom'] ?></td>
            <td><?php echo $matiere['niveau']?> </td>
            <td>
                <button class="btn btn-warning" id="update"
                    onclick="afficherAction('update',<?php echo $matiere['id']?>)"><i
                        class="bi bi-arrow-counterclockwise"></i></button>
                <button class="btn btn-danger" onclick="afficherAction('del',<?php echo $matiere['id']?>)"><i
                        class="bi bi-trash3"></i></button>

            </td>

        </tr>
        <?php endforeach?>
    </tbody>
</table>