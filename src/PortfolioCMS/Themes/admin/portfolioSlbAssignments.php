<!doctype html>
<?php

$page_title = "Slb opdrachten | Admin";
$pageName = "portfolio";

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
                                Portfolio van <?= $dataProvider->call( 'student', 'getFirstName' ) . ' ' . $dataProvider->call( 'student', 'getLastName' ) ?>
                            </strong>
                        </h4>

                        <hr class="style-one"/>
                        <form class="form-custom " action="" method="POST">

                            <?php if ( $dataProvider->hasFeedback() ) : ?>
                                <div class="alert alert-<?= $dataProvider->get( 'feedback-type' ) ?>">
                                    <span><?= $dataProvider->get( 'feedback' ) ?></span>
                                </div>
                            <?php endif; ?>

                            <div class="form-group">
                                <br/>
                                <label class="form-label" for="title">Cijfer geven aan dit portfolio:</label>

                                <input type="number"
                                       name="grade"
                                       class="form-control"
                                       id="grade"
                                       placeholder="Cijfer"
                                       value="<?= $dataProvider->get( 'grade' ) ?>"
                                       required>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 clearfix"><br/></div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-custom">Cijfer opslaan</button>

                        </form>

                        <br>
                        <br>
                        <h4 class="title text-center">
                            <strong>
                                SLB opdrachen van <?= $dataProvider->call( 'student', 'getFirstName' ) . ' ' . $dataProvider->call( 'student', 'getLastName' ) ?>
                            </strong>
                        </h4>
                        <hr class="style-one"/>
                        <table class="table table-hover table-custom-portfolio">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Naam</th>
                                <th>Feedback</th>
                                <th>Feedback toevoegen</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($dataProvider->get( 'slbAssignments', [] ) as $slbAssignment): ?>
                                <tr>
                                    <td><?= $slbAssignment->getId() ?></td>
                                    <td><?= $slbAssignment->getName() ?></td>
                                    <td><?= $slbAssignment->getFeedback() ?></td>
                                    <td>
                                        <a href="../addFeedback/<?= $slbAssignment->getId() ?>">
                                            <button class="btn btn-md btn-primary btn-block btn-custom">
                                                <i class="fa fa-edit"></i>
                                                Feedback toevoegen
                                            </button>
                                        </a>
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
