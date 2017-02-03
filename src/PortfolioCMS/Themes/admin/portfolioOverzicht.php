<!doctype html>
<?php

$page_title = "Overzicht | Admin";
$pageName = "portfolio";

include 'header.php'; ?>
<body>

<?php include 'navigation.php' ?>

<div class="content">
    <div class="">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title text-center">
                            <strong>
                                Overzicht van alle portfolio's
                            </strong>
                        </h4>
                        <hr class="style-one"/>
                        <?php if( $dataProvider->isAdmin() ) : ?>
                            <div class="col-sm-5 custom-buttons">
                                <a href="addPortfolio">
                                    <button class="btn btn-md btn-primary btn-block btn-custom">
                                        <i class="fa fa-plus"></i> Nieuw portfolio
                                    </button>
                                </a>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-custom-portfolio">
                                    <thead>
                                    <th>ID</th>
                                    <th>Naam portfolio</th>
                                    <th>Bewerk</th>
                                    <th>Verwijder</th>
                                    </thead>
                                    <tbody>
                                    <?php foreach ( $dataProvider->get( 'portfolios-data' ) as $portfolioMetaData ): ?>
                                        <tr>
                                            <td><?= $portfolioMetaData->getStudentName() ?></td>
                                            <td>
                                                <a href="portfolio_van/<?= $portfolioMetaData->getStudentId() ?>"></a>
                                            </td>
                                            <td>
                                                <a href="portfolio_van/<?= $portfolioMetaData->getStudentId() ?>">
                                                    <button class="btn btn-sm btn-primary btn-block btn-custom btn-custom-sm">
                                                        <i class="fa fa-edit"></i>
                                                        <span class="out_window">Bewerk</span>
                                                    </button>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="">
                                                    <button class="btn btn-sm btn-primary btn-block btn-custom btn-custom-sm">
                                                        <i class="fa fa-remove"></i>
                                                        <span class="out_window">Verwijder</span>
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                        <?php elseif( $dataProvider->isSlbTeacher() ) :?>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-custom-portfolio">
                                    <thead>
                                        <th>Student id</th>
                                        <th>Naam Student</th>
                                        <th>Bekijk SLB oparachten</th>
                                        </thead>
                                    <tbody>
                                    <?php foreach ( $dataProvider->get( 'portfolios-data' ) as $portfolioMetaData ): ?>
                                        <tr>
                                            <td><?= $portfolioMetaData->getStudentId() ?></td>
                                            <td><?= $portfolioMetaData->getStudentName() ?></td>
                                            <td>
                                                <a href="slbOpdrachtenVan/<?= $portfolioMetaData->getStudentId() ?>">
                                                    <button class="btn btn-sm btn-primary btn-block btn-custom btn-custom-sm">
                                                        <i class="fa fa-edit"></i>
                                                        Bekijk SLB opdrachten
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                        <?php elseif( $dataProvider->isTeacher() ): ?>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-custom-portfolio">
                                    <thead>
                                        <th>ID</th>
                                        <th>Naam portfolio</th>
                                        <th>Bekijk projecten</th>
                                    </thead>
                                    <tbody>
                                    <?php foreach ( $dataProvider->get( 'portfolios-data' ) as $portfolioMetaData ): ?>
                                        <tr>
                                            <td><?= $portfolioMetaData->getStudentName() ?></td>
                                            <td>
                                                <a href="portfolio_van/<?= $portfolioMetaData->getStudentId() ?>"></a>
                                            </td>
                                            <td>
                                                <a href="projectenVan/<?= $portfolioMetaData->getStudentId() ?>">
                                                    <button class="btn btn-sm btn-primary btn-block btn-custom btn-custom-sm">
                                                        <i class="fa fa-edit"></i>
                                                        Bekijk Projecten
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php' ?>
<?php include 'scripts.php' ?>
</body>
</html>