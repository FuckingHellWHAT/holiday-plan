<?php
include($_SERVER['DOCUMENT_ROOT'] . '/custom.php');
$person = (new Form)->detailView($_GET['person'] ?? 0);
?>


<!DOCTYPE html>
<html lang="de-DE">

<head>
  <title>Urlaubsantrag::Detail</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/assets/stylesheet/detail.css" media="screen">
  </link>
  <link rel="stylesheet" href="/assets/stylesheet/print-detail.css" media="print">
  </link>
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
</head>

<body>
  <h1><b>Urlaubsantrag von <?= $person["name"] ?> </b></h1>

  <div class="detail">
    <table>
      <thead>
        <tr>
          <th>ID</th>
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
        </tr>
      </thead>
      <tbody>
        <tr>
          <td> <?= $person["person_id"] ?></td>
          <td> <?= $person["name"] ?> </td>
          <td> <?= $person["wann"] ?></td>
          <td> <?= $person["till"] ?> </td>
          <td> <?= $person["paid"] . $person["unpaid"] ?> </td>
          <td> <?= $person["last"] ?> </td>
          <td> <?= $person["current"] ?> </td>
          <td> <?= $person["taken"] ?> </td>
          <td> <?= $person["new"] ?> </td>
          <td> <?= $person["remaining"] ?> </td>
          <td> <?= $person["signature"] ?></td>
        </tr>
      </tbody>
    </table>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
  <script src="assets/Javascript/custom.js"></script>
</body>

</html>