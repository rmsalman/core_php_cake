<?php require 'includes/header.php'; ?>
<h2>Home Page</h2>
	<?php include('errors.php'); ?>

<div class="content">	
	<!-- logged in user information -->
	<?php  if (isset($_SESSION['username'])) : ?>
		<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
		<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
	<?php endif ?>

<?php
$result = data_select();
if($result !== false){
?>
<div class="row ">
<?php
while($row = mysqli_fetch_assoc($result)) {
?>
	<div class="col-sm-4">
		<article class="card cake">
			<img src="uploads/<?= $row["cake_pic"]; ?>" alt="<?= $row["cake_name"]; ?>" class="card-img-top">
			<div class="card-body">
				<h5 class="card-title"><?= $row["cake_name"]; ?> <small class="float-right"><?= $row["cake_price"] ?></small></h5>
				<div class="card-text"><?= $row["cake_category"]; ?></div>

				<div class="card-text"><?= $row["cake_description"]; ?></div>
				<a href="#" class="btn btn-primary">Add to Cart</a>
				<a href="insert_cake.php?id=<?= $row["cake_id"]?>" class="btn btn-info">Edit</a>
				<a href=/fyp?delete&from=cakes&where=cake_id=<?= $row["cake_id"]?> class="btn btn-danger">Delete</a>
			</div>
		</article>
		<br>
	</div>
<?php
}



?>	

<span class="clearfix"></span>
</div>
<?php

}
else {
	echo '<h4 class="text-center">Sorry Nothing Found</h4>';
}
?>	



</div>
	
<?php require 'includes/footer.php'; ?>