<?php
//output on page

// $name = $_POST["name"];
// $when = $_POST["when"];
// $till = $_POST["till"];
// $paid = $_POST["paid"] ?? "";
// $unpaid = $_POST["unpaid"] ?? "";
// $last = $_POST["last"];
// $current = $_POST["current"];
// $taken = $_POST["taken"];
// $new = $_POST["new"];
// $remaining = $_POST["remaining"];
// $signature = $_POST["signature"];
// $accepted = $_POST["accepted"] ?? "";
// $refused = $_POST["refused"] ?? "";
// $reason = $_POST["reason"];
// $secondSignature = $_POST["secondSignature"];

foreach($_POST as $key => $value) {
  if(is_int($value)) {
    $$key = $value ?? 0 ; 
  }elseif(is_string($value)) {
    $$key = "'" .($value ?? ''). "'" ; 
  }

}

//email
$to      = 'nobody@example.com';
$subject = 'Urlaubsantrag'; 
$message = "Urlaubsantrag!
Name:        $name 
Urlaub vom:  $when   bis:  $till 
Urlaubsart: 
            ".($paid ?? '')." ".($unpaid ?? '')."
Resturlaub Vorjahr:        $last   Tage

Urlaubsanspruch aktuell:   $current   Tage
davon bereits genommen:    $taken   Tage
neu beantragter Urlaub:    $new   Tage 
verbleibender Resturlaub:  $remaining   Tage
Mit meiner Unterschrift bestaetige ich die Korrektheit der gemachten Angaben

 $signature 
Datum, Unterschrift Mitarbeiter

        - - - - - - - - -
wird vom Vorgesetzten ausgefuellt

Der Urlaubsantrag wird: 
                       ".($accepted ?? '')."  ".($refused ?? '')." 
Grund der Ablehnung:   $reason 

 $secondSignature 
Datum, Unterschrift Vorgesetzer";

$headers = array('From'=>'webmaster@example.com', 
'Reply-To'=>'webmaster@example.com', 
'X-Mailer'=>'PHP/' . phpversion(),
"MIME-Version" => "1.0", 
"Content-Type" => "text/html; charset=iso-8859-1");

if (isset($name) || $name === '' ) {
  echo "Bitte Informationen eingeben!!!!";
} else {
  var_dump($_POST);
  mail($to, $subject, $message, $headers);
}

$servername = "db";
$username = "db";
$password = "db";
$dbname = "db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit();
}

if (($paid ?? '') !== '' && ($unpaid ?? '') === ''){
  $paid === true;
  ($unpaid ?? '') === false;
} elseif (($paid ?? '') === '' && ($unpaid ?? '') !== ''){
  $unpaid === true;
  ($paid ?? '') === false;
} elseif (($paid ?? '') !== '' && ($unpaid ?? '') !== ''){
  echo 'Bitte nur bezahlt ODER unbezahlt eingeben! ';
} else {
  echo 'Bitte alle informationen angeben!';
}

if (($accepted ?? '') !== '' && ($refused ?? '') === ''){
  $accepted === true;
  ($refused ?? '') === false;
} elseif (($accepted ?? '') === '' && ($refused ?? '') !== ''){
  $refused === true;
  ($accepted ?? '') === false;
} elseif (($accepted ?? '') !== '' && ($refused ?? '') !== ''){
  echo 'Bitte nur genehmigt ODER abgelehnt eingeben! ';
} else {
  echo 'Bitte alle informationen angeben! ';
}

if (empty($_POST["name"])) {
  $sql = "INSERT INTO `holiday` (`name`, `wann`, `till`, `paid`, `unpaid`, `last`, `current`, `taken`, `new`, `remaining`, `signature`, `accepted`, `refused`, `reason`, `secondSignature`)
          VALUES                ($name, $when,  $till,  ".($paid ?? 0).",  ".($unpaid ?? 0).",  $last,  $current,  $taken,  $new,  $remaining,  $signature,  ".($accepted ?? 0).", ".($refused ?? 0).",  $reason,  $secondSignature)";

  $result = $conn->query($sql);

  if ($result !== FALSE){
    echo "Daten wurden erfolgreich geupdated";
  }
}

$conn -> close();

?>