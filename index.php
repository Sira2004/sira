<?php 
    include_once('./config/mysql.php');
    include_once('./varriable.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My-School</title>
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/style.css" />
    <style>

    </style>
</head>

<body class="bg-light">
    <?php include_once('header.php')?>

    <main id="main">
        <!-- la section pour les informations generales sur les élèves -->
        <section class="d-flex justify-content-between">
            <div class="container p-2 mb-2">
                <div class="row row-cols-auto gx-2 gx-lg-4">
                    <!-- le nombre total d'élève -->
                    <div class="col m-auto">
                        <div class="card  mb-3 border-0 shadow" style="width: 12rem">
                            <div class="card-body d-flex justify-content-between bg-white text-info">
                                <img src="./../icon/total-students.png" width="50px" />
                                <p class="card-text text-center d-inline">
                                    <?php echo ($students>1)? $students.' élèves':$students.' élève' ?>
                                </p>
                            </div>
                            <div class="card-footer border-0 bg-info ">
                                <p class="card-text h6">Total d'élève inscris</p>
                            </div>
                        </div>
                    </div>

                    <!-- le nombre total de garçons  -->
                    <div class="col m-auto">
                        <div class="card  mb-3 border-0 shadow" style="width: 12rem">
                            <div class="card-body d-flex justify-content-between bg-white text-info">
                                <img src="./../icon/boy-student.png" width="50px" />
                                <p class="card-text text-center d-inline">
                                    <?php echo ($boys>1)? $boys.' élèves':$boys.' élève' ?></p>
                            </div>
                            <div class="card-footer border-0 bg-info ">
                                <p class="card-text h6">Total garçons inscris</p>
                            </div>
                        </div>
                    </div>
                    <!-- le nombre total de fille -->
                    <div class="col m-auto">
                        <div class="card  mb-3 border-0 shadow" style="width: 12rem">
                            <div class="card-body d-flex justify-content-between bg-white text-info">
                                <img src="./../icon/female-student.png" width="50px" />
                                <p class="card-text text-center d-inline">
                                    <?php echo ($girls>1)? $girls.' élèves':$girls.' élève' ?></p>
                            </div>
                            <div class="card-footer border-0 bg-info ">
                                <p class="card-text h6">Total de filles inscris</p>
                            </div>
                        </div>
                    </div>

                    <!-- le nombre total de classe -->
                    <div class="col m-auto">
                        <div class="card  mb-3 border-0 shadow" style="width: 12rem">
                            <div class="card-body d-flex justify-content-between bg-white text-info">
                                <img src="./../icon/classroom.png" width="50px" />
                                <p class="card-text text-center d-inline">
                                    <?php echo ($classes>1)? $classes.' élèves':$classes.' élève' ?>
                                </p>
                            </div>
                            <div class="card-footer border-0 bg-info ">
                                <p class="card-text h6">Total de classe</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
    <footer></footer>
    <script src="js/bootstrap.js"></script>
</body>

</html>