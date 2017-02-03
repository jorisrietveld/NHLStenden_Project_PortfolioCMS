<?php
$student = $dataProvider->get( 'student' );
$hasPageSuffix = FALSE !== strpos( $dataProvider->call( 'httpRequest', 'getBaseUrl' ), $dataProvider->get( 'current-page' ) );
?>
<!DOCTYPE html>
<htmL>
<head>
    <title></title>
    <!-- Custom bootstap css lib in ubuntu style -->
    <link rel="stylesheet" href="<?= $dataProvider->get( 'asset-path' ) ?>css/bootstrap_ubuntu.css" type="text/css"/>
    <!-- Compiled custom stylesheet -->
    <link rel="stylesheet" href="<?= $dataProvider->get( 'asset-path' ) ?>css/styles.css" type="text/css"/>
    <!-- Font awesome css file-->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<?php include __DIR__ . DIR_SEP . 'navigation.php'; ?>
<div class="page-wrapper container">

    <main>
        <header class="jumbotron text-center row" id="portfolio-header">
            <h1 class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-mono">
                <span class="color-orange header-text-size">Projects</span> /var/www
            </h1>
        </header>

        <section class="jumbotron row">
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
