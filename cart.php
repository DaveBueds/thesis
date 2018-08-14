<?php

require_once('errormessages.php');
include 'database.php';
$pdo = Database::connect();

$flag = isset($_GET['flag'])?intval($_GET['flag']):0;
$message = '';
if($flag) {
    $message = $messages[$flag];
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
                      <h5><?php echo $message; ?></h5>
                      <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } elseif($flag && $flag != 1){ ?>
                <div class="callout success small" data-closable="" data-alert>
                  <h5><?php echo $message; ?></h5>
                  <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>

    </div>


    <div class="cell medium-auto medium-cell-block-container">
        <div class="">
            <h2>Regressie boom</h2>
            <br>
        </div>


        <div class="grid-x grid-padding-x">
            <div class="cell medium-6 medium-cell-block-y" style="border-right: 1px solid #cacaca;">
                <h4>Afstelling predicter</h4>
                <h5>Voorspelde tijd: 
                    <span class="success label">
                        <?php 
                        $command = escapeshellcmd('/Applications/MAMP/htdocs/thesis/scripts/app.py');
                        $output = shell_exec($command);
                        echo $output;
                        ?>
                    </span>
                </h5>

                <hr>

                <form action="/plot" method="post">
                    <div class="grid-x grid-margin-x">
                        <div class="cell small-2">
                            <label for="middle-label" class="text-left middle">Toe:</label>
                        </div>
                        <div class="cell small-4">
                            <input type="text" id="middle-label">
                        </div>

                        <div class="cell small-2">
                            <label for="middle-label" class="text-left middle">Camber:</label>
                        </div>
                        <div class="cell small-4">
                            <input type="text" id="middle-label">
                        </div>
                    </div>

                    <div class="grid-x grid-margin-x">
                        <div class="cell small-2">
                            <label for="middle-label" class="text-left middle">Banden:</label>
                        </div>
                        <div class="cell small-4">
                            <input type="text" id="middle-label">
                        </div>
                        <div class="cell small-2">
                            <label for="middle-label" class="text-left middle">Bandendruk:</label>
                        </div>
                        <div class="cell small-4">
                            <input type="text" id="middle-label">
                        </div>
                    </div>


                    <div class="grid-x grid-margin-x">
                        <div class="cell small-2">
                            <label for="middle-label" class="text-left middle">Hoogte:</label>
                        </div>
                        <div class="cell small-4">
                            <input type="text" id="middle-label">
                        </div>
                        <div class="cell small-2">
                            <label for="middle-label" class="text-left middle">Ondergrond:</label>
                        </div>
                        <div class="cell small-4">
                            <input type="text" id="middle-label">
                        </div>
                    </div>

                    <div class="grid-x grid-margin-x">
                        <div class="cell small-2">
                            <label for="middle-label" class="text-left middle">Type event:</label>
                        </div>
                        <div class="cell small-4">
                            <input type="text" id="middle-label">
                        </div>
                        <div class="cell small-2">
                            <label for="middle-label" class="text-left middle">Weer:</label>
                        </div>
                        <div class="cell small-4">
                            <input type="text" id="middle-label">
                        </div>
                    </div>
                    <div class="clearfix">
                        <div class="button-group">
                            <a id="btn_koppel" class="button">Voorspel tijd</a>
                        </div>
                    </div>

              </form>
          </div>


          <div class="cell medium-6 medium-cell-block-y">
            <h4>Ideale afstelling</h4>
            <h5>Voorspelde tijd: <span class="success label">2,03 s</span></h5>
            <hr>

            <form>
                    <div class="grid-x grid-margin-x">
                        <div class="cell small-2">
                            <label for="middle-label" class="text-left middle">Toe:</label>
                        </div>
                        <div class="cell small-4">
                            <input type="text" id="middle-label" readonly>
                        </div>

                        <div class="cell small-2">
                            <label for="middle-label" class="text-left middle">Camber:</label>
                        </div>
                        <div class="cell small-4">
                            <input type="text" id="middle-label" readonly>
                        </div>
                    </div>

                    <div class="grid-x grid-margin-x">
                        <div class="cell small-2">
                            <label for="middle-label" class="text-left middle">Banden:</label>
                        </div>
                        <div class="cell small-4">
                            <input type="text" id="middle-label" readonly>
                        </div>
                        <div class="cell small-2">
                            <label for="middle-label" class="text-left middle">Bandendruk:</label>
                        </div>
                        <div class="cell small-4">
                            <input type="text" id="middle-label" readonly>
                        </div>
                    </div>


                    <div class="grid-x grid-margin-x">
                        <div class="cell small-2">
                            <label for="middle-label" class="text-left middle">Hoogte:</label>
                        </div>
                        <div class="cell small-4">
                            <input type="text" id="middle-label" readonly>
                        </div>
                        <div class="cell small-2">
                            <label for="middle-label" class="text-left middle">Ondergrond:</label>
                        </div>
                        <div class="cell small-4">
                            <input type="text" id="middle-label" readonly>
                        </div>
                    </div>

                    <div class="grid-x grid-margin-x">
                        <div class="cell small-2">
                            <label for="middle-label" class="text-left middle">Type event:</label>
                        </div>
                        <div class="cell small-4">
                            <input type="text" id="middle-label" readonly>
                        </div>
                        <div class="cell small-2">
                            <label for="middle-label" class="text-left middle">Weer:</label>
                        </div>
                        <div class="cell small-4">
                            <input type="text" id="middle-label" readonly>
                        </div>
                    </div>

              </form>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>
</div>
</div>
<?php include('scripts.php'); ?>
<script type="text/javascript">

    $(document).ready(function() {

    });
</script>
</body>
</html>

<?php
Database::disconnect();
?>
