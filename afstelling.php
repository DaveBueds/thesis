<?php
/**
* Author:    David Bueds
* Created:   2017-2018
* Subject:   Masterproef 
**/
require_once('errormessages.php');
include 'database.php';
$pdo = Database::connect();
$flag = isset($_GET['flag'])?intval($_GET['flag']):0;
$message = '';
if($flag ) {
  $message = $messages[$flag];
}
if (isset($_GET['voorspeltijdbtn']) && ($flag != 3))  {
  $weer = $_GET['voorspelweer'];
  $banden = $_GET['voorspelbanden'];
  $typeEvent = $_GET['voorspeltypeevent'];
  $toespoor = $_GET['voorspeltoespoor'];
  $camber = $_GET['voorspelcamber'];
  $bandendruk = $_GET['voorspelbandendruk'];
  $hoogte = $_GET['voorspelhoogte'];
}
else {
  $weer = "";
  $banden = "";
  $typeEvent = "";
  $toespoor = "";
  $camber = "";
  $bandendruk = "";
  $hoogte = "";
}
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <?php include('head.php'); ?>
  </head>
  <body>
    <div class="grid-container">
      <?php include('navbar.php'); ?>
      <div class="grid-y medium-grid-frame">
        <div class="cell shrink header medium-cell-block-container">
          <br>
          <div class="clearfix">
            <div class="button-group float-right">
            </div>
          </div>
          <?php if($flag == 1 || $flag == 3 || $flag == 4 || $flag == 5  || $flag == 6 || $flag == 7) { ?>
          <div class="callout alert small" data-closable="" data-alert>
            <h5>
              <?php echo $message; ?>
            </h5>
            <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
              <span aria-hidden="true">&times;
              </span>
            </button>
          </div>
          <?php } elseif($flag && $flag != 1){ ?>
          <div class="callout success small" data-closable="" data-alert>
            <h5>
              <?php echo $message; ?>
            </h5>
            <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
              <span aria-hidden="true">&times;
              </span>
            </button>
          </div>
          <?php } ?>
        </div>
        <div class="cell medium-auto medium-cell-block-container">
          <div class="grid-x grid-padding-x">
            <div class="cell medium-3 medium-cell-block-y">
            </div>
            <div class="cell medium-6 medium-cell-block-y">
              <div>
                <h2>Afstellingpredicter
                </h2>
              </div>
              <h4>Verbeterde afstelling: 
                <span class="success label">
                  <?php 
                  //Oproepen python script
                  $weer = escapeshellarg($weer);
                  $banden = escapeshellarg($banden);
                  $typeEvent = escapeshellarg($typeEvent);
                  if(isset($_GET['voorspeltijdbtn']) && $toespoor == "") {
                    $toespoor = 0;
                  }
                  if(isset($_GET['voorspeltijdbtn']) && $camber == "") {
                    $camber = 0;
                  }
                  if(isset($_GET['voorspeltijdbtn']) && $bandendruk == "") {
                    $bandendruk = 0;
                  }
                  if(isset($_GET['voorspeltijdbtn']) && $hoogte == "") {
                    $hoogte = 0;
                  }
                  $toespoor = escapeshellarg($toespoor);
                  $camber = escapeshellarg($camber);
                  $bandendruk = escapeshellarg($bandendruk);
                  $hoogte = escapeshellarg($hoogte);
                  $command = escapeshellcmd("/usr/local/bin/python3 /Applications/MAMP/htdocs/thesis/scripts/afstelling.py $weer $banden $typeEvent $toespoor $camber $bandendruk $hoogte");
                  $output = shell_exec($command);
                  $outputpieces = explode(" ", $output);
                  echo @$outputpieces[0];
                  echo @$outputpieces[1];
                  ?>
                </span>
              </h4>
              <p class="help-text" id="exampleHelpText">Velden met een (*) zijn verplicht in te vullen!
              </p>
              <hr>
              <form id="voorspelform" action="" method="GET">
                <div class="grid-x grid-margin-x">
                  <div class="cell medium-2">
                    <label for="main" class="text-left middle">
                      <span data-tooltip class="top" title="De weersomstandigheden waarop je voorspelling wil baseren">Weer*:
                      </span>
                    </label>
                  </div>
                  <div class="cell medium-4">
                    <select type="text" id="main" name="voorspelweer">
                      <option disabled selected value> -selecteer een optie- 
                      </option>
                      <?php 
                      $sql = 'SELECT DISTINCT main FROM WeerData';
                      foreach ($pdo->query($sql) as $row) {
                        echo '<option value="'.$row['main'].'">'. $row['main'] . '</option>';
                      }
                      ?>
                    </select>
                    <script type="text/javascript">
                      document.getElementById('main').value = "<?php echo $_GET['voorspelweer'];?>";
                    </script>
                  </div>
                  <div class="cell medium-2">
                    <label for="banden" class="text-left middle">
                      <span data-tooltip class="top" title="De bandensoort waarop je voorspelling wil baseren">Banden*:
                      </span>
                    </label>
                  </div>
                  <div class="cell medium-4">
                    <select type="text" id="banden" name="voorspelbanden">
                      <option disabled selected value> -selecteer een optie- 
                      </option>
                      <?php 
                      $sql = 'SELECT DISTINCT banden FROM MechanicalData';
                      foreach ($pdo->query($sql) as $row) {
                        echo '<option value="'.$row['banden'].'">'. $row['banden'] . '</option>';
                      }
                      ?>
                    </select>
                    <script type="text/javascript">
                      document.getElementById('banden').value = "<?php echo $_GET['voorspelbanden'];?>";
                    </script>
                  </div>
                </div>
                <div class="grid-x grid-margin-x">
                  <div class="cell medium-2">
                    <label for="typeEvent" class="text-left middle">
                      <span data-tooltip class="top" title="Het type event waarop je voorspelling wil baseren">Type event*:
                      </span>
                    </label>
                  </div>
                  <div class="cell medium-4">
                    <select type="text" id="typeEvent" name="voorspeltypeevent">
                      <option disabled selected value> -selecteer een optie- 
                      </option>
                      <?php 
                      $sql = 'SELECT DISTINCT typeEvent FROM CircuitData';
                      foreach ($pdo->query($sql) as $row) {
                        echo '<option value="'.$row['typeEvent'].'">'. $row['typeEvent'] . '</option>';
                      }
                      ?>
                    </select>
                    <script type="text/javascript">
                      document.getElementById('typeEvent').value = "<?php echo $_GET['voorspeltypeevent'];?>";
                    </script>
                  </div>
                  <div class="cell medium-2">
                    <label for="toespoor" class="text-left middle">
                      <span data-tooltip class="top" title="De hoeveelheid toespoor die je wil voorspellen">Toe:
                      </span>
                    </label>
                  </div>
                  <div class="cell medium-4">
                    <input type="number" placeholder="1000" step="1" min="995" max="1005" id="toespoor" name="voorspeltoespoor" value="<?php echo $outputpieces[2]; ?>">
                  </div>
                </div>
                <div class="grid-x grid-margin-x">
                  <div class="cell medium-2">
                    <label for="camber" class="text-left middle">
                      <span data-tooltip class="top" title="De hoeveelheid camber die je wil voorspellen">Camber:
                      </span>
                    </label>
                  </div>
                  <div class="cell medium-4">
                    <input type="number" placeholder="-0.5" step="0.1" min="-1.0" max="0" id="camber" name="voorspelcamber" value="<?php echo $outputpieces[3]; ?>">
                  </div>
                  <div class="cell medium-2">
                    <label for="bandendruk" class="text-left middle">
                      <span data-tooltip class="top" title="De hoeveelheid bandendruk die je wil voorspellen">Bandendruk:
                      </span>
                    </label>
                  </div>
                  <div class="cell medium-4">
                    <input type="number" placeholder="0.7" step="0.1" min="0.6" max="0.8" id="bandendruk" name="voorspelbandendruk" value="<?php echo $outputpieces[4]; ?>">
                  </div>
                </div>
                <div class="grid-x grid-margin-x">
                  <div class="cell medium-2">
                    <label for="hoogte" class="text-left middle">
                      <span data-tooltip class="top" title="De hoeveelheid hoogte die je wil voorspellen">Hoogte:
                      </span>
                    </label>
                  </div>
                  <div class="cell medium-4">
                    <input type="number" placeholder="30" step="1" min="20" max="40" id="hoogte" name="voorspelhoogte" 
                           value="<?php echo $outputpieces[5]; ?>">
                  </div>
                </div>
                <div class="grid-x grid-margin-x">
                  <div class="cell medium-12">
                    <input id="flag" type="hidden" name="flag" value="<?php echo $flag; ?>">
                    <input id="voorspelbtn" type="submit" class="button expanded" name="voorspeltijdbtn" value="Verbeter afstelling">
                  </div>
                </div>
              </form>
            </div>
            <div class="cell medium-3 medium-cell-block-y" >
            </div>
          </div>
        </div>
        <?php include('footer.php'); ?>
      </div>
    </div>
    <?php include('scripts.php'); ?>
    <script type="text/javascript">
      $(document).ready(function() {
        $('.callout').closest('[data-alert]').delay(10000).fadeOut(1000);
        $("#voorspelbtn").click(function(){
          $weer = $('#main').val();
          $banden = $('#banden').val();
          $typeEvent = $('#typeEvent').val();
          $toespoor = $('#toespoor').val();
          $camber = $('#camber').val();
          $bandendruk = $('#bandendruk').val();
          $hoogte = $('#hoogte').val();
          //Indien variabelen ingevuld
          if($weer && $banden && $typeEvent ) {
            $vlag = 9;
            $("#flag").val($vlag);
            $("#voorspelform").submit();
          }
          else {
            $vlag = 3;
            $("#flag").val($vlag);
            window.location.href = window.location.pathname + "?flag=" + $vlag ;
          }
        });
      });
    </script>
  </body>
</html>
<?php
Database::disconnect();
?>
