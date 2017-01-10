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
        
        <title>Portfolio</title>
    </head>
    <body>       
        <main class="page-content">
            <nav class="navbar navbar-default navbar-fixed-top">
              <div class="container">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="#">Logo</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                  <ul class="nav navbar-nav navbar-right">
                    <li><a href="#over">OVER</a></li>
                    <li><a href="#cv">CV</a></li>
                    <li><a href="#contact">CONTACT</a></li>
                  </ul>
                </div>
              </div>
            </nav>
            <div class="jumbotron text-center">
              <h1>Portefolio</h1>
              <p>Kevin Tabak</p>
            </div>
            <div id="over" class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Over mij</h2>
                        <p> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. 
                            Aenean commodo ligula eget dolor. Aenean massa. 
                            Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. 
                            Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. 
                            Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. 
                            In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. 
                            Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. 
                            Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. 
                            Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. 
                            Curabitur ullamcorper ultricies nisi. Nam eget dui. 
                        </p>
                    </div>
                </div>
            </div>
            <div id="cv" class="container-fluid bg-grey">
              <div class="row">
                <div class="col-sm-6">
                    <h2>CV</h2>
                    <p>In mijn CV staat al mijn werk ervaring en mijn contactgegevend.</p>
                </div>
                <div class="col-sm-4 text-center">
                    <h2>Download</h2>
                    <a href="files/CV.pdf" target="_blank" id="DownCV">
                        <span class="glyphicon glyphicon-file"></span>
                        <p>CV.pdf</p>
                    </a>
                </div>
              </div>
            </div>
            <div id="cijfers" class="container-fluid">
                <div class="row">
                    <div id="CTable" class="col-sm-3">
                        <table class="table text-center">
                            <thead>
                              <tr>
                                <th class="text-center">Vak</th>
                                <th class="text-center">Cijfer</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>PHP</td>
                                <td>8</td>
                              </tr>
                              <tr>
                                <td>DGD</td>
                                <td>7</td>
                              </tr>
                              <tr>
                                <td>HTML</td>
                                <td>8</td>
                              </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div id="contact" class="container-fluid bg-grey">
                <h2 class="text-center">CONTACT</h2>
                <div class="row">
                    <div class="col-sm-5">
                        <p>Neem contact met mij op.</p>
                        <p><span class="glyphicon glyphicon-phone"></span> +31 6 46723554</p>
                        <p><span class="glyphicon glyphicon-envelope"></span> kevin_tabak@outlook.com</p>
                    </div>
                    <div class="col-sm-7">
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
                            </div>
                        </div>
                        <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea><br>
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <button class="btn btn-default pull-right" type="submit">Send</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

    </body>
</html>
