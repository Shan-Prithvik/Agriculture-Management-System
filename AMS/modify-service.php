<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/functions.php'); ?>

<?php
$errors = array();
$service_id = '';
$service = '';
$description = '';

if (isset($_GET['service_id'])) {
    // getting the user information
    $service_id = mysqli_real_escape_string($connection, $_GET['service_id']);
    $query = "SELECT * FROM services WHERE id = {$service_id} LIMIT 1";

    $result_set = mysqli_query($connection, $query);

    if ($result_set) {
        if (mysqli_num_rows($result_set) == 1) {
            // user found
            $result = mysqli_fetch_assoc($result_set);
            $service = $result['service'];
            $description = $result['description'];
        } else {
            // user not found
            header('Location: services.php?err=service_not_found');
            exit();
        }
    } else {
        // query unsuccessful
        header('Location: services.php?err=query_failed');
        exit();
    }
}

if (isset($_POST['submit'])) {
    $service_id = $_POST['service_id'];
    $service = $_POST['service'];
    $description = $_POST['description'];

    if (empty($errors)) {
        $query = "UPDATE services SET ";
        $query .= "service = '{$service}', ";
        $query .= "description = '{$description}' ";
        $query .= "WHERE id = {$service_id} LIMIT 1";

        $result = mysqli_query($connection, $query);

        if ($result) {
            // Query successful, redirect to services.php or another page
            header('Location: services.php');
            exit();
        } else {
            // Query unsuccessful
            $errors[] = 'Update failed. Please try again.';
        }
    }
}
?>

<?php require('inc/header.php'); ?>

<main>
    <h1>View / Modify services<span> <a href="services.php">&lt; Back to Service List</a></span></h1>

    <?php
    if (!empty($errors)) {
        display_errors($errors);
    }
    ?>

    <form action="modify-service.php" method="post" class="serviceform">
        <input type="hidden" name="service_id" value="<?php echo $service_id; ?>">
        <p>
            <label for="">Service:</label>
            <input type="text" name="service" value="<?php echo htmlspecialchars($service); ?>">
        </p>

        <p>
            <label for="">Description:</label>
            <input type="text" name="description" value="<?php echo htmlspecialchars($description); ?>">
        </p>

        <p>
            <label for="">&nbsp;</label>
            <button type="submit" class="btn btn-success" name="submit">Save</button>
        </p>
    </form>
</main>

<?php require_once('inc/footer.php'); ?>

<style>

/* Reset default browser styles */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

/* Form Styles */
.serviceform {
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

input[type="text"] {
  width: calc(100% - 20px); /* Adjusted width to accommodate padding */
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  margin-bottom: 15px;
}

button {
  padding: 10px 20px;
  background-color: #28a745;
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

button:hover {
  background-color: #218838;
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