<!DOCTYPE html>
<html>
<head>
    <title><?= $dataProvider->get( 'title', 'Portfolio' ) ?></title>
    <?= $dataProvider->call( 'debugBarRenderer', 'renderHead' ) ?>
</head>
<body>
    <h1>Hello world</h1>
    <nav>
        <ul>
            <?php foreach ( $dataProvider->get( 'pages' ) as $page ) : ?>
                <li>
                    <a href="./<?= $dataProvider->get('url', '' ) . '/' . $page->getUrl() ?>">
                        <?= $page->getName() ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
    <?= $dataProvider->call( 'debugBarRenderer', 'render' ) ?>
</body>
</html>
