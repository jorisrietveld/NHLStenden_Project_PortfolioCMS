<?php
$student = $dataProvider->get( 'student' );
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Bootstrap css files -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Font awesome css file-->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <!-- Custom css lib -->
    <link rel="stylesheet" type="text/css" href="<?= $dataProvider->get( 'asset-path' ) ?>css/styles.css"/>

    <title>Portfolio</title>
    <?= $dataProvider->call( 'debugBarRenderer', 'renderHead' ) ?>
</head>
<body>
<main class="page-content">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><?= $student->getFirstName() . " " . $student->getLastName(); ?></a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="http://www.profolio.ml/">HOME</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">PORTFOLIO'S
                            <span class="fa fa-caret-down"></span></a>
                        <ul class="dropdown-menu">
                            <?php foreach ($dataProvider->get( 'portfoliosMetadata' ) as $portfolio): ?>
                                <li>
                                    <a href="../portfolio/<?= $portfolio->getUrl() ?>"><?= $portfolio->getStudentName() ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li><a href="#over">OVER</a></li>
                    <li><a href="#cv">CV</a></li>
                    <li><a href="#cijfers">CIJFERS</a></li>
                    <li><a href="#galerij">GALERIJ</a></li>
                    <li><a href="#contact">CONTACT</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="jumbotron text-center">
        <div id="title">
            <h1>Portfolio</h1>
            <p><?= $student->getFirstName() . " " . $student->getLastName(); ?></p>
        </div>
    </div>
    <div id="over" class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h2>Over mij</h2>
                <p>Mijn naam is Kevin Tabak mijn roepnaam is Kevin. Ik ben een 18 jarige student enthousiast en nog
                    vol energie om zo te zeggen. Ik heb nog niet veel werk ervaring omdat ik nog jong bent maar dat
                    betekent dat ik alleen maar meer kan leren.</p>
            </div>
        </div>
    </div>
    <div id="cv" class="container-fluid bg-grey">
        <div class="row">
            <div class="col-sm-6">
                <h2>CV</h2>
                <p>In mijn CV staat al mijn werkervaring en mijn contactgegevend.</p>
            </div>
            <div class="col-sm-4 text-center">
                <h2>Download</h2>
                <a href="files/CV.pdf" target="_blank" id="DownCV">
                    <span class="glyphicon glyphicon-file"></span>
                    <p>CV.pdf</p>
                </a>
            </div>
        </div>
    </div>
    <div id="cijfers" class="container-fluid">
        <div class="row">
            <div id="CTable" class="col-sm-3 text-center">
                <h2>Cijfers</h2>
                <table class="table">
                    <thead>
                    <tr>
                        <th class="text-center">Vak</th>
                        <th class="text-center">Cijfer</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>SLB</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Project</td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="galerij" class="container-fluid text-center">
        <h2>Galerij</h2>
        <h4>Mijn afbeeldingen</h4>
        <div class="row text-center">
            <div class="col-sm-3">
                <div class="thumbnail">
                    <img src="<?= $dataProvider->get( 'asset-path' ) ?>files/me-1.jpg" alt="WOW">
                    <p><strong>WOW</strong></p>
                    <p>very wow</p>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="thumbnail">
                    <img src="<?= $dataProvider->get( 'asset-path' ) ?>files/me-2.jpg" alt="WOW">
                    <p><strong>WOW</strong></p>
                    <p>very wow</p>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="thumbnail">
                    <img src="<?= $dataProvider->get( 'asset-path' ) ?>files/me-3.jpg" alt="WOW">
                    <p><strong>WOW</strong></p>
                    <p>very wow</p>
                </div>
            </div>
        </div>
    </div>
    <div id="contact" class="container-fluid bg-grey">
        <h2 class="text-center">CONTACT</h2>
        <div class="row">
            <div class="col-sm-5">
                <h4>Neem contact met mij op.</h4>
                <p><span class="glyphicon glyphicon-phone"></span> <?= $student->getPhoneNumber() ?></p>
                <p><span class="glyphicon glyphicon-envelope"></span> <?= $student->getEmail() ?></p>
                <h4>Meer informatie over mij:</h4>
                <p>
                    <span class="glyphicon glyphicon-home"></span> <?= $student->getaddress() . " " . $student->getlocation() ?>
                </p>
            </div>
            <div class="col-sm-7">
                <form name="sentMessage" id="contactForm" action='' method='POST' novalidate>
                    <?php if ( $dataProvider->hasFeedback() ) : ?>
                        <div class="alert alert-<?= $dataProvider->get( 'feedback-type' ) ?>">
                            <strong><?= $dataProvider->get( 'feedback-type' ) == 'success' ? '<i class="fa fa-check-square" aria-hidden="true"></i>&nbsp;Bedankt!' : '<i class="fa fa-exclamation-triangle" aria-hidden="true">&nbsp;</i>Oeps er ging iets mis' ?></strong><br>
                            <span><?= $dataProvider->get( 'feedback' ) ?></span>
                        </div>
                    <?php endif; ?>

                        <div class="col-sm-6 col-lg-6 form-group">
                            <input class="form-control" id="sender" name="sender" placeholder="Naam" type="text" required>
                        </div>

                        <div class="col-sm-6 col-lg-6 form-group">
                            <input class="form-control" id="onderwerp" name="title" placeholder="Onderwerp" type="text" required>
                        </div>
                        <div class="col-sm-12 col-lg-12 form-group">
                            <textarea class="form-control" id="message" name="message" placeholder="Reactie" rows="5"></textarea><br>
                        </div>
                        <input type="hidden" value="<?= $dataProvider->call( 'student', 'getId' ) ?>" name="studentId" id="studentId"/>
                        <div class="row">
                            <div class="col-sm-12 col-lg-12 form-group">
                                <button class="btn btn-default pull-right" type="submit">Send</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</main>
<!-- jQuery -->
<script src="<?= $dataProvider->get( 'lib-path' ) ?>jquery/dist/jquery.min.js"></script>
<!-- Bootstrap js lib plugin -->
<script src="<?= $dataProvider->get( 'lib-path' ) ?>bootstrap/dist/js/bootstrap.min.js"></script>
<?= $dataProvider->call( 'debugBarRenderer', 'render' ) ?>
</body>
</html>
