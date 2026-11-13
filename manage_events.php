<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include 'connection.php';

$sql = "SELECT * FROM events ORDER BY event_id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Events</title>
</head>
<body>

<h1>Manage Events</h1>

<a href="add_event.php">Add New Event</a>

<br><br>

<table border="1" cellpadding="10" cellspacing="0">

    <tr>
        <th>ID</th>
        <th>Event Name</th>
        <th>Category</th>
        <th>Date</th>
        <th>Venue</th>
        <th>Maximum Participants</th>
        <th>Action</th>
    </tr>

    <?php if ($result && $result->num_rows > 0) { ?>

        <?php while ($event = $result->fetch_assoc()) { ?>

            <tr>
                <td>
                    <?php echo $event['event_id']; ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($event['event_name']); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($event['category']); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($event['event_date']); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($event['venue']); ?>
                </td>

                <td>
                    <?php echo (int)$event['max_participants']; ?>
                </td>

                <td>
                    <a href="edit_event.php?id=<?php echo $event['event_id']; ?>">
                        Edit
                    </a>

                    <br><br>

                    <form method="POST"
                          action="delete_event.php"
                          onsubmit="return confirm('Are you sure you want to delete this event?');">

                        <input type="hidden"
                               name="event_id"
                               value="<?php echo $event['event_id']; ?>">

                        <button type="submit">Delete</button>

                    </form>
                </td>
            </tr>

        <?php } ?>

    <?php } else { ?>

        <tr>
            <td colspan="7">No events found.</td>
        </tr>

    <?php } ?>

</table>

<br>

<a href="admin_dashboard.php">Back to Dashboard</a>

</body>
</html>