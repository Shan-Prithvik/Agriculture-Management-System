<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>

<?php
include("db_connection.php"); // Include your database connection file

if (isset($_GET['service_id'])) {
    $service_id = mysqli_real_escape_string($connection, $_GET['service_id']);

    // Update the is_approval to 'UnApproved'
    $update_query = "UPDATE service_approval SET is_approval='UnApproved' WHERE id = '$service_id'";

    $result = mysqli_query($connection, $update_query);

    if ($result) {
        // Update successful
        echo "Record updated successfully.";
    } else {
        // Update failed
        echo "Error updating record: " . mysqli_error($connection);
    }
}

// Redirect back to the page where the link was clicked
header("Location: services-approvals.php"); // Change 'previous_page.php' to the appropriate page
exit();
?>