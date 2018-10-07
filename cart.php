<?php require 'includes/header.php'; ?>
<h2 class="text-center">Shoping Cart</h2>
<br>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Order #ID</th>
			<th>User #ID</th>
			<th>Cake Name</th>
			<th>Cake Category</th>
			<th>Cake Size</th>
			<th>Cake Price</th>
			<th>Cake Image</th>
			<th>Purchased On</th>
			<th>Admin Status of Confirmation</th>
			<th>User Status of Confirmation</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
<?php

if($userid == ''){
	echo '<meta http-equiv="refresh" content="0;url=/fyp/">';
}

$result = orders();
if($result !== false){
	while($row = mysqli_fetch_assoc($result)) {
	// print_r($row);
	?>
		<tr>
			<td><?= $row['order_id'] ?></td>
			<td><?= $row['id'] ?></td>
			<td><?= $row['cake_name'] ?></td>
			<td><?= $row['cake_category'] ?></td>
			<td><?= $row['order_cake_size'] ?></td>
			<td><?= $row['cake_price'] ?> x <?= $row['order_cake_size'] ?></td>
			<td><img src="/fyp/uploads/<?= $row['cake_pic'] ?>" alt="cake" class="img-fluid"></td>
			<td><?= $row['order_created_at'] ?></td>
			<td><?= $row['order_cake_status_admin'] ?></td>
			<td><?= $row['order_cake_status_user'] ?></td>
			<td>
				<form method="GET" action="/fyp/cart.php">
					<input type="hidden" name="orderupdate" value="1">
					<input type="hidden" name="order_cake_id" value="<?= $row['order_cake_id'] ?>">
					<input type="hidden" name="order_id" value="<?= $row['order_id'] ?>">
					<div>Size in Pounds: <input type="number" name="order_cake_size" placeholder="Cake size in Pounds" value="<?= $row['order_cake_size'] ?>"></div>
					<div><label for="order_cake_status_user_<?= $row['order_id'] ?>">Confirm Order: <input id="order_cake_status_user_<?= $row['order_id']?>" type="checkbox" name="order_cake_status_user"></label></div>

					<?php if($role){?>
					<div><label for="order_cake_status_admin_<?= $row['order_id'] ?>">Confirm Order as Admin: <input id="order_cake_status_admin_<?= $row['order_id']?>" type="checkbox" name="order_cake_status_admin"></label></div>

					<?php } ?>

					<input type="submit" name="submit" class="btn btn-primary" value="Submit">
				</form>
				<a class="btn btn-danger" href="/fyp/cart.php?delete=1&from=orders&where=order_id=<?= $row['order_id'] ?>">Delete Order</a>
			</td>
		</tr>		
	<?php } ?>
<?php }else {?>
<tr>
	<td colspan="10" align="center">No Result Found</td>
</tr>
<?php 
} ?>
</tbody>
</table>
	
<?php require 'includes/footer.php'; ?>