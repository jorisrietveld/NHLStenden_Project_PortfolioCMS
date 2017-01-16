<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 13-01-2017 17:55
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
?>
<!DOCTYPE html>
<htmL>
<head>
    <title></title>
    <!-- Custom bootstap css lib in ubuntu style -->
    <link rel="stylesheet" href="<?= $dataProvider->get( 'asset-path' ) ?>css/bootstrap_ubuntu.css"  type="text/css" />
    <!-- Compiled custom stylesheet -->
    <link rel="stylesheet" href="<?= $dataProvider->get( 'asset-path' )?>css/styles.css" type="text/css" />
</head>
<body>

    <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a href="../" class="navbar-brand">Bootswatch</a>
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="navbar-collapse collapse" id="navbar-main">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes">Themes <span class="caret"></span></a>
                        <ul class="dropdown-menu" aria-labelledby="themes">
                            <li><a href="../default/">Default</a></li>
                            <li class="divider"></li>
                            <li><a href="../cerulean/">Cerulean</a></li>
                            <li><a href="../cosmo/">Cosmo</a></li>
                            <li><a href="../cyborg/">Cyborg</a></li>
                            <li><a href="../darkly/">Darkly</a></li>
                            <li><a href="../flatly/">Flatly</a></li>
                            <li><a href="../journal/">Journal</a></li>
                            <li><a href="../lumen/">Lumen</a></li>
                            <li><a href="../paper/">Paper</a></li>
                            <li><a href="../readable/">Readable</a></li>
                            <li><a href="../sandstone/">Sandstone</a></li>
                            <li><a href="../simplex/">Simplex</a></li>
                            <li><a href="../slate/">Slate</a></li>
                            <li><a href="../spacelab/">Spacelab</a></li>
                            <li><a href="../superhero/">Superhero</a></li>
                            <li><a href="../united/">United</a></li>
                            <li><a href="../yeti/">Yeti</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="../help/">Help</a>
                    </li>
                    <li>
                        <a href="http://news.bootswatch.com">Blog</a>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="download">United <span class="caret"></span></a>
                        <ul class="dropdown-menu" aria-labelledby="download">
                            <li><a href="http://jsfiddle.net/bootswatch/cvLkpsx0/">Open Sandbox</a></li>
                            <li class="divider"></li>
                            <li><a href="./bootstrap.min.css">bootstrap.min.css</a></li>
                            <li><a href="./bootstrap.css">bootstrap.css</a></li>
                            <li class="divider"></li>
                            <li><a href="./variables.less">variables.less</a></li>
                            <li><a href="./bootswatch.less">bootswatch.less</a></li>
                            <li class="divider"></li>
                            <li><a href="./_variables.scss">_variables.scss</a></li>
                            <li><a href="./_bootswatch.scss">_bootswatch.scss</a></li>
                        </ul>
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="http://builtwithbootstrap.com/" target="_blank">Built With Bootstrap</a></li>
                    <li><a href="https://wrapbootstrap.com/?ref=bsw" target="_blank">WrapBootstrap</a></li>
                </ul>

            </div>
        </div>
    </div>


    <div class="page-wrapper container-fluid">
        <h1>Hello world</h1>
    </div>

<!-- Jquery javascript library -->
<script src="<?= $dataProvider->get('lib-path') ?>jquery/dist/jquery.min.js" type="text/javascript"></script>
<!-- Bootstrap javascript library -->
<script src="<?= $dataProvider->get('lib-path') ?>bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
</body>
</htmL>
