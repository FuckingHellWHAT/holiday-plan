<!DOCTYPE html>
<html lang="de-DE">

<head>
  <title>Urlaubsantrag</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/assets/stylesheet/custom.css" media="screen">
  </link>
  <link rel="stylesheet" href="/assets/stylesheet/print.css" media="print">
  </link>
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
</head>

<body>
  <div class="menu">

  </div>
  <h1>Urlaubsantrag</h1>

  <form method="POST">
    <div class="container">
      <label for="name">Name: </label>
      <input type="text" class="form-control" id="name" name="name" placeholder="_________________________________________"><br><br>

      <div class="container">
        <div class="row">
          <div class="col">
            <label for="when" class="form-label">Urlaub vom: </label>
            <div class="col-5">
              <div class="input-group date" id="datepicker">
                <input type="text" class="form-control" id="when" name="when">
                <span class="input-group-append">
                  <span class="input-group-text-bg-light-d-block">
                    <i class="fa-fa-calendar"></i>
                  </span>
                </span>
              </div>
            </div>
            <label for="till" class="form-label">Bis: </label>
            <div class="col-5">
              <div class="input-group date" id="datepicker2">
                <input type="text" class="form-control" id="till" name="till">
                <span class="input-group-append">
                  <span class="input-group-text-bg-light-d-block">
                    <i class="fa-fa-calendar"></i>
                  </span>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <fieldset class="row mb-3">
        <legend class="col-form-label col-md-2 pt-0">Urlaubsart: </legend>
        <div class="col-sm-10">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="paid[]" id="paid" value="true">
            <label class="form-check-label" for="paid">
              bezahlter Urlaub
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="paid[]" id="unpaid" value="true">
            <label class="form-check-label" for="unpaid">
              unbezahlter Urlaub
            </label>
          </div>
        </div>
      </fieldset>

      <div class="row g-3">
        <div class="col-sm-7">
          <label for="last">Resturlaub Vorjahr: </label>
        </div>
        <div class="col-sm">
          <input type="number" class="form-control" id="last" name="last">
        </div>
        <div class="col-sm">
          <label for="last"> Tage</label><br><br><br>
        </div>
      </div>

      <div class="row g-3">
        <div class="col-sm-7">
          <label for="current">Urlaubsanspruch aktuell: </label>
        </div>
        <div class="col-sm">
          <input type="number" class="form-control" id="current" name="current">
        </div>
        <div class="col-sm">
          <label for="current"> Tage</label><br><br>
        </div>
      </div>

      <div class="row g-3">
        <div class="col-sm-7">
          <label for="taken">davon bereits genommen: </label>
        </div>
        <div class="col-sm">
          <input type="number" class="form-control" id="taken" name="taken">
        </div>
        <div class="col-sm">
          <label for="taken"> Tage</label><br><br>
        </div>
      </div>

      <div class="row g-3">
        <div class="col-sm-7">
          <label for="new">neu beantragter Urlaub: </label>
        </div>
        <div class="col-sm">
          <input type="number" class="form-control" id="new" name="new">
        </div>
        <div class="col-sm">
          <label for="new"> Tage</label><br><br>
        </div>
      </div>

      <div class="row g-3">
        <div class="col-sm-7">
          <label for="remaining">verbleibender Resturlaub: </label>
        </div>
        <div class="col-sm">
          <input type="number" class="form-control" id="remaining" name="remaining">
        </div>
        <div class="col-sm">
          <label for="remaining"> Tage</label><br><br>
        </div>
      </div>

      <fieldset>
        <div class="row">
          <label for="signature">Mit meiner Unterschrift bestätige ich die Korrektheit der gemachten Angaben:</label><br><br><br><br>
          <input type="text" class="form-control" id="signature" name="signature" placeholder="__________________________________________">
          <div class="cal-6">
            Datum, Unterschrift Mitarbeiter
          </div>
        </div>
      </fieldset>

      <div class="display">
        <div class="container text-center">
          <div class="row">
            <div class="col">
              <hr>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <i>wird vom Vorgesetzen ausgefüllt</i><br><br><br>
            </div>
          </div>
        </div>
        <div class="container-hidden"></div>
        <fieldset class="answer">
          <fieldset class="row mb-3">
            <legend class="col-form-label col-md-2 pt-0">
              Der Urlaubsantrag wird:
            </legend>
            <div class="col-sm-10">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="accepted" id="accepted" value="true">
                <label class="form-check-label" for="accepted">
                  genehmigt
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="refused" id="refused" value="true">
                <label class="form-check-label" for="refused">
                  abgelehnt
                </label>
              </div>
            </div><br><br><br>
          </fieldset>
          <fieldset>
            <label for="reason" class="reason">Grund der Ablehnung: </label>
            <input type="text" class="form-control" id="reason" name="reason" placeholder="___________________________________________________"><br><br><br>
          </fieldset>
          <fieldset>
            <div class="row">
              <input type="text" class="form-control" id="secondSignature" name="secondSignature" placeholder="_________________________________________">
              <div class="cal-6">
                Datum, Unterschrift Vorgesetzter
              </div>
            </div>
      </div>
      <input type="submit" value="Submit" id="submit">
      </fieldset>
      </fieldset>

    </div>
  </form>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
  <script src="assets/Javascript/custom.js"></script>
</body>

</html>
<?php
error_reporting(E_ERROR | E_PARSE);

include($_SERVER['DOCUMENT_ROOT'] . '/custom.php');

(new Form)->sendForm();

?>