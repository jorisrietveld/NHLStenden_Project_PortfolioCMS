<?php include_once "weather2.php" ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Hogeschool Meppel</title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <meta name="keywords" content="Hogeschool, Meppel, Officiële, School, Lerarenopleiding, Muziekopleiding, Pop, Heavy Metal, Geschiedenis, Aardrijkskunde, Nieuwe Opleidingen">
        <meta name="description" content="Officiële Website van Hogeschool Meppel">
    </head>
    <body>
        <div class="container">
            <div class="aboveheader">
                <div class="logomobile">
                    <a href="index.php"><img src="afbeeldingen/logomobile.jpg" alt="Logo" title="Klik hier om naar de home pagina te gaan"></a>
                </div>
                <div class="weer" style="background-image: url(afbeeldingen/<?php achtergrond() ?>.jpg">
                    <p><?php echo getWeatherStringMeppel(); ?></p>
                </div>
                <div class="rsslogo">
                    <a href="rss.xml"><img src="afbeeldingen/rss.png" alt="RSS Logo"></a>
                </div>
                <div class="aboveheadercontact">
                    <a href="subpaginas/contact.html"><img src="afbeeldingen/contact.jpg" alt="Contact knop" title="Klik hier voor de contact pagina"></a>
                </div>
            </div>	
            <div class="header">
                <div class="logo">
                    <img src="afbeeldingen/logoklein.png" alt="Hogeschool Meppel Logo" />
                </div>
                <div class="menu">
                    <nav>
                        <ul class="cf">
                            <li><a class="dropdown" href="#">Hogeschool Meppel</a>
                                <ul>
                                    <li><a href="subpaginas/overons.html">Over Ons</a></li>
                                    <li><a href="subpaginas/fotogalerij.html">Fotogalerij</a></li>
                                    <li><a href="subpaginas/waarom.html">Waarom HM</a></li>
                                    <li><a href="subpaginas/nieuweopleidingen.html">Nieuwe Opleidingen</a></li>
                                </ul>
                            </li>
                            <li><a class="dropdown" href="#">&#9998; Lerarenopleiding</a>
                                <ul>
                                    <li><a href="subpaginas/testimonialslo.html">Testimonials</a></li>
                                    <li><a href="subpaginas/aardrijkskunde.html">Aardrijkskunde</a></li>
                                    <li><a href="subpaginas/geschiedenis.html">Geschiedenis</a></li>
                                    <li><a href="subpaginas/aanmelden.html">Aanmelden</a></li>
                                </ul>
                            </li>
                            <li><a class="dropdown" href="#">&#9836; Muziekopleiding</a>
                                <ul>
                                    <li><a href="subpaginas/testimonialsmo.html">Testimonials</a></li>
                                    <li><a href="subpaginas/heavymetal.html">Heavy Metal</a></li>
                                    <li><a href="subpaginas/pop.html">Pop</a></li>
                                    <li><a href="subpaginas/aanmelden.html">Aanmelden</a></li>
                                </ul>
                            </li>
                            <li><a class="dropdown" href="#">&#10068; Meer Informatie</a>
                                <ul>
                                    <li><a href="subpaginas/contact.html">Contact</a></li>
                                    <li><a href="subpaginas/locatie.html">Locatie</a></li>
                                    <li><a href="subpaginas/vacatures.html">Vacatures</a></li>		
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="aanmelden">
                    <a href="subpaginas/aanmelden.html"><img src="afbeeldingen/aanmeld.png" alt="aanmeld knop"/></a>
                </div>
            </div>
            <div class="imgheader">
                <div class="welkom">
                    <p>HOGESCHOOL MEPPEL</p>
                    <hr>
                    <p class="welkomtextmidden">HEET U VAN HARTE WELKOM</p>
                    <hr>
                    <p>OP ONZE NIEUWE WEBSITE! </p>
                </div>
            </div>
            <div class="mpimgheader">
                <div class="welkom">
                    <p>HOGESCHOOL MEPPEL</p>
                    <hr>
                    <p class="welkomtextmidden">HEET U VAN HARTE WELKOM</p>
                    <hr>
                    <p>OP ONZE NIEUWE WEBSITE! </p>
                </div>
            </div>
            <div class="mpcontentback">	
            </div>
            <div class="mpcontent">
                <div class="mpcontentupperbar">
                </div> 
                <!-- Ontdek Onze Nieuwe Opleidingen -->
                <div class="imgandtextboxmpc">
                    <div class="imgboxmpc">
                        <a href="subpaginas/nieuweopleidingen.html"><img src="afbeeldingen/mpcontentontdek.jpg" alt="Ontdek onze nieuwe opleidingen" title="Klik en ontdek onze nieuwe opleidingen"></a>
                    </div>
                    <div class="textimgboxmpc">
                        <p>ONTDEK ONZE NIEUWE OPLEIDINGEN</p>
                    </div>
                </div>
                <!-- Waarom Hogeschool Meppel -->
                <div class="imgandtextboxmpc">
                    <div class="imgboxmpc">
                        <a href="subpaginas/waarom.html"><img src="afbeeldingen/mpcontentwaarom.jpg" alt="Waarom Hogeschool Meppel" title="Klik en ontdek waarom Hogeschool Meppel"></a>
                    </div>
                    <div class="textimgboxmpc">
                        <p>WAAROM HOGESCHOOL MEPPEL </p>
                    </div>
                </div>
                <div class="newsmpc">
                    <p class="nieuws"> Nieuws & Agenda </p>
                    <p class="nieuwsdatum"> &#x2756; Dinsdag 26 Augustus </p>
                    <p class="nieuwscontent"> Open Dag </p>
                    <p class="nieuwsdatum"> &#x2756; Maandag 6 Oktober </p>
                    <p class="nieuwscontent"> Meeloopdag </p>
                    <p class="nieuwsdatum"> &#x2756; Donderdag 3 Januari </p>
                    <p class="nieuwscontent"> Introductieweek </p>
                    <p class="nieuwsdatum"> &#x2756; Vrijdag 8 Januari </p>
                    <p class="nieuwscontent"> Introductie party </p>
                </div>
            </div>
            <div class="footer">
                <p>&copy; 2016 | <i>Hogeschool</i>Meppel</p>
            </div>
        </div>
    </body>
</html>