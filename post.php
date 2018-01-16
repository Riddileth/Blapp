<?php

	require('config/config.php');
	require('config/db.php');

	if(isset($_POST['delete']))
	{
		$delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);

		$query = "DELETE FROM posts WHERE id = {$delete_id}";

		if(mysqli_query($conn, $query))
		{
			header('Location: ' .ROOT_URL. '');
		}
		else
		{
			echo 'ERROR: ' . mysqli_error($conn);
		}
	}

	$id = mysqli_real_escape_string($conn, $_GET['id']);

	$query = 'SELECT * FROM posts WHERE id = '.$id;

	$result = mysqli_query($conn, $query);

	$post = mysqli_fetch_assoc($result);

	mysqli_free_result($result);

	mysqli_close($conn);

?>
<?php include('includes/header.php'); ?>
<div class="container">

	<h1><?php echo $post['title']; ?></h1>
	<small>Created on <?php echo $post['created_at']; ?> by <?php echo $post['author']; ?></small>
	<p><?php echo $post['body']; ?></p>
	<a class="btn btn-default" href="<?php echo ROOT_URL; ?>">Back</a>
	<hr>
	<a class="btn btn-default" href="<?php echo ROOT_URL; ?>editPost.php?id=<?php echo $post['id']; ?>">Edit</a>
	<form class="pull-right" method="post" action="<?php echo $cPage; ?>">
	<input type="hidden" name="delete_id" value="<?php echo $post['id']; ?>">
	<button class="btn btn-danger" type="submit" name="delete">
		Delete Post
	</button>
	</form>
</div>
<?php include('includes/footer.php'); ?>
