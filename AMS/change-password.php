<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php 
	// checking if a user is logged in
	if (!isset($_SESSION['user_id'])) {
		header('Location: index.php');
	}

	$errors = array();
	$user_id = '';
	$first_name = '';
	$last_name = '';
	$email = '';

	if (isset($_GET['user_id'])) {
		// getting the user information
		$user_id = mysqli_real_escape_string($connection, $_GET['user_id']);
		$query = "SELECT * FROM user WHERE id = {$user_id} LIMIT 1";

		$result_set = mysqli_query($connection, $query);

		if ($result_set) {
			if (mysqli_num_rows($result_set) == 1) {
				// user found
				$result = mysqli_fetch_assoc($result_set);
				$first_name = $result['first_name'];
				$last_name = $result['last_name'];
				$email = $result['email'];
			} else {
				// user not found
				header('Location: users.php?err=user_not_found');	
			}
		} else {
			// query unsuccessful
			header('Location: users.php?err=query_failed');
		}
	}

	if (isset($_POST['submit'])) {
		$user_id = $_POST['user_id'];
		$password = $_POST['password'];

		// checking required fields
		$req_fields = array('user_id', 'password');
		$errors = array_merge($errors, check_req_fields($req_fields));

		// checking max length
		$max_len_fields = array('password' => 40);
		$errors = array_merge($errors, check_max_len($max_len_fields));

		if (empty($errors)) {
			// no errors found... adding new record
			$password = mysqli_real_escape_string($connection, $_POST['password']);
			$hashed_password = sha1($password);

			$query = "UPDATE user SET ";
			$query .= "password = '{$hashed_password}' ";
			$query .= "WHERE id = {$user_id} LIMIT 1";

			$result = mysqli_query($connection, $query);

			if ($result) {
				// query successful... redirecting to users page
				header('Location: users.php?user_modified=true');
			} else {
				$errors[] = 'Failed to update the password.';
			}

		}
	}



?>
<?php require('inc/header.php'); ?>

	<main>
		<h1>Change Password<span> <a href="users.php">< Back to User List</a></span></h1>

		<?php 

			if (!empty($errors)) {
				display_errors($errors);
			}

		 ?>

		<form action="change-password.php" method="post" class="userform">
			<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
			<p>
				<label for="">First Name:</label>
				<input type="text" name="first_name" <?php echo 'value="' . $first_name . '"'; ?> disabled>
			</p>

			<p>
				<label for="">Last Name:</label>
				<input type="text" name="last_name" <?php echo 'value="' . $last_name . '"'; ?> disabled>
			</p>

			<p>
				<label for="">Email Address:</label>
				<input type="text" name="email" <?php echo 'value="' . $email . '"'; ?> disabled>
			</p>

			<p>
				<label for="">New Password:</label>
				<input type="password" name="password" id="password" autofocus>
			</p>

			<p>
				<label for="">Show Password:</label>
				<input type="checkbox" name="showpassword" id="showpassword" style="width:20px;height:20px">
			</p>

			<p>
				<label for="">&nbsp;</label>
				<button type="submit" name="submit">Update Password</button>
			</p>

		</form>

		
		
	</main>
	<script src="js/jquery.js"></script>
	<script>
		$(document).ready(function(){
			$('#showpassword').click(function(){
				if ( $('#showpassword').is(':checked') ) {
					$('#password').attr('type','text');
				} else {
					$('#password').attr('type','password');
				}
			});
		});
	</script>
<?php require_once('inc/footer.php'); ?>

<style>

/* Reset default browser styles */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

/* Form Styles */
.userform {
  max-width: 400px;
  margin: 0 auto;
  padding: 20px;
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
  display: block;
  margin-bottom: 8px;
  color: #333;
  font-weight: bold;
}

input[type="text"],
input[type="password"] {
  width: calc(100% - 20px); /* Adjusted width to accommodate padding */
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  margin-bottom: 15px;
}

input[type="checkbox"] {
  width: 20px;
  height: 20px;
}

button {
  padding: 10px 20px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

button:hover {
  background-color: #0056b3;
}

h1 {
  font-size: 35px;
  margin-bottom: 20px;
}

h1 span {
  font-size: 20px;
  margin-left: 10px;
}

h1 span a {
  text-decoration: none;
  color: #007bff;
}

h1 span a:hover {
  text-decoration: underline;
}

</style>