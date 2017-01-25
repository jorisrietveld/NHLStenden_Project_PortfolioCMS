<?php 
$student = $dataProvider->get( 'student' );
?>
<!DOCTYPE html>
<html>
    <head>
        <!-- Bootstrap css lib -->
        <link rel="stylesheet" href="<?= $dataProvider->get("lib-path") ?>bootstrap/dist/css/bootstrap.min.css" />

        <!-- Custom css lib -->
        <link rel="stylesheet" type="text/css" href="<?= $dataProvider->get( 'asset-path' ) ?>css/styles.css"/>
        <link href="<?= $dataProvider->get( 'lib-path' )?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        
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
                      <li><a href="http://digitaalportfolio/">HOME</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">PORTFOLIO'S <span class="fa fa-caret-down"></span></a>
                        <ul class="dropdown-menu">
                            <?= $dataProvider->get( 'portfolioMenuLinks', '' ) ?>
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
                    <h1>Portefolio</h1>
                    <p><?= $student->getFirstName() . " " . $student->getLastName(); ?></p>
                </div>
            </div>
            <div id="over" class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Over mij</h2>
                        <p></p>
                    </div>
                </div>
            </div>
            <div id="cv" class="container-fluid bg-grey">
              <div class="row">
                <div class="col-sm-6">
                    <h2>CV</h2>
                    <p>In mijn CV staat al mijn werk ervaring en mijn contactgegevend.</p>
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
            <div id="SLB" class="bg-grey container-fluid">
                
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
                        <p><span class="glyphicon glyphicon-home"></span> <?= $student->getaddress() . " " . $student->getlocation() ?></p>
                    </div>
                    <div class="col-sm-7">
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <input class="form-control" id="name" name="name" placeholder="Naam" type="text" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
                            </div>
                        </div>
                        <textarea class="form-control" id="comments" name="comments" placeholder="Reactie" rows="5"></textarea><br>
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <button class="btn btn-default pull-right" type="submit">Send</button>
                            </div>
                        </div>
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
