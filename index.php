<?php require 'includes/header.php'; ?>
<h2 class="text-center">Home Page</h2>
<br>
<div class="content">	

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
						<h5 class="card-title"><?= $row["cake_name"]; ?> <small class="float-right"><strong>Pkr.<?= $row["cake_price"] ?></strong></small></h5>
						<div class="card-text"><?= $row["cake_category"]; ?></div>
						<div class="card-text"><?= $row["cake_description"]; ?></div>
						<a  class="btn btn-primary"
							<?php  if (!isset($_SESSION['username'])) : ?>
								href="#" data-toggle="modal" data-target="#signIn" data-whatever="@getbootstrap"
							<?php else : ?>
								href="/fyp/cart.php?orderinsert&order_cake_id=<?= $row["cake_id"]; ?>"
							<?php endif ?>
						>Add to Cart</a>

					<?php 
					   	if($role){
					?>
						<a href="insert_cake.php?id=<?= $row["cake_id"]?>" class="btn btn-info">Edit</a>
						<a href=/fyp?delete&from=cakes&where=cake_id=<?= $row["cake_id"]?> class="btn btn-danger">Delete</a>
					<?php } ?>
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