<!doctype html>
<?php

$page_title = "Overzicht | Admin";
$isOnAdminPage = "portfolio";

include 'header.php'; ?>
<body>

<?php include 'navigation.php' ?>

<div class="content">
    <div class="">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <div class="content table-responsive table-full-width">
                            <?php if ( $dataProvider->isOwnOrAdmin() ) : ?>
                            <h4 class="title text-center">
                                <strong>
                                    <?php if ( $dataProvider->isAtLeasedTeacher() ): ?>
                                        Portfolio van <?= $dataProvider->call( 'student', 'getFirstName' ) . ' ' . $dataProvider->call( 'student', 'getLastName' ) ?>
                                    <?php else : ?>
                                        Mijn Portfolio
                                    <?php endif; ?>
                                </strong>
                            </h4>
                            <hr class="style-one"/>
                            <div class="col-sm-5 custom-buttons">

                            </div>
                            <form class="form-custom float-left" action="" method="POST">
                                <?php if ( $dataProvider->hasFeedback() ) : ?>
                                    <div class="alert alert-<?= $dataProvider->get( 'feedback-type' ) ?>">
                                        <span><?= $dataProvider->get( 'feedback' ) ?></span>
                                    </div>
                                <?php endif; ?>
                                <br>
                                <h4 class="title text-center">
                                    <strong>
                                        Werk ervaringen
                                    </strong>
                                </h4>
                                <hr class="style-one"/>
                                <div class="col-sm-5 custom-buttons">
                                    <a href="../addJobExperience/<?= $dataProvider->get( 'id' ) ?>">
                                        <button class="btn btn-md btn-primary btn-block btn-custom">
                                            <i class="fa fa-plus"></i> Werk ervaring toevoegen
                                        </button>
                                    </a>
                                </div>
                                <table class="table table-hover table-custom-portfolio">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Id</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($dataProvider->get( 'guestBookMessages' ) as $guestBookMessage ): ?>
                                        <tr>

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
</div>
<?php include 'footer.php' ?>
<?php include 'scripts.php' ?>
</body>
</html>
