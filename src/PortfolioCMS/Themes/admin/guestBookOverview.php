<!doctype html>
<?php
$page_title = "Gastenboek overzicht | Admin";
$pageName = "guestBook";
include 'header.php'; ?>
<body>
<?php include 'navigation.php' ?>
<div class="content">
    <div class="">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title text-center"><strong>Gastenboek overzicht</strong></h4>
                        <hr class="style-one"/>
                        <div class="col-sm-5 custom-buttons">
                        </div>
                        <div class="content table-responsive table-full-width">
                            <table class="table table-hover table-custom-portfolio">
                                <thead>
                                <tr>
                                    <th>Portfolio Id</th>
                                    <th>UserId</th>
                                    <th>Voornaam</th>
                                    <th>Achternaam</th>
                                    <th>Bekijk gastenboek</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($dataProvider->get( 'portfolio-meta-data' ) as $portfolioMetaData): ?>
                                    <tr>
                                        <td><?= $portfolioMetaData->getId() ?></td>
                                        <td><?= $portfolioMetaData->getStudentId() ?></td>
                                        <td><?= $portfolioMetaData->getStudentFirstName() ?></td>
                                        <td><?= $portfolioMetaData->getStudentLastName() ?></td>
                                        <td>
                                            <a href="./moderateGuestbook/<?= $portfolioMetaData->getStudentId() ?>">
                                                <button class="btn btn-md btn-primary btn-block btn-custom">
                                                    <i class="fa fa-edit"></i>
                                                    <span class="out_window">Bekijk gastenboek berichten</span>
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