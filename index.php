<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sistem Perintah Kerja Lembur</title>
	<link rel="stylesheet" type="text/css" href="index.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
	<link rel="shortcut icon" href="img/SLPB.png">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
</head>
<body>
	<!-- loader -->
	<div class="bg-loader">
		<div class="loader"></div>
	</div>

	<!-- header -->
	<div class="medsos">
			<ul>
				<li><a href="https://www.facebook.com/polibatamofficial/" target="_blank"><i class="fab fa-facebook"></i></a></li>
				<li><a href="https://www.youtube.com/c/PolibatamTV" target="_blank"><i class="fab fa-youtube"></i></a></li>
				<li><a href="https://twitter.com/polibatam_" target="_blank"><i class="fab fa-twitter"></i></a></li>
				<li><a href="https://www.instagram.com/polibatamofficial/" target="_blank"><i class="fab fa-instagram"></i></a></li>
			</ul>
	</div>
	<header>
        <img src="img/SLpeb.jpg" height="100" width="250" title="Sistem Lembur Polibatam"/> 
			<ul>
            <li class="active logins" style="margin-top : 18px; margin-right:25px "><a href="login.php"><span class="fa fa-lock"></span> Login <span class="sr-only">(current)</span></a></li>
			</ul>
	</header>

	<!-- banner -->
	<section class="banner">
		<h2>SISTEM PERINTAH KERJA LEMBUR</h2>
	</section>

	<!-- about -->
	

	<!-- service -->
	<section class="alip">
		<div class="container">
			<h3>FOLLOW US</h3>
			<div class="box">
				<div class="col-4">
					<div class="icon"><a href="https://www.facebook.com/polibatamofficial/" target="_blank"><i class="fab fa-facebook-f"></i></a></div>
					<h4>Politeknik Negeri Batam</h4>
				</div>
				<div class="col-4">
					<div class="icon"><a href="https://twitter.com/polibatam_" target="_blank"><i href="https://twitter.com/polibatam" class="fab fa-twitter"></a></i></div>
					<h4>Polibatamofficial</h4>
				</div>
				<div class="col-4">
					<div class="icon"><a href="https://www.instagram.com/polibatamofficial/" target="_blank"><i href="https://www.instagram.com/polibatamofficial/" class="fab fa-instagram"></i></a></div>
					<h4>Polibatamofficial</h4>
				</div>
				<div class="col-4">
					<div class="icon"><a href="https://www.youtube.com/c/PolibatamTV" target="_blank"><i href="https://www.youtube.com/c/PolibatamTV" class="fab fa-youtube"></i></a></div>
					<h4>Polibatam TV</h4>
				</div>
			</div>
		</div>
	</section>
	

	<!-- footer -->
	<footer>
		<div class="container">
			<small>Copyright &copy; 2020 - Politeknik Negeri Batam. All Rights Reserved.</small>
		</div>
	</footer>
	<?php include "template/footer.php"; ?> 


	<script type="text/javascript">
		$(document).ready(function(){
			$(".bg-loader").hide();
		})
	</script>
</body>
</html>