<!doctype html>
<?php

$page_title = "Gastenboek berichten | Admin";
$pageName = "guestBook";

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
                                <?php if ( $dataProvider->hasFeedback() ) : ?>
                                    <div class="alert alert-<?= $dataProvider->get( 'feedback-type' ) ?>">
                                        <span><?= $dataProvider->get( 'feedback' ) ?></span>
                                    </div>
                                <?php endif; ?>
                                <br/>
                                <h4 class="title text-center">
                                    <strong>
                                        GastBoek berichten
                                    </strong>
                                </h4>
                                <hr class="style-one"/>
                                <table class="table table-custom-portfolio">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Verstuurd door</th>
                                            <th>Verstuurd op</th>
                                            <th>Bericht</th>
                                            <th>Weergave aanpassen</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($dataProvider->get( 'guestBookMessages', [] ) as $guestBookMessage): ?>
                                            <tr>
                                                <td>
                                                    <?= $guestBookMessage->getId() ?>
                                                </td>
                                                <td>
                                                    <?= $guestBookMessage->getSender() ?>
                                                </td>
                                                <td>
                                                    <?= $guestBookMessage->getSendAt()->format( 'd-m-Y H:i' ) ?>
                                                </td>
                                                <td>
                                                    <?= $guestBookMessage->getMessage() ?>
                                                </td>
                                                <td>
                                                    <input type="hidden" value="<?= $guestBookMessage->getId() ?>" id="messageId" name="messageId" required/>
                                                    <input type="hidden" value="<?= !$guestBookMessage->getIsAccepted() ?>" id="isAccepted" name="isAccepted" required/>
                                                    <input class="btn btn-primary btn-custom" type="submit" value="Bericht <?= $guestBookMessage->getIsAccepted() ? 'Verbergen' : 'Toestaan' ?>"/>
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
    </div>
<?php include 'footer.php' ?>
<?php include 'scripts.php' ?>
</body>
</html>
