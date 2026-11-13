<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include 'connection.php';

if (!isset($_GET['id']) || !filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    die("Invalid event ID.");
}

$event_id = (int)$_GET['id'];
$message = "";

$stmt = $conn->prepare("SELECT * FROM events WHERE event_id = ?");
$stmt->bind_param("i", $event_id);
$stmt->execute();
$result = $stmt->get_result();
$event = $result->fetch_assoc();
$stmt->close();

if (!$event) {
    die("Event not found.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $event_name = trim($_POST['event_name']);
    $category = trim($_POST['category']);
    $event_date = $_POST['event_date'];
    $venue = trim($_POST['venue']);
    $description = trim($_POST['description']);
    $max_participants = (int)$_POST['max_participants'];

    $stmt = $conn->prepare(
        "UPDATE events SET event_name=?, category=?, event_date=?,
        venue=?, description=?, max_participants=?
        WHERE event_id=?"
    );

    $stmt->bind_param(
        "sssssii",
        $event_name,
        $category,
        $event_date,
        $venue,
        $description,
        $max_participants,
        $event_id
    );

    if ($stmt->execute()) {
        header("Location: manage_events.php");
        exit();
    } else {
        $message = "Error updating event.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Event</title>
</head>
<body>

<h1>Edit Event</h1>

<p><?php echo htmlspecialchars($message); ?></p>

<form method="POST">

    <label>Event Name:</label><br>
    <input type="text" name="event_name"
        value="<?php echo htmlspecialchars($event['event_name']); ?>"
        required><br><br>

    <label>Category:</label><br>
    <select name="category" required>
        <?php
        $categories = ["Technical", "Cultural", "Sports", "Academic"];
        foreach ($categories as $category) {
            $selected = ($event['category'] == $category) ? "selected" : "";
            echo "<option value='" . htmlspecialchars($category) . "' $selected>"
                . htmlspecialchars($category) . "</option>";
        }
        ?>
    </select><br><br>

    <label>Event Date:</label><br>
    <input type="date" name="event_date"
        value="<?php echo htmlspecialchars($event['event_date']); ?>"
        required><br><br>

    <label>Venue:</label><br>
    <input type="text" name="venue"
        value="<?php echo htmlspecialchars($event['venue']); ?>"
        required><br><br>

    <label>Description:</label><br>
    <textarea name="description" required><?php
        echo htmlspecialchars($event['description']);
    ?></textarea><br><br>

    <label>Maximum Participants:</label><br>
    <input type="number" name="max_participants" min="1"
        value="<?php echo (int)$event['max_participants']; ?>"
        required><br><br>

    <button type="submit">Update Event</button>

</form>

<br>
<a href="manage_events.php">Back to Manage Events</a>

</body>
</html>