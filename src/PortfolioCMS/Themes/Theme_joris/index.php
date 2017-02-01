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
    <!-- Font awesome css file-->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<?php include __DIR__ . DIR_SEP . 'navigation.php'; ?>
<div class="page-wrapper container">
    <header class="jumbotron text-center row" id="portfolio-header">
        <h1 class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-mono">
            <span class="color-orange header-text-size"><?= $student->getFirstName() ?>@<?= $dataProvider->call( 'httpRequest', 'getServerIp' ) ?>:~$</span> whoami
        </h1>
    </header>

    <main>
        <section class="jumbotron row">
            <div class="col-lg-9 col-md-6 col-sm-12 col-xs-12">
                <h1><?= $student->getFirstName() . ' ' . $student->getLastName() ?></h1>
                <h4>
                    <i class="fa fa-birthday-cake" aria-hidden="true"></i>
                    <?= $student->getDateOfBirth()->format( 'Y-m-d' ) ?></h4>
                <h4>
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    <?= $student->getEmail() ?>
                </h4>
                <h4>
                    <i class="fa fa-road" aria-hidden="true"></i>
                    <?= $student->getAddress() ?>
                </h4>
                <h4>
                    <i class="fa fa-home" aria-hidden="true"></i>
                    <?= $student->getZipCode() . ' ' . $student->getLocation() ?>
                </h4>
                <h4>
                    <i class="fa fa-mobile" aria-hidden="true"></i>
                    <?= $student->getPhoneNumber() ?>
                </h4>

            </div>
                <img
                class=" pull-right img-circle header-profile-picture col-lg-3 col-md-4 col-sm-12 col-xs-12"
                src="../../../images/<?= $dataProvider->nestedCall( 'images', 'getEntityWith:getFileName', [ [ 'type', 'PROFILE_IMAGE' ], [] ] )?>"
                alt="<?= $dataProvider->nestedCall( 'images', 'getEntityWith:getDescription', [ [ 'type', 'PROFILE_IMAGE' ], [] ] )?>"/>
        </section>

        <section class="jumbotron row">
            <div class="col-lg-4">
                <h3>Mijn Vaardigheden</h3>
                <?php foreach ( $dataProvider->get('skills', []) as $skill ) : ?>
                    <?= $skill->getName()?><br>
                    <?php for( $i = 0; $i < 10; $i++ ) : ?>
                        <i class="color-orange fa fa-circle<?= $skill->getLevelOfExperience() <= $i ? '-o': ''?>" aria-hidden="true"></i>
                    <?php endfor; ?>
                    <br>
                <?php endforeach; ?>
            </div>
            <div class="col-lg-4">
                <h3>Mijn Talen</h3>
                <?php foreach ( $dataProvider->get('languages', []) as $language ) : ?>
                    <?= $language->getLanguage()?><br>
                    <?php for( $i = 0; $i < 10; $i++ ) : ?>
                        <i class="color-orange fa fa-circle<?= $language->getLevel() <= $i ? '-o': ''?>" aria-hidden="true"></i>
                    <?php endfor; ?>
                    <br>
                <?php endforeach; ?>
            </div>
            <div class="col-lg-4">
                <h3>Mijn Hobbies</h3>
                <?php foreach ( $dataProvider->get('hobbies', []) as $hobby ) : ?>
                    <?= $hobby->getName()?><br>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="jumbotron row">
            <div class="col-lg-12">
                <h3>Mijn Opleidingen</h3>
                <?php foreach ( $dataProvider->get('trainings', []) as $training ) : ?>
                    <div class="col-lg-12 row">
                        <h4 class="col-lg-12">
                            <span class="color-orange"><?= $training->getTitle()?></span>
                            &nbsp;@&nbsp;
                            <span class="color-purple"><?= $training->getInstitution()?></span>
                        </h4>
                        <div class="col-lg-11">
                        <?= $training->getDescription()?><br><br>
                        </div>
                        <div class="col-lg-1">
                            <?php if ( !$training->getCurrentTraining() ): ?>
                                <img alt="certificate icon" class="certificate-icon" src="<?= $dataProvider->get( 'asset-path' ) ?>/images/obtained_certificate<?= $training->getObtainedCertificate()? '':'_not'?>.png"/>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="jumbotron row">
            <div class="col-lg-6">
                <h3>Mijn Werkervaringen</h3>
                <?php foreach( $dataProvider->call( 'jobExperiences', 'getEntitiesWith', [ 'IsInternship', FALSE ] ) as $jobExperience ) : ?>
                    <h4 class="color-orange"><?= $jobExperience->getLocation()?></h4>
                    <?= $jobExperience->getDescription()?><br><br>
                <?php endforeach; ?>
            </div>

            <div class="col-lg-6">
                <h3>Mijn Stages</h3>
                <?php foreach( $dataProvider->call( 'jobExperiences', 'getEntitiesWith', [ 'IsInternship', TRUE ] ) as $internship ) : ?>
                    <h4 class="color-orange"><?= $internship->getLocation()?></h4>
                    <?= $internship->getDescription()?><br><br>
                <?php endforeach; ?>
            </div>
            <?php if( $dataProvider->call( 'cv', 'getId' ) !== 0 ): ?>
                <a class="btn btn-lg btn-info col-lg-12" href="../../slbAssignments/<?= $dataProvider->call( 'cv', 'getFileName' )?>" download>
                    <i class="fa fa-download" aria-hidden="true"></i>&nbsp;&nbsp;Download mijn CV
                </a>
            <?php endif; ?>
        </section>

        <section class="jumbotron row">
           <h3>Mijn foto's</h3>
            <?php foreach ( $dataProvider->get( 'images' ) as $image ): ?>
                <?php dump( $image ) ?>
            <?php endforeach; ?>
        </section>


    </main>
</div>
<!-- Jquery javascript library -->
<script src="<?= $dataProvider->get( 'lib-path' ) ?>jquery/dist/jquery.min.js" type="text/javascript"></script>
<!-- Bootstrap javascript library -->
<script src="<?= $dataProvider->get( 'lib-path' ) ?>bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
</body>
</htmL>
