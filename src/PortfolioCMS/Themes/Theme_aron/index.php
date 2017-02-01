<?php
$student = $dataProvider->get( 'student' );
$hasPageSuffix = FALSE !== strpos( $dataProvider->call( 'httpRequest', 'getBaseUrl' ), $dataProvider->get( 'current-page' ) );
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $dataProvider->get( 'title' ) ?></title>

    <!-- Font awesome css files -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <!-- Bootstrap css files -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- CSS -->
    <link href="<?= $dataProvider->get( 'asset-path' )?>css/freelancer.css" rel="stylesheet" />
    <link href="<?= $dataProvider->get( 'asset-path' )?>css/styles.css" rel="stylesheet">

    <link href="<?= $dataProvider->get( 'lib-path' )?>google-fonts/aron_fonts.css" rel="stylesheet" type="text/css" />
    <?= $dataProvider->call( 'debugBarRenderer', 'renderHead' ) ?>
</head>

<body id="page-top" class="index">

<!-- Navigation -->
<nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
            </button>
            <div class="page-title">
                <a class="navbar-brand" href="#page-top">Portfolio <?= $student->getFirstName() ?></a>
            </div>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="hidden">
                    <a href="#page-top"></a>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Portfolio's <span class="fa fa-caret-down"></span></a>
                    <ul class="dropdown-menu">
                        <?php foreach ($dataProvider->get( 'portfoliosMetadata' ) as $portfolio): ?>
                            <li>
                                <a href="../portfolio/<?= $portfolio->getUrl() ?>"><?= $portfolio->getStudentName() ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <li class="page-scroll">
                    <a href="#over">Over</a>
                </li>
                <li class="page-scroll">
                    <a href="#talen">Talen</a>
                </li>
                <li class="page-scroll">
                    <a href="#opleiding">Opleiding</a>
                </li>

                <li class="page-scroll">
                    <a href="#werkervaring">Werkervaring</a>
                </li>

                <li class="page-scroll">
                    <a href="#stages">Stages</a>
                </li>

                <li class="page-scroll">
                    <a href="#gastenboek">Gastenboek</a>
                </li>

                <li class="page-scroll">
                    <a href="#slb">SLB Opdrachten</a>
                </li>

                <li class="page-scroll">
                    <a href="#cijfers">Cijfers</a>
                </li>

                <li>
                    <?php if( isset( $_SESSION['userId'] ) ): ?>
                        <a href="/logout">
                            <i class="fa fa-sign-out"></i> Afmelden
                        </a>
                    <?php else: ?>
                        <a href="/login">
                            <i class="fa fa-sign-in"></i> Aanmelden
                        </a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>

<!-- Header -->
<header>
    <div class="container-fluid natureHeader">
        <div class="row">
            <div class="col-lg-12">
                <div class="intro-text">
                    <span class="name"><?= $student->getFirstName() ?> <?= $student->getLastName() ?></span>
                    <hr class="linestyle">
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Over Section -->
<section class="success" id="over">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Over mij</h2>
                <hr class="linestyle">
                <p class="records">
                    Naam:
                    <?php
                    $studentfn = $dataProvider->get( 'student' );
                    echo $studentfn->getFirstName();
                    ?>
                    <?php
                    $studentln = $dataProvider->get( 'student' );
                    echo $studentln->getLastName();
                    ?>


                </p>

                <p class="records">
                    Geboortedatum:
                    <?php
                    $birthdate = $dataProvider->get( 'student' );
                    echo $birthdate->getDateOfBirth()->format( 'd-m-Y' );
                    ?>
                </p>

                <p class="records">
                    Woonplaats:
                    <?php
                    $place = $dataProvider->get( 'student' );
                    echo $place->getLocation();
                    ?>
                </p>

                <p class="records">
                    Email:
                    <?php
                    $email = $dataProvider->get( 'student' );
                    echo $email->getEmail();
                    ?>
                </p>
            </div>
        </div>
        <div class="row">

        </div>
    </div>
</section>

<!-- Talen Section -->
<section   id="talen">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Mijn talen</h2>
                <hr class="linestyle">
            </div>
        </div>
        <div class="text-center">
        <?php foreach ( $dataProvider->get('languages', []) as $language ) : ?>
        <div class="col-lg-6 row">
            <?= $language->getLanguage()?><br>
            <?php for( $i = 0; $i < 10; $i++ ) : ?>
                <i class="fa fa-circle<?= $language->getLevel() <= $i ? '-o': ''?>" aria-hidden="true"></i>
            <?php endfor; ?>
            <br>
        </div>
        <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Opleiding Section -->
<section class="success" id="opleiding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Mijn opleidingen</h2>
                <hr class="linestyle">
            </div>
        </div>
        <?php foreach ( $dataProvider->get('trainings', []) as $training ) : ?>
            <div class="col-lg-12 row">
                <h4 class="col-lg-12">
                    <span class="color-orange"><?= $training->getTitle()?></span>
                    <i>@</i>
                    <span class="color-purple"><?= $training->getInstitution()?></span>
                </h4>
                <div class="col-lg-10">
                    <?= $training->getDescription()?><br><br>
                </div>
                <div class="col-lg-2">
                    Diploma behaald:
                    <?php
                    if($training->getObtainedCertificate() == true){

                        echo'<b>Ja</b>';
                    }else{
                        echo'<b>Nee</b>';
                    } ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Werkervaring Section -->
<section   id="werkervaring">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Mijn Werkervaring</h2>
                <hr class="linestyle">
            </div>
        </div>
        <?php foreach( $dataProvider->call( 'jobExperiences', 'getEntitiesWith', [ 'IsInternship', FALSE ] ) as $jobExperience ) : ?>
            <h4 class=""><?= $jobExperience->getLocation()?></h4>
            <?= $jobExperience->getDescription()?><br><br>
        <?php endforeach; ?>
    </div>
