<?php

class Form
{

  public function sendForm()
  {
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

    foreach ($_POST as $key => $value) {
      if (is_int($value)) {
        $$key = $value ?? 0;
      } elseif (is_string($value)) {
        $$key = $value ?? '';
      }
    }



    //email
    $to      = 'nobody@example.com';
    $subject = 'Urlaubsantrag';

    $message = <<<TEXT
<head> 
<style>
body {
  background: #FFF;

  color: #000;

  font-family: Arial, Helvetica, sans-serif;

  margin-right: 10px;

  margin-left: 40px;
  }

pre {
    font-family: Arial, Helvetica, sans-serif;

    line-height: 1.2;
  }

i {
  font-size: 12px;
  }
</style>
</head>
<body>
<header>
    <center><h1>Urlaubsantrag</h1></center>
</header>
<pre>Name:       $name </pre> <br>
<pre>Urlaub vom: $when bis: $till </pre> <br>
<p> Urlaubsart: </p>
<pre>
               bezahlter Urlaub?   $paid
               unbezahlter Urlaub? $unpaid
</pre> <br>
<pre>
Resturalaub Vorjahr:      $last Tage

Urlaubsanspruch aktuell:  $current Tage
davon bereits genommen:   $taken Tage
neu beantragter Urlaub:   $new Tage
verbleibender Resturlaub: $remaining Tage
</pre> <br>
<p> Mit meiner Unterschrift bestaetige ich die Korrektheit der gemachten Angaben: </p> <br> <br>
<pre> 
$signature
Datum, Unterschrift Mitarbeiter
</pre> <br>
<hr>
<center><i>wird vom Vorgesetzten ausgefuellt</i></center>
<br>
<p> Der Urlaubsantrag wird: </p>
<pre>
                    genehmigt? 
                    abgelehnt? 
</pre> <br>
<p>Grund der Ablehnung: __________________________________________________ </p> <br>
<pre> 
________________________________________
Datum, Unterschrift Vorgesetzter
</pre> <br>
</body>
TEXT;

    $headers = array(
      'From' => 'webmaster@example.com',
      'Reply-To' => 'webmaster@example.com',
      'X-Mailer' => 'PHP/' . phpversion(),
      "MIME-Version" => "1.0",
      "Content-Type" => "text/html; charset=iso-8859-1"
    );

    if (isset($name) && $name !== '') {
      echo "<span class='php'>Email wurde gesendet. </span>";
      mail($to, $subject, $message, $headers);
    } else {
      echo "<span class='php'>Bitte Informationen eingeben!!!! </span>";
    }

    if (($paid ?? '') !== '' && ($unpaid ?? '') === '') {
      echo '';
    } elseif (($paid ?? '') === '' && ($unpaid ?? '') !== '') {
      echo '';
    } elseif (($paid ?? '') !== '' && ($unpaid ?? '') !== '') {
      echo "Bitte nur bezahlt ODER unbezahlt eingeben! ";
    } elseif (($paid ?? '') === '' && ($unpaid ?? '') === '') {
      echo "<span class='php'> Bezahlt oder Unbezahlt bitte nicht vergessen! </span>";
    }

    $this->connectDatabase($_POST);
  }
  private function connectDatabase($post)
  {
    foreach ($post as $key => $value) {
      if (is_int($value)) {
        $$key = $value ?? 0;
      } elseif (is_string($value)) {
        $$key = "'" . ($value ?? '') . "'";
      }
    }

    $servername = "db";
    $username = "db";
    $password = "db";
    $dbname = "db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_errno) {
      echo "<span class='php'>Failed to connect to MySQL: </span>" . $conn->connect_error;
      exit();
    }

    if (isset($name) && $name !== '') {
      $sql = "INSERT INTO `holiday` (`name`, `wann`, `till`, `paid`, `unpaid`, `last`, `current`, `taken`, `new`, `remaining`, `signature`)
      VALUES ($name, $when,  $till,  " . ($paid ?? 0) . ",  " . ($unpaid ?? 0) . ",  $last,  $current,  $taken,  $new,  $remaining,  $signature)";

      $result = $conn->query($sql);

      if ($result !== FALSE) {
        echo "<span class='php'> Daten wurden erfolgreich geupdated</span>";
      }

      $conn->close();
    } else {
      echo "<span class='php'>Insert wurde unterbrochen</span>";
    }
  }

  public function detailView($id)
  {

    $servername = "db";
    $username = "db";
    $password = "db";
    $dbname = "db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_errno) {
      echo "<span class='php'>Failed to connect to MySQL: </span>" . $conn->connect_error;
      exit();
    }

    foreach ($_GET as $key => $value) {
      if (is_int($value)) {
        $$key = $value ?? 0;
      } elseif (is_string($value)) {
        $$key = "'" . ($value ?? '') . "'";
      }
    }

    $sql = "SELECT * FROM holiday WHERE person_id=$person";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $arrayResult[] = $row;
      }
    } else {
      echo "0 results";
    }

    $conn->close();
    return $arrayResult[0];
  }

  // - could go with SELECT name FROM holiday?? What am I doing?? I'm trying to somehow access $row in list.php with a function and I'm dying inside lol
  public function versuchListe($valu)
  {

    foreach ($_GET as $key => $value) {
      if (is_int($value)) {
        $$key = $value ?? 0;
      } elseif (is_string($value)) {
        $$key = "'" . ($value ?? '') . "'";
      }
    }

    $servername = "db";
    $username = "db";
    $password = "db";
    $dbname = "db";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_errno) {
        echo "<span class='php'>Failed to connect to MySQL: </span>" . $conn->connect_error;
        exit();
    }
    
    $sql = "SELECT * FROM holiday";
    
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
      }
    } else {
      echo "0 results";
    }

    $conn->close();
  }
}
