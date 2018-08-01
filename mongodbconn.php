<?php

//phpinfo();

ini_set('display_errors','true');
error_reporting(E_ALL);

$messages = array(
	1=>'Verwijderen van document succesvol gelukt.',
	2=>'Er is een fout opgetreden. Probeer opnieuw.', 
	3=>'Document succesvol opgeslagen.',
    4=>'Document updaten succesvol gelukt.', 
    5=>'Alle velden zijn verplicht in te vullen.' );


$mongoDbname  =  'thesis';
//$mongoTblName =  'products';
$manager     =   new MongoDB\Driver\Manager("mongodb://localhost:27017");

?>