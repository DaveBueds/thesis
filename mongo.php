<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta charset="latin1_swedish_ci">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Training Data Collector</title>
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">    
    <!--<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/zf/dt-1.10.18/datatables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.7/css/select.dataTables.min.css">
</head>

<body>

    <div class="grid-container">

        <nav>
            <div class="title-bar" data-responsive-toggle="example-menu" data-hide-for="medium">
                <button class="menu-icon" type="button" data-toggle="example-menu"></button>
                <div class="title-bar-title">Training Data Collector</div>
            </div>

            <div class="top-bar" id="example-menu">
                <div class="top-bar-left">
                    <ul class="dropdown menu" data-dropdown-menu>
                        <li class="menu-text">Training Data Collector</li>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="mongo.php">MongoDB</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="grid-y medium-grid-frame">
            <div class="cell shrink header medium-cell-block-container">
                <br>
                
            </div>

            
            <div class="cell medium-auto medium-cell-block-container">
                <div class="grid-x grid-padding-x">


                    <div class="cell medium-12 medium-cell-block-y">
                        <h4>Telemetrie data</h4>
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



                    <div class="cell medium-4 medium-cell-block-y">
                        
                    </div>
                </div>
            </div>

            <div class="cell shrink footer">
                <hr>
                <div id="engadget-footer-contact-details-container">
                    <footer id="engadget-footer-contact-details">
                        <div class="footer-left">
                            <div class="contact-details">
                                <ul>
                                    <li>
                                        <img class="thumbnail" src="img/footerthumbnail.png">
                                    </li>
                                    <li class="footerColor">
                                        <i class="fa fa-phone fa-lg" aria-hidden="true"></i> +32 016 35 20 81
                                    </li>
                                    <li>
                                        <a data-toggle="animatedModal10"><i class="fa fa-envelope-o" aria-hidden="true"></i> Contact us</a>
                                    </li>
                                    <li>
                                        <i class="fa fa-map-marker fa-lg" aria-hidden="true"></i> Diestsesteenweg 692, 3010 Kessel-lo, Belgium
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
        </div>




    </div>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!--<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>-->
    <!--<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>-->
    <script type="text/javascript" src="https://cdn.datatables.net/v/zf/dt-1.10.18/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>



    <script type="text/javascript">

        $(document).ready(function() {


        } );
    </script>


</body>

</html>

<?php
Database::disconnect();
?>