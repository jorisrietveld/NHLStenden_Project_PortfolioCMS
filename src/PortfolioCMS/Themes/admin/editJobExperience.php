<!doctype html>
<?php
$page_title = "Portfolio | Admin";
$isOnAdminPage = "portfolio";
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
                                <i class="fa fa-pencil-square-o"></i> Werk ervaring aanpassen
                            </strong>
                        </h4>
                        <hr class="style-one"/>
                        <div class="col-sm-5 custom-buttons">
                            <a href="portfolioOverzicht">
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
                                                <label class="form-label col-lg-3" for="inputEmail">Werkplaats:</label>
                                                <input type="text"
                                                       name="location"
                                                       class="form-control"
                                                       id="plaats"
                                                       value="<?= $dataProvider->call('jobExperiences-data','getLocation') ?>"
                                                       required>
                                            </div>
                                            
                                            
                                            <!--Input type text in verband met beperkte browser support input date en format invoer database   -->
                                            <div class="form-group">
                                                <label class="form-label col-lg-3" for="inputEmail">Startdatum:</label>
                                                <input type="text"
                                                       name="startedAt"
                                                       class="form-control"
                                                       value="<?= $dataProvider->call('jobExperiences-data','getStartedAt')?>"
                                                       id="startdatum"
                                                   
                                                       >
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="form-label col-lg-3" for="inputEmail">Einddatum:</label>
                                                <input type="text"
                                                       name="endedAt"
                                                       class="form-control"
                                                       value="<?= $dataProvider->call('jobExperiences-data','getEndedAt')?>"
                                                       id="einddatum"
                                                       
                                                       >
                                            </div>
                                            
                                             <div class="form-group">
                                                <label class="form-label col-lg-3" for="inputEmail">Werk omschrijving:</label>
                                                <textarea 
                                                       rows="10"
                                                       name="description"
                                                       class="form-control"
                                                       id="workdescription"
                                                       required><?= $dataProvider->call('jobExperiences-data','getDescription')?></textarea>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="form-label col-lg-3" for="inputEmail">Type werkplek:</label>
                                                <select required  class="form-control" name="isInternship">
                                                    <option value="">Geen</option>
                                                    <option value="werk">Werkplek</option>
                                                    <option value="stage">Stageplaats</option>
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