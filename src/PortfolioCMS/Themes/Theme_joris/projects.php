<?php
$student = $dataProvider->get( 'student' );
$hasPageSuffix = FALSE !== strpos( $dataProvider->call( 'httpRequest', 'getBaseUrl' ), $dataProvider->get( 'current-page' ) );
?>
<!DOCTYPE html>
<htmL>
<head>
    <title></title>
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
                        Portfolio's<span class="caret"></span>
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
                    <?php elseif ( $dataProvider->isOwnOrAdmin() ): ?>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="profile-menu">
                            Mijn account<span class="caret"></span>
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
                    <?php else: ?>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="login-form">
                            Admin paneel<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="admin-portfolio-menu">
                            <li>
                                <a href="#">Mijn Profiel</a>
                            </li>
                            <li>
                                <a href="#">Mijn Portfolio</a>
                            </li>
                            <li>
                                <a href="#">Mijn Cijfers</a>
                            </li>
                            <li>
                                <a href="#">Mijn Gastenboek berichten</a>
                            </li>
                        </ul>
                    <?php endif; ?>
                </li>
            </ul>

        </div>
    </div>
</div>
<div class="page-wrapper container">

    <main>
        <section class="jumbotron row">
            <h1>Projecten</h1>
        </section>
    </main>
</div>
<!-- Jquery javascript library -->
<script src="<?= $dataProvider->get( 'lib-path' ) ?>jquery/dist/jquery.min.js" type="text/javascript"></script>
<!-- Bootstrap javascript library -->
<script src="<?= $dataProvider->get( 'lib-path' ) ?>bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
</body>
</htmL>
