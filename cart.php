<?php

require_once('errormessages.php');
include 'database.php';
$pdo = Database::connect();

$flag = isset($_GET['flag'])?intval($_GET['flag']):0;
$message = '';
if($flag ) {
    $message = $messages[$flag];
}

if (isset($_POST['voorspeltijdbtn'])) {
    /*if (empty($_POST['voorspelweer']) || empty($_POST['voorspelbanden']) || empty($_POST['voorspeltypeevent']) || empty($_POST['voorspeltoespoor']) || empty($_POST['voorspelcamber']) || empty($_POST['voorspelbandendruk']) || empty($_POST['voorspelhoogte'])) {
        //$flag = 3;
        header("Location: cart.php");
    }*/
    //$flag = 2;
    //$message = $messages[$flag];
    $weer = $_POST['voorspelweer'];
    $banden = $_POST['voorspelbanden'];
    $typeEvent = $_POST['voorspeltypeevent'];
    $toespoor = $_POST['voorspeltoespoor'];
    $camber = $_POST['voorspelcamber'];
    $bandendruk = $_POST['voorspelbandendruk'];
    $hoogte = $_POST['voorspelhoogte'];
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

        <div class="grid-x grid-padding-x">
            <div class="cell medium-2 medium-cell-block-y">
            </div>
            <div class="cell medium-8 medium-cell-block-y">
                <div>
            <h2>Regressie boom</h2>
            <br>
        </div>
                <h4>Afstelling predicter</h4>
                <h5>Voorspelde tijd: 
                    <span class="success label">
                        <?php 
                        $weer = escapeshellarg($weer);
                        $banden = escapeshellarg($banden);
                        $typeEvent = escapeshellarg($typeEvent);
                        $toespoor = escapeshellarg($toespoor);
                        $camber = escapeshellarg($camber);
                        $bandendruk = escapeshellarg($bandendruk);
                        $hoogte = escapeshellarg($hoogte);

                        $command = escapeshellcmd("/usr/local/bin/python3 /Applications/MAMP/htdocs/thesis/scripts/app.py $weer $banden $typeEvent $toespoor $camber $bandendruk $hoogte");
                        $output = shell_exec($command);
                        echo $output;
                        ?>
                    </span>
                </h5>

                <hr>

                <form action="" method="post">
                    <div class="grid-x grid-margin-x">
                        <div class="cell medium-2">
                            <label for="main" class="text-left middle">Weer:</label>
                        </div>
                        <div class="cell medium-4">
                            <select type="text" id="main" name="voorspelweer">
                                <option disabled selected value> -selecteer een optie- </option>
                                <option value="Clear">Clear</option>
                                <option value="Rain">Rain</option>
                            </select>
                            <script type="text/javascript">
                              document.getElementById('main').value = "<?php echo $_POST['voorspelweer'];?>";
                            </script>
                        </div>

                        <div class="cell medium-2">
                            <label for="banden" class="text-left middle">Banden:</label>
                        </div>
                        <div class="cell medium-4">
                            <select type="text" id="banden" name="voorspelbanden">
                                <option disabled selected value> -selecteer een optie- </option>
                                <option value="C17 slick">C17 slick</option>
                                <option value="C17 wet">C17 wet</option>
                            </select>
                            <script type="text/javascript">
                              document.getElementById('banden').value = "<?php echo $_POST['voorspelbanden'];?>";
                            </script>
                        </div>
                        
                    </div>

                    <div class="grid-x grid-margin-x">
                        <div class="cell medium-2">
                            <label for="typeEvent" class="text-left middle">Type event:</label>
                        </div>
                        <div class="cell medium-4">
                            <select type="text" id="typeEvent" name="voorspeltypeevent">
                                <option disabled selected value> -selecteer een optie- </option>
                                <option value="Acceleratie">Acceleratie</option>
                                <option value="SkidPad">SkidPad</option>
                            </select>
                            <script type="text/javascript">
                              document.getElementById('typeEvent').value = "<?php echo $_POST['voorspeltypeevent'];?>";
                            </script>
                        </div>

                        <div class="cell medium-2">
                            <label for="toespoor" class="text-left middle">Toe:</label>
                        </div>
                        <div class="cell medium-4">
                            <input type="number" placeholder="1000" step="1" min="995" max="1005" id="toespoor" name="voorspeltoespoor">
                            <script type="text/javascript">
                              document.getElementById('toespoor').value = "<?php echo $_POST['voorspeltoespoor'];?>";
                            </script>
                        </div>

                        
                        
                    </div>


                    <div class="grid-x grid-margin-x">
                        <div class="cell medium-2">
                            <label for="camber" class="text-left middle">Camber:</label>
                        </div>
                        <div class="cell medium-4">
                            <input type="number" placeholder="-0.5" step="0.1" min="-1.0" max="0" id="camber" name="voorspelcamber">
                            <script type="text/javascript">
                              document.getElementById('camber').value = "<?php echo $_POST['voorspelcamber'];?>";
                            </script>
                        </div>

                        <div class="cell medium-2">
                            <label for="bandendruk" class="text-left middle">Bandendruk:</label>
                        </div>
                        <div class="cell medium-4">
                            <input type="number" placeholder="0.7" step="0.1" min="0.6" max="0.8" id="bandendruk" name="voorspelbandendruk">
                            <script type="text/javascript">
                              document.getElementById('bandendruk').value = "<?php echo $_POST['voorspelbandendruk'];?>";
                            </script>
                        </div>
                    </div>

                    <div class="grid-x grid-margin-x">
                        <div class="cell medium-2">
                            <label for="hoogte" class="text-left middle">Hoogte:</label>
                        </div>
                        <div class="cell medium-4">
                            <input type="number" placeholder="30" step="1" min="20" max="40" id="hoogte" name="voorspelhoogte">
                            <script type="text/javascript">
                              document.getElementById('hoogte').value = "<?php echo $_POST['voorspelhoogte'];?>";
                            </script>
                        </div>

                    </div>
                    <div class="grid-x grid-margin-x">
                        <div class="cell medium-12">
                            <input type="submit" class="button expanded" name="voorspeltijdbtn" value="Voorspel tijd">
                        </div>
                    </div>

                </form>
            </div>
            <div class="cell medium-2 medium-cell-block-y">
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
    });
</script>
</body>
</html>

<?php
Database::disconnect();
?>
