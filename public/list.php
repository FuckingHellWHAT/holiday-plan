<?php

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
    echo "<head> <style> table, th, td { border: 1px solid black; } 
                         body {font-family: Arial, Helvetica, sans-serif; } 
                         #holiday { border-collapse: collapse; width: 100%; }
                         #holiday tr:hover { background-color: #ddd; }
                         #holiday td:nth-child(even) { background-color: #f2f2f2; }
                         #holiday td, #holiday th { border: 1px solid #ddd; padding: 8px; }
                         #holiday th { padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: rgb(111, 0, 255); color: white; }
          </style> </head>
          <body>
          <table id='holiday'> <thead>
          <tr>
          <th>NAME</th>
          <th>URLAUB VOM</th>
          <th>BIS</th>
          <th>URLAUBSART</th>
          <th>RESTURLAUB VORJAHR</th>
          <th>URLAUBSANSPRUCH AKTUELL</th>
          <th>DAVON BEREITS GENOMMEN</th>
          <th>NEU BEANTRAGTER URLAUB</th>
          <th>VERBLEIBENDER RESTURLAUB</th>
          <th>UNTERSCHRIFT</th>
          <th> </th>
          </tr> </thead>";
    while ($row = $result->fetch_assoc()) {
        echo "<tbody> <tr> 
              <td>" . $row["name"] . "  </td>
              <td>" . $row["wann"] . "</td>
              <td>" . $row["till"] . "</td>
              <td>" . $row["paid"] . $row["unpaid"] . "</td>
              <td>" . $row["last"] . "</td>
              <td>" . $row["current"] . "</td>
              <td>" . $row["taken"] . "</td>
              <td>" . $row["new"] . "</td>
              <td>" . $row["remaining"] . "</td>
              <td>" . $row["signature"] . "</td>
               <td><a href='detail.php?person=" . $row["person_id"] . "'>Detail</a></td>
              </tr>";
              var_dump($row); //idk maybe I could use this to call upon an array name in the row array?? then put it in the $_GET?? I dont know
    }
    echo "</tbody> </table> </body>";
} else {
    echo "0 results";
}

$conn->close();

//<?php include($_SERVER['DOCUMENT_ROOT'] . '/custom.php'); $?? = (new Form)->versuchListe(??);?

?>



<!DOCTYPE html>
<html lang="de-DE">

<head>
  <title>Urlaubsanträge:Liste</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
</head>

<body>
  <h1><b>URLAUBSANTRÄGE</b></h1>
  <table>
      <thead>
        <tr>
          <th>NAME</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td> <?= $row["name"] ?> </td>
          <td ><a href='detail.php?person=<?=" . $row[person_id] . "?>'>Detail</a></td>
        </tr>
      </tbody>
    </table>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
  <script src="assets/Javascript/custom.js"></script>
</body>
</html>