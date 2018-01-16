<?php

        require('config/config.php');
        require('config/db.php');

        $cPage = filter_input(INPUT_SERVER, 'PHP_SELF', FILTER_SANITIZE_URL);

        //check for submit
        if(isset($_POST['submit']))
        {
                //Get form data
		$update_id = mysqli_real_escape_string($conn, $_POST['update_id']);
                $title = mysqli_real_escape_string($conn, $_POST['title']);
                $body = mysqli_real_escape_string($conn, $_POST['body']);
                $author = mysqli_real_escape_string($conn, $_POST['author']);
                $query = "UPDATE posts SET
			title= '$title',
			author='$author',
			body='$body'
		WHERE id = {$update_id}
		";

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

	$query = 'SELECT * FROM posts WHERE id = ' .$id;

	$result = mysqli_query($conn, $query);

	$post = mysqli_fetch_assoc($result);

	mysqli_free_result($result);

	mysqli_close($conn);

?>
<?php include('includes/header.php'); ?>

        <div class="container">
                <h1>Edit Post</h1>
                <form method="post" action="<?php echo $cPage; ?>">
                <div class="form-group">
                        <label>Title</label>
                        <input class="form-control" type="text" name="title" value="<?php echo $post['title']; ?>">
                </div>
                <div class="form-group">
                        <label>Author</label>
                        <input class="form-control" type="text" name="author" value="<?php echo $post['author']; ?>">
                </div>
                <div class="form-group">
			<label>Body</label>
                        <textarea class="form-control" type="text" name="body">
				<?php echo $post['body']; ?>
                        </textarea>
                </div>
		<input type="hidden" name="update_id" value="<?php echo $post['id']; ?>">
                <button class="btn btn-primary" type="submit" name="submit">
                        Submit
                </button>
                </form>
        </div>

<?php include('includes/footer.php');

