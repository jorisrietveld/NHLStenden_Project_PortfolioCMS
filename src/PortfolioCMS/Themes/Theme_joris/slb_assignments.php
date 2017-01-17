<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 13-01-2017 17:55
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */

$student = $dataProvider->get('student');

?>
<!DOCTYPE html>
<htmL>
<head>
    <title></title>
    <!-- Custom bootstap css lib in ubuntu style -->
    <link rel="stylesheet" href="<?= $dataProvider->get( 'asset-path' ) ?>css/bootstrap_ubuntu.css"  type="text/css" />
    <!-- Compiled custom stylesheet -->
    <link rel="stylesheet" href="<?= $dataProvider->get( 'asset-path' )?>css/styles.css" type="text/css" />
    <!-- Font awesome icons-->
    <link rel="stylesheet" href="<?= $dataProvider->get( 'lib-path' ) ?>font-awesome/css/font-awesome.min.css" type="text/css" />
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
                <?php foreach ( $dataProvider->get( 'pages' ) as $page ): ?>
                    <li>
                        <a href=".<?= $page->getUrl() ?>"><?= $page->getName() ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>

            <ul class="nav navbar-nav navbar-right">

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="portfolio-menu">
                        Portfolio's<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="portfolio-menu">
                        <?php foreach ( $dataProvider->get( 'portfoliosMetadata' ) as $portfolio ): ?>
                            <li>
                                <a href="./<?= $portfolio->getUrl() ?>"><?= $portfolio->getStudentName() ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>

                <li class="dropdown">
                    <?php if( $dataProvider->isGuest() ): ?>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="login-form">
                            Aanmelden<span class="caret"></span>
                        </a>
                        <div class="dropdown-menu" style="padding:17px;">
                            <form class="form" id="login-form" action="../login" method="post">
                                <input name="email" id="login-form-email" placeholder="Email adres" type="email" class="" />
                                <input name="password" id="login-form-password" placeholder="Wachtwoord" type="password" class="" />
                                <input name="Aanmelden" type="submit" id="form-submit" value="Aanmelden" class="btn btn-info"/>
                            </form>
                        </div>
                    <?php else: ?>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="login-form">
                            Aanmelden<span class="caret"></span>
                        </a>
                        <div class="dropdown-menu" style="padding:17px;">
                            <form class="form" id="login-form" action="../login" method="post">
                                <input name="email" id="login-form-email" placeholder="Email adres" type="email" class="" />
                                <input name="password" id="login-form-password" placeholder="Wachtwoord" type="password" class="" />
                                <input name="Aanmelden" type="submit" id="form-submit" value="Aanmelden" class="btn btn-info"/>
                            </form>
                        </div>
                    <?php endif; ?>
                </li>
            </ul>

        </div>
    </div>
</div>

<header class="page-wrapper container">
    <div class="jumbotron text-center row" id="portfolio-header">
        <h1 class="col-lg-12 text-mono">SLB assignments</h1>
    </div>

</header>

<!-- Jquery javascript library -->
<script src="<?= $dataProvider->get('lib-path') ?>jquery/dist/jquery.min.js" type="text/javascript"></script>
<!-- Bootstrap javascript library -->
<script src="<?= $dataProvider->get('lib-path') ?>bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
</body>
</htmL>
