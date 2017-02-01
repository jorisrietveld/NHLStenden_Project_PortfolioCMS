<?php
// An check for the amount of elements in the URL for generating URL's
$hasPageSuffix = count( explode( '/', $dataProvider->call( 'httpRequest', 'getRequestUri' ) ) ) == 4;
?>
<div class="wrapper">
    <div class="sidebar" data-color="blue" data-image="<?= $dataProvider->get( "asset-path" ) ?>img/sidebar-5.jpg">

        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="<?=$hasPageSuffix?'../':''?>gebruikersOverzicht" class="simple-text">
                    Portfolio Beheer
                </a>
            </div>

            <ul class="nav">

                <?php if ( $dataProvider->isAdmin() ): ?>
                    <li class="<?= $pageName == 'users' ? 'active' : '' ?>">
                        <a href="<?= $hasPageSuffix ? '../' : '' ?>gebruikersOverzicht">
                            <i class="fa fa-list"></i>
                            <p>Gebruikers</p>
                        </a>
                    </li>
                <?php elseif ( $dataProvider->isAtleasedTeacher() ) : ?>
                    <li <?= $pageName == 'users' ? 'active' : '' ?>>
                        <a href="<?= $hasPageSuffix ? '../' : '' ?>editTeacher/<?= $dataProvider->getcurrentuserid() ?>">
                            <i class="fa fa-user"></i>
                            <p>Mijn account</p>
                        </a>
                    </li>
                <?php else: ?>
                    <li <?= $pageName == 'users' ? 'active' : '' ?>>
                        <a href="<?= $hasPageSuffix ? '../' : '' ?>editStudent/<?= $dataProvider->getcurrentuserid() ?>">
                            <i class="fa fa-user"></i>
                            <p>Mijn account</p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if ( $dataProvider->isStudent() ): ?>
                    <li class="<?= ( $pageName == 'portfolio' ) ? 'active' : '' ?>">
                        <a href="<?= $hasPageSuffix ? '../' : '' ?>portfolio_van/<?= $dataProvider->getCurrentUserId() ?>">
                            <i class="fa fa-user-circle-o"></i>
                            <p>Mijn Portfolio</p>
                        </a>
                    </li>
                <?php elseif ( $dataProvider->isAtLeasedTeacher() ): ?>
                    <li class="<?= $pageName == 'portfolio' ? 'active' : '' ?>">
                        <a href="<?= $hasPageSuffix ? '../' : '' ?>portfolioOverzicht">
                            <i class="fa fa-user-circle-o"></i>
                            <p>Portfolios</p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if ( $dataProvider->isAtLeasedTeacher() ) : ?>
                    <li class="<?= $pageName == 'grades' ? 'active' : '' ?>">
                        <a href="<?= $hasPageSuffix ? '../' : '' ?>cijferOverzicht">
                            <i class="fa fa-bar-chart" aria-hidden="true"></i>
                            <p>Cijfers Administratie</p>
                        </a>
                    </li>
                <?php else: ?>
                    <li class="<?= $pageName == 'grades' ? 'active' : '' ?>">
                        <a href="<?= $hasPageSuffix ? '../' : '' ?>cijferAdministratie/<?= $dataProvider->getcurrentuserid() ?>">
                            <i class="fa fa-bar-chart" aria-hidden="true"></i>
                            <p>Mijn Cijfers</p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if ( $dataProvider->isAdmin() ): ?>
                    <li class="<?= $pageName == 'guestBook' ? 'active' : '' ?>">
                        <a href="<?= $hasPageSuffix ? '../' : '' ?>guestBookOverview">
                            <i class="fa fa-comments" aria-hidden="true"></i>
                            <p>Gastenboek overzicht</p>
                        </a>
                    </li>
                <?php elseif( $dataProvider->isStudent() ): ?>
                    <li class="<?= $pageName == 'guestBook' ? 'active' : '' ?>">
                        <a href="<?= $hasPageSuffix ? '../' : '' ?>moderateGuestbook/<?= $dataProvider->getcurrentuserid() ?>">
                            <i class="fa fa-comments" aria-hidden="true"></i>
                            <p>Gastenboek berichten</p>
                        </a>
                    </li>
                <?php endif; ?>
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
                                <?php foreach ($dataProvider->get( 'portfolio-meta-data' ) as $metaDataObject) : ?>
                                    <li>
                                        <a href="/portfolio/<?= $metaDataObject->getUrl() ?>"><?= $metaDataObject->getStudentName() ?></a>
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