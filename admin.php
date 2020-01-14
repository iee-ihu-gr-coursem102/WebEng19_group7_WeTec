<?php
	include './definitions.php';
	session_start();
	$now = time(); // Checking the time now when home page starts.
	// in case someone try to enter and it is not admin force logout user
	if ($now > $_SESSION['expire'] || !isset($_SESSION['name']) || $_SESSION['privileged'] == 0) {
		session_destroy();
		header("Location: $domain/index.php");
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>WeTec - Διαχειριστής</title>
	<link rel="shortcut icon" href="img/favicon.png">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel='stylesheet' type='text/css'>
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/lightbox.css">
	<link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.default.css">
	<link rel="stylesheet" href="css/arrow.css">
	<link rel="stylesheet" href="css/waypoints.css">
	
	<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
	<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
	
	<style>
		td
		{
			text-align: center;
			vertical-align: middle;
		}
	</style>
</head>
<body>
<div class="modal fade" id="addJob" tabindex="-1" role="dialog "
	aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close"
					   data-dismiss="modal">
						   <span aria-hidden="true">&times;</span>
						   <span class="sr-only">Ακύρωση</span>
					</button>
					<font size='3'><font color='#388DC9'>Προσθέστε Εργασία</font></font>
				</div>
		<div class="modal-body">
			<form action="insertJobService.php" method="POST" role="form" enctype="multipart/form-data">
				<div class="form-group">
							<label for="jobNameLabel">Όνομα Εργασίας</label>
							<input class="form-control" id="jobName" name="jobName" type="text" placeholder="Όνομα Εργασίας" required>
						<br>
							<label for="minTempLabel">Ελάχιστη Θερμοκρασία</label>
							<input class="form-control" id="minTemp" name="minTemp" type="number" step="0.01" placeholder="Ελάχιστη Θερμοκρασία" required>
						<br>
							<label for="maxTempLabel">Μέγιστη Θερμοκρασία</label>
							<input class="form-control" id="maxTemp" name="maxTemp" type="number" step="0.01" placeholder="Μέγιστη Θερμοκρασία" required>
						<br>
							<label for="minHumidityLabel">Ελάχιστη Υγρασία</label>
							<input class="form-control" id="minHumidity" name="minHumidity" type="number" step="0.01" placeholder="Ελάχιστη Υγρασία" required>
						<br>
							<label for="maxHumidityLabel">Μέγιστη Υγρασία</label>
							<input class="form-control" id="maxHumidity" name="maxHumidity" type="number" step="0.01" placeholder="Μέγιστη Υγρασία" required>
						<br>
							<label for="minWindSpeedLabel">Ελάχιστη Ταχύτητα Ανέμου</label>
							<input class="form-control" id="minWindSpeed" name="minWindSpeed" type="number" step="0.01" placeholder="Ελάχιστη Ταχύτητα Ανέμου" required>
						<br>
							<label for="maxWindSpeedLabel">Μέγιστη Ταχύτητα Ανέμου</label>
							<input class="form-control" id="maxWindSpeed" name="maxWindSpeed" type="number" step="0.01" placeholder="Μέγιστη Ταχύτητα Ανέμου" required>							
					<div class="modal-footer">
						 <button type="button" class="btn btn-default" data-dismiss="modal">Ακύρωση</button>
						 <button type="submit" class="btn btn-primary">Αποθήκευση</button>
					</div>
				</div>
			</form>
		</div>
		</div>
		</div>
	</div>
		
	<div class="modal fade" id="editJob" tabindex="-1" role="dialog "
		aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close"
						   data-dismiss="modal">
							   <span aria-hidden="true">&times;</span>
							   <span class="sr-only">Ακύρωση</span>
						</button>
						<font size='3'><font color='#388DC9'>Επεξεργασία</font></font>
					</div>
			<div class="modal-body">
				<form action="updateJobService.php" method="POST" role="form" enctype="multipart/form-data">
					<div class="form-group">
								<label for="jobNameLabel">Όνομα Εργασίας</label>
								<input class="form-control" id="jobName" name="jobName" type="text" placeholder="Όνομα Εργασίας" required>
							<br>
								<label for="minTempLabel">Ελάχιστη Θερμοκρασία</label>
								<input class="form-control" id="minTemp" name="minTemp" type="number" step="0.01" placeholder="Ελάχιστη Θερμοκρασία" required>
							<br>
								<label for="maxTempLabel">Μέγιστη Θερμοκρασία</label>
								<input class="form-control" id="maxTemp" name="maxTemp" type="number" step="0.01" placeholder="Μέγιστη Θερμοκρασία" required>
							<br>
								<label for="minHumidityLabel">Ελάχιστη Υγρασία</label>
								<input class="form-control" id="minHumidity" name="minHumidity" type="number" step="0.01" placeholder="Ελάχιστη Υγρασία" required>
							<br>
								<label for="maxHumidityLabel">Μέγιστη Υγρασία</label>
								<input class="form-control" id="maxHumidity" name="maxHumidity" type="number" step="0.01" placeholder="Μέγιστη Υγρασία" required>
							<br>
								<label for="minWindSpeedLabel">Ελάχιστη Ταχύτητα Ανέμου</label>
								<input class="form-control" id="minWindSpeed" name="minWindSpeed" type="number" step="0.01" placeholder="Ελάχιστη Ταχύτητα Ανέμου" required>
							<br>
								<label for="maxWindSpeedLabel">Μέγιστη Ταχύτητα Ανέμου</label>
								<input class="form-control" id="maxWindSpeed" name="maxWindSpeed" type="number" step="0.01" placeholder="Μέγιστη Ταχύτητα Ανέμου" required>
								
								<input class="form-control" type="hidden" class="form-control" id="jobID" name="jobID" value= "" />
						<div class="modal-footer">
							 <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
							 <button type="submit" class="btn btn-primary">Επεξεργασία</button>
						</div>
					</div>
				</form>
			</div>
			</div>
			</div>
		</div>

	<div class="modal fade" id="editUser" tabindex="-1" role="dialog "
		aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close"
						   data-dismiss="modal">
							   <span aria-hidden="true">&times;</span>
							   <span class="sr-only">Ακύρωση</span>
						</button>
						<font size='3'><font color='#388DC9'>Επεξεργασία Χρήστη</font></font>
					</div>
			<div class="modal-body">
				<form action="updateUserService.php" method="POST" role="form" enctype="multipart/form-data">
					<div class="form-group">
								<label for="adminLabel">Διαχειριστής</label>
								<div class="checkbox">
									<input id="privileged" name="privileged" data-toggle="toggle" type="checkbox">
								</div>
								* Προκειμένου να επεξεργαστείτε τα δικαιώματα, απαιτείται είσοδος του χρήστη  <br>
							<br>
								<label for="nameLabel">Όνομα</label>
								<input class="form-control" id="name" name="name" type="text" placeholder="Όνομα" required>
							<br>
								<label for="surnameLabel">Επίθετο</label>
								<input class="form-control" id="surname" name="surname" type="text" placeholder="Επίθετο" required>
							<br>
								<label for="exampleInputEmail1">Email</label>
								<input class="form-control" id="email" name="email" type="email" placeholder="Email" required>
							<br>
								<label for="exampleInputEmail1">Password</label>
								<input class="form-control" id="password" name="password" type="text" placeholder="Password">
								* παραμένει κενό εάν δεν επιθυμείτε να αλλάξετε το password του χρήστη
							<br>
								<label for="exampleInputEmail1">Ημερομηνία Γέννησης</label>
								<input class="form-control" id="birth" name="birth" type="date" placeholder="Ημερομηνία Γέννησης" required><br>
							<br>
								<input class="form-control" type="hidden" class="form-control" id="userID" name="userID" value= "" />
						<div class="modal-footer">
							 <button type="button" class="btn btn-default" data-dismiss="modal">Ακύρωση</button>
							 <button type="submit" class="btn btn-primary">Επεξεργασία</button>
						</div>
					</div>
				</form>
			</div>
			</div>
			</div>
		</div>


	<div class="modal fade" id="deleteUser" tabindex="-1" role="dialog "
	aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close"
					   data-dismiss="modal">
						   <span aria-hidden="true">&times;</span>
						   <span class="sr-only">Ακύρωση</span>
					</button>
					<font size='3'><font color='#388DC9'>Διαγραφή</font></font>
				</div>
		<div class="modal-body">
			<p>Είστε σίγουροι ότι επιθυμείτε να διαγράψετε τον χρήστη με email: <b><i class="title"></i></b>.</p>
			<p>Θέλετε να προχωρήσετε?</p>
			<form action="deleteUserService.php" method="POST" role="form" enctype="multipart/form-data">
				<div class="form-group">
						<input type="hidden" class="form-control" id="userID" name="userID" value= "" />
					<div class="modal-footer">
						 <button type="button" class="btn btn-default" data-dismiss="modal">Ακύρωση</button>
						 <button type="submit" class="btn btn-primary">Διαγραφή Χρήστη</button>
					</div>
				</div>
			</form>
		</div>
		</div>
		</div>
	</div>
	
	<div class="modal fade" id="deleteJob" tabindex="-1" role="dialog "
	aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close"
					   data-dismiss="modal">
						   <span aria-hidden="true">&times;</span>
						   <span class="sr-only">Ακύρωση</span>
					</button>
					<font size='3'><font color='#388DC9'>Delete</font></font>
				</div>
		<div class="modal-body">
			<p>Είσαστε σίγουρος ότι θέλετε να διαγράψετε την εργασία: <b><i class="title"></i></b>.</p>
			<p>Θέλετε να προχωρήσετε?</p>
			<form action="deleteJobService.php" method="POST" role="form" enctype="multipart/form-data">
				<div class="form-group">
						<input type="hidden" class="form-control" id="jobID" name="jobID" value= "" />
					<div class="modal-footer">
						 <button type="button" class="btn btn-default" data-dismiss="modal">Ακύρωση</button>
						 <button type="submit" class="btn btn-primary">Διαγραφή Εργασίας</button>
					</div>
				</div>
			</form>
		</div>
		</div>
		</div>
	</div>
<!--- Start Home section -->
<div id="home" class="offset">
<!--- Navigation -->
<nav class="navbar navbar-expand-md fixed-top always-solid">
<div class="container-fluid">
	<a class="navbar-brand" href="home.php"><img src="img/wetec.png" alt=""></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
		<span class="custom-toggler-icon"><i class="fas fa-bars"></i></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarResponsive">
	</div>
</div>
</nav>
<!--- End Navigation -->

</div>
<!--- End Home Section -->

<div id="title-heading">
<div class="row">
	<div class="col-12 os-animation" data-animation="fadeInLeft">
	<h3>Καλώς ήλθατε, <?php echo $_SESSION['name']; ?></h3>
	<h3>Έχετε εισέλθει ως Διαχειριστής</h3>
	<div class="title-heading-underline">
	</div>
	</div>
</div>
</div>

<div id="features" class="offset">
<!--- Start Jumbotron -->
<div class="jumbotron">


<!--- Start Pricing Columns -->
<div class="container" style="width:100%">
		<br>
		<ul class="nav nav-tabs">
		  <li><a data-toggle="tab" class="nav-link active" href="#manageUsers">Διαχείριση Χρηστών</a></li>
		  <li><a data-toggle="tab" class="nav-link" href="#manageJobs">Διαχείριση Εργασιών</a></li>
		</ul>
		
		<div class="tab-content">
		  <div id="manageUsers" class="tab-pane container active">
			<br>
			<div class="row">
				<div class="col-12 os-animation" data-animation="fadeInLeft">
				<h3>Διαχείριση Χρηστών</h3>
			<div class="title-heading-underline">
			</div>
			</div>
			</div>
			<br>
				<table id="userTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>ID</th>
						<th>privileged</th>
						<th>registrationTime</th>
						<th>name</th>
						<th>surname</th>
						<th>birth</th>
						<th>email</th>
						<th>Modify</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>ID</th>
						<th>privileged</th>
						<th>registrationTime</th>
						<th>name</th>
						<th>surname</th>
						<th>birth</th>
						<th>email</th>
						<th>Modify</th>
					</tr>
				</tfoot>
			</table>
		  </div>
		  <div id="manageJobs" class="tab-pane container">
		  	<br>
		 	<div class="row">
				<div class="col-12 os-animation" data-animation="fadeInLeft">
				<h3>Διαχείριση Εργασιών</h3>
			<div class="title-heading-underline">
			</div>
			</div>
			</div>
			<br>
				<button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#addJob" data-record-id="" data-record-title = "" >
				 <span class="glyphicon glyphicon-plus"></span>Πρoσθεσε Εργασiα<font color="#337ab7"></font>
				</button>
			<br><br>
			<table id="jobTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Job Name</th>
						<th>Minimum Temperature</th>
						<th>Maximum Temperature</th>
						<th>Minimum Humidity</th>
						<th>Maximum Humidity</th>
						<th>Minimum Wind Speed</th>
						<th>Maximum Wind Speed</th>
						<th>Modify</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>Job Name</th>
						<th>Minimum Temperature</th>
						<th>Maximum Temperature</th>
						<th>Minimum Humidity</th>
						<th>Maximum Humidity</th>
						<th>Minimum Wind Speed</th>
						<th>Maximum Wind Speed</th>
						<th>Modify</th>
					</tr>
				</tfoot>
			</table>
		  </div>
		</div>
		
	
	</div>
<!--- End Pricing Columns -->


</div>
</div>
<!--- End Jumbotron -->


<!--- End of Pricing Section -->

<!--- Start Contact Section -->
<div id="contact" class="offset">

<footer>
<div class="row text-center">

	<div class="col-md-4">
		<img src="img/wetec.png" alt="">
		<p>Στόχος μας είναι η παροχή βοήθειας στον επαγγελματία που θέλει να προγραμματίσει τις τεχνικές εργασίες της εταιρίας του με κριτήριο τις καιρικές συνθήκες που επικρατούν σε μια περιοχή.</p>
	</div>

	<div class="col-md-4">
		<h3 class="text-center">Στοιχεια επικοινωνιασ</h3>
		<strong>Our Location</strong>
		<p>100 Street Name<br/>Our City, AA 10000</p>
		<strong>Contact Info</strong>
		<p>(888) 888-8888<br>email@wetec.com</p>
	</div>

	<div class="col-md-4">
		<h3 class="text-center">ΕΠΙΚΟΙΝΩΝΕΙΣΤΕ ΜΑΖΙ ΜΑΣ</h3>
		<a href="#"><i class="fab fa-facebook-square"></i></a>
		<a href="#"><i class="fab fa-twitter-square"></i></a>
		<a href="#"><i class="fab fa-instagram"></i></a>
		<a href="#"><i class="fab fa-reddit-square"></i></a>
		<a href="#"><i class="fab fa-linkedin"></i></a>
		<br><br>
	</div>

	<hr class="socket">
	&copy; WeTec.

</div> <!--- End of Row -->
</footer> <!--- End of Footer -->

</div>
<!--- End of Contact Section -->

<!--- Top Scroll -->
<a href="#home" class="top-scroll">
	<i class="fas fa-angle-up"></i>
</a>
<!--- End of Top Scroll -->

<!--- Script Source Files -->
<script src="https://use.fontawesome.com/releases/v5.10.2/js/all.js"></script>
<script src="js/custom.js"></script>
<script src="js/jquery.waypoints.min.js"></script>
<script src="js/waypoints.js"></script>
<script src="js/lightbox.js"></script>
<script src="js/owl.carousel.js"></script>
<script src="js/jquery.counterup.js"></script>
<script src="js/validator.js"></script>


<!--- End of Script Source Files -->

</body>
</html>

<script>	
	$('#userTable').DataTable( {
 		"scrollX": true,
        "pagingType": "full_numbers",
        "order": [[ 0, "desc" ]],
        "processing": true,
        "serverSide": true,
        "ajax": "fetchUsersAdmin.php",
    } );
	
	// initialize tab only one time!! -- this prevent for warning issue with Datatables
	var firstTimeJobInitialization = false;
	$("a[href='#manageJobs']").on('shown.bs.tab', function(e) {
		if(firstTimeJobInitialization == true){
			return;
		}
		firstTimeJobInitialization = true;
		$('#jobTable').DataTable( {
			"scrollX": true,
			"pagingType": "full_numbers",
			"order": [[ 0, "desc" ]],
			"processing": true,
			"serverSide": true,
			"ajax": "fetchJobsAdmin.php",
		} );
	});
	
	$('#modalShowWeather').on('show.bs.modal', function(e) {
		var data = $(e.relatedTarget).data();
		$(e.currentTarget).find('input[name="userID"]').val(data.recordId);
	});
	
	$('#deleteUser').on('show.bs.modal', function(e) {
		var data = $(e.relatedTarget).data();
		$('.title', this).text(data.recordTitle);
		$(e.currentTarget).find('input[name="userID"]').val(data.recordId);
	});
	
	$('#deleteJob').on('show.bs.modal', function(e) {
		var data = $(e.relatedTarget).data();
		$('.title', this).text(data.recordTitle);
		$(e.currentTarget).find('input[name="jobID"]').val(data.recordId);
	});

	$('#editUser').on('show.bs.modal', function(e) {
		var data = $(e.relatedTarget).data();
		var weatherData = data.recordTitle;
		var mySplitResult;
        mySplitResult = weatherData.split("#delimiter#");
		
		var isAdmin = mySplitResult[0].localeCompare("1");
		if (isAdmin == 0)
		  $('#privileged').bootstrapToggle('on');
		else
		  $('#privileged').bootstrapToggle('off');
		
		$(e.currentTarget).find('input[name="name"]').val(mySplitResult[1]);
		$(e.currentTarget).find('input[name="surname"]').val(mySplitResult[2]);
		$(e.currentTarget).find('input[name="birth"]').val(mySplitResult[3]);
		$(e.currentTarget).find('input[name="email"]').val(mySplitResult[4]);
		$(e.currentTarget).find('input[name="userID"]').val(data.recordId);
	});

	$('#editJob').on('show.bs.modal', function(e) {
		var data = $(e.relatedTarget).data();
		var weatherData = data.recordTitle;
		var mySplitResult;
        mySplitResult = weatherData.split("#delimiter#");
		
		$(e.currentTarget).find('input[name="jobName"]').val(mySplitResult[0]);
		$(e.currentTarget).find('input[name="minTemp"]').val(mySplitResult[1]);
		$(e.currentTarget).find('input[name="maxTemp"]').val(mySplitResult[2]);
		$(e.currentTarget).find('input[name="minHumidity"]').val(mySplitResult[3]);
		$(e.currentTarget).find('input[name="maxHumidity"]').val(mySplitResult[4]);
		$(e.currentTarget).find('input[name="minWindSpeed"]').val(mySplitResult[5]);
		$(e.currentTarget).find('input[name="maxWindSpeed"]').val(mySplitResult[6]);
		$(e.currentTarget).find('input[name="jobID"]').val(data.recordId);
	});
</script>