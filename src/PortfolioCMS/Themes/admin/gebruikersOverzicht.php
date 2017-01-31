<!doctype html>
<?php
$page_title = "Overzicht | Admin";
$pageName = "users";

include 'header.php'; ?>
<body>

<?php include 'navigation.php' ?>

<div class="content">
    <div class="">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title text-center"><strong>Gebruikersoverzicht</strong></h4>
                        <hr class="style-one"/>
                        <div class="col-sm-5 custom-buttons">
                            <a href="addTeacher">
                                <button class="btn btn-md btn-primary btn-block btn-custom">
                                    <i class="fa fa-plus"></i> Docent toevoegen
                                </button>
                            </a>

                            <a href="addStudent">
                                <button class="btn btn-md btn-primary btn-block btn-custom">
                                    <i class="fa fa-plus"></i> Student toevoegen
                                </button>
                            </a>
                        </div>
                        <div class="content table-responsive table-full-width">
                            <table class="table table-hover table-custom-portfolio">
                                <thead>
                                <th>Id</th>
                                <th>Voornaam</th>
                                <th>Achternaam</th>
                                <th>E-mailadres</th>
                                <th>Type</th>
                                <th>Admin</th>
                                <th>Actief</th>
                                <th></th>
                                <th></th>
                                </thead>
                                <tbody>
                                <?php foreach ($dataProvider->get( 'users' ) as $user): ?>
                                    <tr>
                                        <td><?=$user->getId()?></td>
                                        <td><?=$user->getFirstName()?></td>
                                        <td><?=$user->getLastName()?></td>
                                        <td class="word-break"><?= $user->getEmail() ?></td>
                                        <td><?= $user->getType()== 'teacher' ? ($user->getIsSLBer() ? "SLB'er" : 'Docent') : 'Student'  ?></td>
                                        <td><?= $user->getIsAdmin() ? 'Ja' : 'Nee' ?></td>
                                        <td><?= $user->getActive() ? 'Ja' : 'Nee' ?></td>
                                        <td>
                                            <a href="./edit<?= ucfirst( $user->getType() )?>/<?= $user->getId() ?>">
                                                <button class="btn btn-md btn-primary btn-block btn-custom">
                                                    <i class="fa fa-edit"></i>
                                                    <span class="out_window">Bewerk</span>
                                                </button>
                                            </a>
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-md btn-primary btn-block btn-custom">
                                                <i class="fa fa-remove"></i><span class="out_window">Verwijder</span>
                                            </button>
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