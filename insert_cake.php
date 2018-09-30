<?php include('includes/header.php'); ?>
<h2>Insert Cakes</h2>

<?php 
$cake_name = $cake_pic = $cake_category = $cake_price = $cake_des = '';

if(isset($_GET['id']))
{
	$result = data_select('cake_id = '.$_GET['id']);

	if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			// print_r($row);
		$cake_id = $row['cake_id'];
		$cake_name = $row['cake_name'];
		$cake_pic = $row['cake_pic'];
		$cake_category = $row['cake_category'];
		$cake_price = $row['cake_price'];
		$cake_des = $row['cake_description'];
		}
	}
}
?>

	<form class="form" action="insert_cake.php" method="POST" enctype="multipart/form-data">
	<?php include('errors.php'); ?>
	
	  <div class="form-group">
	    <label for="exampleInputEmail1">Cake Name</label>
	    <input type="text" name="cake_name" value="<?= $cake_name; ?>" class="form-control" id="exampleInputEmail1" placeholder="Cake Name">
	  </div>
	  <div class="form-group">
	    <label for="exampleInputPassword1">Cake Category</label>
	    <select name="cake_category" class="form-control" id="exampleInputPassword1">
	    	<option value="Birthday">Birthday Cake</option>
	    	<option value="Eid">Eid Cake</option>
	    	<option value="Wedding">Wedding Cake</option>
	    </select>
	  </div>
	  <div class="form-group">
	    <label for="exampleInputPassword12">Cake Price (pkr)</label>
	    <input type="number" value="<?= $cake_price; ?>" class="form-control" name="cake_price" id="exampleInputPassword12" placeholder="Cake Price">
	  </div>
	  <div class="form-group">
	    <label for="cake_pic">Cake Picture</label>
	    <input type="file" required="required" name="cake_pic" id="cake_pic">
	  </div>
	  <div class="form-group">
	    <label for="exampleInputPassword124">Cake Description</label>
	    <textarea class="form-control" name="cake_des" id="exampleInputPassword124" placeholder="Add Description"><?= $cake_des; ?></textarea>
	  </div>
	
		<?php 
		if(isset($_GET['id']))
		{
		?>
			<input type="hidden" name="cake_update" value="<?= $cake_id ?>">
		<?php 
		} 
		?>
	  <button type="submit" name="cake_insert" class="btn btn-primary">Submit</button>
	</form>

</div>

<?php include('includes/footer.php'); ?>		