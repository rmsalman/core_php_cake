<?php  if (count($errors) > 0) : ?>
	<br>
	<div class="alert alert-danger">
		<?php foreach ($errors as $error) : ?>
			<p class="m-0"><?php echo $error ?></p>
		<?php endforeach ?>
	</div>
<?php  endif ?>
<?php  if (count($msgs) > 0) : ?>
	<br>
	<div class="alert alert-success">
		<?php foreach ($msgs as $msg) : ?>
			<p class="m-0"><?php echo $msg ?></p>
		<?php endforeach ?>
	</div>
<?php  endif ?>
