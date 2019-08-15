<?php
session_start();
if(isset($_SESSION["uid"])){
	header("location:profile.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/bootstrap.min.css"/>
		<script src="js/jquery2.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="main.js"></script>
		<script src="js/edit.js"></script>
		  <script
  src="https://code.jquery.com/jquery-3.1.1.js"
  integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="
  crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body{
	
;


	
	
}

.textediting{
	margin-left:560px;
	margin-top:100px;
	color:black;

;

}
#Click{
	text-decoration:none;
	margin-left:650px;
	background-color:#006699;
	padding:10px;
	color:white;
}

#image_slide{
	margin-left:50px;
	
}
.par_editing{
	margin-left:55px;
	font-family: Arial;
	
	color:black;

	
	
	
}

</style>
</head>
<body>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">	
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse" aria-expanded="false">
					<span class="sr-only">navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="#" class="navbar-brand">PaisaVasool</a>
			</div>
		<div class="collapse navbar-collapse" id="collapse">
			<ul class="nav navbar-nav">
				<li><a href="index.php"><span class="glyphicon glyphicon-home"></span>Home</a></li>
				<li><a href="product.php"><span class="glyphicon glyphicon-modal-window"></span>Products</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				
					<div class="dropdown-menu" style="width:400px;">
						<div class="panel panel-success">
							<div class="panel-heading">
								<div class="row">
									<div class="col-md-3">Sl.No</div>
									<div class="col-md-3">Product Image</div>
									<div class="col-md-3">Product Name</div>
									<div class="col-md-3">Price in $.</div>
								</div>
							</div>
							<div class="panel-body"></div>
							<div class="panel-footer"></div>
						</div>
					</div>
				</li>
				<li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span>SignIn</a>
					<ul class="dropdown-menu">
						<div style="width:300px;">
							<div class="panel panel-primary">
								<div class="panel-heading" id="display_login">Login</div>
								<small  color="red"> </small>
								<div class="panel-heading">
									<label for="email">Email</label>
									<input type="email" class="form-control" id="email" required/>
									<label for="email">Password</label>
									<input type="password" class="form-control" id="password" required/>
									<p><br/></p>
									<input type="submit" class="btn btn-success" style="float:right;" id="login" value="Login">
									
								</div>
								<div class="panel-footer" id="e_msg"></div>
							</div>
						</div>
					</ul>
				</li>
				<li><a href="customer_registration.php"><span class="glyphicon glyphicon-user"></span>SignUp</a></li>
			</ul>
		</div>
	</div>
</div>

    
<h1 class="textediting"> Welcome to PaisaVasool</h1>
<img name="slide" id="image_slide" width="93%" height="400">

<h2 class="par_editing"> Where you get to experience exclusive items to shop we have a wide variety of items for you to shop.<br>
						Ranging from electronic to clothing,home appliances etc.</h2>
	<a href="product.php" id="Click"> Go Shopping </a>
</body>
<script>
	var i = 0; // Start point
	var images = [];
	var time = 3000;

	// Image List
	images[0] = 'watches.jpg';
	images[1] = 'denim.jpg';
	images[2] = 'appliance.jpg';
	images[3] = 'watches.jpg';

	// Change Image
	function changeImg(){
		document.slide.src = images[i];

		if(i < images.length - 1){
			i++;
		} else {
			i = 0;
		}

		setTimeout("changeImg()", time);
	}

	window.onload = changeImg;

</script>
</html> 
