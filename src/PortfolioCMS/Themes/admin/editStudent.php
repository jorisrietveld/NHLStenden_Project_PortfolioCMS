<!doctype html>
<?php
$page_title = "Overzicht | Admin";
$isOnAdminPage = "overzicht";
include 'header.php';
?>
<body>

<?php include 'navigation.php' ?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title text-center">
                            <strong>
                                <i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;<?= $dataProvider->isAdmin() ? 'Student aanpassen' : 'Account aanpassen' ?>
                            </strong>
                        </h4>
                        <hr class="style-one"/>
                        <div class="col-sm-5 custom-buttons">
                            <?php if( $dataProvider->isAdmin() ): ?>
                            <a href="../gebruikersOverzicht">
                                <button class="btn btn-md btn-primary btn-block btn-custom">
                                    <i class="fa fa-arrow-left"></i> Terug
                                </button>
                            </a>
                            <?php endif; ?>
                        </div>
                        <div class="clearfix"></div>
                        <div class="content">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3">
                                        <form class="form-custom float-left" action="" method="POST">

                                            <div class="form-group">
                                                <label class="form-label col-lg-3" for="inputEmail">Email</label>
                                                <input type="email"
                                                       name="email"
                                                       class="form-control"
                                                       id="inputEmail"
                                                       placeholder="Email"
                                                       title="Ongeldig email adres"
                                                       value="<?= $dataProvider->call('student-data', 'getEmail') ?>"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label col-lg-3"
                                                       for="inputPassword">Wachtwoord</label>
                                                <input type="password"
                                                       name="password"
                                                       class="form-control"
                                                       id="inputWachtwoord"
                                                       placeholder="Wachtwoord"
                                                       pattern="{7,}"
                                                       title="Het wachtwoord moet minimaal 8 karakters zijn">
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label col-lg-3" for="inputPassword">Wachtwoord
                                                    opnieuw</label>
                                                <input type="password"
                                                       name="password"
                                                       class="form-control"
                                                       id="inputWachtwoord"
                                                       placeholder="Wachtwoord"
                                                       pattern="{7,}"
                                                       title="Het wachtwoord moet minimaal 8 karakters zijn">
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label col-lg-3" for="inputPassword">Voornaam</label>
                                                <input type="text"
                                                       name="firstName"
                                                       class="form-control"
                                                       id="inputFirstName"
                                                       placeholder="Voornaam"
                                                       pattern="[a-zA-Z]{2,}"
                                                       title="Ongeldige voornaam"
                                                       value="<?= $dataProvider->call('student-data', 'getFirstName') ?>"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label col-lg-3"
                                                       for="inputPassword">Achternaam</label>
                                                <input type="text"
                                                       name="lastName"
                                                       class="form-control"
                                                       id="inputLastName"
                                                       placeholder="Achternaam"
                                                       pattern="[a-zA-Z]{2,}"
                                                       title="Ongeldige achternaam"
                                                       value="<?= $dataProvider->call('student-data', 'getLastName') ?>"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label col-lg-3" for="inputPassword">addres</label>
                                                <input type="text"
                                                       name="address"
                                                       class="form-control"
                                                       id="inputAddress"
                                                       placeholder="Addres"
                                                       value="<?= $dataProvider->call('student-data', 'getAddress') ?>"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label col-lg-3" for="inputPassword">postcode</label>
                                                <input type="text"
                                                       name="zipCode"
                                                       class="form-control"
                                                       id="inputZipCode"
                                                       placeholder="postcode"
                                                       pattern="[1-9]\d{3} ?[a-zA-Z]{2}"
                                                       title="Ongeldige postcode"
                                                       value="<?= $dataProvider->call('student-data', 'getZipCode') ?>"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label col-lg-3"
                                                       for="inputPassword">woonplaats</label>
                                                <input type="text"
                                                       name="location"
                                                       class="form-control"
                                                       id="inputLocation"
                                                       placeholder="Woonplaats"
                                                       value="<?= $dataProvider->call('student-data', 'getLocation') ?>"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label col-lg-3" for="inputPassword">geboorte
                                                    datum</label>
                                                <input type="date"
                                                       name="dateOfBirth"
                                                       class="form-control"
                                                       id="inputDateOfBirth"
                                                       placeholder="geboorte datum"
                                                       value="<?= $dataProvider->nestedCall('student-data', 'getDateOfBirth:format', [[], ['Y-m-d'],]) ?>"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label col-lg-3" for="inputPassword">student
                                                    code</label>
                                                <input type="text"
                                                       name="studentCode"
                                                       class="form-control <?= $dataProvider->isAdmin() ? '' : 'disabled' ?>"
                                                       id="inputStudentCode"
                                                       placeholder="student code"
                                                       pattern="[1-9]\d{4,}"
                                                       title="Ongeldige student code"
                                                       value="<?= $dataProvider->call('student-data', 'getStudentCode') ?>"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label col-lg-3" for="inputPassword">telefoon
                                                    nummer</label>
                                                <input type="tel"
                                                       name="lastName"
                                                       class="form-control"
                                                       id="inputLastName"
                                                       placeholder="telefoon nummer"
                                                       value="<?= $dataProvider->call('student-data', 'getPhoneNumber') ?>"
                                                       required>
                                            </div>


                                            <?php if ($dataProvider->isAdmin()): ?>
                                                <div class="row radio-buttons-custom">
                                                    <div class="col-lg-12">
                                                        <p class="centertext">Admin</p><br/>
                                                        <label><input type="radio" name="isAdmin" value="1"
                                                                      class="radio-custom"><span
                                                                    class="isSelected"> Ja</span></input></label>
                                                        <label><input type="radio" name="isAdmin" value="0"
                                                                      class="radio-custom"
                                                                      id="inputLastName"
                                                                      placeholder="Achternaam" checked><span
                                                                    class="isSelected"> Nee</span></input></label>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <hr/>
                                                <div class="row radio-buttons-custom">
                                                    <div class="col-lg-12">
                                                        <p class="centertext">Actief</p><br/>
                                                        <label>
                                                            <input type="radio" name="active" value="1"
                                                                   class="radio-custom" checked><span
                                                                    class="isSelected"> Ja</span></input></label>
                                                        <label><input type="radio" name="active" value="0"
                                                                      class="radio-custom"
                                                                      id="inputLastName"
                                                                      placeholder="Achternaam"><span
                                                                    class="isSelected"> Nee</span></input></label>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <div class="row">
                                                <div class="col-lg-6 clearfix"><br/></div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-custom">Opslaan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
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