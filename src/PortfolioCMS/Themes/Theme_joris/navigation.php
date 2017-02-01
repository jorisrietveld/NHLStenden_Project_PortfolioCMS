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
                    <?php if( $page->getUrl() == '/slb_assignments' && $dataProvider->isGuest() ):?>
                        <!-- Not allowed -->
                    <?php else: ?>
                        <li>
                            <a href="<?= $hasPageSuffix ? '.' . $page->getUrl() : $dataProvider->get( 'url' ) . $page->getUrl() ?>"><?= $page->getName() ?></a>
                        </li>
                    <?php endif;?>
                <?php endforeach; ?>
            </ul>

            <ul class="nav navbar-nav navbar-right">

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="portfolio-menu">
                        <i class="fa fa-address-card" aria-hidden="true"></i>&nbsp;&nbsp;Portfolio's<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="portfolio-menu">
                        <?php foreach ($dataProvider->get( 'portfoliosMetadata' ) as $portfolio): ?>
                            <li>
                                <a href="<?= $hasPageSuffix ? '../' : '' ?>../portfolio/<?= $portfolio->getUrl() ?>"><?= $portfolio->getStudentName() ?></a>
                            </li>
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
                    <?php elseif ( $dataProvider->isStudent() ) : ?>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="profile-menu">
                            <i class="fa fa-user-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;Mijn account<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="profile-menu">
                            <li>
                                <a href="../../../admin/editStudent/<?= $dataProvider->getCurrentUserId() ?>">Mijn Profiel</a>
                            </li>
                            <li>
                                <a href="../../../admin/portfolio_van/<?= $dataProvider->getCurrentUserId() ?>">Mijn Portfolio</a>
                            </li>
                            <li>
                                <a href="../../../admin/cijferAdministratie/<?= $dataProvider->getCurrentUserId() ?>">Mijn Cijfers</a>
                            </li>
                            <li>
                                <a href="../../../admin/moderateGuestbook/<?= $dataProvider->getCurrentUserId() ?>">Mijn Gastenboek berichten</a>
                            </li>
                            <li>
                                <a href="../../../logout">Afmelden</a>
                            </li>
                        </ul>
                    <?php else: ?>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="profile-menu">
                            <i class="fa fa-user-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;Mijn account<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="profile-menu">
                            <li>
                                <a href="../../../admin/editTeacher/<?= $dataProvider->getCurrentUserId() ?>">Mijn Profiel</a>
                            </li>
                            <li>
                                <a href="../../../admin/cijferOverzicht">Cijfer overzicht</a>
                            </li>
                            <li>
                                <a href="../../../admin/guestBookOverview">Gastenboek overzicht</a>
                            </li>
                            <li>
                                <a href="../../../admin/gebruikersOverzicht">Gebruikers overzicht</a>
                            </li>
                            <li>
                                <a href="../../../admin/portfolioOverzicht">Portfolio overzicht</a>
                            </li>
                            <li>
                                <a href="../../../logout">Afmelden</a>
                            </li>
                        </ul>
                    <?php endif; ?>
                </li>
            </ul>

        </div>
    </div>
</div>