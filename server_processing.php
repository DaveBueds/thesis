<?php
 
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
 
// DB table to use
$table = <<<EOT
 (
    SELECT Data.idData, FROM_UNIXTIME(GPS.timestamp, '%Y-%m-%dT%H:%i:%s') AS timestamp, DataTypeToSelect.type, Data.data, DataTypeToSelect.Unit, DataTypeToSelect.idDataTypeToSelect,GPS.idGPS, GPS.decimalLatitude, GPS.decimalLongitude 
    FROM Data 
    INNER JOIN GPS ON Data.GPSId=GPS.idGPS
    INNER JOIN DataTypeToSelect ON Data.datatypeId=DataTypeToSelect.idDataTypeToSelect 
    ORDER BY Data.idData DESC
 ) temp
EOT;
 
// Table's primary key
$primaryKey = 'idData';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array(
        'db' => 'idData',
        'dt' => 'DT_RowId',
        'formatter' => function( $d, $row ) {
            // Technically a DOM id cannot start with an integer, so we prefix
            // a string. This can also be useful if you have multiple tables
            // to ensure that the id is unique with a different prefix
            return 'row_'.$d;
        }
    ),
    array( 'db' => 'idData',            'dt' => 0 ),
    array( 'db' => 'timestamp',         'dt' => 1 ),
    array( 'db' => 'type',              'dt' => 2 ),
    array( 'db' => 'data',              'dt' => 3 ),
    array( 'db' => 'Unit',              'dt' => 4 ),
    array( 'db' => 'idDataTypeToSelect','dt' => 5 ),
    array( 'db' => 'idGPS',             'dt' => 6 ),
    array( 'db' => 'decimalLatitude',   'dt' => 7 ),
    array( 'db' => 'decimalLongitude',  'dt' => 8 )
);
 
// SQL server connection information

$sql_details = array(
    'user' => 'root',
    'pass' => 'root',
    'db'   => 'thesis',
    'host' => 'localhost'
);
/*
$sql_details = array(
    'user' => 'a17_formula',
    'pass' => 'zo1jrzrf',
    'db'   => 'a17_formula',
    'host' => 'studev.groept.be'
);
 */
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( 'ssp.class.php' );
 
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);