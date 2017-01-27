<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Portfolio Aron Soppe</title>

    <!-- Bootstrap css lib -->
    <link rel="stylesheet" href="<?= $dataProvider->get( 'lib-path' )?>bootstrap/dist/css/bootstrap.min.css" />

    <!-- CSS -->
    <link href="<?= $dataProvider->get( 'asset-path' )?>css/freelancer.css" rel="stylesheet" />
    <link href="<?= $dataProvider->get( 'asset-path' )?>css/styles.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?= $dataProvider->get( 'lib-path' )?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= $dataProvider->get( 'lib-path' )?>google-fonts/aron_fonts.css" rel="stylesheet" type="text/css" />
    <?= $dataProvider->call( 'debugBarRenderer', 'renderHead' ) ?>
</head>

<body id="page-top" class="index">
<?php dump($dataProvider); ?>
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
                <a class="navbar-brand" href="#page-top">Portfolio Aron</a>
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
                        <?= $dataProvider->get( 'portfolioMenuLinks', '' ) ?>
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
                    <span class="name">Aron Soppe</span>
                    <hr class="linestyle">
                    <span class="skills">Informatica student Stenden - Digitaal Portfolio</span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Portfolio Grid Section -->
<!-- <section id="portfolio">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Portfolio</h2>
                <hr class="linestyle">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 portfolio-item">
                <a href="#portfolioModal1" class="portfolio-link" data-toggle="modal">
                    <div class="caption">
                        <div class="caption-content">
                            <i class="fa fa-search-plus fa-3x"></i>
                        </div>
                    </div>
                    <img src="img/naturebg.jpg" class="img-responsive" alt="">
                </a>
            </div>
        </div>
    </div>
</section> -->

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
                    Plaats:
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
<section id="talen">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Mijn talen</h2>
                <hr class="linestyle">
            </div>
        </div>
        <div class="row">

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
        <div class="row">

        </div>
    </div>
</section>

<!-- Werkervaring Section -->
<section id="werkervaring">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Mijn werkervaring</h2>
                <hr class="linestyle">
            </div>
        </div>
        <div class="row">

        </div>
    </div>
</section>

<!-- CV Section -->
<section class="success" id="cv">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Mijn CV</h2>
                <hr class="linestyle">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-lg-offset-2">
                <p>placeholder</p>
            </div>
            <div class="col-lg-4">
                <p>placeholder</p>
            </div>
            <div class="col-lg-8 col-lg-offset-2 text-center">
                <a href="#" class="btn btn-lg btn-outline">
                    <i class="fa fa-spinner fa-pulse fa-fw"></i> button
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Gastenboek Section -->
<section id="gastenboek">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Gastenboek</h2>
                <hr class="linestyle">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
                <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
                <form name="sentMessage" id="contactForm" novalidate>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Naam</label>
                            <input type="text" class="form-control" placeholder="Naam" id="name" required
                                   data-validation-required-message="Vul je naam in.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Emailadres</label>
                            <input type="email" class="form-control" placeholder="Emailadres" id="email" required
                                   data-validation-required-message="Vul je emailadres in.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Bericht</label>
                            <textarea rows="5" class="form-control" placeholder="Bericht" id="message" required
                                      data-validation-required-message="Vul een bericht in."></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <br>
                    <div id="success"></div>
                    <div class="row">
                        <div class="form-group col-xs-12">
                            <button type="submit" class="btn btn-success btn-lg">Send</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- SLB Section -->
<section class="success" id="slb">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Mijn SLB opdrachten</h2>
                <hr class="linestyle">
            </div>
        </div>
        <div class="row">

        </div>
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

<!-- Footer -->
<footer class="text-center">
    <div class="footer-above">
        <div class="container">
            <div class="row">
                <div class="footer-col col-md-12">
                    <h3>Social Media</h3>
                    <ul class="list-inline">
                        <li>
                            <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-facebook"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-below">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    Copyright &copy; Aron Soppe
                </div>
            </div>
        </div>
    </div>
</footer>

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
