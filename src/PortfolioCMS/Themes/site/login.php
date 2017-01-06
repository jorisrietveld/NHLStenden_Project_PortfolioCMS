<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>INF1B Portfolio's</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../lib/cover.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <?= $dataProvider->call( 'debugBarRenderer', 'renderHead' ) ?>
</head>

<body>
<div class="site-wrapper">
    <div class="site-wrapper-inner">

        <div class="cover-container">

            <div class="masthead clearfix">
                <div class="inner">
                    <nav class="navbar navbar-default navbar-custom">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="collapse navbar-collapse" id="myNavbar">
                                <ul class="nav navbar-nav">
                                    <li class="active-menu"><a href="#">Home</a></li>
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Portfolio's <span class="fa fa-caret-down"></span></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="../Theme_aron/index.php"><i class="fa fa-caret-right" aria-hidden="true"></i> Aron</a></li>
                                            <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Marco</a></li>
                                            <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Joris</a></li>
                                            <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Anouk</a></li>
                                            <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Kevin Veldman</a></li>
                                            <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Esmée</a></li>
                                            <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Zervan</a></li>
                                            <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Kevin Tabak</a></li>

                                        </ul>
                                    </li>
                                    <li><a href="#">Contact</a></li>
                                </ul>
                                <ul class="nav navbar-nav navbar-right">
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-sign-in"></i> Aanmelden </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="login">Inloggen</a></li>
                                            <li><a href="register">Registreren</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>

            <div class="inner cover custom-main">
                <h1 class="cover-heading">INF1B Portfolio's</h1>
                <p class="lead">Login pagina.</p>
            </div>
        </div>

    </div>
</div>

<script src="https://use.fontawesome.com/7ab9d2d06f.js"></script>
<?= $dataProvider->call( 'debugBarRenderer', 'render' ) ?>
</body>
</html>
