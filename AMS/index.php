<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php 


	// check for form submission
	if (isset($_POST['submit'])) {

		$errors = array();

		// check if the username and password has been entered
		if (!isset($_POST['email']) || strlen(trim($_POST['email'])) < 1 ) {
			$errors[] = 'Username is Missing / Invalid';
		}

		if (!isset($_POST['password']) || strlen(trim($_POST['password'])) < 1 ) {
			$errors[] = 'Password is Missing / Invalid';
		}

		// check if there are any errors in the form
		if (empty($errors)) {
			// save username and password into variables
			$email 		= mysqli_real_escape_string($connection, $_POST['email']);
			$password 	= mysqli_real_escape_string($connection, $_POST['password']);
			$hashed_password = sha1($password);

			// prepare database query
			$query = "SELECT * FROM user 
						WHERE email = '{$email}' 
						AND password = '{$hashed_password}' 
						LIMIT 1";

			$result_set = mysqli_query($connection, $query);

			verify_query($result_set);

			if (mysqli_num_rows($result_set) == 1) {
				// valid user found
				$user = mysqli_fetch_assoc($result_set);
				$_SESSION['user_id'] = $user['id'];
				$_SESSION['first_name'] = $user['first_name'];
				$_SESSION['role'] = $user['role'];
				$_SESSION['email'] = $user['email'];
				// updating last login
				$query = "UPDATE user SET last_login = NOW() ";
				$query .= "WHERE id = {$_SESSION['user_id']} LIMIT 1";

				$result_set = mysqli_query($connection, $query);

				verify_query($result_set);

				// redirect to users.php
				
				if ($_SESSION['role'] == 'Officer' || $_SESSION['role'] == 'User') {
					header('Location: services.php');
				} else {
					header('Location: users.php');
					exit();
				}

			} else {
				// user name and password invalid
				$errors[] = 'Invalid Username / Password';
			}
		}
	}
?>

<?php require('inc/header.php'); ?>
<div class="login-bg">

		<form action="index.php" method="post">
		
			<fieldset>
				

				<?php 
					if (isset($errors) && !empty($errors)) {
						echo '<p class="error">Invalid Username / Password</p>';
					}
				?>

				<?php 
					if (isset($_GET['logout'])) {
						echo '<p class="info">You have logged out from the system</p>';
					}
				?>

				<div class="offset-xl-4 col-xl-4 mt-5 mb-3">
					<h2>Welcome to Echo Farming</h2>
					<br><legend><h5>Log In</h5></legend>
					<div class="form-group mt-3">
						<label for="">Username:</label>
						<input type="text" name="email" id="" class="form-control" placeholder="Email Address" autofocus>
					</div>

					<div class="form-group mt-3">
						<label for="">Password:</label>
						<input type="password" name="password" id="" class="form-control" placeholder="Password" required>
					</div>
					<div class="form-group mt-3 text-center">
						<button type="submit" class="btn btn-primary" name="submit">Log In</button>
					</div>
					<br><p>Don't have an account? <a href="register.php">Register</a></p>
				</div>


			</fieldset>

		</form>		

	</div> <!-- .login -->
<?php require_once('inc/footer.php'); ?>

<style>

.login-bg{
  margin: 0;
  padding: 0;
  font-family: Arial, sans-serif;
  background-image: url("https://media.licdn.com/dms/image/D4D12AQG6RjxFsLXEtg/article-cover_image-shrink_720_1280/0/1696000616078?e=2147483647&v=beta&t=JZsBesitOdoZMShrETDyGXPQDYuCRpaMPFDfyCwEWwQ");
  background-size: cover;
  background-position: center;
  height: 100vh;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  color: #fff;
}
</style>

