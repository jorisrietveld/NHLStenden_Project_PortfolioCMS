<?php 
$student = $dataProvider->get( 'student' );
$language = $dataProvider->get( 'language' );
?>
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Portfolio Anouk van der Veen</title>
    <link rel="stylesheet" href="<?= $dataProvider->get( 'lib-path' )?>bootstrap/dist/css/bootstrap.min.css" />

    <!-- Custom Fonts -->
    <link href="<?= $dataProvider->get( 'lib-path' )?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?= $dataProvider->get( 'request-uri' ) ?>/assets/Theme_anouk/css/styles.css"/>
    <!-- Page styles -->
    <link rel="stylesheet" type="text/css" href="<?= $dataProvider->get( 'asset-path' )?>css/styles.css"/>
    <?= $dataProvider->call( 'debugBarRenderer', 'renderHead' ) ?>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand topnav" href="#">Portfolio Anouk</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden active">
                            <a href="#page-top"></a>
                        </li>
                        <li class="page-scroll">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-menu-down"></span> Portfolio's </a>
                            <ul class="dropdown-menu">
                                <?= $dataProvider->get( 'portfolioMenuLinks', '' ) ?>
                            </ul>
                        </li>
                        <li class="page-scroll">
                            <a href='#overmij'><span class="glyphicon glyphicon-user"></span> Over mij</a>
                        </li>
                        <li class="page-scroll">
                            <a href="#slbopdrachten"><span class="glyphicon glyphicon-pencil"></span> SLB Opdrachten</a>
                        </li>
                        <li class="page-scroll">
                            <a href="#cv"> <span class="glyphicon glyphicon-file"></span> CV</a>
                        </li>
                        <li class="page-scroll">
                            <a href="#cijfers"><span class="glyphicon glyphicon-ok"></span> Cijfers</a>
                        </li>
                        <li class="page-scroll">
                            <a href="#galerij"> <span class="glyphicon glyphicon-picture"></span> Galerij</a>
                        </li>
                        <li class="page-scroll">
                            <a href="#gastenboek"> <span class="glyphicon glyphicon-comment"></span> Gastenboek</a>   
                        </li>
