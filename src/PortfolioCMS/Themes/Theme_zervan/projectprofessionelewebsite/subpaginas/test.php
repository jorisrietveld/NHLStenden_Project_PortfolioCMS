<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <title>addContact.html</title>
 <link rel = "stylesheet"
  type = "text/css"
  href = "contact.css" />
</head>
<body>
 <?php
 //read data from form
 $lName = filter_input(INPUT_POST, "lName");
 $fName = filter_input(INPUT_POST, "fName");
 $email = filter_input(INPUT_POST, "email");
 $phone = filter_input(INPUT_POST, "phone");
 //print form results to user
 print <<< HERE
 <h1>Thanks!</h1>
 <p>
  Your spam will be arriving shortly.
 </p>
 <p>
 first name: $fName <br />
 last name: $lName <br />
 email: $email <br />
 phone: $phone
 </p>
HERE;
 //generate output for text file
 $output = <<< HERE
first: $fName
last: $lName
email: $email
phone: $phone
HERE;
 //open file for output
 $fp = fopen("contacts.txt", "a");
 //write to the file
 fwrite($fp, $output);
 fclose($fp);
 ?>
</body>
</html>