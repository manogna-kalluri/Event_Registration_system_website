<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>

    <h1>Welcome, Admin!</h1>

    <h2>College Event Registration System</h2>

    <p>Welcome, <?php echo htmlspecialchars($_SESSION['admin_username']); ?>!</p>

    <a href="add_event.php">Add Event</a><br><br>

    <a href="manage_events.php">Manage Events</a><br><br>

    <a href="participants.php">View Participants</a><br><br>

    <a href="admin_logout.php">Logout</a>

</body>
</html>