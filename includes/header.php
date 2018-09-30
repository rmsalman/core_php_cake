<?php include('server.php');
// if (!isset($_SESSION['username'])) {
	// 	$_SESSION['msg'] = "You must log in first";
	// 	header('location: login.php');
	// }

	// if (isset($_GET['logout'])) {
	// 	session_destroy();
	// 	unset($_SESSION['username']);
	// 	header("location: login.php");
	// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<title>Home</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <a class="navbar-brand" href="/fyp/">LOGO</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item active">
	        <a class="nav-link" href="/fyp/">Home <span class="sr-only">(current)</span></a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="/fyp/insert_cake.php">Insert Cakes</a>
	      </li>

	    </ul>
	   <!--  <form class="form-inline my-2 my-lg-0">
	      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
	      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
	    </form> -->
		<div class="right ml-5">
				<a href="/fyp/login.php" class="btn btn-info" type="submit">Login</a>
				<a href="/fyp/register.php" class="btn  btn-info" type="submit">Register</a>
		</div>
	  </div>
	</nav>

<!-- notification message -->
<?php if (isset($_SESSION['success'])) : ?>
	<div class="error success" >
		<h3>
			<?php 
				echo $_SESSION['success']; 
				unset($_SESSION['success']);
			?>
		</h3>
	</div>
<?php endif ?>

<div class="container">
<br>