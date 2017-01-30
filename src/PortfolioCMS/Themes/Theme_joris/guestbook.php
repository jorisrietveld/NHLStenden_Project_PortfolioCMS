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
<div class="navbar navbar-default navbar-fixed-top">

    <div class="container">

        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <div class="navbar-collapse collapse" id="navbar-main">
            <ul class="nav navbar-nav">
                <?php foreach ($dataProvider->get( 'pages' ) as $page): ?>
                    <?php if ( $hasPageSuffix ): ?>
                        <li>
                            <a href=".<?= $page->getUrl() ?>"><?= $page->getName() ?></a>
                        </li>
                    <?php else: ?>
                        <li>
                            <a href="<?= $dataProvider->get( 'url' ) . $page->getUrl() ?>"><?= $page->getName() ?></a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>

            <ul class="nav navbar-nav navbar-right">

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="portfolio-menu">
                        <i class="fa fa-address-card" aria-hidden="true"></i>&nbsp;&nbsp;Portfolio's<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="portfolio-menu">
                        <?php foreach ($dataProvider->get( 'portfoliosMetadata' ) as $portfolio): ?>
                            <?php if ( $hasPageSuffix ) : ?>
                                <li>
                                    <a href="../../portfolio/<?= $portfolio->getUrl() ?>"><?= $portfolio->getStudentName() ?></a>
                                </li>
                            <?php else: ?>
                                <li>
                                    <a href="../portfolio/<?= $portfolio->getUrl() ?>"><?= $portfolio->getStudentName() ?></a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </li>

                <li class="dropdown">
                    <?php if ( $dataProvider->isGuest() ): ?>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="login-form">
                            Aanmelden<span class="caret"></span>
                        </a>
                        <div class="dropdown-menu" style="padding:17px;">
                            <form class="form" id="login-form" action="../login" method="post">
                                <input name="email" id="login-form-email" placeholder="Email adres" type="email" class=""/>
                                <input name="password" id="login-form-password" placeholder="Wachtwoord" type="password" class=""/>
                                <input name="Aanmelden" type="submit" id="form-submit" value="Aanmelden" class="btn btn-info"/>
                            </form>
                        </div>
                    <?php else: ?>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="profile-menu">
                            <i class="fa fa-user-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;Mijn account<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="profile-menu">
                            <li>
                                <a href="../../../admin/editStudent/<?php echo $dataProvider->getCurrentUserId() ?>">Mijn Profiel</a>
                            </li>
                            <li>
                                <a href="../../../admin/portfolio_van/<?php echo  $dataProvider->getCurrentUserId() ?>">Mijn Portfolio</a>
                            </li>
                            <li>
                                <a href="../../../admin/cijferAdministratie/<?php echo  $dataProvider->getCurrentUserId() ?>">Mijn Cijfers</a>
                            </li>
                            <li>
                                <a href="../../../admin/moderateGuestbook/<?php echo $dataProvider->getCurrentUserId() ?>">Mijn Gastenboek berichten</a>
                            </li>
                            <li>
                                <a href="../../../logout">Afmelden</a>
                            </li>
                        </ul>
                    <?php endif; ?>
                </li>
            </ul>

        </div>
    </div>
</div>
<div class="page-wrapper container">
    <header class="jumbotron text-center row" id="portfolio-header">
        <h1 class="col-lg-12 text-mono">
            <span class="color-orange">write nand pts/1<?= $dataProvider->call('httpRequest','getClientIp') ?>@<?= $dataProvider->call( 'httpRequest', 'getServerIp' ) ?>:~$</span> whoami
        </h1>
    </header>

    <main>
        <section class="jumbotron row">
            <div class="col-lg-9">
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
            <img class="img-circle header-profile-picture col-lg-3" src="<?= $dataProvider->get( 'asset-path' ) ?>images/profile.jpg"/>
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
    </main>
</div>
<!-- Jquery javascript library -->
<script src="<?= $dataProvider->get( 'lib-path' ) ?>jquery/dist/jquery.min.js" type="text/javascript"></script>
<!-- Bootstrap javascript library -->
<script src="<?= $dataProvider->get( 'lib-path' ) ?>bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
</body>
</htmL>
