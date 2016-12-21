<?php
declare( strict_types = 1 );
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Bootstrap css lib -->
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
          crossorigin="anonymous"/>

    <!-- Custom css lib -->
    <link rel="stylesheet"
          type="text/css"
          href="css/styles.css"/>

    <title>Digitaal Portfolio</title>
</head>
<body>
    <main class="page-content">
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>                        
                </button>
                <a class="navbar-brand" href="#">Logo</a>
              </div>
              <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                  <li class="active"><a href="#">Home</a></li>
                  <li><a href="#">Projecten</a></li>
                  <li><a href="#">Gastenboek</a></li>
                  <li><a href="#">Contact</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                  <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                </ul>
              </div>
            </div>
        </nav>  
        <div class="container-fluid text-center">    
          <div class="row content">
            <div class="col-md-2 sidenav">
            </div>
            <div class="col-md-8 text-left"> 
              <h1>Welkom</h1>
              <p>In dit digitale portfolio vind u het portfolio van Zervan Hoving.
                 Het portfolio is gemaakt op basis van een groepsproject, in het portofolio kunt u ondere andere projecten vinden van mij.
                 Het portfolio heeft een aantal functies waaronder een gastenboek, studenten kunnen een template gebruiken om een standaard style voor het portfolio te gebruiken.
              </p>
              <hr>
              <h3>Over mij</h3>
              <p>Mijn naam is Zervan Hoving, ik ben 21 jaar en ben woonachtig in Duitsland.
                 Tijdens mijn opleiding doe ik een aantal projecten deze projecten kunt u vinden in mijn portfolio. Het portfolio was ondere andere een van mijn projecten.
                 In het portfolio kunt u mijn overige projecten inzien en mijn CV bekijken. 
              </p>
            </div>
            <div class="col-md-2 sidenav">
            </div>
          </div>
        </div>
    <footer class="container-fluid text-center">
        <p><span class=" glyphicon glyphicon-copyright-mark">Zervan Hoving</span></p>
    </footer>
    </main>
<!-- Jquery js lib -->


<script
    src="https://code.jquery.com/jquery-2.2.4.min.js"
    integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
    crossorigin="anonymous"></script>
    

<!-- Bootstrap js lib -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>

<!-- Custom js lib -->
<script src="js/script.js"
        type="text/javascript"></script>
</body>
</html>
