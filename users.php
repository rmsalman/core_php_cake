<?php require 'includes/header.php'; ?>
<h2 class="text-center">Users</h2>
<br>

<?php 
if(!$role){
		echo '<meta http-equiv="refresh" content="0;url=/fyp/">';
	}
?>

<table class="table table-striped">
	<thead>
		<tr>
			<th>User #ID</th>
			<th>UserName</th>
			<th>Email</th>
			<th>Action</th>
			<th>Created On</th>
		</tr>
	</thead>
	<tbody>
<?php
$result = data_select('1', 'users');
if($result !== false){
	while($row = mysqli_fetch_assoc($result)) {
?>
<tr>
	<td><?= $row['id'] ?></td>
	<td><?= $row['username'] ?></td>
	<td><?= $row['email'] ?></td>
	<td><?= $row['created_at'] ?></td>
	<td><a class="btn btn-danger" href="/fyp/users.php?delete=1&from=users&where=id=<?= $row['id'] ?>">Delete user</a></td>
</tr>
<?php 
	}

	}else {?>
<tr>
	<td colspan="10" align="center">No Result Found</td>
</tr>
<?php 
} ?>

	</tbody>
</table>
	
<?php require 'includes/footer.php'; ?>