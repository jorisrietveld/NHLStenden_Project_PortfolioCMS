<!--<?php
$student = $dataProvider->get( 'student' );
$hasPageSuffix = FALSE !== strpos( $dataProvider->call( 'httpRequest', 'getBaseUrl' ), $dataProvider->get( 'current-page' ) );
?>-->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $dataProvider->get( 'title' ) ?></title>

    <link href="https://fonts.googleapis.com/css?family=Sansita" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="<?= $dataProvider->get( 'asset-path' )?>css/custom.css" rel="stylesheet" />
    <link href="css/custom.css" rel="stylesheet" /><!--VERWIJDEREN-->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <?php include __DIR__ . DIR_SEP . 'navigation.php'; ?>
<div class="header">
  <div class="container">
      <div class="col-lg-12 text-center">
        <h1 class>Student name</h1><!--<?= $student->getFirstName() . ' ' . $student->getLastName() ?>-->
      </div>
      <div class="clearfix">
      </div>
  </div>
</div>
<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <h1><?= $student->getFirstName() . ' ' . $student->getLastName() ?></h1><!--<?= $student->getFirstName() . ' ' . $student->getLastName() ?>-->
        <h4>
        <div class="icon coln1">
          <i class="fa fa-envelope" aria-hidden="true"></i>
        </div>
        <div class="infoBox">
          <?= $student->getEmail() ?>
        </div>

        <div class="icon coln1">
          <i class="fa fa-birthday-cake" aria-hidden="true"></i>
        </div>
        <div class="infoBox">
          <?= $student->getDateOfBirth()->format( 'Y-m-d' ) ?>
        </div>

        <div class="icon coln1">
          <i class="fa fa-road" aria-hidden="true"></i>
        </div>
        <div class="infoBox">
          <?= $student->getAddress() ?>
        </div>

        <div class="icon coln1">
          <i class="fa fa-home" aria-hidden="true"></i>
        </div>
        <div class="infoBox">
          <?= $student->getZipCode() . ' ' . $student->getLocation() ?>
        </div>

        <div class="icon coln1">
          <i class="fa fa-mobile" aria-hidden="true"></i>
        </div>
        <div class="infoBox">
          <?= $student->getPhoneNumber() ?>
        </div>
      </h4>
      </div>
      <div class="col-lg-3 col-lg-offset-1 col-sm-6 col-sm-offset-3">
        <img
        class=" pull-right img-circle header-profile-picture col-lg-3 col-md-4 col-sm-12 col-xs-12 imgSizing"
        src="../../../images/<?= $dataProvider->nestedCall( 'images', 'getEntityWith:getFileName', [ [ 'type', 'PROFILE_IMAGE' ], [] ] )?>"
        alt="<?= $dataProvider->nestedCall( 'images', 'getEntityWith:getDescription', [ [ 'type', 'PROFILE_IMAGE' ], [] ] )?>"/>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-5 ">
          <h3>Mijn Vaardigheden</h3>
          <?php foreach ( $dataProvider->get('skills', []) as $skill ) : ?>
              <?= $skill->getName()?><br>
              <?php for( $i = 0; $i < 10; $i++ ) : ?>
                  <i class="coln1 fa fa-circle<?= $skill->getLevelOfExperience() <= $i ? '-o': ''?>" aria-hidden="true"></i>
              <?php endfor; ?>
              <br>
          <?php endforeach; ?>
      </div>
      <div class="col-lg-5 col-lg-offset-1">
          <h3>Mijn Talen</h3>
          <?php foreach ( $dataProvider->get('languages', []) as $language ) : ?>
              <?= $language->getLanguage()?><br>
              <?php for( $i = 0; $i < 10; $i++ ) : ?>
                  <i class="coln1 fa fa-circle<?= $language->getLevel() <= $i ? '-o': ''?>" aria-hidden="true"></i>
              <?php endfor; ?>
              <br>
          <?php endforeach; ?>
      </div>
      <div class="col-lg-5">
          <h3>Mijn Hobbies</h3>
          <?php foreach ( $dataProvider->get('hobbies', []) as $hobby ) : ?>
              <?= $hobby->getName()?><br>
          <?php endforeach; ?>
      </div>

    </div>
    <div class="row">
      <div class="col-lg-12">
          <h3>Mijn Opleidingen</h3>
          <?php foreach ( $dataProvider->get('trainings', []) as $training ) : ?>
              <div class="col-lg-12">
                  <h4 class="col-lg-12">
                      <span class="coln1"><?= $training->getTitle()?></span>
                      &nbsp;@&nbsp;
                      <span class="coln3"><?= $training->getInstitution()?></span>
                  </h4>
                  <div class="col-lg-12">
                  <?= $training->getDescription()?><br><br>
                  </div>
              </div>
          <?php endforeach; ?>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6">
          <h3>Mijn Werkervaringen</h3>
          <?php foreach( $dataProvider->call( 'jobExperiences', 'getEntitiesWith', [ 'IsInternship', FALSE ] ) as $jobExperience ) : ?>
              <div class="row">
                <h4 class="coln1"><?= $jobExperience->getLocation()?></h4>
                <?= $jobExperience->getDescription()?><br><br>
              </div>
          <?php endforeach; ?>
      </div>

      <div class="col-lg-6">
          <h3>Mijn Stages</h3>
          <?php foreach( $dataProvider->call( 'jobExperiences', 'getEntitiesWith', [ 'IsInternship', TRUE ] ) as $internship ) : ?>
              <div class="row">
                <h4 class="coln1"><?= $internship->getLocation()?></h4>
                <?= $internship->getDescription()?><br><br>
              </div>
          <?php endforeach; ?>
      </div>
      <?php if( $dataProvider->call( 'cv', 'getId' ) !== 0 ): ?>
          <a class="btn btn-lg bgcoln1 col-lg-12" href="../../slbAssignments/<?= $dataProvider->call( 'cv', 'getFileName' )?>" download>
              <i class="fa fa-download" aria-hidden="true"></i>&nbsp;&nbsp;Download mijn CV
          </a>
      <?php endif; ?>

    </div>

  </div>

</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  </body>
</html>
