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
                    <i class="fa fa-address-card-o fa-3x" aria-hidden="true"></i>
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
                            Email: 
                            <?php
                            $email = $dataProvider->get( 'student' );
                            if($email->getFirstName()=='Marco'){
                                
                                echo'marcobrink@outlook.com';
                            }else{
                                echo $email->getEmail();
                            }
                            
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
                    <p class="records">
                    <?php
                    if($dataProvider->get( 'student' )->getFirstName()=='Marco'){
                       
                    echo"Hallo! Op dit moment ben ik 20 jaar. Ik woon in Assen.
                    Ik studeer Informatica bij Stenden hogeschool 
                    in Emmen. Mijn hobbys zijn basketbal   
                    (en het kijken van basketbal), gamen, 
                    luisteren van muziek en reizen.";
                    }        
                    ?>
                    </p>
                    
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
                    <i class="fa fa-flag fa-3x" aria-hidden="true"></i>
                    <hr class="blue">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2 col-lg-offset-2">
                    <div class="nederland">
                          
                        
                        <p class="records">
                        <?php //  dump($dataProvider) ?>
                            Taal:
                            <?php
                            echo $dataProvider->get( 'languages', [1] )[1]->getLanguage();
                            ?>
                    
                        </p>  
                        
                        <p class="records">
                       
                            Niveau:
                            <?php
                            if($dataProvider->get( 'languages', [1] )[1]->getLevel()==10){
                                
                                echo'C2';
                            }
                            if($dataProvider->get( 'languages', [1] )[1]->getLevel()== 9){
                                
                                echo'C1';
                            }
                            if($dataProvider->get( 'languages', [1] )[1]->getLevel()== 8){
                                
                                echo'C1';
                            }
                            ?>
                            
                   
                        </p> 
                        
                         <p class="records">
                      
                            Moedertaal:
                            <?php
                            if($dataProvider->get( 'languages', [1] )[1]->getIsIsNative()==TRUE){
                                
                                echo'Ja';
                            }
                            if($dataProvider->get( 'languages', [1] )[1]->getIsIsNative()== FALSE){
                                
                                echo'Nee';
                            }
                          
                        ?>
                            
                   
                        </p> 
            
                        
            
                    </div>
                </div>
                <div class="col-lg-2 col-lg-offset-2">
                     <div class="engels">
                          
                        
                        <p class="records">
                        <?php //  dump($dataProvider) ?>
                            Taal:
                            <?php
                            echo $dataProvider->get( 'languages', [1] )[2]->getLanguage();
                            ?>
                    
                        </p>  
                        
                        <p class="records">
                       
                            Niveau:
                            <?php
                            if($dataProvider->get( 'languages', [1] )[2]->getLevel()==10){
                                
                                echo'C2';
                            }
                            if($dataProvider->get( 'languages', [1] )[2]->getLevel()== 9){
                                
                                echo'C1';
                            }
                            if($dataProvider->get( 'languages', [1] )[2]->getLevel()== 8){
                                
                                echo'C1';
                            }
                            if($dataProvider->get( 'languages', [1] )[2]->getLevel()== 7){
                                
                                echo'B2';
                            }
                            if($dataProvider->get( 'languages', [1] )[2]->getLevel()== 6){
                                
                                echo'B1';
                            }
                            if($dataProvider->get( 'languages', [1] )[2]->getLevel()== 5){
                                
                                echo'B1';
                            }
                             if($dataProvider->get( 'languages', [1] )[2]->getLevel()== 4){
                                
                                echo'A2';
                            }
                             if($dataProvider->get( 'languages', [1] )[2]->getLevel()== 3){
                                
                                echo'A2';
                            }
                            if($dataProvider->get( 'languages', [1] )[2]->getLevel()== 2){
                                
                                echo'A1';
                            }
                            if($dataProvider->get( 'languages', [1] )[2]->getLevel()== 1){
                                
                                echo'A1';
                            }
                            ?>
                            
                   
                        </p> 
                        
                         <p class="records">
                      
                            Moedertaal:
                            <?php
                            if($dataProvider->get( 'languages', [1] )[2]->getIsIsNative()==TRUE){
                                
                                echo'Ja';
                            }
                            if($dataProvider->get( 'languages', [1] )[2]->getIsIsNative()== FALSE){
                                
                                echo'Nee';
                            }
                          
                        ?>
                            
                   
                        </p> 
            
                        
            
                    </div>
                </div>
                <div class="col-lg-2 col-lg-offset-2">
                     <div class="duits">
                          
                        
                        <p class="records">
                        <?php //  dump($dataProvider) ?>
                            Taal:
                            <?php
                            echo $dataProvider->get( 'languages', [1] )[3]->getLanguage();
                            ?>
                    
                        </p>  
                        
                        <p class="records">
                       
                            Niveau:
                            <?php
                            if($dataProvider->get( 'languages', [1] )[3]->getLevel()==10){
                                
                                echo'C2';
                            }
                            if($dataProvider->get( 'languages', [1] )[3]->getLevel()== 9){
                                
                                echo'C1';
                            }
                            if($dataProvider->get( 'languages', [1] )[3]->getLevel()== 8){
                                
                                echo'C1';
                            }
                            if($dataProvider->get( 'languages', [1] )[3]->getLevel()== 7){
                                
                                echo'B2';
                            }
                            if($dataProvider->get( 'languages', [1] )[3]->getLevel()== 6){
                                
                                echo'B1';
                            }
                            if($dataProvider->get( 'languages', [1] )[3]->getLevel()== 5){
                                
                                echo'B1';
                            }
                             if($dataProvider->get( 'languages', [1] )[3]->getLevel()== 4){
                                
                                echo'A2';
                            }
                             if($dataProvider->get( 'languages', [1] )[3]->getLevel()== 3){
                                
                                echo'A2';
                            }
                            if($dataProvider->get( 'languages', [1] )[3]->getLevel()== 2){
                                
                                echo'A1';
                            }
                            if($dataProvider->get( 'languages', [1] )[3]->getLevel()== 1){
                                
                                echo'A1';
                            }
                            ?>
                            
                   
                        </p> 
                        
                         <p class="records">
                      
                            Moedertaal:
                            <?php
                            if($dataProvider->get( 'languages', [1] )[3]->getIsIsNative()==TRUE){
                                
                                echo'Ja';
                            }
                            if($dataProvider->get( 'languages', [1] )[3]->getIsIsNative()== FALSE){
                                
                                echo'Nee';
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
                    <h3>Opleidingen/Certificaten</h3>
                     <i class="fa fa-book fa-3x" aria-hidden="true"></i>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-lg-offset-2">
                    <div class="opleidingen">
                        
                        <h3>Opleidingen</h3>
                        
                        <p class="records">
                        <?php //  dump($dataProvider) ?>
                            Naam Studie:
                            <?php
                            echo $dataProvider->get( 'trainings', [1] )[1]->getTitle();
                        ?> 
                        </p> 
                        
                        <p class="records">
                  
                            Naam school:
                            <?php
                            echo $dataProvider->get( 'trainings', [1] )[1]->getInstitution();
                        ?> 
                        </p> 
                        
                          
                        <p class="records">
                     
                            Locatie:
                            <?php
                            echo $dataProvider->get( 'trainings', [1] )[1]->getLocation();
                        ?> 
                        </p> 
                        
                        <p class="records">
                     
                            Begonnen op:
                            <?php
                            echo $dataProvider->get( 'trainings', [1] )[1]->getStatedAt()->format( 'd-m-Y' );
                        ?> 
                        </p> 
                        
                        <p class="records">
                      
                            Beëindigd op:
                            <?php
                            echo $dataProvider->get( 'trainings', [1] )[1]->getFinishedAt()->format( 'd-m-Y' );
                        ?> 
                        </p> 
                        
                         <p class="records" >
                       
                            Behaald:
                            <?php
                            if($dataProvider->get( 'trainings', [1] )[1]->getObtainedCertificate()== true){
                                
                                echo'Ja';
                            }else{
                                echo'Nee';
                            }
                        ?> 
                        </p> 
                        
                        
                        <br>
                        <br>
                        <br>
                        <!-- Tweede opleiding--->
                        
                           
                        <p class="records">
                        
                            Naam Studie:
                            <?php
                            echo $dataProvider->get( 'trainings', [1] )[2]->getTitle();
                        ?> 
                        </p> 
                        
                        <p class="records">
                      
                            Naam school:
                            <?php
                            echo $dataProvider->get( 'trainings', [1] )[2]->getInstitution();
                        ?> 
                        </p> 
                        
                          
                        <p class="records">
                    
                            Locatie:
                            <?php
                            echo $dataProvider->get( 'trainings', [1] )[2]->getLocation();
                        ?> 
                        </p> 
                        
                        <p class="records">
                        
                            Begonnen op:
                            <?php
                            echo $dataProvider->get( 'trainings', [1] )[2]->getStatedAt()->format( 'd-m-Y' );
                        ?> 
                        </p> 
                        
                        <p class="records">
                        
                            Beëindigd op:
                            <?php
                            echo $dataProvider->get( 'trainings', [1] )[2]->getFinishedAt()->format( 'd-m-Y' );
                        ?> 
                        </p> 
                        
                         <p class="records">
                      
                            Behaald:
                            <?php
                            if($dataProvider->get( 'trainings', [1] )[2]->getObtainedCertificate()== true){
                                
                                echo'Ja';
                            }else{
                                echo'Nee';
                            }
                        ?> 
                        </p>
            <!--Derde studie --->
                        <br>
                        <br>
                        <br>
                        
                        
                           
                        <p class="records">
                        
                            Naam Studie:
                            <?php
                            echo $dataProvider->get( 'trainings', [1] )[3]->getTitle();
                        ?> 
                        </p> 
                        
                        <p class="records">
                      
                            Naam school:
                            <?php
                            echo $dataProvider->get( 'trainings', [1] )[3]->getInstitution();
                        ?> 
                        </p> 
                        
                          
                        <p class="records">
                    
                            Locatie:
                            <?php
                            echo $dataProvider->get( 'trainings', [1] )[3]->getLocation();
                        ?> 
                        </p> 
                        
                        <p class="records">
                        
                            Begonnen op:
                            <?php
                            echo $dataProvider->get( 'trainings', [1] )[3]->getStatedAt()->format( 'd-m-Y' );
                        ?> 
                        </p> 
                        
                        <p class="records">
                        
                            Beëindigd op:
                            <?php
                            echo $dataProvider->get( 'trainings', [1] )[3]->getFinishedAt()->format( 'd-m-Y' );
                        ?> 
                        </p> 
                        
                         <p class="records" >
                      
                            Behaald:
                            <?php
                            if($dataProvider->get( 'trainings', [1] )[3]->getObtainedCertificate()== true){
                                
                                echo'Ja';
                            }else{
                                echo'Nee';
                            }
                        ?> 
                        </p>
                        <p class="records">
                        
                            
                            <?php
                            if( $dataProvider->get( 'student' )->getFirstName()=='Marco'){
                                echo'*Het judicium cum laude is toegekend op grond van artikel 52a juncto 64.';
                            }
                        ?> 
                        </p> 
                       
            
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="opleidingen">
                        
                        <h3>Certificaten</h3>
                        
                        <p class="records">
                        <?php //  dump($dataProvider) ?>
                            Naam Certificaat:
                            <?php
                            echo $dataProvider->get( 'trainings', [1] )[4]->getTitle();
                        ?> 
                        </p> 
                        
                        <p class="records">
                  
                            Naam school:
                            <?php
                            echo $dataProvider->get( 'trainings', [1] )[4]->getInstitution();
                        ?> 
                        </p> 
                        
                          
                        <p class="records">
                     
                            Locatie:
                            <?php
                            echo $dataProvider->get( 'trainings', [1] )[4]->getLocation();
                        ?> 
                        </p> 
                        
                        <p class="records">
                     
                            Begonnen op:
                            <?php
                            echo $dataProvider->get( 'trainings', [1] )[4]->getStatedAt()->format( 'd-m-Y' );
                        ?> 
                        </p> 
                        
                        <p class="records">
                      
                            Beëindigd op:
                            <?php
                            echo $dataProvider->get( 'trainings', [1] )[4]->getFinishedAt()->format( 'd-m-Y' );
                        ?> 
                        </p> 
                        
                         <p class="records" >
                       
                            Behaald:
                            <?php
                            if($dataProvider->get( 'trainings', [1] )[4]->getObtainedCertificate()== true){
                                
                                echo'Ja';
                            }else{
                                echo'Nee';
                            }
                        ?> 
                        </p> 
                        
                        
                        <br>
                        <br>
                        <br>
                        <!-- Tweede Certificaat--->
                        
                           
                        <p class="records">
                        
                            Naam Certificaat:
                            <?php
                            echo $dataProvider->get( 'trainings', [1] )[5]->getTitle();
                        ?> 
                        </p> 
                        
                        <p class="records">
                      
                            Naam school:
                            <?php
                            echo $dataProvider->get( 'trainings', [1] )[5]->getInstitution();
                        ?> 
                        </p> 
                        
                          
                        <p class="records">
                    
                            Locatie:
                            <?php
                            echo $dataProvider->get( 'trainings', [1] )[5]->getLocation();
                        ?> 
                        </p> 
                        
                        <p class="records">
                        
                            Begonnen op:
                            <?php
                            echo $dataProvider->get( 'trainings', [1] )[5]->getStatedAt()->format( 'd-m-Y' );
                        ?> 
                        </p> 
                        
                        <p class="records">
                        
                            Beëindigd op:
                            <?php
                            echo $dataProvider->get( 'trainings', [1] )[5]->getFinishedAt()->format( 'd-m-Y' );
                        ?> 
                        </p> 
                        
                         <p class="records">
                      
                            Behaald:
                            <?php
                            if($dataProvider->get( 'trainings', [1] )[5]->getObtainedCertificate()== true){
                                
                                echo'Ja';
                            }else{
                                echo'Nee';
                            }
                        ?> 
                        </p>
            <!--Derde Certificaat --->
                        <br>
                        <br>
                        <br>
                        
                        
                           
                        <p class="records">
                        
                            Naam Certificaat:
                            <?php
                            echo $dataProvider->get( 'trainings', [1] )[6]->getTitle();
                        ?> 
                        </p> 
                        
                        <p class="records">
                      
                            Naam school:
                            <?php
                            echo $dataProvider->get( 'trainings', [1] )[6]->getInstitution();
                        ?> 
                        </p> 
                        
                          
                        <p class="records">
                    
                            Locatie:
                            <?php
                            echo $dataProvider->get( 'trainings', [1] )[6]->getLocation();
                        ?> 
                        </p> 
                        
                        <p class="records">
                        
                            Begonnen op:
                            <?php
                            echo $dataProvider->get( 'trainings', [1] )[6]->getStatedAt()->format( 'd-m-Y' );
                        ?> 
                        </p> 
                        
                        <p class="records">
                        
                            Beëindigd op:
                            <?php
                            echo $dataProvider->get( 'trainings', [1] )[6]->getFinishedAt()->format( 'd-m-Y' );
                        ?> 
                        </p> 
                        
                         <p class="records" >
                      
                            Behaald:
                            <?php
                            if($dataProvider->get( 'trainings', [1] )[6]->getObtainedCertificate()== true){
                                
                                echo'Ja';
                            }else{
                                echo'Nee';
                            }
                        ?> 
                        </p>
                        
                       
            
                    </div>
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
                    <i class="fa fa-handshake-o fa-2x" aria-hidden="true"></i>
                    <hr class="blue">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-lg-offset-2">
                    <div class="info">
                        
                        <p class="records">
                        
                        Werkplaats:
                        <?php
                            echo $dataProvider->get( 'jobExperiences', [1] )[1]->getLocation();
                        ?> 
                        </p>   
                        
                        <p class="records">
                        
                        Beschrijving:
                        <?php
                            echo $dataProvider->get( 'jobExperiences', [1] )[1]->getDescription();
                        ?> 
                        </p> 
                        
                        <p class="records">
                        
                        Begonnen op:
                            <?php
                            echo $dataProvider->get( 'jobExperiences', [1] )[1]->getStartedAt()->format( 'd-m-Y' );
                        ?> 
                        </p>
                        
                        <p class="records">
                        
                            Beëindigd op:
                            <?php
                            echo $dataProvider->get( 'jobExperiences', [1] )[1]->getEndedAt()->format( 'd-m-Y' );
                        ?> 
                        </p> 
                        
                        <p class="records" >
                      
                            Stage:
                            <?php
                            if($dataProvider->get( 'jobExperiences', [1] )[1]->getIsInternship()== true){
                                
                                echo'Ja';
                            }else{
                                echo'Nee';
                            }
                        ?> 
            
                       
            
                    </div>
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
                     <i class="fa fa-bar-chart fa-2x" aria-hidden="true"></i>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-lg-offset-3">
                    <div class="info">
                        
                        <h2>Project:</h2>
                        
                        <p class="records" style="font-size:40pt">
                            <?php
                      //  echo $dataProvider->get( 'portfolios')->getGrade();
                            //dump($dataProvider)
                        ?>
                        </p>    
            
                        
                    </div>
                </div>
                <div class="col-lg-4">
                    <h2>Portfolio:</h2>
                      <p class="records" style="font-size:40pt">
                        <?php
                       // echo $dataProvider->get( 'portfolios')->getGrade();
                        ?>
                      </p>
                    
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
                      <i class="fa fa-file-o fa-3x" aria-hidden="true"></i>
                    <hr class="blue">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-lg-offset-2">
                    <div class="info">
                        
                        <p class="records">
                            Naam: Marco Brink
                        </p>    
            
            
                    </div>
                </div>
                <div class="col-lg-4">
                    
                   
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
                    <i class="fa fa-comment-o fa-2x" aria-hidden="true"></i>
                    
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
                    <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
                    <form name="sentMessage" id="contactForm" action="marco_brink" method="post" >
                        <div class="row control-group" style="border:2px solid;border-radius:4px ">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Name" id="name" required data-validation-required-message="Please enter your name." style="color:white;">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group" style="border:2px solid;border-radius:4px ">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Message</label>
                                <textarea rows="5" name="message" class="form-control" placeholder="Message" id="message" required data-validation-required-message="Please enter a message." style="color:white;"></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <br>
                        <div id="success"></div>
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <input type="submit" name="submit" class="btn btn-success btn-lg">
                            </div>
                        </div>
                        <?php
                    if(htmlentities(isset($_POST['submit'])))
                        {
                    
                        if(htmlentities(empty($_POST['name']) || empty($_POST['message'])))
                            {
                                    echo "<p>You must enter everything!</p>"; 
                                    
                            }else{
                            $conn= mysqli_connect('85.144.187.81','inf1b','peer');
                            if($conn == FALSE)
                            {
                
                                echo "<p>unable to connect</p>".
                                "<p>Error code " . mysqli_errno() . ": "  . mysqli_error() . "</p>";
                    
                            }else{
                            $DBName='DigitalPortfolio';
                            if(!mysqli_select_db($conn, $DBName))
                            {
                                $SQLstring = "CREATE DATABASE $DBName";  
                                $SQLquery  = mysqli_query($conn, $SQLstring); 
                                if ($SQLquery === FALSE){
                              
                                echo "<p>Unable to execute the query.</p>" . "<p>Error code "  . 
                                      mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>";
                                }
                                else{
                            
                                   echo "<p>Your messge has been placed!</p>"; 
                                }
                    
                          }
                          mysqli_select_db($conn, $DBName);
                          
                          $TableName='GuestBookMessage';
                          $SQLstring= "SHOW TABLES LIKE '$TableName'";
                          $QueryResult= mysqli_query($conn, $SQLstring);
                          
                          if(mysqli_num_rows($QueryResult) == 0)
                          {
                              $SQLstring= "CREATE TABLE $TableName(Bugnr SMALLINT NOT NULL AUTO_INCREMENT PRIMARY KEY, product_name VARCHAR(40), version VARCHAR(20),type VARCHAR(40), OS VARCHAR(20), 
                                           frequency INT, solutions TEXT(500))";
                              $QueryResult = mysqli_query($conn,$SQLstring);
                             if($QueryResult === FALSE)
                             { echo "<p>Unable to create the table.</p>" . "<p>Error code "  . 
                              mysqli_errno($conn) . ": " . mysqli_error($conn) . "</p>"; 
                             
                             }
                              
                        }
                          $Name = stripslashes(htmlentities($_POST['name']));
                          $Message = stripslashes(htmlentities($_POST['message']));
                          $userId = "";
                          $studentln = $dataProvider->get( 'student' );
                          $sendAt=date("Y-m-d H:i:s");
                          $accepted='0';
                         
                           $userId = $dataProvider->call( 'student', 'getId' );
                            
                            
                           
                       
                          
                          $string = "INSERT INTO GuestBookMessage(sender, title, message, sendAt, studentId, accepted) VALUES('$Name','', '$Message','$sendAt','$userId','$accepted')"; 
                          $Result = mysqli_query($conn, $string);
                          if($Result === FALSE) 
                         { echo "<p>Unable to execute the query.</p>" . "<p>Error code " . mysqli_errno($conn) . 
                                ": " . mysqli_error($conn) . "</p>"; 
                         
                         } else { echo "<h1>Bedankt voor uw bericht!</h1>";
                                      
                         }
                         
                        mysqli_close($conn);
                          
                    }
                    
                }
                }
                ?>
                        
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
