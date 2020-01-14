<?php

	// function checking if weather data is valid based on selected job
	// main is main object of API
	function matchesConditions($main, $minTemp, $maxTemp, $minHumidity, $maxHumidity, $weatherDescription, $wind, $minWindSpeed, $maxWindSpeed){
		if(
			$main->temp_min >= $minTemp && $main->temp_min <= $maxTemp &&
			$main->temp_max >= $minTemp && $main->temp_max <= $maxTemp &&
			$main->humidity >= $minHumidity && $main->humidity <= $maxHumidity &&
			$wind->speed >= $minWindSpeed && $wind->speed <= $maxWindSpeed &&
			strpos($weatherDescription, "rain") === FALSE &&
			strpos($weatherDescription, "snow") === FALSE
		){
			return true;
		}else{
			return false;
		}
	}

	include './definitions.php';
	session_start();
	$now = time(); // Checking the time now when home page starts.
	if ($now > $_SESSION['expire'] || !isset($_SESSION['name'])) {
		session_destroy();
		header("Location: $domain/index.php");
	}

	// get restrictions for API
	$jobID = $_POST["jobID"];
	$minTemp = 0.0;
	$maxTemp = 0.0;
	$minHumidity = 0.0;
	$maxHumidity = 0.0;
	$minWindSpeed = 0.0;
	$maxWindSpeed = 0.0;
	$result = mysqli_prepare($connectionDB, "SELECT `minTemp`, `maxTemp`, `minHumidity`, `maxHumidity`, `minWindSpeed`, `maxWindSpeed`  FROM `jobs` WHERE `ID` = ?;");
	mysqli_stmt_bind_param($result, 'i', $jobID);
	mysqli_stmt_execute($result);
	mysqli_stmt_bind_result($result, $minTemp, $maxTemp, $minHumidity, $maxHumidity, $minWindSpeed, $maxWindSpeed);
	while(mysqli_stmt_fetch($result))
	{
		$minTemp = $minTemp;
		$maxTemp = $maxTemp;
		$minHumidity = $minHumidity;
		$maxHumidity = $maxHumidity;
		$minWindSpeed = $minWindSpeed;
		$maxWindSpeed = $maxWindSpeed;
	}
	mysqli_stmt_close($result);
					
	$weatherResponse = "{
		\"cod\": \"404\",
		\"message\":\"Unexpected Error\"
	}"; // invalid response
	$queryParam = $_POST['queryParam']; 
	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://api.openweathermap.org/data/2.5/forecast?q=".$queryParam."&appid=e8442c998e682b121995edb9d6fc1263&units=metric",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "GET"
	));
	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
	if ($err) {
	  echo "cURL Error #:" . $err;
	  $weatherResponse = json_decode($weatherResponse);
	} else {
	  $weatherResponse = json_decode($response);
	}
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>WeTec - Εγγραφή</title>
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
		function addFavorite(){
			if (confirm('Είστε σίγουροι ότι θέλετε να αποθηκεύσετε την επιλογή σας?')){
			<?php
				// ADD in favorite
			?>
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

	<div class="modal fade" id="modalFavoriteForm" tabindex="-1" role="dialog "
	aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close"
					   data-dismiss="modal">
						   <span aria-hidden="true">&times;</span>
						   <span class="sr-only">Ακύρωση</span>
					</button>
					<font size='3'><font color='#388DC9'>Αποθήκευση</font></font>
				</div>
		<div class="modal-body">
			<form action="addFavoriteService.php" method="POST" role="form" enctype="multipart/form-data">
				<div class="form-group">
					  <br><label for="exampleInputEmail1">Προσθέστε Περιγραφή</label>
						<input type="text" class="form-control"
						id="keyword" placeholder="Περιγραφή" name="keyword"  required="required" value=""/>
						<input type="hidden" class="form-control" id="userID" name="userID" value= "" />
						<input type="hidden" class="form-control" id="weatherDateTime" name="weatherDateTime" value= "" />
						<input type="hidden" class="form-control" id="minTemp" name="minTemp" value= "" />
						<input type="hidden" class="form-control" id="maxTemp" name="maxTemp" value= "" />
						<input type="hidden" class="form-control" id="pressure" name="pressure" value= "" />
						<input type="hidden" class="form-control" id="humidity" name="humidity" value= "" />
						<input type="hidden" class="form-control" id="icon" name="icon" value= "" />
						<input type="hidden" class="form-control" id="weatherDescription" name="weatherDescription" value= "" />
						<input type="hidden" class="form-control" id="windSpeed" name="windSpeed" value= "" />
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
		<ul class="navbar-nav ml-auto">
			<li class="nav-item">
				<a href="home.php" class="nav-link">ΑΡΧΙΚΗ</a>
			</li>
		</ul>
	</div>
</div>
</nav>
<!--- End Navigation -->

</div>
<!--- End Home Section -->

<div id="title-heading">
<div class="row">
	<div class="col-12 os-animation" data-animation="fadeInLeft">
	<h3><?php echo $_SESSION['name']; ?> τα αποτελέσματα σας!</h3>
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
		<br><br>
		<?php
			if($weatherResponse->cod=="200"){
		?>

		<div class="row">
			<div class="col-12 os-animation" data-animation="fadeInLeft">
			<h3>5ήμερη Πρόγνωση</h3>
			<div class="title-heading-underline">
			</div>
			</div>
		</div>
		<br>
			<table id="newWeatherTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Date and Time</th>
						<th>Minimum Temperature</th>
						<th>Maximum Temperature</th>
						<th>Pressure(hPa)</th>
						<th>Humidity</th>
						<th>Weather</th>
						<th>Wind Speed (meter/sec)</th>
						<th>Add to Favorite</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$list = $weatherResponse->list;
					for($index = 0; $index < count($list); $index++) {
						$main = $list[$index]->main;
						$weather = $list[$index]->weather;
						$wind = $list[$index]->wind;
						if(!matchesConditions($main, $minTemp, $maxTemp, 
						$minHumidity, $maxHumidity, $weather[0]->description,
						$wind, $minWindSpeed, $maxWindSpeed)){
							// invalid weather go to next iteration 
							continue;
						}
						echo "<tr>";
							echo "<td>".$list[$index]->dt_txt."</td>";
							echo "<td>".$main->temp_min." °C"."</td>";
							echo "<td>".$main->temp_max." °C"."</td>";
							echo "<td>".$main->pressure."</td>";
							echo "<td>".$main->humidity."</td>";
							echo "<td><img src=\"http://openweathermap.org/img/wn/".$weather[0]->icon."@2x.png\" alt=\"-\"><br>".$weather[0]->description."</td>";
							echo "<td>".$wind->speed."</td>";
							echo "<td>";
						?>
								<button class="btn btn-info" data-toggle="modal" data-target="#modalFavoriteForm" data-record-id="<?php echo $_SESSION['id']; ?>" 
								data-record-title = "<?php echo $list[$index]->dt_txt."#"
															.$main->temp_min."#"
															.$main->temp_max."#"
															.$main->pressure."#"
															.$main->humidity."#"
															.$weather[0]->icon."#"
															.$weather[0]->description."#"
															.$wind->speed;?>" >
									 <i class="fas fa-cloud-download-alt"></i> Αποθήκευση<font color="#337ab7"></font>
								</button>
						<?php
							echo "</td>";
						echo "</tr>";
					}
					?>
				</tbody>
				<tfoot>
					<tr>
						<th>Date and Time</th>
						<th>Minimum Temperature</th>
						<th>Maximum Temperature</th>
						<th>Pressure(hPa)</th>
						<th>Humidity</th>
						<th>Weather</th>
						<th>Wind Speed (meter/sec)</th>
						<th>Add to Favorite</th>
					</tr>
				</tfoot>
			</table>
		<?php
		}else{
			?>
			<h3>API ERROR with message:</h3><br>
			<?php
			echo $weatherResponse->message;
		}
		
		?>
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
	$('#newWeatherTable').DataTable( {
        "pagingType": "full_numbers",
        "order": [[ 0, "asc" ]]
    } );
	
	$('#modalFavoriteForm').on('show.bs.modal', function(e) {
		var data = $(e.relatedTarget).data();
		var weatherData = data.recordTitle;
		var mySplitResult;
        mySplitResult = weatherData.split("#");
		$(e.currentTarget).find('input[name="weatherDateTime"]').val(mySplitResult[0]);
		$(e.currentTarget).find('input[name="minTemp"]').val(mySplitResult[1]);
		$(e.currentTarget).find('input[name="maxTemp"]').val(mySplitResult[2]);
		$(e.currentTarget).find('input[name="pressure"]').val(mySplitResult[3]);
		$(e.currentTarget).find('input[name="humidity"]').val(mySplitResult[4]);
		$(e.currentTarget).find('input[name="icon"]').val(mySplitResult[5]);
		$(e.currentTarget).find('input[name="weatherDescription"]').val(mySplitResult[6]);
		$(e.currentTarget).find('input[name="windSpeed"]').val(mySplitResult[7]);
		$(e.currentTarget).find('input[name="userID"]').val(data.recordId);
	});
</script>
