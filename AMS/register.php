<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php require('inc/header.php'); ?>

<?php

	
	$first_name = '';
	$last_name = '';
	$email = '';
	$password = '';

	if (isset($_POST['submit'])) {

		$errors = array();
		
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		// checking required fields
		$req_fields = array('first_name', 'last_name', 'email', 'password');
		$errors = array_merge($errors, check_req_fields($req_fields));

		// checking max length
		$max_len_fields = array('first_name' => 50, 'last_name' =>100, 'email' => 100, 'password' => 40);
		$errors = array_merge($errors, check_max_len($max_len_fields));

		// checking email address
		if (!is_email($_POST['email'])) {
			$errors[] = 'Email address is invalid.';
		}

		// checking if email address already exists
		$email = mysqli_real_escape_string($connection, $_POST['email']);
		$query = "SELECT * FROM user WHERE email = '{$email}' LIMIT 1";

		$result_set = mysqli_query($connection, $query);

		if ($result_set) {
			if (mysqli_num_rows($result_set) == 1) {
				$errors[] = 'Email address already exists';
			}
		}

		if (empty($errors)) {
			// no errors found... adding new record
			$first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
			$last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
			$password = mysqli_real_escape_string($connection, $_POST['password']);
			$email = mysqli_real_escape_string($connection, $_POST['email']);
			// email address is already sanitized
			$hashed_password = sha1($password);

			$query = "INSERT INTO user (";
			$query .= "first_name, last_name, email, password, role, is_deleted";
			$query .= ") VALUES (";
			$query .= "'{$first_name}', '{$last_name}', '{$email}', '{$hashed_password}', 'User', 0";
			$query .= ")";
			
			$result = mysqli_query($connection, $query);

			if ($result) {
				// query successful... redirecting to users page
				header('Location: users.php?user_added=true');
			} else {
				$errors[] = 'Failed to add the new record.';
			}


		}



	}



?>

<form action="register.php" method="post">
	<div class = "register-bg">

			<fieldset>

					<?php
						if (!empty($errors) && in_array('Email address already exists', $errors)) {
							echo '<div class="alert alert-danger mt-3">Email address already exists</div>';
						}
					?>

				<div class="offset-xl-4 col-xl-4 mt-5 mb-3">
					<legend><h5>Register</h5></legend>
					<div class="form-group mt-3">
						<label for="">First Name:</label>
						<input type="text"  id="" name="first_name" class="form-control" placeholder="First Name" autofocus>
					</div>
					<div class="form-group mt-3">
						<label for="">Last Name:</label>
						<input type="text" id="" name="last_name" class="form-control" placeholder="Last Name" autofocus>
					</div>
                    <div class="form-group mt-3">
						<label for="">Email:</label>
						<input type="text" name="email" id="" class="form-control" placeholder="Email Address" autofocus>
					</div>
					<div class="form-group mt-3">
						<label for="">Password:</label>
						<input type="password" name="password" id="" class="form-control" placeholder="Password" required>
					</div>
					<input type="text" value="User" name="role" hidden>
					<div class="form-group mt-3 text-center">
						<button type="submit" class="btn btn-primary" name="submit">Register</button>
					</div>
                    <br><p>Already have an account? <a href="index.php">Login</a></p>
				</div>

			</fieldset>

		</form>	


<?php require_once('inc/footer.php'); ?>

<style>

.register-bg{
  margin: 0;
  padding: 0;
  font-family: Arial, sans-serif;
  background-image: url("https://media.licdn.com/dms/image/C5612AQGEqpMnT3LH7g/article-cover_image-shrink_720_1280/0/1638781400665?e=2147483647&v=beta&t=xBtUbZuizkdgNoO_9eUOgXWSOiDS3bcJ79t-9xLM96s");
  background-size: cover;
  background-position: center;
  height: 100vh;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  color: #fff;
}
</style>

