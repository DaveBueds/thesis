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
                        <a id="btn_koppel" class="success button">Koppel</a>
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


                    <div class="cell medium-8 medium-cell-block-y">
                        <h4>Telemetrie data</h4>

                        <table id="sensortabel" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Tijd</th>
                                    <th>Type</th>
                                    <th>Data</th>
                                    <th>Unit</th>
                                    <th>Typeid</th>
                                    <th>GPSid</th>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>id</th>
                                    <th>Tijd</th>
                                    <th>Type</th>
                                    <th>Data</th>
                                    <th>Unit</th>
                                    <th>Typeid</th>
                                    <th>GPSid</th>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>



                    <div class="cell medium-4 medium-cell-block-y">
                        <ul class="accordion" data-accordion data-allow-all-closed="true" data-multi-expand="true">
                            

                            <li class="accordion-item" data-accordion-item>

                                <a href="#" class="accordion-title">Mechanische data</a>
                                <div class="accordion-content" data-tab-content>
                                    <form action="create_md.php" method="post">
                                        <div class="grid-container">
                                            <div class="grid-x grid-padding-x">

                    

                                                <div class="medium-12 cell">
                                                    <label>Settings:
                                                        <select name="settings" id="md_settings">
                                                            <option value="0">Maak/Selecteer setting</option>
                                                            <?php 
                                                            $sql = 'SELECT * FROM MechanicalData ORDER BY idMechanischeData ASC';

                                                            $i = 1;
                                                            $geselecteerd = "";
                                                            foreach ($pdo->query($sql) as $row) {
                                                                if($i == 1) { $geselecteerd = "selected"; }
                                                                echo '<option value="'.$row['idMechanischeData'].'"' . $geselecteerd . '>'.
                                                                't:' . $row['toespoor'].
                                                                ',c: ' .$row['camber'].
                                                                ',b: ' .$row['banden'].
                                                                ',bd: ' .$row['bandendruk'].
                                                                ',h: ' .$row['hoogte'].
                                                                ',v: ' .$row['veer'].
                                                                ',tv: ' .$row['torsieveer'].
                                                                ',LR_H: ' .$row['LR_HSB'].
                                                                ',LR_L: ' .$row['LR_LSB'].
                                                                ',LR_R: ' .$row['LR_R'].
                                                                ',M_H: ' .$row['M_HSB'].
                                                                ',M_L: ' .$row['M_LSB'].
                                                                ',M_R: ' .$row['M_R'].
                                                                '</option>';
                                                                $i++;
                                                            }
                                                            ?>
                                                        </select>
                                                    </label>
                                                </div>

                                                <div class="md_new_block medium-12 cell">
                                                    <p>Maak hier een nieuwe setting.</p>
                                                </div>

                                                <div class="md_new_block medium-4 cell">
                                                    <label>
                                                        <span data-tooltip class="top" title="Uitleg toespoor">Toe (mm):</span>
                                                        <input name="toespoor" type="number" value="100" step="1" required>
                                                    </label>
                                                </div>

                                                <div class="md_new_block medium-4 cell">
                                                    <label>
                                                        <span data-tooltip class="top" title="Front view">Camber (°):</span>
                                                        <input name="camber" type="number" value="2" step="1" required>
                                                    </label>
                                                </div>

                                                <div class="md_new_block medium-4 cell">
                                                    <label>
                                                        <span data-tooltip class="top" title="Uitleg hoogte">Hoogte (mm):</span>
                                                        <input name="hoogte" type="number" value="3" step="0.5" required>
                                                    </label>
                                                </div>

                                                <div class="md_new_block medium-6 cell">
                                                    <label>
                                                        <span data-tooltip class="top" title="Uitleg bandentype">Bandentype:</span>
                                                        <select name="banden" required>
                                                            <option value="C17 slick">C17 slick</option>
                                                            <option value="C17 wet">C17 wet</option>
                                                        </select>
                                                    </label>
                                                </div>
                                                
                                                <div class="md_new_block medium-6 cell">
                                                    <label>
                                                        <span data-tooltip class="top" title="Uitleg bandendruk">Bandendruk (bar):</span>
                                                        <input name="bandendruk" type="number" value="2" step="0.1" required>
                                                    </label>
                                                </div>

                                                

                                                <div class="md_new_block medium-6 cell">
                                                    <label>
                                                        <span data-tooltip class="top" title="Uitleg veer">Veer:</span>
                                                        <select name="veer" required>
                                                            <option value="36mm soft">36mm Soft</option>
                                                            <option value="36mm hard">36mm Hard</option>
                                                        </select>
                                                    </label>
                                                </div>

                                                <div class="md_new_block medium-6 cell">
                                                    <label>
                                                        <span data-tooltip class="top" title="Uitleg torsieveer">Torsieveer:</span>
                                                        <select name="torsieveer" required>
                                                            <option value="torsieveer 1">torsieveer 1</option>
                                                            <option value="torsieveer 2">torsieveer 2</option>
                                                        </select>
                                                    </label>
                                                </div>    


                                                <div class="md_new_block medium-4 cell">
                                                    <label>
                                                        <span data-tooltip class="top" title="Uitleg demper">LR HSB:</span>
                                                        <input name="LR_HSB" type="number" min="1" max="18" value="9" step="1" required>
                                                    </label>
                                                </div>
                                                <div class="md_new_block medium-4 cell">
                                                    <label>
                                                        <span data-tooltip class="top" title="Uitleg demper">LR LSB:</span>
                                                        <input name="LR_LSB" type="number" min="1" max="18" value="9" step="1" required>
                                                    </label>
                                                </div>
                                                <div class="md_new_block medium-4 cell">
                                                    <label>
                                                        <span data-tooltip class="top" title="Uitleg demper">LR R:</span>
                                                        <input name="LR_R" type="number" min="1" max="18" value="9" step="1" required>
                                                    </label>
                                                </div>

                                                <div class="md_new_block medium-4 cell">
                                                    <label>
                                                        <span data-tooltip class="top" title="Uitleg demper">M HSB:</span>
                                                        <input name="M_HSB" type="number" min="1" max="18" value="9" step="1" required>
                                                    </label>
                                                </div>
                                                <div class="md_new_block medium-4 cell">
                                                    <label>
                                                        <span data-tooltip class="top" title="Uitleg demper">M LSB:</span>
                                                        <input name="M_LSB" type="number" min="1" max="18" value="9" step="1" required>
                                                    </label>
                                                </div>
                                                <div class="md_new_block medium-4 cell">
                                                    <label>
                                                        <span data-tooltip class="top" title="Uitleg demper">M R:</span>
                                                        <input name="M_R" type="number" min="1" max="18" value="9" step="1" required>
                                                    </label>
                                                </div>

                                                <div class="md_new_block medium-12 cell">
                                                    <button name="btn_md" type="button submit" class="button float-right">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </li>



                            

                            <li class="accordion-item" data-accordion-item>
                                <a href="#" class="accordion-title">Circuit data</a>
                                <div class="accordion-content" data-tab-content>
                                    <form action="create_cd.php" method="post">
                                        <div class="grid-container">
                                            <div class="grid-x grid-padding-x">

                                                <div class="medium-12 cell">
                                                    <label>Settings:
                                                        <select name="settings" id="cd_settings">
                                                            <option value="0">Maak/Selecteer setting</option>

                                                            <?php 
                                                            $sql = 'SELECT * FROM CircuitData ORDER BY idCircuitData ASC';

                                                            $i = 1;
                                                            $geselecteerd = "";
                                                            foreach ($pdo->query($sql) as $row) {
                                                                if($i == 1) { $geselecteerd = "selected"; }
                                                                echo '<option value="'.$row['idCircuitData'].'"' . $geselecteerd . '>'.
                                                                'locatie:' . $row['locatienaam'].
                                                                ',wegtype: ' .$row['wegtype'].
                                                                ',ondergrond: ' .$row['ondergrond'].
                                                                ',typeEvent: ' .$row['typeEvent'].
                                                                '</option>';
                                                                $i++;
                                                            }
                                                            ?>
                                                        </select>
                                                    </label>
                                                </div>

                                                <div class="cd_new_block medium-12 cell">
                                                    <p>Maak hier een nieuwe setting.</p>
                                                </div>
                                                <div class="cd_new_block medium-6 cell">
                                                    <label>Naam (locatie):
                                                        <input name="locatienaam" type="text">
                                                    </label>
                                                </div>
                                                <div class="cd_new_block medium-6 cell">
                                                    <label>Weg type:
                                                        <select name="wegtype">
                                                            <option value="Asfalt">Asfalt</option>
                                                            <option value="Beton">Beton</option>
                                                        </select>
                                                    </label>
                                                </div>

                                                <div class="cd_new_block medium-6 cell">
                                                    <label>Ondergrond:
                                                        <select name="ondergrond">
                                                            <option value="Droog">Droog</option>
                                                            <option value="Nat">Nat</option>
                                                        </select>
                                                    </label>
                                                </div>

                                                <div class="cd_new_block medium-6 cell">
                                                    <label>Type event:
                                                        <select name="typeEvent">
                                                            <option value="Acceleratie">Acceleratie</option>
                                                            <option value="SkidPad">Skid Pad</option>
                                                        </select>
                                                    </label>
                                                </div>

                                                <div class="cd_new_block medium-12 cell">
                                                    <button name="btn_cd" type="button submit" class="button float-right">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li>
                            <li class="accordion-item" data-accordion-item>
                                <a href="#" class="accordion-title">Weer data (API)</a>
                                <div class="accordion-content" data-tab-content>
                                    <form action="create_wd.php" method="post">
                                        <div class="grid-container">
                                            <div class="grid-x grid-padding-x">

                                                <div class="medium-12 cell">
                                                    <label>Settings:
                                                        <select name="settings" id="wd_settings">
                                                            <option value="0">Maak/Selecteer setting</option>
                                                            <?php 
                                                            $sql = 'SELECT * FROM WeerData ORDER BY idWeerData ASC';

                                                            $i = 1;
                                                            $geselecteerd = "";
                                                            foreach ($pdo->query($sql) as $row) {
                                                                if($i == 1) { $geselecteerd = "selected"; }
                                                                echo '<option value="'.$row['idWeerData'].'"' . $geselecteerd . '>'.
                                                                's:' . $row['stadsnaam'].
                                                                ',m: ' .$row['main'].
                                                                ',t: ' .$row['temperatuur'].
                                                                ',kb: ' .$row['kortebeschrijving'].
                                                                ',ld: ' .$row['luchtdruk'].
                                                                ',v: ' .$row['vochtigheid'].
                                                                ',tmin: ' .$row['temperatuur_min'].
                                                                ',tmax: ' .$row['temperatuur_max'].
                                                                ',ws: ' .$row['windsnelheid'].
                                                                ',wr: ' .$row['windrichting'].
                                                                ',b: ' .$row['bewolktheid'].
                                                                '</option>';
                                                                $i++;
                                                            }
                                                            ?>
                                                        </select>
                                                    </label>
                                                </div>

                                                <div class="wd_new_block medium-10 cell search">
                                                    <input name="stadsnaam" id="search-txt" type="text" placeholder="Geef stadsnaam">
                                                </div>
                                                <div class="wd_new_block medium-2 cell search">
                                                    <button id="search-btn" type="button" class="button float-right"><i class="fa fa-search" aria-hidden="true"></i></button>
                                                </div>

                                                <div class="wd_new_block medium-7 cell">
                                                    <label>Main (regen, sneeuw,...):
                                                        <input name="main" id="weer_main" type="text" readonly>
                                                    </label>
                                                </div>
                                                <div class="wd_new_block medium-5 cell">
                                                    <label>Temperatuur (°C):
                                                        <input name="temperatuur" id="weer_temp" type="text" readonly>
                                                    </label>
                                                </div>

                                                <div class="wd_new_block medium-6 cell">
                                                    <label>Korte beschrijving:
                                                        <input name="kortebeschrijving" id="weer_sd" type="text" readonly>
                                                    </label>
                                                </div>

                                                <div class="wd_new_block medium-6 cell">
                                                    <label>Luchtdruk (hPa):
                                                        <input name="luchtdruk" id="weer_pressure" type="text" readonly>
                                                    </label>
                                                </div>
                                                <div class="wd_new_block medium-6 cell">
                                                    <label>Vochtigheid (%):
                                                        <input name="vochtigheid" id="weer_vochtigheid" type="text" readonly>
                                                    </label>
                                                </div>
                                                <div class="wd_new_block medium-6 cell">
                                                    <label>Temp. min (°C):
                                                        <input name="temperatuur_min" id="weer_tempmin" type="text" readonly>
                                                    </label>
                                                </div>
                                                <div class="wd_new_block medium-6 cell">
                                                    <label>Temp. max (°C):
                                                        <input name="temperatuur_max" id="weer_tempmax" type="text" readonly>
                                                    </label>
                                                </div>
                                                <div class="wd_new_block medium-6 cell">
                                                    <label>Wind snelheid (m/s):
                                                        <input name="windsnelheid" id="weer_windsnelheid" type="text" readonly>
                                                    </label>
                                                </div>
                                                <div class="wd_new_block medium-6 cell">
                                                    <label>Wind richting (°):
                                                        <input name="windrichting" id="weer_windrichting" type="text" readonly>
                                                    </label>
                                                </div>
                                                <div class="wd_new_block medium-6 cell">
                                                    <label>Bewolktheid (%):
                                                        <input name="bewolktheid" id="weer_bewolktheid" type="text" readonly>
                                                    </label>
                                                </div>
                                                <div class="wd_new_block medium-12 cell">
                                                    <button name="btn_wd" type="button submit" class="button float-right">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>

            <?php include('footer.php'); ?>
        </div>




    </div>
    


    <?php include('scripts.php'); ?>


    <script type="text/javascript">

        $(document).ready(function() {
            var selected = [];

            $('#sensortabel').DataTable( {
                lengthMenu: [[50, 100, 1000, 2000, -1], [50, 100, 1000, 2000, "All"]],
                select: true,
                language: {
                    select: {
                        rows: {
                            _: "You have selected %d rows",
                            0: "Click a row to select it",
                            1: "Only 1 row selected"
                        }
                    }
                },
                processing: true,
                serverSide: true,
                ajax: "server_processing.php",
                rowCallback: function( row, data ) {
                    if ( $.inArray(data.DT_RowId, selected) !== -1 ) {
                        $(row).addClass('selected');
                    }
                }
            })
            .on( 'error.dt', function ( e, settings, techNote, message ) {
                $vlag = 5;
                window.location.href = window.location.pathname + "?flag=" + $vlag ; 
            } );



            function cal_avg(lengte, data) {
                var avg = 0;
                var nl = lengte;
                var i = 0;

                //bij negatief getal, verwijderen uit array, lengte aanpassen
                for (i = 0; i < nl; i++) {
                    if(parseFloat(data[i]) < 0){
                        var index = data.indexOf(data[i]);
                        data.splice(index, 1);
                        nl--;
                        i--;
                    }
                }

                for(var j = 0; j <= data.length; j++) {
                    if(j == data.length) {
                        avg = avg / data.length;
                        break;
                    }
                    //bereken lopende som               
                    avg += parseFloat(data[j]);
                }
                if(isNaN(avg)) {
                    avg = 0;
                    return avg;
                }
                else {
                    var avg_r = Math.round(avg*1000)/1000; //afronden op 3 na komma
                    return avg_r;
                }
            }


            
            $("#btn_koppel").click(function(){
                var data = [];
                var table = $('#sensortabel').DataTable();

                $md_val = parseInt($('#md_settings').val());
                $cd_val = parseInt($('#cd_settings').val());
                $wd_val = parseInt($('#wd_settings').val());

                if ( $md_val == 0 || $cd_val == 0 || $wd_val == 0  ) {
                    $vlag = 4;
                    window.location.href = window.location.pathname + "?flag=" + $vlag ; 
                }
                else {
                    if($( "tr.selected" ).length == 0) {
                        $vlag = 7;
                        window.location.href = window.location.pathname + "?flag=" + $vlag ; 
                    }

                    var myObj = { "md_val": $md_val, "cd_val": $cd_val, "wd_val": $wd_val};

                    //Dynamische variabelen in window, hierdoor geen elendige lange code
                    //Telkens er een nieuw type geselecteerd is wordt dit toegevoegd aan typearray
                    var typearray = [];
                    var timearray = [];


                    $( "tr.selected" ).each(function( index ) {
                        var type = table.row(this).data()[5];
                        var tijd = table.row(this).data()[1];
                        if($.inArray("type_"+type, typearray) == -1) {
                            typearray.push("type_"+type);
                        }
                        timearray.push(new Date(tijd));
                    });
                    console.log(typearray);

                    //sorteren van tijden oplopen
                    var date_sort_asc = function (date1, date2) {
                      if (date1 > date2) return 1;
                      if (date1 < date2) return -1;
                      return 0;
                    };

                    timearray.sort(date_sort_asc);
                    var beginTijd = timearray[0];
                    var eindTijd = timearray[timearray.length -1];
                    
                    var totaalTijd = (eindTijd.getTime() - beginTijd.getTime())/1000; //tijd in seconden
                    myObj["totaalTijd"] = totaalTijd;

                    //typearray wordt gebruikt om variabele met zelfde naam te maken
                    for (var i=0;i<typearray.length;i+=1){
                      window[typearray[i]] = [];
                    }


                    
                    $( "tr.selected" ).each(function( index ) {
                        
                        var type = table.row(this).data()[5];
                        var content = table.row(this).data()[3];

                        //wanneer type gelijk is wordt de data aan de variabel met naam type toegevoegd
                        switch("type_"+type) {
                            case "type_"+type:
                                window["type_"+type].push(content);
                                break;
                            default:
                                //window["type_"+type].push(0);
                                break;
                        }
                    });

                    //de array met naam 'type'_avg wordt gebruikt om het gemiddelde van de 'type' array te berekenen 
                    //elk type wordt aan json toegevoegd
                    for (var i=0;i<typearray.length;i+=1){
                        var naam = typearray[i]+'_avg';
                        window[typearray[i]+'_avg'] = cal_avg(parseFloat(window[typearray[i]].length), window[typearray[i]]);
                        myObj[naam] = window[typearray[i]+'_avg'];
                    }
                    console.log(window);

                    
                    data.push(myObj);

                    var json = JSON.stringify(data);
                    //console.log(json);
                    
                    
                    $.ajax({
                        url: "koppeldata.php",
                        type: "POST",
                        data: {'data': json},
                        dataType: "JSON",
                        success: function( data ) {
                            $vlag = data;
                            window.location.href = window.location.pathname + "?flag=" + $vlag ;
                            
                        }
                    });
                    
                    
                }

            });
            

            $('.callout').closest('[data-alert]').delay(10000).fadeOut(1000);

            if(parseInt($('#md_settings').val()) !== 0 ) {
                $('.md_new_block').hide(); 
            } 

            if(parseInt($('#cd_settings').val()) !== 0 ) {
                $('.cd_new_block').hide(); 
            } 

            if(parseInt($('#wd_settings').val()) !== 0 ) {
                $('.wd_new_block').hide(); 
            }

            $(function() {
                $('#md_settings').change(function(){
                    if(parseInt($('#md_settings').val()) !== 0 ) {
                        $('.md_new_block').hide(); 
                    } 
                    else {
                        $('.md_new_block').show(); 
                    } 
                });

                $('#cd_settings').change(function(){
                    if(parseInt($('#cd_settings').val()) !== 0 ) {
                        $('.cd_new_block').hide(); 
                    } 
                    else {
                        $('.cd_new_block').show(); 
                    } 
                });


                $('#wd_settings').change(function(){
                    if(parseInt($('#wd_settings').val()) !== 0 ) {
                        $('.wd_new_block').hide(); 
                    } 
                    else {
                        $('.wd_new_block').show(); 
                    } 
                });
            });

        } );
    </script>
    <script type="text/javascript">
        const appKey = "750c14f70068a54374c7d3f610e4bc76";

        let searchButton = document.getElementById("search-btn");
        let searchInput = document.getElementById("search-txt");
        let main = document.getElementById("weer_main");
        let temperature = document.getElementById("weer_temp");
        let kortebeschrijving = document.getElementById("weer_sd");
        let luchtdruk = document.getElementById("weer_pressure");
        let vochtigheid = document.getElementById("weer_vochtigheid");
        let tempmin = document.getElementById("weer_tempmin");
        let tempmax = document.getElementById("weer_tempmax");
        let windsnelheid = document.getElementById("weer_windsnelheid");
        let windrichting = document.getElementById("weer_windrichting");
        let bewolktheid = document.getElementById("weer_bewolktheid");

        searchButton.addEventListener("click", findWeatherDetails);
        searchInput.addEventListener("keyup", enterPressed);

        function enterPressed(event) {
            if (event.key === "Enter") {
                findWeatherDetails();
            }
        }

        function findWeatherDetails() {
            if (searchInput.value === "") {
                $vlag = 6;
                window.location.href = window.location.pathname + "?flag=" + $vlag ;
            }
            else {
                let searchLink = "https://api.openweathermap.org/data/2.5/weather?q=" + searchInput.value + "&appid="+appKey;
                httpRequestAsync(searchLink, theResponse);
            }
        }

        function theResponse(response) {
            let jsonObject = JSON.parse(response);

            main.value = jsonObject.weather[0].main;
            temperature.value = parseInt(jsonObject.main.temp - 273);
            kortebeschrijving.value = jsonObject.weather[0].description;
            luchtdruk.value = parseInt(jsonObject.main.pressure);
            vochtigheid.value = parseInt(jsonObject.main.humidity);
            tempmin.value = parseInt(jsonObject.main.temp_min - 273);
            tempmax.value = parseInt(jsonObject.main.temp_max - 273);
            windsnelheid.value = parseInt(jsonObject.wind.speed);
            windrichting.value = parseInt(jsonObject.wind.deg);
            bewolktheid.value = parseInt(jsonObject.clouds.all);

        }

        function httpRequestAsync(url, callback) {
            var httpRequest = new XMLHttpRequest();
            httpRequest.onreadystatechange = () => { 
                if (httpRequest.readyState == 4 && httpRequest.status == 200){
                    callback(httpRequest.responseText);
                }
                if (httpRequest.status == 404) {
                    $vlag = 6;
                    window.location.href = window.location.pathname + "?flag=" + $vlag ;
                }
            }
            httpRequest.open("GET", url, true); // true for asynchronous 
            httpRequest.send();
        }
    </script>

</body>

</html>

<?php
Database::disconnect();
?>