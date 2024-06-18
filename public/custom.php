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
        $$key = "'" . ($value ?? '') . "'";
      }
    }

    $content = '';
    foreach ($_POST as $key => $value) {
      if (is_int($value)) {
        $content .= $key . ':' . (trim($value) ?? 0) . '<br>';
      } elseif (is_string($value)) {
        $content .= $key . ':' . ($value ?? '') . "<br>";
      }
    }

    //email
    $to      = 'nobody@example.com';
    $subject = 'Urlaubsantrag';

    $message = <<<TEXT
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
                    genehmigt? $accepted
                    abgelehnt? $refused
</pre> <br>
<p>Grund der Ablehnung: $reason </p> <br>
<pre> 
$secondSignature
Datum, Unterschrift Vorgesetzter
</pre> <br>
TEXT;

    $headers = array(
      'From' => 'webmaster@example.com',
      'Reply-To' => 'webmaster@example.com',
      'X-Mailer' => 'PHP/' . phpversion(),
      "MIME-Version" => "1.0",
      "Content-Type" => "text/html; charset=iso-8859-1"
    );

    if (isset($name)) {
      echo "<span class='php'>Bitte Informationen eingeben!!!!</span>";
    } else {
      echo "<span class='php'>Email wurde gesendet.</span>";
      mail($to, $subject, $message, $headers);
    }



    if (($paid ?? '') !== '' && ($unpaid ?? '') === '') {
      $unpaid = 'false';
    } elseif (($paid ?? '') === '' && ($unpaid ?? '') !== '') {
      $paid = 'false';
    } elseif (($paid ?? '') !== '' && ($unpaid ?? '') !== '') {
      echo "Bitte nur bezahlt ODER unbezahlt eingeben! ";
    } elseif (($accepted ?? '') !== '' && ($refused ?? '') === '') {
      $refused = 'false';
    } elseif (($accepted ?? '') === '' && ($refused ?? '') !== '') {
      $accepted = 'false';
    } elseif (($accepted ?? '') !== '' && ($refused ?? '') !== '') {
      echo "<span class='php'>Bitte nur genehmigt ODER abgelehnt eingeben! </span>";
    } else {
      echo "<span class='php'>Bitte alle informationen angeben! </span>";
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

    if (empty($name)) {
      echo "<span class='php'>Insert wurde unterbrochen</span>";
    } else {
      $sql = "INSERT INTO `holiday` (`name`, `wann`, `till`, `paid`, `unpaid`, `last`, `current`, `taken`, `new`, `remaining`, `signature`)
      VALUES ($name, $when,  $till,  " . ($paid ?? 0) . ",  " . ($unpaid ?? 0) . ",  $last,  $current,  $taken,  $new,  $remaining,  $signature";

      $result = $conn->query($sql);

      if ($result !== FALSE) {
        echo "<span class='php'>Daten wurden erfolgreich geupdated</span>";
      }
      $conn->close();
    }
  }
}
