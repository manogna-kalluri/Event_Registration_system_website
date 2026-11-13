<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include 'connection.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_name = trim($_POST['event_name']);
    $category = trim($_POST['category']);
    $event_date = $_POST['event_date'];
    $venue = trim($_POST['venue']);
    $description = trim($_POST['description']);
    $max_participants = (int)$_POST['max_participants'];

    $stmt = $conn->prepare(
        "INSERT INTO events
        (event_name, category, event_date, venue, description, max_participants)
        VALUES (?, ?, ?, ?, ?, ?)"
    );

    $stmt->bind_param(
        "sssssi",
        $event_name,
        $category,
        $event_date,
        $venue,
        $description,
        $max_participants
    );

    if ($stmt->execute()) {
        $message = "Event added successfully!";
    } else {
        $message = "Error adding event: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Event</title>
</head>
<body>

<h1>Add New Event</h1>

<p><?php echo htmlspecialchars($message); ?></p>

<form method="POST">
    <label>Event Name:</label><br>
    <input type="text" name="event_name" required><br><br>

    <label>Category:</label><br>
    <select name="category" required>
        <option value="">Select Category</option>
        <option value="Technical">Technical</option>
        <option value="Cultural">Cultural</option>
        <option value="Sports">Sports</option>
        <option value="Academic">Academic</option>
    </select><br><br>

    <label>Event Date:</label><br>
    <input type="date" name="event_date" required><br><br>

    <label>Venue:</label><br>
    <input type="text" name="venue" required><br><br>

    <label>Description:</label><br>
    <textarea name="description" required></textarea><br><br>

    <label>Maximum Participants:</label><br>
    <input type="number" name="max_participants" min="1" required><br><br>

    <button type="submit">Add Event</button>
</form>

<br>
<a href="admin_dashboard.php">Back to Dashboard</a>

</body>
</html>