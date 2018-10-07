<?php 
ini_set('display_errors',1);
error_reporting(E_ALL);

session_start(); 

if (isset($_SESSION['userid'])){
	$userid = $_SESSION['userid'];
}else {
	$userid = '';
}

if (isset($_SESSION['role'])){
	$role = $_SESSION['role'];
}else {
	$role = '';
}

	// variable declaration
	$username = "";
	$email    = "";
	$errors = array(); 
	$msgs = array(); 
	$_SESSION['success'] = "";

	// connect to database
	$db = mysqli_connect('localhost', 'root', 'root', 'vu');


	// generic db select function
	function data_select ($where = '1', $from='cakes', $select = '*') {
		$sql = "SELECT $select FROM $from WHERE $where";
		$data_select_result = mysqli_query($GLOBALS['db'], $sql);
		if (mysqli_num_rows($data_select_result) > 0) {
			return $data_select_result;
		} else {
			return $data_select_result = false;
		}
	}

	// generic db delete function
	if (isset($_GET['delete'])) {
		$from = $_GET['from'];
		$where = $_GET['where'];
		$sql = "DELETE from $from where $where";
		$delete_product = mysqli_query($db, $sql);
		array_push($msgs, "Required $where has been Deleted");
	}



	function orders () {
		$userid = $GLOBALS['userid'];
		if($GLOBALS['role']){	
			$where = 'where 1';
		}else {
			$where = "WHERE ord.order_user_id = $userid";
		}

		$sql = "SELECT * 
				FROM orders ord
				JOIN users usr
				ON ord.order_user_id = usr.id
				JOIN cakes ck
				ON ord.order_cake_id = ck.cake_id
				$where";

		$data_select_result = mysqli_query($GLOBALS['db'], $sql);
		if (mysqli_num_rows($data_select_result) > 0) {
			return $data_select_result;
		} else {
			return $data_select_result = false;
		}
	}




	// REGISTER USER
	if (isset($_POST['reg_user'])) {
		// receive all input values from the form
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

		// form validation: ensure that the form is correctly filled
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }

		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database
			$query = "INSERT INTO users (username, email, password) 
					  VALUES('$username', '$email', '$password')";

			if (mysqli_query($db, $query)) {
				$_SESSION['userid'] = $db->insert_id;
				$_SESSION['username'] = $username;
				$_SESSION['success'] = "You are now logged in";
				array_push($msgs, "User Has been Created");
			} else {
				array_push($errors, mysqli_error($db));
				array_push($errors, $sql);
			}
		}

	}


	// LOGIN USER
	if (isset($_POST['login_user'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			$password = md5($password);
			$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) {
			    while($row = $results->fetch_assoc()) {
			    	$userid = $row['id'];	
			    }
				$_SESSION['userid'] = $userid;
				if($userid == 1) {
					$_SESSION['role'] = 1;
				}
				$_SESSION['username'] = $username;
				$_SESSION['success'] = "You are now logged in";
				header('location: index.php');
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}

	if (isset($_POST['cake_insert'])) {
		$cake_name = mysqli_real_escape_string($db, $_POST['cake_name']);
		$cake_category = mysqli_real_escape_string($db, $_POST['cake_category']);
		$cake_price = mysqli_real_escape_string($db, $_POST['cake_price']);
		$cake_pic = $_FILES['cake_pic'];
		$cake_description = mysqli_real_escape_string($db, $_POST['cake_des']);


		// form validation: ensure that the form is correctly filled
		if (empty($cake_name)) { array_push($errors, "Cake Name is required"); }
		if (empty($cake_category)) { array_push($errors, "Cake Category is required"); }
		if (empty($cake_pic)) { array_push($errors, "Cake Picture is required"); }
		if (empty($cake_price)) { array_push($errors, "Cake Price is required"); }


		$target_dir = "uploads/";
		$target_file = $target_dir . basename($_FILES["cake_pic"]["name"]);
		$uploadOk = 0;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
	    $check = getimagesize($_FILES["cake_pic"]["tmp_name"]);
	    if($check !== false) {
	        $uploadOk = 1;
	    } else {
	    	array_push($errors, "File is not an image.");
	        $uploadOk = 0;
	    }

	    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
	    	array_push($errors, "Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
		    $uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
	    	array_push($errors, "Sorry, your file was not uploaded.");
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($_FILES["cake_pic"]["tmp_name"], $target_file)) {
		        // echo "The file ". . " has been uploaded.";
		    } else {
		    	array_push($errors, "Sorry, there was an error uploading your file.");
		    }
		}

		
		$cake_pic = basename( $_FILES["cake_pic"]["name"]);


		// register user if there are ncake_updateo errors in the form
		if (count($errors) == null) {
			
			$sql = '';
			if(isset($_POST['cake_update']))
			{
				$sql = "UPDATE `cakes` SET `cake_name` = '$cake_name', `cake_category` = '$cake_category', `cake_price` = $cake_price, `cake_description` = '$cake_description', `cake_pic` = '$cake_pic' WHERE `cake_id`= ".$_POST['cake_update'];
			}else{
				$sql = "INSERT INTO `cakes` 
				(`cake_name`, `cake_category`, `cake_price`, `cake_description`, `cake_pic`) 
				VALUES 
				('$cake_name','$cake_category','$cake_price', '$cake_description', '$cake_pic')";
			}
	
			if (mysqli_query($db, $sql)) {
				array_push($msgs, "New record created successfully");
				header('location: index.php');

			} else {
				array_push($errors, mysqli_error($db));
				array_push($errors, $sql);
			}

		}
	}


	if (isset($_GET['order_cake_id'])) {
		
		if (!isset($_SESSION['userid'])){
			header('location: index.php');
		}

		$order_cake_id = $order_user_id = $order_cake_size = $order_cake_status_admin = $order_cake_status_user = '';

		$order_cake_id = mysqli_real_escape_string($db, $_GET['order_cake_id']);
		$order_user_id = $_SESSION['userid'];

		if(isset($_GET['orderinsert'])){
			$sql = "INSERT INTO `orders` 
			(`order_cake_id`, `order_user_id`) 
			VALUES 
			($order_cake_id, $order_user_id)";
		}elseif(isset($_GET['orderupdate'])) {
			$order_id = mysqli_real_escape_string($db, $_GET['order_id']);
			if(isset($_GET['order_cake_status_user']) && $_GET['order_cake_status_user'] == 'on'){
				$order_cake_status_user = 1;
			}else {
				$order_cake_status_user = 0;
			}

			if(isset($_GET['order_cake_status_admin']) && $_GET['order_cake_status_admin'] == 'on'){
				$order_cake_status_admin = 1;
			}else {
				$order_cake_status_admin = 0;
			}

			if(!empty($_GET['order_cake_size'])){
				$order_cake_size = $_GET['order_cake_size'];
			}else {
				$order_cake_size = 1;
			}

			if($role == 1){
				$sql = "UPDATE `orders` SET `order_user_id`='$order_user_id',`order_cake_size`=$order_cake_size,`order_cake_status_admin`= $order_cake_status_admin,`order_cake_status_user`='$order_cake_status_user' WHERE `order_id` =". $order_id;
			}else{
				$sql = "UPDATE `orders` SET `order_cake_size`='$order_cake_size',`order_cake_status_user`='$order_cake_status_user' WHERE `order_id` =". $order_id;
			}

		}

		if (mysqli_query($db, $sql)) {
			array_push($msgs, "Order Has Been Added/Updated");
			header('location: cart.php');
		} else {
			array_push($errors, mysqli_error($db));
			array_push($errors, $sql);
		}
	}
?>