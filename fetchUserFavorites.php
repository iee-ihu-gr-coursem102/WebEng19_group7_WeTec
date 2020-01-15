<?php

	require( './databaseCredentials.php' );
	session_start();
	$table = 'favorites';
	// Table's primary key
	$primaryKey = 'ID';
	$userID = $_SESSION['id'];

	// Array of database columns which should be read and sent back to DataTables.
	// The `db` parameter represents the column name in the database, while the `dt`
	// parameter represents the DataTables column identifier. In this case simple
	// indexes
	$columns = array(
		array( 'db' => 'weatherDescription',  'dt' => -1 ),
		array( 'db' => 'weatherDateTime',  'dt' => 0 ),
		array( 'db' => 'minTemp',   'dt' => 1 ,
			'formatter' => function( $minTemp, $row ) {
				return $minTemp."°C";
			}
		),
		array( 'db' => 'maxTemp',   'dt' => 2 ,
			'formatter' => function( $maxTemp, $row ) {
				return $maxTemp."°C";
			}
		),
		array( 'db' => 'pressure',   'dt' => 3 ),
		array( 'db' => 'humidity',   'dt' => 4 ),
		array( 'db' => 'icon',   'dt' => 5,
			'formatter' => function( $iconID, $row ) {
				return "<img src=\"http://openweathermap.org/img/wn/".$iconID."@2x.png\" alt=\"-\"><br>".$row['weatherDescription'];
			}
		),
		array( 'db' => 'windSpeed',   'dt' => 6 ),
		array( 'db' => 'keyword',   'dt' => 7 ),
		array( 'db' => 'ID',     'dt' => 8  , 
		'formatter' => function( $d, $row ) {
			return ' <button class="btn btn-danger" data-toggle="modal" data-target="#deleteFavorite" data-record-id="'.$row['ID'].'" data-record-title = "'.$row['keyword'].'" >
				<i class="far fa-trash-alt"></i> Διαγραφή
			</button>';
		} )
	);

	// SQL server connection information
	$sql_details = array(
		'user' => $dbUser,
		'pass' => $dbPass,
		'db'   => $dbName,
		'host' => $dbHost
	);

	require( 'scripts/ssp.class.php' );
	$where = " userID = ".$userID;
	// return Json in ajax table call
	echo json_encode(
		SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns,$where)
	);
?>
