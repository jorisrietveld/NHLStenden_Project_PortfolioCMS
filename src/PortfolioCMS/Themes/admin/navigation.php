<?php

$hasPageSuffix = count( explode( '/', $dataProvider->call( 'httpRequest', 'getRequestUri' ) ) ) == 4;

?>
<div class="wrapper">
    <div class="sidebar" data-color="blue" data-image="<?= $dataProvider->get( "asset-path" ) ?>img/sidebar-5.jpg">

        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="gebruikersOverzicht" class="simple-text">
                    Portfolio Beheer
                </a>
            </div>

            <ul class="nav">
                <?php if ( $dataProvider->isAdmin() ): ?>
                    <li <?php if ( $isOnAdminPage == 'overzicht' )
                        { ?>class="active"<?php } ?>>
                        <?php if ( $hasPageSuffix ) : ?>
                        <a href="../gebruikersOverzicht">
                            <?php else: ?>
                            <a href="gebruikersOverzicht">
                                <?php endif; ?>
                                <i class="fa fa-list"></i>
                                <p>Gebruikers</p>
                            </a>
                    </li>
                <?php else: ?>
                    <li <?php if ( $isOnAdminPage == 'overzicht' )
                        { ?>class="active"<?php } ?>>
                        <?php if ( $hasPageSuffix ) : ?>
                        <a href="../overzicht">
                            <?php else: ?>
                            <a href="overzicht">
                                <?php endif; ?>
                                <i class="fa fa-user"></i>
                                <p>Mijn account</p>
                            </a>
                    </li>
                <?php endif; ?>

                <?php if ( $dataProvider->isStudent() ): ?>

                    <li class="<?= ( $isOnAdminPage == 'portfolio' ) ? 'active' : '' ?>">

                        <?php if ( $hasPageSuffix ) : ?>
                            <a href="../portfolio_van/<?= $dataProvider->getCurrentUserId() ?>">
                                <i class="fa fa-user-circle-o"></i>
                                <p>Mijn Portfolio</p>
                            </a>
                        <?php else: ?>
                            <a href="../portfolio">
                                <i class="fa fa-user-circle-o"></i>
                                <p>Mijn Portfolio</p>
                            </a>
                        <?php endif; ?>

                    </li>

                <?php elseif ( $dataProvider->isAtLeasedTeacher() ): ?>
                    <li class="<?= $isOnAdminPage == 'portfolio' ? 'active' : '' ?>">

                        <?php if ( $hasPageSuffix ) : ?>
                            <a href="../portfolioOverzicht">
                                <i class="fa fa-user-circle-o"></i>
                                <p>Portfolios</p>
                            </a>
                        <?php else: ?>
                            <a href="portfolioOverzicht">
                                <i class="fa fa-user-circle-o"></i>
                                <p>Portfolios</p>
                            </a>
                        <?php endif; ?>

                    </li>
                <?php endif; ?>

                <!-- <li <?php /*if ($isOnAdminPage == 'thema') {*/ ?>class="active"<?php /*} */ ?>>
                    <a href="./thema">
                        <i class="fa fa-cube"></i>
                        <p>Thema</p>
                    </a>
                </li>-->

                <li <?php if ( $isOnAdminPage == 'cijfer' )
                    { ?>class="active"<?php } ?>>
                    <?php if ( $hasPageSuffix ) : ?>
                    <a href="../cijferOverzicht">
                        <?php else: ?>
                        <a href="cijferOverzicht">
                            <?php endif; ?>
                            <i class="fa fa-area-chart"></i>
                            <p>Cijferregistratie</p>
                        </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                </div>
                <div class="collapse navbar-collapse">


                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-address-book-o"></i> Alle Portfolio's
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <?php foreach ( $dataProvider->get( 'portfolio-meta-data' ) as $metaDataObject) : ?>
                                    <li>
                                        <a href="../portfolio/<?= $metaDataObject->getUrl()?>"><?= $metaDataObject->getStudentName()?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                        <li>
                            <a>
                                <i class="fa fa-user"></i> <?= $dataProvider->getAuthenticatedUserName() ?>
                            </a>
                        </li>
                        <li>
                            <a href="../logout">
                                <i class="fa fa-sign-out"></i> Uitloggen
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>