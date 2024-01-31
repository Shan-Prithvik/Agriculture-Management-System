<?php session_start();
$user_role = isset($_SESSION['role']) ? $_SESSION['role'] : null;?>
<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php 
	// checking if a service is logged in
	if (!isset($_SESSION['user_id'])) {
		header('Location: index.php');
	}

	$service_approval_list = '';
	$search = '';

	// getting the list of services
	if ( isset($_GET['search']) ) {
		$search = mysqli_real_escape_string($connection, $_GET['search']);
		$query = "SELECT * FROM service_approval WHERE (first_name LIKE '%{$search}%' OR last_name LIKE '%{$search}%' OR email LIKE '%{$search}%') AND is_deleted=0 ORDER BY first_name";					
	} else {
		$query = "SELECT * FROM service_approval WHERE is_approval='Pending' AND is_deleted = 0";
	}
	
	$services = mysqli_query($connection, $query);

	verify_query($services);

	while ($service = mysqli_fetch_assoc($services)) {
		$service_approval_list .= "<tr>";
		$service_approval_list .= "<td>{$service['user_name']}</td>";
		$service_approval_list .= "<td>{$service['service']}</td>";
		$service_approval_list .= "<td>{$service['description']}</td>";
		$service_approval_list .= "<td>{$service['is_approval']}</td>";
        $service_approval_list .= "<td class='text-center'><a href=\"service-approval.php?service_id={$service['id']}\" 
        onclick=\"return confirm('Are you sure?');\" class='btn btn-success'>Approve</a></td>";
		$service_approval_list .= "<td class='text-center'><a href=\"delete-approval.php?service_id={$service['id']}\" 
						onclick=\"return confirm('Are you sure?');\" class='btn btn-danger'>Un Approve</a></td>";
		$service_approval_list .= "</tr>";
	}
 ?>

<?php require('inc/header.php'); ?>
<?php require('inc/navbar.php'); ?>

	<main>	

		<h1>Users <span><a href="add-service.php">+ Add New</a> | <a href="services-approvals.php">Refresh</a></span></h1>

		<div class="search">
			<form action="services.php" method="get">
				<p>
					<input type="text" name="search" id="" placeholder="Search" value="<?php echo $search; ?>" required autofocus>
				</p>
			</form>
		</div>

		<table class="masterlist table table-bordered">
			<tr>
				<th>User Name</th>
				<th>Service</th>
				<th>Description</th>
				<th>Status</th>
				<th class='text-center'>Select</th>
				<th class='text-center'>Reject</th>
			</tr>

			<?php echo $service_approval_list; ?>

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

/* Search Form Styles */
.search {
  margin-bottom: 20px;
}

.search input[type="text"] {
  width: 300px;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
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


</style>