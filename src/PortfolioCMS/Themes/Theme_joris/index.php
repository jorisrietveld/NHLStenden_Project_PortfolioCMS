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
<body id="body" class="container-fluid col-lg-12">


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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.terminal/0.11.11/js/jquery.terminal.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.terminal/0.11.11/css/jquery.terminal.min.css" rel="stylesheet"/>
    <script>

        jQuery(function($, undefined) {
            if( document.getElementById('#terminal') !== 'undifined' ) {
                $('#terminal').terminal(function (command, term) {

                    if( command == 'help' )
                    {
                        term.echo( '[----------------------------------------------------]\n' +
                            '[   HELP!   HELP!    HELP!   HELP!    HELP!   HELP!  ]\n' +
                            '[----------------------------------------------------]\n\n' +
                            'type: location home; voor de home pagina\n' +
                            'type: location locatie; voor de locatie pagina\n' +
                            'type: location weather; voor de weer pagina\n' +
                            'type: location interests; voor de hobbies pagina\n' +
                            'type: location contact; voor de contact pagina\n' );
                        return;
                    }

                    if ( command.substring(0,8) == 'location') {
                        var goto = command.substring(8, (command.length-1) );
                        window.location = goto;

                    } else {
                        term.echo('Dat begrijp ik niet');
                    }
                }, {
                    greetings: ''+
                    '██╗    ██╗███████╗██╗     ██╗  ██╗ ██████╗ ███╗   ███╗\n'+
                    '██║    ██║██╔════╝██║     ██║ ██╔╝██╔═══██╗████╗ ████║\n'+
                    '██║ █╗ ██║█████╗  ██║     █████╔╝ ██║   ██║██╔████╔██║\n'+
                    '██║███╗██║██╔══╝  ██║     ██╔═██╗ ██║   ██║██║╚██╔╝██║\n'+
                    '╚███╔███╔╝███████╗███████╗██║  ██╗╚██████╔╝██║ ╚═╝ ██║\n'+
                    ' ╚══╝╚══╝ ╚══════╝╚══════╝╚═╝  ╚═╝ ╚═════╝ ╚═╝     ╚═╝\n'+
                    '\n' +
                    '\n',
                    name: 'Welkom op dezuh site',
                    prompt: 'root@nsa.gov> '
                });
            }
        });
    </script>
</body>
</html>
