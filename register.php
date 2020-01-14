<?php
	include './definitions.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>WeTec - Εγγραφή</title>
	<link rel="shortcut icon" href="img/favicon.png">
	<link rel="stylesheet" href="bootstrap-4.3.1-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/lightbox.css">
	<link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.default.css">
	<link rel="stylesheet" href="css/arrow.css">
	<link rel="stylesheet" href="css/fixed.css">
	<link rel="stylesheet" href="css/waypoints.css">
</head>
<body>

<!--- Start Home section -->
<div id="home" class="offset">

<!--- Navigation -->
<nav class="navbar navbar-expand-md fixed-top always-solid">
<div class="container-fluid">
	<a class="navbar-brand" href="index.php"><img src="img/wetec.png" alt=""></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
		<span class="custom-toggler-icon"><i class="fas fa-bars"></i></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarResponsive">
		<ul class="navbar-nav ml-auto">
			<li class="nav-item">
				<a class="nav-link" href="index.php">ΑΡΧΙΚΗ</a>
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
	<h3 class="title-heading">Εγγραφη</h3>
	<div class="title-heading-underline">
	</div>
	</div>
</div>
</div>

<div id="features" class="offset">
<!--- Start Jumbotron -->
<div class="jumbotron">
<div class="narrow">




	<div class="row">
	<div class="col-md-6 col-lg-4">
	</div>	
	<div class="col-md-6 col-lg-4">
		<div class="os-animation" data-animation="fadeInUp">
		<div class="feature">
        <div class="form-group">
                <form action="registerService.php" method="POST">
                    <input id="name" class="form-control" name="name" type="text" placeholder="Name" required>
                    <input id="surname" class="form-control" name="surname" type="text" placeholder="Surname" required>
                    <input id="email" class="form-control" name="email" type="email" placeholder="Email" required>
					<input id="password" class="form-control" name="password" type="password" placeholder="Password" required>
					<input id="birth" class="form-control" name="birth" type="date" placeholder="Birth date" required>
					 <br><br> 
					  <a align="justify" href="<?php echo "$domain/index.php" ?>">Εάν έχετε ήδη λογαριασμό ακολουθήστε το link!</a> 
					 <br><br>
                    <button class="btn btn-turquoise btn-sm" type="submit">Εγγραφη</button>
                </form>
        </div>
    	</div>
		</div>
	</div>
    <div class="col-md-6 col-lg-4">
	</div>
	</div>

</div> <!--- End Narrow -->
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
<script src="js/jquery-3.3.1.min.js"></script>
<script src="bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
<script src="https://use.fontawesome.com/releases/v5.10.2/js/all.js"></script>
<script src="js/custom.js"></script>
<script src="js/jquery.waypoints.min.js"></script>
<script src="js/waypoints.js"></script>
<script src="js/lightbox.js"></script>
<script src="js/owl.carousel.js"></script>
<script src="js/jquery.counterup.js"></script>
<script src="js/validator.js"></script>
<script src="js/contact.js"></script>
<!--- End of Script Source Files -->

</body>
</html>