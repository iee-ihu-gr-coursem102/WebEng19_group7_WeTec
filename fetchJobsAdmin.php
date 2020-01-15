<?php

	require( './databaseCredentials.php' );

	$table = 'jobs';
	// Table's primary key
	$primaryKey = 'ID';

	// Array of database columns which should be read and sent back to DataTables.
	// The `db` parameter represents the column name in the database, while the `dt`
	// parameter represents the DataTables column identifier. In this case simple
	// indexes
	$columns = array(
		array( 'db' => 'jobName',  'dt' => 0 ),
		array( 'db' => 'minTemp',  'dt' => 1,
			'formatter' => function( $minTemp, $row ) {
				return $minTemp." °C";
			}
		),
		array( 'db' => 'maxTemp',  'dt' => 2,
			'formatter' => function( $maxTemp, $row ) {
				return $maxTemp." °C";
			}
		),
		array( 'db' => 'minHumidity',   'dt' => 3 ),
		array( 'db' => 'maxHumidity',   'dt' => 4 ),
		array( 'db' => 'minWindSpeed',   'dt' => 5 ),
		array( 'db' => 'maxWindSpeed',   'dt' => 6 ),
		array( 'db' => 'ID',     'dt' => 7  , 
		'formatter' => function( $d, $row ) {
			$parameterForModal = $row['jobName']."#delimiter#".$row['minTemp']."#delimiter#".$row['maxTemp']."#delimiter#".$row['minHumidity']
			."#delimiter#".$row['maxHumidity']."#delimiter#".$row['minWindSpeed']
			."#delimiter#".$row['maxWindSpeed'];
			return ' 
			<button class="btn btn-info" data-toggle="modal" data-target="#editJob" data-record-id="'.$row['ID'].'" 
			data-record-title = "'.$parameterForModal.'" >
				<i class="fas fa-pencil-alt"></i> Επεξεργασία
			</button>
			<br><br>
			<button class="btn btn-danger" data-toggle="modal" data-target="#deleteJob" data-record-id="'.$row['ID'].'" data-record-title = "'.$row['jobName'].'" >
				<i class="far fa-trash-alt"></i> Διαγραφή
			</button>
			';
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
	$where = " 1=1"; // fetch all users with no filter
	// return Json in ajax table call
	echo json_encode(
		SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns,$where)
	);
?>