</section>

<!-- Stages Section -->
<section class="success"  id="stages">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Mijn Stages</h2>
                <hr class="linestyle">
            </div>
        </div>
        <?php foreach( $dataProvider->call( 'jobExperiences', 'getEntitiesWith', [ 'IsInternship', TRUE ] ) as $internship ) : ?>
            <h4 class="color-orange"><?= $internship->getLocation()?></h4>
            <?= $internship->getDescription()?><br><br>
        <?php endforeach; ?>
    </div>
</section>

<!-- Gastenboek Section -->
<section  id="gastenboek">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Gastenboek</h2>
                <hr class="linestyle">
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
            </div>
        </div>
        <div class="row">
            <hr>
            <p>Schrijf een bericht op de portfolio van <?= $student->getFirstName() ?> <?= $student->getLastName() ?>:</p>

            <div class="col-lg-8 col-lg-offset-2">
                <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
                <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
                <form name="sentMessage" id="contactForm" action='' method='POST' novalidate>
                    <?php if ( $dataProvider->hasFeedback() ) : ?>
                        <div class="alert alert-<?= $dataProvider->get( 'feedback-type' ) ?>">
                            <strong><?= $dataProvider->get( 'feedback-type' ) == 'success' ? '<i class="fa fa-check-square" aria-hidden="true"></i>&nbsp;Bedankt!' : '<i class="fa fa-exclamation-triangle" aria-hidden="true">&nbsp;</i>Oeps er ging iets mis' ?></strong><br>
                            <span><?= $dataProvider->get( 'feedback' ) ?></span>
                        </div>
                    <?php endif; ?>

                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label for="sender">Uw naam</label>
                            <input type="text" class="form-control" placeholder="Uw naam" name='sender' id="sender" required
                                   data-validation-required-message="Vul je naam in.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>

                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label for="title">Onderwerp</label>
                            <input type="text" class="form-control" placeholder="Onderwerp" name='title' id="title" required
                                   data-validation-required-message="Vul je naam in.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label for="message">Bericht</label>
                            <textarea rows="5" class="form-control" placeholder="Bericht" name='message' id="message" required
                                      data-validation-required-message="Vul een bericht in."></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <br>
                    <input type="hidden" value="<?= $dataProvider->call( 'student', 'getId' ) ?>" name="studentId" id="studentId"/>
                    <div id="success"></div>
                    <div class="row">
                        <div class="form-group col-xs-12">
                            <button type="submit" name='submit' class="btn btn-success btn-lg">Send</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- SLB Section -->
<section class="success" id="slb">
    <div class="container">        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Mijn SLB Opdrachten</h2>
                <hr class="linestyle">
            </div>
        </div>
        <?php foreach ( $dataProvider->get( 'slbAssignments', [] ) as $slbAssignment ) : ?>
            <button type="button" class="btn btn-info col-lg-12 col-md-12 col-sm-12 col-xs-12" data-toggle="modal" data-target="#model-<?=  $slbAssignment->getId() ?>">
                Bekijk de opdracht: <?= $slbAssignment->getName() ?>
            </button>
            <div class="col-lg-12">
                <?= strlen( $slbAssignment->getFeedback() ) == 0 ? 'Deze opdracht heeft geen feedback.' : $slbAssignment->getFeedback() ?>
                <br/>
                <br/>
            </div>

            <div class="modal fade" id="model-<?= $slbAssignment->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="slb-model=<?= $slbAssignment->getId()?>">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title"><?= $slbAssignment->getName() ?></h4>
                        </div>

                        <div class="modal-body">

                            <object
                                    class="pdf-object col-lg-12 col-md-12 col-sm-12 col-xs-1"
                                    type="application/pdf"
                                    data="../../../slbAssignments/<?= $slbAssignment->getFileName() ?>?#zoom=85&scrollbar=0&toolbar=0&navpanes=0"
                                    id="pdf-content-<?= $slbAssignment->getId() ?>">
                                <p>De slb opdracht kan niet worden weergegeven.</p>
                            </object>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-info col-lg-12 col-md-12 col-sm-12 col-xs-1" data-dismiss="modal">Opdracht sluiten</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Cijfers Section -->
<section id="cijfers">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Mijn Cijfers</h2>
                <hr class="linestyle">
            </div>
        </div>
        <div class="row">

        </div>
    </div>
</section>


<!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
<div class="scroll-top page-scroll hidden-sm hidden-xs hidden-lg hidden-md">
    <a class="btn btn-primary" href="#page-top">
        <i class="fa fa-chevron-up"></i>
    </a>
</div>

<!-- Portfolio Modals -->
<div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="modal-body">
                        <h2>Placeholder title</h2>
                        <hr class="linestyle">
                        <img src="img/naturebg.jpg" class="img-responsive img-centered" alt="">
                        <p>placeholder</p>
                        <ul class="list-inline item-details">
                            <li>placeholder:
                                <strong><a href="#">--</a>
                                </strong>
                            </li>
                        </ul>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i>
                            Sluiten
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- jQuery -->
<script src="<?= $dataProvider->get( 'lib-path' ) ?>jquery/dist/jquery.min.js"></script>
<!-- Bootstrap js lib plugin -->
<script src="<?= $dataProvider->get( 'lib-path' ) ?>bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Plugin JavaScript -->
<script src="<?= $dataProvider->get( 'lib-path' ) ?>jquery.easing/js/jquery.easing.min.js"></script>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<?= $dataProvider->call( 'debugBarRenderer', 'render' ) ?>
</body>
</html>
