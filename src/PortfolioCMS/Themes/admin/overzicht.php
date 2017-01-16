<!doctype html>
<?php

$page_title = "Overzicht | Admin";
$isOnAdminPage = "overzicht";

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
                            <a href="add_user">
                                <button class="btn btn-md btn-primary btn-block btn-custom">
                                    <i class="fa fa-plus"></i> Gebruiker toevoegen
                                </button>
                            </a>

                            <a href="#">
                                <button class="btn btn-md btn-primary btn-block btn-custom">
                                    <i class="fa fa-times"></i> Gebruiker verwijderen
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
                                <tr>
                                    <td>1</td>
                                    <td>Joris</td>
                                    <td>Rietveld</td>
                                    <td class="word-break">jorisrietveld@gmail.com</td>
                                    <td>Student</td>
                                    <td>Nee</td>
                                    <td>Ja</td>
                                    <td><a href="edit_user"><button class="btn btn-md btn-primary btn-block btn-custom"><i class="fa fa-edit"></i><span class="out_window">Bewerk</span></button></a></td>
                                    <td><button type="submit" class="btn btn-md btn-primary btn-block btn-custom"><i class="fa fa-remove"></i><span class="out_window">Verwijder</span></button></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Anouk</td>
                                    <td>Van der Veen</td>
                                    <td class="word-break">anouk.van.der.veen@student.stenden.com</td>
                                    <td>Student</td>
                                    <td>Nee</td>
                                    <td>Ja</td>
                                    <td><a href="edit_user"><button type="submit" class="btn btn-md btn-primary btn-block btn-custom"><i class="fa fa-edit"></i><span class="out_window">Bewerk</span></button></a></td>
                                    <td><button type="submit" class="btn btn-md btn-primary btn-block btn-custom"><i class="fa fa-remove"></i><span class="out_window">Verwijder</span></button></td>
                                </tr>
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

</body>

<?php include 'scripts.php' ?>

</html>
