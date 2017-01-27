<!doctype html>
<?php

$page_title = "Overzicht | Admin";
$isOnAdminPage = "overzicht";

include 'header.php'; ?>
<body>

<?php include 'navigation.php' ?>

<div class="content">
    <div class="">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title text-center">
                            <strong>
                                <?php if( $dataProvider->isAtLeasedTeacher() ):?>
                                    Cijfers van <?= $dataProvider->call( 'student', 'getFirstName' ) . ' ' . $dataProvider->call( 'student', 'getLastName' ) ?>
                                <?php else : ?>
                                    Mijn cijfers
                                <?php endif; ?>
                            </strong>
                        </h4>
                        <hr class="style-one"/>
                        <div class="col-sm-5 custom-buttons">

                        </div>
                        <table class="table table-hover table-custom-portfolio">
                            <thead>
                            <tr>
                                <th>Naam student</th>
                                <th><span class="pull-right">Cijfer</span></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ( $dataProvider->get( 'grade-data' ) as $grade): ?>
                                <tr>
                                    <td><?= $grade['name'] ?></td>
                                    <td>
                                       <span class="pull-right"><?= $grade['grade'] == 0 ? 'Nog geen cijfer toegekend':$grade['grade'] ?></span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php' ?>
<?php include 'scripts.php' ?>
</body>
</html>
