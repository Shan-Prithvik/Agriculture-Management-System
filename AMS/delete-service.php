<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php 
	// checking if a user is logged in
	if (!isset($_SESSION['service_id'])) {
		header('Location: index.php');
	}

	if (isset($_GET['service_id'])) {
		// getting the user information
		$service_id = mysqli_real_escape_string($connection, $_GET['service_id']);

		if ( $service_id == $_SESSION['service_id'] ) {
			// should not delete current user
			header('Location: services.php?err=cannot_delete_current_service');
		} else {
			// deleting the user
			$query_user = "UPDATE services SET is_deleted = 1 WHERE id = {$service_id} LIMIT 1";

			$result_user = mysqli_query($connection, $query_user);

			// deleting the service approval
			$query_approval = "UPDATE service_approval SET is_deleted = 1 WHERE service_id = {$service_id}";

			$result_approval = mysqli_query($connection, $query_approval);

			if ($result) {
				// user deleted
				header('Location: services.php?msg=user_deleted');
			} else {
				header('Location: services.php?err=delete_failed');
			}
		}
		
	} else {
		header('Location: services.php');
	}
?>