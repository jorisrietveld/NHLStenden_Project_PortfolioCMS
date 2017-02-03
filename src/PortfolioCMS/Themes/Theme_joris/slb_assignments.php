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
                <span class="color-orange header-text-size">SLB Opdrachten</span> /home/<?= $student->getFirstName()?>/doc
            </h1>
        </header>

        <section class="jumbotron row">
            <?php foreach ( $dataProvider->get( 'slbAssignments', [] ) as $slbAssignment ) : ?>
                <button type="button" class="btn btn-info col-lg-12 col-md-12 col-sm-12 col-xs-12" data-toggle="modal" data-target="#model-<?=  $slbAssignment->getId() ?>">
                    Bekijk de opdracht: <?= $slbAssignment->getName() ?>
                </button>
                <div class="col-lg-12">
                    <?= strlen( $slbAssignment->getFeedback() ) == 0 ? 'Deze opdracht heeft geen feedback.' : $slbAssignment->getFeedback() ?>
                    <br/>
                    <br/>
                </div>

                <div class="modal fade" id="model-<?= $slbAssignment->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="slb-model=<?= $slbAssignment->getId()?>">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title"><?= $slbAssignment->getName() ?></h4>
                            </div>

                            <div class="modal-body">

                                <object
                                    class="pdf-object col-lg-12 col-md-12 col-sm-12 col-xs-1"
                                    type="application/pdf"
                                    data="../../../slbAssignments/<?= $slbAssignment->getFileName() ?>?#zoom=85&scrollbar=0&toolbar=0&navpanes=0"
                                    id="pdf-content-<?= $slbAssignment->getId() ?>">
                                    <p>De slb opdracht kan niet worden weergegeven.</p>
                                </object>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-info col-lg-12 col-md-12 col-sm-12 col-xs-1" data-dismiss="modal">Opdracht sluiten</button>
                            </div>
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
