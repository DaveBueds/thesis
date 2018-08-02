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
                
            </div>

            
            <div class="cell medium-auto medium-cell-block-container">
                <div class="grid-x grid-padding-x">


                    <div class="cell medium-12 medium-cell-block-y">
                        <h4>Gekoppelde data</h4>
                        <p><?php echo $obj->var; ?></p>

                        <table id="example" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Tijd</th>
                                    <th>Type</th>
                                    <th>Data</th>
                                    <th>Unit</th>
                                    <th>GPSid</th>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                    <th>Toe</th>
                                    <th>Camber</th>
                                    <th>Bandentype</th>
                                    <th>Hoogte</th>
                                    <th>Veer</th>
                                    <th>Torsieveer</th>
                                    <th>LR_HSB</th>
                                    <th>LR_LSB</th>
                                    <th>LR_R</th>
                                    <th>R_HSB</th>
                                    <th>R_LSB</th>
                                    <th>R_R</th>
                                    <th>Locatie</th>
                                    <th>Weg type</th>
                                    <th>Ondergrond</th>
                                    <th>Type event</th>
                                    <th>Weer stad</th>
                                    <th>Main</th>
                                    <th>Temp</th>
                                    <th>Korte beschrijving</th>
                                    <th>Luchtdruk</th>
                                    <th>Vochtigheid</th>
                                    <th>Tmin</th>
                                    <th>Tmax</th>
                                    <th>Windsnelheid</th>
                                    <th>Windrichting</th>
                                    <th>Bewolktheid</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>id</th>
                                    <th>Tijd</th>
                                    <th>Type</th>
                                    <th>Data</th>
                                    <th>Unit</th>
                                    <th>GPSid</th>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                    <th>Toe</th>
                                    <th>Camber</th>
                                    <th>Bandentype</th>
                                    <th>Hoogte</th>
                                    <th>Veer</th>
                                    <th>Torsieveer</th>
                                    <th>LR_HSB</th>
                                    <th>LR_LSB</th>
                                    <th>LR_R</th>
                                    <th>R_HSB</th>
                                    <th>R_LSB</th>
                                    <th>R_R</th>
                                    <th>Locatie</th>
                                    <th>Weg type</th>
                                    <th>Ondergrond</th>
                                    <th>Type event</th>
                                    <th>Weer stad</th>
                                    <th>Main</th>
                                    <th>Temp</th>
                                    <th>Korte beschrijving</th>
                                    <th>Luchtdruk</th>
                                    <th>Vochtigheid</th>
                                    <th>Tmin</th>
                                    <th>Tmax</th>
                                    <th>Windsnelheid</th>
                                    <th>Windrichting</th>
                                    <th>Bewolktheid</th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>


                </div>
            </div>

            <?php include('footer.php'); ?>
        </div>




    </div>
    
    <?php include('scripts.php'); ?>



    <script type="text/javascript">

        $(document).ready(function() {


        } );
    </script>


</body>

</html>

<?php
Database::disconnect();
?>