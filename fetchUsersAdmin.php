<?php

	require( './databaseCredentials.php' );

	$table = 'users';
	// Table's primary key
	$primaryKey = 'ID';

	// Array of database columns which should be read and sent back to DataTables.
	// The `db` parameter represents the column name in the database, while the `dt`
	// parameter represents the DataTables column identifier. In this case simple
	// indexes
	$columns = array(
		array( 'db' => 'ID',  'dt' => 0 ),
		array( 'db' => 'privileged',  'dt' => 1,
		'formatter' => function( $isAdmin, $row ) {
			if($isAdmin == 1){
				return 'admin';
			}else{
				return 'simple user';
			}
		}),
		array( 'db' => 'registrationTime',   'dt' => 2 ),
		array( 'db' => 'name',   'dt' => 3 ),
		array( 'db' => 'surname',   'dt' => 4 ),
		array( 'db' => 'birth',   'dt' => 5 ),
		array( 'db' => 'email',   'dt' => 6 ),
		array( 'db' => 'ID',     'dt' => 7  , 
		'formatter' => function( $d, $row ) {
			$parameterForModal = $row['privileged']."#delimiter#".$row['name']."#delimiter#".$row['surname']."#delimiter#".$row['birth']
			."#delimiter#".$row['email']."#delimiter#";
			return ' 
			<button class="btn btn-info" data-toggle="modal" data-target="#editUser" data-record-id="'.$row['ID'].'" 
			data-record-title = "'.$parameterForModal.'" >
				<i class="fas fa-user-edit"></i> Επεξεργασία
			</button>
			<br><br>
			<button class="btn btn-danger" data-toggle="modal" data-target="#deleteUser" data-record-id="'.$row['ID'].'" data-record-title = "'.$row['email'].'" >
				<i class="fas fa-user-times"></i> Διαγραφή
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
