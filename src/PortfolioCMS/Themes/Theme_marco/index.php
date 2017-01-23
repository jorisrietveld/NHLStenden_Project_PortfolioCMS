<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Portfolio Marco Brink</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?= $dataProvider->get( 'lib-path' ) ?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="<?= $dataProvider->get("asset-path") ?>css/styles_1.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?= $dataProvider->get( 'lib-path' )?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Wellfleet" rel="stylesheet">
    <?= $dataProvider->call( 'debugBarRenderer', 'renderHead' ) ?>
</head>

<body id="page-top" class="index">

    <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="#page-top">Marco</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Portfolio's <span class="fa fa-caret-down"></span></a>
                                        <ul class="dropdown-menu">
                                            <?= $dataProvider->get( 'portfolioMenuLinks', '' ) ?>
                                        </ul>
                    </li>
                    
                    <li class="page-scroll">
                        <a href="#talen">Talen</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#opleiding">Opleiding</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#werk">Werkervaring</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#cijfer">Cijfers</a>
                    </li>
                    
                     <li class="page-scroll">
                        <a href="#assignment">SLB opdrachten</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-text">
                        <span class="name">Marco Brink
                        </span>
                        
                        <span class="name" style="font-size:20pt;">Welkom!
                        </span>
                        
                        <span class="name" style="font-size:20pt;">Laat me mezelf introduceren.
                        </span>
                        
                        <a href="#skip"><i class="fa fa-angle-double-down fa-3x" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- About Section -->
    <section class="about" id="skip">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h3>Pesoonlijke gegevens</h3>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-lg-offset-2">
                    <div class="info">
                        
                        <p class="records">
                            Naam:  
                            <?php
                            $studentfn = $dataProvider->get( 'student' );
                            echo $studentfn->getFirstName();
                            ?>
                            <?php
                            $studentln = $dataProvider->get( 'student' );
                            echo $studentln->getLastName();
                            ?>
                        </p>    
            
                        <p class="records">    
                            Geboortedatum:   
                            <?php
                            $birthdate = $dataProvider->get( 'student' );
                            echo $birthdate->getDateOfBirth()->format( 'd-m-Y' );
                            ?>
                        </p>
            
                        <p class="records">    
                            Plaats: 
                            <?php
                            $place = $dataProvider->get( 'student' );
                            echo $place->getLocation();
                            ?>
                        </p>
       
                       
            
                        <p class="records">
                            E-mailadres: 
                            <?php
                            $email = $dataProvider->get( 'student' );
                            echo $email->getEmail();
                            ?>
                        </p>
            
                        <p class="records">
                            Rijbewijs:
                            <?php
                            $driver = $dataProvider->get( 'student' );
                            if($driver->getStudentCode() == 535672 || 533270 || 550035 || 55827){
                                
                                echo'Ja';
                            }else{
                                
                                echo 'Nee';
                            }
                            ?>
                            
                        </p>
            
                    </div>
                </div>
                <div class="col-lg-4">
                    <p> Hallo! Op dit moment ben ik 20 jaar. Ik woon in Assen.
                    Ik studeer Informatica bij Stenden hogeschool 
                    in Emmen. Mijn hobby's zijn het spelen van basketbal(en het kijken van basketbal), gamen, 
                    luisteren van muziek en reizen.</p>
                </div>
            </div>
        </div>
    </section>
        <!-- Languages Section -->
    <section class="language" id="talen">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h3 id="skip">Talen</h3>
                    <hr class="blue">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-lg-offset-2">
                    <div class="nederland">
                          
                        
                        <p class="records">
                        
                            <?php 
                            $DBConnect = mysqli_connect('85.144.187.81','inf1b','peer');
                           if ($DBConnect === FALSE)
                            {
                            echo "<p>Unable to connect to the database server.</p>"
                            . "<p>Error code " . mysqli_errno() . ": " . mysqli_error()
                            . "</p>";
                            }else {
                                $DBName = "DigitalPortfolio";
                                if(!mysqli_select_db ($DBConnect, $DBName))
                                    {
                                      echo "<p>There are no entries in the guest book!</p>";
                                    }else {
                                        $TableName = "Language";
                                        $SQLstring = "SELECT * FROM $TableName WHERE portfolioId = 5" ;
                                        $QueryResult = mysqli_query($DBConnect, $SQLstring);
                                        if (mysqli_num_rows($QueryResult) == 0)
                                        {
                                            echo "<p>There are no languages!</p>";
                                        }else{
                                            
                                        
                                       
        
                                        while($Row = mysqli_fetch_assoc($QueryResult))
                                        {
                                            echo "{$Row['language']}<br>";
                                            echo "{$Row['level']}<br>";
                                        }
                                    }
                                    mysqli_free_result($QueryResult);
                                }
                            mysqli_close($DBConnect);
                        }
                                    
                            
                                    
                            ?>
                        </p>  
            
                        
            
                    </div>
                </div>
               
            </div>
        </div>
    </section>
            <!-- Certificates Section -->
    <section class="about" id="opleiding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h3>Certificaten</h3>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-lg-offset-2">
                    <div class="info">
                        
                        <p class="records">
                            Naam: Marco Brink
                        </p>    
            
                        <p class="records">    
                            Geboortedatum: 10 mei 1996
                        </p>
            
                        <p class="records">    
                            Plaats: Assen
                        </p>
       
                        <p class="records">
                            Nationaliteit: Nederlands
                        </p>
            
                        <p class="records">
                            E-mailadres: marco.brink@student.stenden.com  
                        </p>
            
                        <p class="records">
                            Rijbewijs: Ja  
                        </p>
            
                    </div>
                </div>
                <div class="col-lg-4">
                    <p> Hallo! Op dit moment ben ik 20 jaar. Ik woon in Assen.
                    Ik studeer Informatica bij Stenden hogeschool 
                    in Emmen. Mijn hobby's zijn het spelen van basketbal(en het kijken van basketbal), gamen, 
                    luisteren van muziek en reizen.</p>
                </div>
            </div>
        </div>
    </section>
                    <!-- Werk ervaring Section -->
    <section class="language" id="werk">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h3 id="skip">Werkervaring</h3>
                    <hr class="blue">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-lg-offset-2">
                    <div class="info">
                        
                        <p class="records">
                            Naam: Marco Brink
                        </p>    
            
                        <p class="records">    
                            Geboortedatum: 10 mei 1996
                        </p>
            
                        <p class="records">    
                            Plaats: Assen
                        </p>
       
                        <p class="records">
                            Nationaliteit: Dutch  
                        </p>
            
                        <p class="records">
                            E-mailadres: marco.brink@student.stenden.com  
                        </p>
            
                        <p class="records">
                            Rijbewijs: Ja  
                        </p>
            
                    </div>
                </div>
                <div class="col-lg-4">
                    <p> Hello! I am currently 20 years old. I live in Assen.
                    At this moment I am studying informatics at Stenden Universtity in 
                    Emmen.!  My hobbies are playing(and watching basketball), gaming, 
                    listening to music(especially electronic)and travelling.</p>
                </div>
            </div>
        </div>
    </section>
               <!-- Cijfers -->
    <section class="about" id="cijfer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h3>Cijfers</h3>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-lg-offset-2">
                    <div class="info">
                        
                        <p class="records">
                            Naam: Marco Brink
                        </p>    
            
                        <p class="records">    
                            Geboortedatum: 10 mei 1996
                        </p>
            
                        <p class="records">    
                            Plaats: Assen
                        </p>
       
                        <p class="records">
                            Nationaliteit: Nederlands
                        </p>
            
                        <p class="records">
                            E-mailadres: marco.brink@student.stenden.com  
                        </p>
            
                        <p class="records">
                            Rijbewijs: Ja  
                        </p>
            
                    </div>
                </div>
                <div class="col-lg-4">
                    <p> Hallo! Op dit moment ben ik 20 jaar. Ik woon in Assen.
                    Ik studeer Informatica bij Stenden hogeschool 
                    in Emmen. Mijn hobby's zijn het spelen van basketbal(en het kijken van basketbal), gamen, 
                    luisteren van muziek en reizen.</p>
                </div>
            </div>
        </div>
    </section>
                        <!-- SLB Assignments Section -->
    <section class="language" id="assignment">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h3>SLB opdrachten </h3>
                    <hr class="blue">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-lg-offset-2">
                    <div class="info">
                        
                        <p class="records">
                            Naam: Marco Brink
                        </p>    
            
                        <p class="records">    
                            Geboortedatum: 10 mei 1996
                        </p>
            
                        <p class="records">    
                            Plaats: Assen
                        </p>
       
                        <p class="records">
                            Nationaliteit: Dutch  
                        </p>
            
                        <p class="records">
                            E-mailadres: marco.brink@student.stenden.com  
                        </p>
            
                        <p class="records">
                            Rijbewijs: Ja  
                        </p>
            
                    </div>
                </div>
                <div class="col-lg-4">
                    <p> Hello! I am currently 20 years old. I live in Assen.
                    At this moment I am studying informatics at Stenden Universtity in 
                    Emmen.!  My hobbies are playing(and watching basketball), gaming, 
                    listening to music(especially electronic)and travelling.</p>
                </div>
            </div>
        </div>
    </section>


    <!-- Contact Section -->
    <section class="contact" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 id="title">Gastenboek</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
                    <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
                    <form name="sentMessage" id="contactForm" novalidate>
                        <div class="row control-group" style="border:2px solid;border-radius:4px ">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Name</label>
                                <input type="text" class="form-control" placeholder="Name" id="name" required data-validation-required-message="Please enter your name." style="color:white;">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group" style="border:2px solid;border-radius:4px ">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Email Address</label>
                                <input type="email" class="form-control" placeholder="Email Address" id="email" required data-validation-required-message="Please enter your email address." style="color:white;">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group" style="border:2px solid;border-radius:4px ">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Phone Number</label>
                                <input type="tel" class="form-control" placeholder="Phone Number" id="phone" required data-validation-required-message="Please enter your phone number." style="color:white;">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group" style="border:2px solid;border-radius:4px ">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Message</label>
                                <textarea rows="5" class="form-control" placeholder="Message" id="message" required data-validation-required-message="Please enter a message." style="color:white;"></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <br>
                        <div id="success"></div>
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <button type="submit" class="btn btn-success btn-lg">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center">
       
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        Copyright &copy; Marco Brink 2017
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll hidden-sm hidden-xs hidden-lg hidden-md">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery -->
    <script src="<?= $dataProvider->get( 'lib-path' ) ?>jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap js lib plugin -->
    <script src="<?= $dataProvider->get( 'lib-path' ) ?>bootstrap/dist/js/bootstrap.min.js"></script>
    <?= $dataProvider->call( 'debugBarRenderer', 'render' ) ?>
</body>
</html>
