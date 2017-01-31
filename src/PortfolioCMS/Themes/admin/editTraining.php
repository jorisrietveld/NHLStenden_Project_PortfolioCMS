<!doctype html>
<?php
$page_title = "Opleiding aanpassen | Admin";
$pageName = "portfolio";
include 'header.php';
$training = $dataProvider->get( 'training-data' );
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
                                <i class="fa fa-pencil-square-o"></i> Opleiding aanpassen
                            </strong>
                        </h4>
                        <hr class="style-one"/>
                        <div class="col-sm-5 custom-buttons">
                            <a href="../portfolioOverzicht">
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

                                            <?php if ( $dataProvider->hasFeedback() ) : ?>
                                                <div class="alert alert-<?= $dataProvider->get( 'feedback-type' ) ?>">
                                                    <span><?= $dataProvider->get( 'feedback' ) ?></span>
                                                </div>
                                            <?php endif; ?>

                                            <div class="form-group">
                                                <label class="form-label col-lg-3" for="title">Titel:</label>
                                                <input type="text"
                                                       name="title"
                                                       class="form-control"
                                                       id="title"
                                                       value="<?= $training->getTitle() ?>"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label col-lg-3" for="institution">Instituut:</label>
                                                <input type="text"
                                                       name="institution"
                                                       class="form-control"
                                                       id="institution"
                                                       value="<?= $training->getInstitution()?>"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label col-lg-3" for="location">Locatie:</label>
                                                <input type="text"
                                                       name="location"
                                                       class="form-control"
                                                       id="location"
                                                       value="<?= $training->getLocation() ?>"
                                                       required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label col-lg-3" for="startedAt">Startdatum:</label>
                                                <input type="text"
                                                       name="startedAt"
                                                       class="form-control"
                                                       id="startedAt"
                                                       value="<?= $training->getStatedAt()->format('Y-m-d')?>">
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label col-lg-3" for="finishedAt">Einddatum:</label>
                                                <input type="text"
                                                       name="finishedAt"
                                                       class="form-control"
                                                       id="finishedAt"
                                                       value="<?= $training->getFinishedAt()->format('Y-m-d') ?>">
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label col-lg-3" for="description">Beschrijving:</label>
                                                <textarea
                                                    rows="5"
                                                    name="description"
                                                    class="form-control"
                                                    id="description"
                                                    required><?= $training->getDescription()?></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label col-lg-3" for="obtainedCertificate">Is de opleiding gehaald?</label>
                                                <select required class="form-control" name="obtainedCertificate" id="obtainedCertificate">
                                                    <option value="TRUE" <?= $training->getObtainedCertificate() ? 'selected':''?>>Ja</option>
                                                    <option value="FALSE" <?= $training->getObtainedCertificate() ? '':'selected'?>>nee</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label col-lg-3" for="currentTraining">Is het de huidige opleiding?</label>
                                                <select required class="form-control" name="currentTraining" id="currentTraining">
                                                    <option value="TRUE" <?= $training->getCurrentTraining()? 'selected':''?>>Ja</option>
                                                    <option value="FALSE" <?= $training->getCurrentTraining()? '':'selected'?>>nee</option>
                                                </select>
                                            </div>

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