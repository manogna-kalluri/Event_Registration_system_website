<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: manage_events.php");
    exit();
}

if (!isset($_POST['event_id']) ||
    !filter_var($_POST['event_id'], FILTER_VALIDATE_INT)) {
    die("Invalid event ID.");
}

$event_id = (int)$_POST['event_id'];

$stmt = $conn->prepare(
    "DELETE FROM events WHERE event_id = ?"
);

$stmt->bind_param("i", $event_id);

if ($stmt->execute()) {
    $stmt->close();
    $conn->close();

    header("Location: manage_events.php");
    exit();
} else {
    echo "Unable to delete event. It may have registered participants.";
}

$stmt->close();
$conn->close();
?>