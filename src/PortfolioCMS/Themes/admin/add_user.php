<!doctype html>
<?php

$page_title = "Overzicht | Admin";
$isOnAdminPage = "overzicht";

include 'header.php'; ?>
<body>

<?php include 'navigation.php' ?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title text-center"><strong><i class="fa fa-plus"></i> Gebruiker toevoegen</strong>
                        </h4>
                        <hr class="style-one"/>
                        <div class="col-sm-5 custom-buttons">
                            <a href="overzicht">
                                <button class="btn btn-md btn-primary btn-block btn-custom">
                                    <i class="fa fa-arrow-left"></i> Terug
                                </button>
                            </a>

                        </div>
                        <div class="clearfix"></div>
                        <div class="content">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3">
                                        <form class="form-custom float-left" action="" method="POST">
                                            <div class="form-group">
                                                <label class="form-label" for="inputEmail">Email</label>
                                                <input type="email" name="email" class="form-control" id="inputEmail"
                                                       placeholder="Email">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="inputPassword">Wachtwoord</label>
                                                <input type="password" name="password" class="form-control"
                                                       id="inputWachtwoord"
                                                       placeholder="Wachtwoord">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="inputPassword">Voornaam</label>
                                                <input type="text" name="firstName" class="form-control"
                                                       id="inputFirstName"
                                                       placeholder="Voornaam">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="inputPassword">Achternaam</label>
                                                <input type="text" name="lastName" class="form-control"
                                                       id="inputLastName"
                                                       placeholder="Achternaam">
                                            </div>
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
                                            <div class="row">
                                                <div class="col-lg-6 clearfix"><br/></div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-custom">Toevoegen</button>
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
