<!doctype html>
<?php

$page_title = "Overzicht | Admin";
$isOnAdminPage = "portfolio";

// ADMIN - SLB'ER - DOCENT

include "db.php";

$sql = "SELECT id, themeId, title, userId FROM Portfolio ORDER BY userId";
$query = mysqli_query($conn, $sql);


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
                        <div class="col-sm-5 custom-buttons">
                            <a href="addPortfolio">
                                <button class="btn btn-md btn-primary btn-block btn-custom">
                                    <i class="fa fa-plus"></i> Nieuwe portfolio
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
                                <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                                    <tr>
                                        <td><?= $row['userId'] ?></td>
                                        <td>
                                            <a href="portfolio_van/<?= $row['userId'] ?>"><?= $row['title'] ?></a>
                                        </td>
                                        <td>
                                            <a href="portfolio_van/<?= $row['userId'] ?>">
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
                                <?php } ?>
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