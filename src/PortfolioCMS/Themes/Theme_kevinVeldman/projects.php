<?php
$student = $dataProvider->get( 'student' );
$hasPageSuffix = FALSE !== strpos( $dataProvider->call( 'httpRequest', 'getBaseUrl' ), $dataProvider->get( 'current-page' ) );
?>
<!DOCTYPE html>
<htmL>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $dataProvider->get( 'title' ) ?></title>
    <link href="https://fonts.googleapis.com/css?family=Sansita" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= $dataProvider->get( 'asset-path' ) ?>css/custom.css" type="text/css"/>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<?php include __DIR__ . DIR_SEP . 'navigation.php'; ?>
<div class="page-wrapper container">

    <main>
        <section class="row">
            <h1>Projecten</h1>
            <br/>
            <?php foreach ( $dataProvider->get( 'projects' ) as $project ) : ?>
                <div class="col-lg-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?= $project->getName()?><span class="pull-right">Cijfer: <?= $project->getGrade()>0 ? $project->getGrade():'Nog geen cijfer' ?></span> </h3>
                        </div>
                        <div class="panel-body">
                            <?= $project->getDescription()?>
                            <br/>
                            <br/>
                            <img src="../../../images/<?= $project->getImage()->getFileName() ?>" class="col-lg-11" style="margin-bottom: 10px"/>
                            <a href="<?= $project->getLink()?>">
                                <button class="btn btn-info col-lg-12">Bekijk het project</button>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </section>
    </main>
</div>
<!-- Jquery javascript library -->
<script src="<?= $dataProvider->get( 'lib-path' ) ?>jquery/dist/jquery.min.js" type="text/javascript"></script>
<!-- Bootstrap javascript library -->
<script src="<?= $dataProvider->get( 'lib-path' ) ?>bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
</body>
</htmL>