<!--                        <li class="page-scroll">
                            <a href="#inloggen">
                                <i class="fa fa-sign-in"></i> Inloggen
                            </a>
                        </li>-->
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Header -->
    <a name="page-top"></a>
    <div class="intro-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-message">
                        <h1>
                            <?php
                            $studentfn = $dataProvider->get( 'student' );
                            echo $studentfn->getFirstName();
                            ?>
                            <?php
                            $studentln = $dataProvider->get( 'student' );
                            echo $studentln->getLastName();
                            ?>  
                        </h1>
                        <hr class="small">
                        <h3>Informatica Student</h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container -->
    </div>
    <!-- /.intro-header -->

    <!-- Page Content -->
    
    <a name="overmij"></a>
    <div class="content-section-b">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">Over mij</h2>
                    <p>
                    Hallo, ik ben
                    <?php
                            $studentfn = $dataProvider->get( 'student' );
                            echo $studentfn->getFirstName();
                            ?>
                            <?php
                            $studentln = $dataProvider->get( 'student' );
                            echo $studentln->getLastName();
                            ?><br>
                    Ik ben geboren op 
                            <?php
                            $birthdate = $dataProvider->get( 'student' );
                            echo $birthdate->getDateOfBirth()->format( 'd-m-Y' );
                            ?> <br>
                    Ik woon op 
                            <?php
                            $address = $dataProvider->get( 'student' );
                            echo $address->getAddress();
                            ?>
                    in <?= $student->getLocation(); ?> <br>
                    Mijn hobbies zijn
                            <?php foreach( $dataProvider->get( 'hobbies', [] ) as $hobby ) :?>
                            <?= $hobby->getName()?>,
                            <?php endforeach; ?><br>
                    De talen die ik spreek zijn 
                            <?php
                            echo $dataProvider->get( 'languages', [1] )[4]->getLanguage();
                            ?>
                    en
                            <?php
                            echo $dataProvider->get( 'languages', [1] )[5]->getLanguage();
                            ?><br>
                    Ik heb gewerkt als 
                        <?php
                            echo $dataProvider->get( 'jobExperiences', [1] )[2]->getDescription();
                        ?>
                    Bij 
                        <?php
                            echo $dataProvider->get( 'jobExperiences', [1] )[2]->getLocation();
                            ?>
                    van <?php
                            echo $dataProvider->get( 'jobExperiences', [1] )[2]->getStartedAt()->format( 'd-m-Y' );
                        ?>
                    tot <?php
                            echo $dataProvider->get( 'jobExperiences', [1] )[2]->getEndedAt()->format( 'd-m-Y' );
                        ?><br>
                    Nu werk ik bij
                        <?php
                            echo $dataProvider->get( 'jobExperiences', [] )[4]->getLocation();
                        ?>
                    als
                            <?php
                            echo $dataProvider->get( 'jobExperiences', [] )[4]->getDescription();
                            ?>
                    van <?php
                            echo $dataProvider->get( 'jobExperiences', [] )[4]->getStartedAt()->format( 'd-m-Y' );
                        ?>
                    tot heden
                    
                    
                           
                    <br>
                    <br>
                    </p>       
                </div>
                <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                    <img class="img-responsive" src="images/usericon.png" alt="icon">
                </div>
            </div>
        </div>
        <!-- /.container -->
    </div>
    </div>
    
    <a name="slbopdrachten"></a>
    <div class="content-section-a">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-lg-offset-1 col-sm-push-6  col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">SLB Opdrachten</h2>
                    <p class="lead">Hier vind je mijn slb opdrachten.</p>
                    <p>Hier staan alle opdrachten die ik voor slb heb gemaakt.</p>
                    <p>
                    </p>
                </div>
                <div class="col-lg-5 col-sm-pull-6  col-sm-6">
                    <img class="img-responsive" src="images/slb.jpg" alt="slb">
                </div>
            </div>
        </div>
        <!-- /.container -->
    </div>
        
    <!-- /.content-section-a -->
    <a name="cv"></a>
    <div class="content-section-b">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">CV</h2>
                    <p class="lead">Hier vind je mijn CV.</p>
                    <p>Download of bekijk hier mijn CV.</p>
                    <p>
                    </p>
                </div>
                <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                    <img class="img-responsive" src="images/CVicon.png" alt="">
                </div>
            </div>
        </div>
        <!-- /.container -->
    </div>
    </div>
   
    <a name="cijfers"></a>
    <div class="content-section-c">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-lg-offset-1 col-sm-push-6  col-sm-6">
                    <hr class="section-heading-spacer">
                        <div class="clearfix"></div>
                        <h2 class="section-heading">Cijfers</h2>
                        <p>De cijfers die ik heb gehaald.</p>
                        <p> 
                        </p>
                </div>
                <div class="col-lg-5 col-sm-pull-6  col-sm-6">
                    <img class="img-responsive" src="images/grade_a_plus.png" alt="">
                </div>
            </div>
        </div>
    </div>
    
    <a name="galerij"></a>
    <div class="content-section-b">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">Galerij</h2>
                    <p>Hier vind je mijn galerij. </p>
                    <p>
                    </p>
                    
                </div>
                <div class="col-lg-4 col-lg-offset-2 col-sm-6">
                    <div class=row">
                    <img class="img-thumbnail col-lg-6 float-left" src="images/pictureanouk.jpg">
                    <img class="img-thumbnail col-lg-6 float-left" src="images/anouk.jpg">
                    <img class="img-thumbnail col-lg-6 float-right" src="images/anoukstairs.jpg">
                    <img class="img-thumbnail col-lg-6 float-right" src="images/anoukberlijn.jpg">
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container -->
    </div>
    </div>
    
    <!-- /.content-section-a -->
    <a name="gastenboek"></a>
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="section-heading">Gastenboek</h2>
                        <form>
                            <div class="row control-group">
                                <div class="form-group col-xs-12 floating-label-form-group controls">
                                    <input type="text" class="form-control" placeholder="Naam"></input>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row control-group">
                                <div class="form-group col-xs-12 floating-label-form-group controls">
                                    <input type="text" class="form-control" placeholder="Email"></input>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row control-group">
                                <div class="form-group col-xs-12 floating-label-form-group controls">
                                    <textarea rows="10"class="form-control" placeholder="Bericht"></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-xs-12">
                                    <button type="submit" class="btn btn-succes btn-lg"> Send </button>
                                </div>
                            </div>
                        </form>
                </div>
                <div class="col-lg-6">
                </div>
            </div>
        </div>
        <!-- /.container -->
    </div>
    <!-- /.banner -->

    
    <!-- Footer -->
    <footer class='text-center'>
        <div class="container">
            <div class="row">
                <h4> Mail: <span class="glyphicon glyphicon-envelope"></span> 
                    <?= $student->getEmail(); ?> </h4>
                <h4> Of bel: <span class="glyphicon glyphicon-earphone"></span>
                    <?= $student->getphoneNumber(); ?> </h4>
                <div class="col-lg-12">
                    <ul class="list-inline">
                        <li>
                            <a href="#overmij">Over Mij</a>
                        </li>
                        <li class="footer-menu-divider">⋅</li>
                        <li>
                            <a href="#slbopdrachten">SLB Opdrachten</a>
                        </li>
                        <li class="footer-menu-divider">⋅</li>
                        <li>
                            <a href="#cv">CV</a>
                        </li>
                        <li class="footer-menu-divider">⋅</li>
                        <li>
                            <a href="#cijfers">Cijfers</a>
                        </li>
                        <li class="footer-menu-divider">⋅</li>
                        <li>
                            <a href="#galerij">Galerij</a>
                        </li>
                        <li class="footer-menu-divider">⋅</li>
                        <li>
                            <a href="#gastenboek">Gastenboek</a>
                        </li>
                    </ul>
                    <p>Copyright &copy; Anouk van der Veen</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery -->
    <script src="<?= $dataProvider->get( 'lib-path' )?>jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?= $dataProvider->get( 'lib-path' )?>bootstrap/dist/js/bootstrap.min.js"></script>
    <?= $dataProvider->call( 'debugBarRenderer', 'render' ) ?>
</body>
</html>
