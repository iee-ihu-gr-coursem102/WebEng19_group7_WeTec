<?php
	include './definitions.php';
	session_start();
	$now = time(); // Checking the time now when home page starts.
	if ($now > $_SESSION['expire'] || !isset($_SESSION['name'])) {
		session_destroy();
		header("Location: $domain/index.php");
	}
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>WeTec - Αρχική Χρήστη</title>
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
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	
	<script>
		function logout(){
			if (confirm('Ειστε σίγουροι ότι θέλετε να αποχωρήσετε?')){
			  window.location = "<?php echo "$domain/logoutService.php"; ?>";
			  return true;
			}else{
			  return false;
			}
		}
	</script>
	
	<style>
		td
		{
			text-align: center;
			vertical-align: middle;
		}
	</style>

	
</head>
<body>
<div class="modal fade" id="modalShowWeather" tabindex="-1" role="dialog "
	aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close"
					   data-dismiss="modal">
						   <span aria-hidden="true">&times;</span>
						   <span class="sr-only">Ακύρωση</span>
					</button>
					<font size='3'><font color='#388DC9'>Εύρεση Κατάλληλης Πρόγνωσης</font></font>
				</div>
	<div class="modal-body">
	<form action="showWeather.php" method="POST" role="form" enctype="multipart/form-data">
	<div class="form-group">
		<br><label text-align="left" for="jobLabel">Επιλέξτε την επιθυμητή εργασία</label><br>
				<select name="jobID">
				<?php
					$result = mysqli_prepare($connectionDB, "SELECT `ID`, `jobName` FROM `jobs`;");
					mysqli_stmt_execute($result);
					mysqli_stmt_bind_result($result, $ID, $jobName);
					while(mysqli_stmt_fetch($result))
					{
						echo "<option value=\"$ID\">$jobName</option>";
					}
					mysqli_stmt_close($result);
				?>
				</select> <br>
		  <br><label for="cityNameLabel">Επιλέξτε Πόλη</label>
			<input type="text" class="form-control"
			id="queryParam" placeholder="Όνομα Πόλης" name="queryParam"  required="required" value=""/>
			<input type="hidden" class="form-control" id="userID" name="userID" value= "" />			
			
		<div class="modal-footer">
			 <button type="button" class="btn btn-default" data-dismiss="modal">Ακύρωση</button>
			 <button type="submit" class="btn btn-primary" target="_blank">Συνέχεια</button>
		</div>
	</div>
	</form>
	</div>
			</div>
		</div>
	</div>
<div class="modal fade" id="deleteFavorite" tabindex="-1" role="dialog "
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
			<p>Είσαστε σίγουροι ότι θέλετε να διαγράψετε τη συγκεκριμένη εργασία? <b><i class="title"></i></b>.</p>
			<p>Θέλετε να προχωρήσετε?</p>
			<form action="deleteFavoriteService.php" method="POST" role="form" enctype="multipart/form-data">
				<div class="form-group">
						<input type="hidden" class="form-control" id="favoriteID" name="favoriteID" value= "" />
					<div class="modal-footer">
						 <button type="button" class="btn btn-default" data-dismiss="modal">Ακύρωση</button>
						 <button type="submit" class="btn btn-primary">Διαγραφή</button>
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
	<div class="title-heading-underline">
	</div>
	</div>
</div>
</div>

<div id="features" class="offset">
<!--- Start Jumbotron -->
<div class="jumbotron">

<div class="container" style="width:100%">
		<br>
		<button type="button" class="btn btn-secondary btn-sm" onclick="logout()">
          <i class="fas fa-sign-out-alt"></i> ΕΞΟΔΟΣ
        </button>
		<button class="btn btn-turquoise btn-sm" data-toggle="modal" data-target="#modalShowWeather" data-record-id="<?php echo $_SESSION['id']; ?>" data-record-title = "" >
			 <i class="fas fa-cloud"></i> Επιλεξτε 5ημερη Προγνωση<font color="#337ab7"></font>
		</button>
		<?php if($_SESSION['privileged'] == 1){ ?>
		 <a href="<?php echo $domain."/admin.php"; ?>" class="btn btn-secondary btn-sm" target="_blank">
		 <span class="fas fa-cog"></span> Διαχειριστης<font color="#337ab7"></font></a> 
		<?php } ?>
		<br><br>

		
			<div class="row">
			<div class="col-12 os-animation" data-animation="fadeInLeft">
			<h3>Αποθηκευμένες Εργασίες</h3>
			<div class="title-heading-underline">
			</div>
			</div>
			</div>
		
		
		<br>
		<table id="favoriteWeatherTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
				<th>Date and Time</th>
				<th>Minimum Temperature</th>
				<th>Maximum Temperature</th>
				<th>Pressure(hPa)</th>
				<th>Humidity</th>
				<th>Weather</th>
				<th>Wind Speed (meter/sec)</th>
				<th>Keyword</th>
				<th>Delete From Favorite</th>
			</tr>
        </thead>
        <tfoot>
            <tr>
				<th>Date and Time</th>
				<th>Minimum Temperature</th>
				<th>Maximum Temperature</th>
				<th>Pressure(hPa)</th>
				<th>Humidity</th>
				<th>Weather</th>
				<th>Wind Speed (meter/sec)</th>
				<th>Keyword</th>
				<th>Delete From Favorite</th>
			</tr>
        </tfoot>
    </table>
	</div>


</div>
</div>
<!--- End Jumbotron -->

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
	$('#favoriteWeatherTable').DataTable( {
        "pagingType": "full_numbers",
        "order": [[ 0, "desc" ]],
        "processing": true,
        "serverSide": true,
        "ajax": "fetchUserFavorites.php",
    } );
	
	$('#modalShowWeather').on('show.bs.modal', function(e) {
		var data = $(e.relatedTarget).data();
		$(e.currentTarget).find('input[name="userID"]').val(data.recordId);
	});
	
	$('#deleteFavorite').on('show.bs.modal', function(e) {
		var data = $(e.relatedTarget).data();
		$('.title', this).text(data.recordTitle);
		$(e.currentTarget).find('input[name="favoriteID"]').val(data.recordId);
	});
</script>