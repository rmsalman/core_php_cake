<?php include('server.php');
	// if (!isset($_SESSION['username'])) {
	// 	$_SESSION['msg'] = "You must log in first";
	// 	header('location: login.php');
	// }

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: index.php");
	}
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

			<?php 
			   	if($role){
			?>
		      <li class="nav-item active">	
		        <a class="nav-link" href="/fyp/insert_cake.php">Insert Cakes</a>
		      </li>
			  <li class="nav-item active">	
		        <a class="nav-link" href="/fyp/users.php">Users</a>
		      </li>
			<?php } ?>

			<?php 
			   	if($userid){
			?>
			  <li class="nav-item active">	
		        <a class="nav-link" href="/fyp/cart.php">Cart</a>
		      </li>
		  <?php } ?>
	    </ul>
	    
		<div class="right ml-5">
	    <?php 
	    	if($userid){
	    ?>
				<a href="/fyp?logout" class="btn btn-info">Logout</a>
		<?php }else { ?>
				<a href="#" class="btn btn-info" data-toggle="modal" data-target="#signIn" data-whatever="@getbootstrap">Login</a>
				<a href="#" class="btn  btn-info"  data-toggle="modal" data-target="#signUp" data-whatever="@getbootstrap">Register</a>
		<?php } ?>
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

<div class="modal fade" id="signIn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	    <form action="" method="POST" id="login">
			<?php include('errors.php'); ?>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Username:</label>
            <input type="text" name="username" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Password:</label>
			<input type="password" name="password" class="form-control">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary"  name="login_user" form="login">Login</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="signUp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	    <form action="" method="POST" id="signUps">
			<?php include('errors.php'); ?>
			<div class="form-group">
				<label for="recipient-name" class="col-form-label">Username:</label>
				<input type="text" name="username" value="<?php echo $username; ?>" class="form-control">
			</div>
			<div class="form-group">
				<label for="message-text" class="col-form-label">Email:</label>
				<input type="email" name="email" value="<?php echo $email; ?>" class="form-control">
			</div>

			<div class="form-group">
				<label class="col-form-label">Password</label>
				<input type="password" name="password_1" class="form-control">
			</div>
			<div class="form-group">
				<label class="col-form-label">Confirm password</label>
				<input type="password" name="password_2" class="form-control">
			</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary" name="reg_user" form="signUps">SignUp</button>
      </div>
    </div>
  </div>
</div>

<div class="container">
<?php include('errors.php'); ?>
<br>
