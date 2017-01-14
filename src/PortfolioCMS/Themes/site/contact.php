<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Dit is het portfolio cms systeem">
    <meta name="author" content="">

    <link rel="icon" href="../../favicon.ico">
    <title>INF1B Portfolio's</title>

    <!-- Bootstrap css lib -->
    <link rel="stylesheet" href="<?= $dataProvider->get( 'lib-path' )?>bootstrap/dist/css/bootstrap.min.css" />
    <!-- Font awesome css file-->
    <link href="<?= $dataProvider->get( 'lib-path' )?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Cover css file -->
    <link href="<?=$dataProvider->get('asset-path')?>css/cover.css" rel="stylesheet">

    <?= $dataProvider->call( 'debugBarRenderer', 'renderHead' ) ?>
</head>

<body>
     <?php
    $verstuurd="";
    
    ?>
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
                                    <li class="active-menu">
                                        <a href="home">Home</a>
                                    </li>
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                            Portfolio's<span class="fa fa-caret-down"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <?= $dataProvider->get( 'portfolioMenuLinks', '' ) ?>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="./contact.php">Contact</a>
                                    </li>
                                </ul>
                                <ul class="nav navbar-nav navbar-right">
                                    <li>
                                        <?php if( isset( $_SESSION['userId'] ) ): ?>
                                            <a href="logout">
                                                <i class="fa fa-sign-in"></i> Afmelden
                                            </a>
                                        <?php else: ?>
                                            <a href="login">
                                                <i class="fa fa-sign-in"></i> Aanmelden
                                            </a>
                                        <?php endif; ?>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </nav>
                </div>
            </div>

            <div class="inner cover custom-main">
                <h1 class="cover-heading">Contact</h1>
                <form action="#" class="custom-form" method="POST">

                    <input type="text" class="inputfield" name="name" placeholder="Naam"/>
                    <input type ="text" class="inputfield" name="onderwerp" placeholder="Onderwerp">
                    <textarea rows="6" cols="35" placeholder="Schrijf uw bericht hier.." name="bericht" id="message" style="color:black; margin-left:16px;"></textarea>
                    <input type="submit" class="inputsubmit btn btn-primary btn-default" name="submit" value="Verstuur bericht"/>
                    
                    <?php
                    echo $verstuurd; 
                    ?>
                    <?php                    
                    
                    if(htmlentities(isset($_POST['submit'])))
                        {
                            if(htmlentities(!empty($_POST['name']) && ($_POST['bericht'])))
                                    {   
                                       $verstuurd = "Uw bericht is verstuurd!";                                  
                                    }
                        }
                    
                    ?>

                </form>
            </div>
        </div>

    </div>
</div>
 <!-- jQuery javascript library -->
 <script src="<?= $dataProvider->get( 'lib-path' ) ?>jquery/dist/jquery.min.js"></script>
 <!-- Bootstrap javascript library -->
 <script src="<?= $dataProvider->get( 'lib-path' ) ?>bootstrap/dist/js/bootstrap.min.js"></script>
 <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
 <!--[if lt IE 9]>
 <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
 <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
 <![endif]-->
<?= $dataProvider->call( 'debugBarRenderer', 'render' ) ?>
</body>
</html>
