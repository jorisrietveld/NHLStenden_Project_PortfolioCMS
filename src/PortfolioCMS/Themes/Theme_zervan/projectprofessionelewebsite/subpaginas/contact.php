
<?php
$errors = '';

if(empty($_POST["naam"])  || 
   empty($_POST["email"]) || 
   empty($_POST["opmerking"]))
{
    $errors .= "\n Error: de velden naam,email en opmerking zijn verplicht";
}


$naam = $_POST["naam"];
$email = $_POST["email"];
$onderwerp = $_POST["onderwerp"];
$keuze = $_POST["keuze"];
$opmerking = $_POST["opmerking"];
$geslacht = $_POST["geslacht"];


if (!preg_match(
"/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", 
$email))
{
    $errors .= "\n Ongeldig mail adres.";
}

$contact = fopen("contact.txt", "a+") or die("Kan bestand niet openen!");
$txt = "naam is: $naam  \n";
fwrite($contact, $txt);
$txt = "email is: $email \n";
fwrite($contact, $txt);
$txt = "onderwerp is $onderwerp \n";
fwrite($contact, $txt);
$txt = "Probleem of vraag? $keuze \n";
fwrite($contact, $txt);
$txt = "opmerking: $opmerking \n";
fwrite($contact, $txt);
$txt = "Man of vrouw? $geslacht \n";
fwrite($contact, $txt);
$txt = "****EINDE BERICHT**** \n";
fwrite($contact, $txt);
fclose($contact);

header("Location: gelukt.html");

?>

<!DOCTYPE HTML> 
<html>
<head>
	<title>Contact form verwerker</title>
</head>

<body>

<?php
echo nl2br($errors);
?>


</body>
</html>