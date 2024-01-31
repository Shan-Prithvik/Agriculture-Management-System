<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>

<?php 
	// checking if a user is logged in
	if (!isset($_SESSION['user_id'])) {
		header('Location: index.php');
	}

	$services_list = '';
	$query = "SELECT * FROM services WHERE is_deleted=0";

	$query = "SELECT services.*, service_approval.is_approval 
          FROM services 
          LEFT JOIN service_approval ON services.id = service_approval.service_id 
          WHERE services.is_deleted = 0";

	$approve_disabled = "SELECT * FROM service_approval WHERE is_approval='Pending'";

	$approve_status = "SELECT * FROM service_approval";
	
	$services = mysqli_query($connection, $query);

	while ($service = mysqli_fetch_assoc($services)) {
		$services_list .= "<tr>";
		$services_list .= "<td>{$service['service']}</td>";
		$services_list .= "<td>{$service['description']}</td>";
	
		$approval_query = "SELECT * FROM service_approval WHERE service_id = {$service['id']} AND is_approval='Pending'";
		$approval_result = mysqli_query($connection, $approval_query);
		$is_pending_approval = mysqli_num_rows($approval_result) > 0;
	
		if ($_SESSION['role'] != 'User') {
			
			$services_list .= "<td class='text-center'><a href=\"modify-service.php?service_id={$service['id']}\" class='btn btn-info'>Edit</a></td>";
			$services_list .= "<td class='text-center'><a href=\"delete-service.php?service_id={$service['id']}\" 
						onclick=\"return confirm('Are you sure?');\" class='btn btn-danger'>Delete</a></td>";
		} else {
			if (!$is_pending_approval) {
				$services_list .= "<td>{$service['is_approval']}</td>";
				$services_list .= "<td class='text-center'><a href=\"approve-send.php?service_id={$service['id']}&service={$service['service']}&description={$service['description']}\" class='btn btn-success'>Approve</a></td>";
			} else {
				$services_list .= "<td class='text-center'><button class='btn btn-success' disabled>Approve</button></td>";
			}
		}
	
		$services_list .= "</tr>";
	}
 ?>
<?php require('inc/header.php'); ?>
<?php require('inc/navbar.php'); ?>
	<main>	

    <h1>Services<span><a href="add-service.php">+ Add New</a> | <a href="services.php">Refresh</a></span></h1>

		<table class="masterlist table table-bordered">
			<tr>
				<th>Service Name</th>
				<th>Service Description</th>
				<?php
					if ($_SESSION['role'] != 'User') {
						echo "<th class='text-center'>Edit</th>";
						echo "<th class='text-center'>Delete</th>";
					} else{
						echo "<th class='text-center'>Status</th>";
						echo "<th class='text-center'>Approval</th>";
					}
				?>
			</tr>
            <?php echo $services_list; ?>
		</table>
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

/* Main Heading Styles */
h1 {
  font-size: 28px;
  margin-bottom: 20px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

h1 span a {
  text-decoration: none;
  margin-left: 10px;
  padding: 8px 15px;
  border-radius: 4px;
  color: #fff;
}

h1 span a:first-child {
  background-color: #007bff; /* Blue color for Add New */
}

h1 span a:last-child {
  background-color: #28a745; /* Green color for Refresh */
}

h1 span a:hover {
  opacity: 0.8;
}

/* Table Styles */
table.masterlist {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 20px;
}

table.masterlist th,
table.masterlist td {
  border: 1px solid #ddd;
  padding: 10px;
}

table.masterlist th {
  background-color: #f8f9fa;
  text-align: left;
}

table.masterlist th.text-center,
table.masterlist td.text-center {
  text-align: center;
}

/* ... Additional styles specific to your application or design ... */


</style>