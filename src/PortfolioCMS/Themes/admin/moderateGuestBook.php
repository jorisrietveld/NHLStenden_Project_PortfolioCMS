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
                            <h4 class="title text-center">
                                <strong>
                                    <?php if ( $dataProvider->isAtLeasedTeacher() ): ?>
                                        Gastenboek berichen van <?= $dataProvider->call( 'student', 'getFirstName' ) . ' ' . $dataProvider->call( 'student', 'getLastName' ) ?>
                                    <?php else : ?>
                                        Mijn Gastenboek berichten
                                    <?php endif; ?>
                                </strong>
                            </h4>
                            <hr class="style-one"/>
                            <div class="col-sm-5 custom-buttons">
                            </div>

                            <form class="form-custom float-left" action="" method="POST">
                                <br/>
                                <h4 class="title text-center">
                                    <strong>
                                        GastBoek berichten
                                    </strong>
                                </h4>
                                <hr class="style-one"/>

                                <?php foreach ($dataProvider->get( 'guestBookMessages', [] ) as $guestBookMessage): ?>
                                    <table class="table table-hover table-custom-portfolio">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Verstuurd door</th>
                                            <th>Bericht</th>
                                            <th>Verstuurd op:</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <?php if ( $guestBookMessage->getIsAccepted() ) : ?>
                                                <td>
                                                    <input type="button" value="TRUE" id="isAccepted" name="isAccepted" required/>
                                                </td>
                                            <?php else: ?>
                                                <td>
                                                    <input type="button" value="FALSE" id="isAccepted" name="isAccepted" required/>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                        </tbody>
                                    </table>
                                <?php endforeach; ?>
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
