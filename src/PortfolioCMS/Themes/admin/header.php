<html lang="en">
<head>
    <meta charset="utf-8"/>
    <link rel="icon" type="image/png" href="<?=$dataProvider->get('asset-path')?>/assets/admin/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    <title><?php echo $page_title ?></title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>

    <!-- Bootstrap css lib -->
    <link rel="stylesheet" href="<?= $dataProvider->get( 'lib-path' )?>bootstrap/dist/css/bootstrap.min.css" />
    <!-- Font awesome css file-->
    <link href="<?= $dataProvider->get( 'lib-path' )?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Cover css file -->
    <link href="<?=$dataProvider->get('asset-path')?>lib/cover.css" rel="stylesheet">
    <!--  Light Bootstrap Table core CSS  -->
    <link href="<?=$dataProvider->get('asset-path')?>css/light-bootstrap-dashboard.css" rel="stylesheet"/>
    <!-- Fonts and icons -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <?= $dataProvider->call( 'debugBarRenderer', 'renderHead' ) ?>
</head>