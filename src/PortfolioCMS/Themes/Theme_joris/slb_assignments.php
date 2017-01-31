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
    <!-- Font awesome icons-->
    <link rel="stylesheet" href="<?= $dataProvider->get( 'lib-path' ) ?>font-awesome/css/font-awesome.min.css" type="text/css"/>
</head>
<body>
<?php include __DIR__ . DIR_SEP . 'navigation.php'; ?>
<div class="page-wrapper container">
    <main>
        <section class="jumbotron row">
            <h1>Slb opdrachen</h1>
        </section>
    </main>
</div>
<!-- Jquery javascript library -->
<script src="<?= $dataProvider->get( 'lib-path' ) ?>jquery/dist/jquery.min.js" type="text/javascript"></script>
<!-- Bootstrap javascript library -->
<script src="<?= $dataProvider->get( 'lib-path' ) ?>bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
</body>
</htmL>
