<?php

	require('config/config.php');
	require('config/db.php');

	$cPage = filter_input(INPUT_SERVER, 'PHP_SELF', FILTER_SANITIZE_URL);

	//check for submit
	if(isset($_POST['submit']))
	{
		//Get form data
		$title = mysqli_real_escape_string($conn, $_POST['title']);
		$body = mysqli_real_escape_string($conn, $_POST['body']);
		$author = mysqli_real_escape_string($conn, $_POST['author']);
		$query = "INSERT INTO posts(title, body, author) VALUES('$title', '$body', '$author')";

		if(mysqli_query($conn, $query))
		{
			header('Location: ' .ROOT_URL. '');
		}
		else
		{
			echo 'ERROR: ' . mysqli_error($conn);
		}
	}

?>

<?php include('includes/header.php'); ?>

	<div class="container">
		<h1>Add Post</h1>
		<form method="post" action="<?php echo $cPage; ?>">
		<div class="form-group">
			<label>Title</label>
			<input class="form-control" type="text" name="title">
		</div>
		<div class="form-group">
			<label>Author</label>
			<input class="form-control" type="text" name="author">
		</div>
		<div class="form-group">
			<textarea class="form-control" type="text" name="body">

			</textarea>
		</div>
		<button class="btn btn-primary" type="submit" name="submit">
			Submit
		</button>
		</form>
	</div>

<?php include('includes/footer.php');
