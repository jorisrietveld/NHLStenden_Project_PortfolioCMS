<!doctype html>
<?php
$page_title = "Overzicht | Admin";
$pageName = "grades";

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
                                Cijfer overzicht
                            </strong>
                        </h4>
                        <hr class="style-one"/>
                        <div class="col-sm-5 custom-buttons">

                        </div>
                        <div class="content table-responsive table-full-width">
                            <table class="table table-hover table-custom-portfolio">
                                <thead>
                                <tr>
                                    <th>Naam student</th>
                                    <th></th>
                                    <th>Bekijk</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ( $dataProvider->get( 'grades-data' ) as $portfolioMetaData): ?>
                                    <tr>
                                        <td><?= $portfolioMetaData->getStudentName() ?></td>
                                        <td>
                                            <a href="cijferAdministratie/<?= $portfolioMetaData->getStudentId() ?>"></a>
                                        </td>
                                        <td>
                                            <a href="cijferAdministratie/<?= $portfolioMetaData->getStudentId() ?>">
                                                <button class="btn btn-sm btn-primary btn-block btn-custom btn-custom-sm">
                                                    <i class="fa fa-address-book-o" aria-hidden="true"></i>
                                                    Bekijk Cijfers
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
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