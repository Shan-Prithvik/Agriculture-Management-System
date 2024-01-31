<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php 
	// checking if a user is logged in
	if (!isset($_SESSION['user_id'])) {
		header('Location: index.php');
	}


?>
<?php require('inc/header.php'); ?>

	<main>
		<h1>Add New Service<span> <a href="services.php">< Back to Services List</a></span></h1>

		<?php 


        if (isset($_POST['submit'])) {
    // Get form data
    $service_name = $_POST['service']; // Assuming this is for service name
    $service_description = $_POST['description']; // Assuming this is for service description
       
    // Validate form data if required

    // Insert query
    $query = "INSERT INTO services (service, description) VALUES ('$service_name', '$service_description')";

    $result = mysqli_query($connection, $query);

}

		 ?>

		<form action="add-service.php" method="post" class="userform">
			
			<p>
				<label for="">Service Name</label>
				<input type="text" name="service">
			</p>

			<p>
				<label for="">Service Description</label>
				<input type="text" name="description">
			</p>

			<p>
				<label for="">&nbsp;</label>
				<button type="submit" name="submit">Save</button>
			</p>

		</form>

	</main>
<?php require_once('inc/footer.php'); ?>

<style>
/* Reset default browser styles */
body,
h1,
h2,
h3,
h4,
h5,
h6,
p,
ul,
li {
  margin: 0;
  padding: 0;
}

/* Body Styles */
body {
  font-family: Arial, sans-serif;
  background-color: #f5f5f5;
  margin: 0;
  padding: 0;
}

/* Main Styles */
main {
  max-width: 800px;
  margin: 50px auto;
  padding: 20px;
  background-color: #fff;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
  margin-bottom: 20px;
}

/* Form Styles */
.userform {
  display: flex;
  flex-direction: column;
}

.userform p {
  margin-bottom: 15px;
}

label {
  display: block;
  margin-bottom: 5px;
}

input[type="text"] {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
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

a {
  text-decoration: none;
  color: #007bff;
}

a:hover {
  text-decoration: underline;
}

/* Style for the heading and link */
h1 {
  font-size: 30px;
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