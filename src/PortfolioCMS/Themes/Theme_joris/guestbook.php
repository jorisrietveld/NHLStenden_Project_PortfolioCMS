<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 13-01-2017 17:55
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */

$student = $dataProvider->get( 'student' );
$hasPageSuffix = FALSE !== strpos( $dataProvider->call( 'httpRequest', 'getBaseUrl' ), $dataProvider->get( 'current-page' ) );
?>
<!DOCTYPE html>
<htmL>
<head>
    <title><?= $dataProvider->get( 'title' ) ?></title>
    <!-- Custom bootstap css lib in ubuntu style -->
    <link rel="stylesheet" href="<?= $dataProvider->get( 'asset-path' ) ?>css/bootstrap_ubuntu.css" type="text/css"/>
    <!-- Compiled custom stylesheet -->
    <link rel="stylesheet" href="<?= $dataProvider->get( 'asset-path' ) ?>css/styles.css" type="text/css"/>
    <!-- Font awesome icons-->
    <link rel="stylesheet" href="<?= $dataProvider->get( 'lib-path' ) ?>font-awesome/css/font-awesome.min.css" type="text/css"/>
</head>
<body>
<?php include __DIR__ . DIR_SEP . 'navigation.php'; ?>
<div class="page-wrapper container">
    <header class="jumbotron text-center row" id="portfolio-header">
        <h1 class="col-lg-12 text-mono">
            <span class="color-orange">Gastenboek</span> /var/mail/<?= $student->getFirstName() ?>
        </h1>
    </header>

    <main>
        <section class="jumbotron row">
            <form method="POST" action="">
                <?php if ( $dataProvider->hasFeedback() ) : ?>
                    <div class="alert alert-<?= $dataProvider->get( 'feedback-type' ) ?>">
                        <strong><?= $dataProvider->get( 'feedback-type' ) == 'success' ? '<i class="fa fa-check-square" aria-hidden="true"></i>Bedankt!' : '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>Oeps er ging iets mis' ?></strong><br>
                        <span><?= $dataProvider->get( 'feedback' ) ?></span>
                    </div>
                <?php endif; ?>
                <h2 class="text-center">Laat een reactie achter:</h2>
                <br/>
                <div class="col-lg-12">

                    <div class="form-group form-group-lg">
                        <label for="sender" hidden>Type hier je naam</label>
                        <input class="form-control" type="text" placeholder="Je naam" id="sender" name="sender"/>
                    </div>

                    <div class="form-group form-group-lg">
                        <label for="title" hidden>Type hier de titel</label>
                        <input class="form-control" type="text" placeholder="Je titel" id="title" name="title"/>
                    </div>

                    <div class="form-group form-group-lg">
                        <label for="message" hidden>Type hier je bericht:</label>
                        <textarea class="form-control" placeholder="Type hier je bericht" id="message" name="message"></textarea>
                    </div>
                    <input type="hidden" value="<?=$student->getId()?>" name="studentId" id="studentId"/>
                    <input type="submit" class="btn btn-info col-lg-12" value="Plaats je bericht"/>
                </div>
            </form>
        </section>

        <section class="jumbotron row">
            <h2 class="text-center">Berichten van gebruikers</h2>
            <?php if( count( $dataProvider->get( 'guestBookMessages' ) )) : ?>
                <?php foreach ( $dataProvider->get( 'guestBookMessages', [] ) as $guestBookId => $guestBookMessageEntity ) : ?>
                    <br/>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <?= $guestBookMessageEntity->getSender() ?>
                                <span class="pull-right"><?= strftime( '%A %e %B %Y', $guestBookMessageEntity->getSendAt()->getTimestamp()) . ' om ' . $guestBookMessageEntity->getSendAt()->format( 'H:m' )?></span>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <h3 class="color-purple"><?= $guestBookMessageEntity->getTitle() ?></h3>
                            <?= $guestBookMessageEntity->getMessage() ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>
    </main>
</div>
<!-- Jquery javascript library -->
<script src="<?= $dataProvider->get( 'lib-path' ) ?>jquery/dist/jquery.min.js" type="text/javascript"></script>
<!-- Bootstrap javascript library -->
<script src="<?= $dataProvider->get( 'lib-path' ) ?>bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
</body>
</htmL>
