<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>

<?php
$email = isset($_SESSION['email']) ? $_SESSION['email'] : null;
echo "Email: " . $email . "<br>";
?>

<?php 

if(isset($_GET['service_id'])) {
    // Retrieve the service_id value from the URL
    $service_id = $_GET['service_id'];
	$service = $_GET['service'];
	$description = $_GET['description'];
	
    // Now you can use $service_id as needed in your script
    echo "Service ID: " . $service_id . "<br>";
	echo "Service: " . $service . "<br>";
	echo "Description: " . $description . "<br>";
	
} else {
    // Handle the case when service_id is not set in the URL
    echo "Service ID not provided in the URL.";
}

    //Perform the registration query
    $query = "INSERT INTO service_approval (service_id, service, description, user_name, is_approval ) 
              VALUES ('$service_id', '$service', '$description', '$email', 'Pending' )";
    
    $result = mysqli_query($connection, $query);

    if ($result) {
        // Registration successful
        echo "Save successful!";
		header('Location: services.php');
    } else {
        // Registration failed
        echo "Error: " . mysqli_error($connection);
    }

    // Close the database connection
    mysqli_close($connection);
//}

?>