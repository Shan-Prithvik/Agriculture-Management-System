
<?php require_once('inc/connection.php'); ?>
<?php
$user_role = isset($_SESSION['role']) ? $_SESSION['role'] : null;
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Echo Farm</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <?php if ($user_role == 'Admin' ): ?>
        <a class="nav-item nav-link active" href="users.php">Users</a>
      <?php endif; ?>
      <a class="nav-item nav-link active" href="services.php">Services</a>
      <?php if ($user_role == 'Admin' ): ?>
        <a class="nav-item nav-link active" href="services-approvals.php">Services Approval</a>
      <?php endif; ?>
      <a class="nav-item nav-link active" href="logout.php">Logout</a>
    </div>
  </div>
</nav>

<style>

/* Reset default browser styles */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

/* Navigation Styles */
.navbar {
  background-color: #4CAF50; /* Green tone resembling agriculture */
  padding: 15px 20px;
}

.navbar-brand {
  font-size: 24px;
  font-weight: bold;
  color: #fff; /* White text for contrast */
  text-decoration: none;
}

.navbar-toggler-icon {
  background-color: #fff; /* White color for the toggler icon */
}

.navbar-nav .nav-item .nav-link {
  color: #fff; /* White text for the links */
  margin-right: 15px; /* Adjust margin between links */
}

.navbar-nav .nav-item .nav-link:hover {
  color: #DFF2BF; /* Lighter shade on hover */
}

/* Style adjustments for Admin-specific links */
.navbar-nav .nav-item .nav-link.admin {
  color: #FFCC00; /* A different color for Admin links */
}


</style>