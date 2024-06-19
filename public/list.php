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
                         tr:hover {background-color: teal;} </style> </head>
          <body>
          <table> <tbody>
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
          </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr> 
              <td>" . $row["name"] . "  </td>
              <td>  " . $row["wann"] . "</td>
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
    }
    echo "</tbody> </table></body>";
} else {
    echo "0 results";
}

$conn->close();
