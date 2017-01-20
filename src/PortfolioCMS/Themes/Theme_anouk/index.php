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
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Portfolio's</a>
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
                        <li class="page-scroll">
                            <a href="#inloggen">
                                <i class="fa fa-sign-in"></i> Inloggen
                            </a>
                        </li>
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
                        <h1>Anouk van der Veen</h1>
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
    
    <a name="over mij"></a>
    <div class="content-section-b">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">Over mij</h2>
                    <p>
                    Naam: Anouk van der Veen<br>
                    Geboortedatum: 21-06-1999<br>
                    Adres: Munnekemoer Oost 19<br>
                    Plaats: Ter Apel<br>
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
    
    <a name="slbopdrachten"></a>
    <div class="content-section-a">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-lg-offset-1 col-sm-push-6  col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">SLB Opdrachten</h2>
                    <p class="lead">Hier vind u mijn slb opdrachten.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                       Ut metus purus, vestibulum sed neque et, posuere iaculis sem. 
                       Integer eleifend tortor eget ultrices facilisis. Aenean aliquam luctus quam. 
                       Curabitur finibus, lacus in imperdiet laoreet, neque lacus maximus mi, 
                       ac porta erat ante sit amet ante. Duis efficitur dui eget scelerisque vestibulum. 
                       Pellentesque in commodo odio. Duis aliquet luctus ex, eu auctor turpis hendrerit a. 
                       Fusce et sem elementum lectus blandit hendrerit at nec ante. Etiam eget nisi leo. 
                       Fusce nec faucibus elit, sit amet tristique leo. Suspendisse nec dui vel nulla varius suscipit. 
                       Interdum et malesuada fames ac ante ipsum primis in faucibus. Fusce augue dui, auctor pulvinar laoreet in, 
                       tempus a lacus. Phasellus tincidunt nunc quis ipsum imperdiet, non interdum leo ullamcorper. 
                       Donec vel odio dignissim, finibus lacus vitae, interdum nulla.
                    </p>
                </div>
                <div class="col-lg-5 col-sm-pull-6  col-sm-6">
                    <img class="img-responsive" src="images/SuperSLB.png" alt="">
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
                    <p>Hier vind je mijn CV </p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                        Ut metus purus, vestibulum sed neque et, posuere iaculis sem. 
                        Integer eleifend tortor eget ultrices facilisis. Aenean aliquam luctus quam. 
                        Curabitur finibus, lacus in imperdiet laoreet, neque lacus maximus mi, 
                        ac porta erat ante sit amet ante. Duis efficitur dui eget scelerisque vestibulum. 
                        Pellentesque in commodo odio. Duis aliquet luctus ex, eu auctor turpis hendrerit a. 
                        Fusce et sem elementum lectus blandit hendrerit at nec ante. Etiam eget nisi leo. 
                        Fusce nec faucibus elit, sit amet tristique leo. Suspendisse nec dui vel nulla varius suscipit. 
                        Interdum et malesuada fames ac ante ipsum primis in faucibus. Fusce augue dui, auctor pulvinar laoreet in, 
                        tempus a lacus. Phasellus tincidunt nunc quis ipsum imperdiet, non interdum leo ullamcorper. 
                        Donec vel odio dignissim, finibus lacus vitae, interdum nulla.</p>
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
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                           Ut metus purus, vestibulum sed neque et, posuere iaculis sem. 
                           Integer eleifend tortor eget ultrices facilisis. Aenean aliquam luctus quam. 
                           Curabitur finibus, lacus in imperdiet laoreet, neque lacus maximus mi, 
                           ac porta erat ante sit amet ante. Duis efficitur dui eget scelerisque vestibulum. 
                           Pellentesque in commodo odio. Duis aliquet luctus ex, eu auctor turpis hendrerit a. 
                           Fusce et sem elementum lectus blandit hendrerit at nec ante. Etiam eget nisi leo. 
                           Fusce nec faucibus elit, sit amet tristique leo. Suspendisse nec dui vel nulla varius suscipit. 
                           Interdum et malesuada fames ac ante ipsum primis in faucibus. Fusce augue dui, auctor pulvinar laoreet in, 
                           tempus a lacus. Phasellus tincidunt nunc quis ipsum imperdiet, non interdum leo ullamcorper. 
                           Donec vel odio dignissim, finibus lacus vitae, interdum nulla.
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
                    <p>Hier vind je mijn CV </p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                        Ut metus purus, vestibulum sed neque et, posuere iaculis sem. 
                        Integer eleifend tortor eget ultrices facilisis. Aenean aliquam luctus quam. </p>
                    
                </div>
                <div class="col-lg-4 col-lg-offset-2 col-sm-6">
                    <div class=row">
                    <img class="img-thumbnail col-lg-6 float-left" src="images/pictureanouk.jpg">
                    <img class="img-thumbnail col-lg-6 float-left" src="images/pictureanouk.jpg">
                    <img class="img-thumbnail col-lg-6 float-right" src="images/pictureanouk.jpg">
                    <img class="img-thumbnail col-lg-6 float-right" src="images/pictureanouk.jpg">
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
                <h4> Mail: <span class="glyphicon glyphicon-envelope"></span> estheranouk123@gmail.com </h4>
                <h4> Of bel: <span class="glyphicon glyphicon-earphone"></span> +31 629766229</h4>
                <div class="col-lg-12">
                    <ul class="list-inline">
                        <li>
                            <a href="#slbopdrachten">SLB Opdrachten</a>
                        </li>
                        <li class="footer-menu-divider">⋅</li>
                        <li>
                            <a href="#cv">CV</a>
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
