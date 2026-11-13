<?php
session_start();

if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

include 'connection.php';

$message = "";
$event_id = isset($_GET['event_id']) ? (int)$_GET['event_id'] : 0;

// Get selected event
$stmt = $conn->prepare("SELECT * FROM events WHERE event_id = ?");
$stmt->bind_param("i", $event_id);
$stmt->execute();
$result = $stmt->get_result();
$event = $result->fetch_assoc();
$stmt->close();

if (!$event) {
    die("Event not found. Please select a valid event.");
}

// Save registration
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $student_id = $_SESSION['student_id'];

    $check = $conn->prepare(
        "SELECT registration_id FROM registrations
         WHERE student_id = ? AND event_id = ?"
    );

    $check->bind_param("ii", $student_id, $event_id);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $message = "You have already registered for this event.";

    } else {

        $insert = $conn->prepare(
            "INSERT INTO registrations (student_id, event_id)
             VALUES (?, ?)"
        );

        $insert->bind_param("ii", $student_id, $event_id);

        if ($insert->execute()) {
            $message = "Event registration successful!";
        } else {
            $message = "Registration failed. Please try again.";
        }

        $insert->close();
    }

    $check->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Event Registration</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f4f6fb;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            background: white;
            width: 450px;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #243b64;
            margin-bottom: 20px;
        }

        .details {
            background: #f4f6fb;
            padding: 18px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .details p {
            margin: 10px 0;
            color: #444;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #243b64;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background: #172a49;
        }

        .message {
            text-align: center;
            color: #16834a;
            margin-bottom: 18px;
        }

        .links {
            text-align: center;
            margin-top: 20px;
        }

        a {
            color: #243b64;
            text-decoration: none;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Event Registration</h2>

    <div class="details">

        <p>
            <strong>Student Name:</strong>
            <?php echo htmlspecialchars($_SESSION['student_name']); ?>
        </p>

        <p>
            <strong>Event Name:</strong>
            <?php echo htmlspecialchars($event['event_name']); ?>
        </p>

        <p>
            <strong>Category:</strong>
            <?php echo htmlspecialchars($event['category']); ?>
        </p>

        <p>
            <strong>Date:</strong>
            <?php echo date("d M Y", strtotime($event['event_date'])); ?>
        </p>

        <p>
            <strong>Venue:</strong>
            <?php echo htmlspecialchars($event['venue']); ?>
        </p>

    </div>

    <?php if ($message != "") { ?>
        <p class="message">
            <?php echo htmlspecialchars($message); ?>
        </p>
    <?php } ?>

    <?php if ($message != "Event registration successful!" &&
              $message != "You have already registered for this event.") { ?>

        <form method="POST">
            <button type="submit">Confirm Registration</button>
        </form>

    <?php } ?>

    <div class="links">
        <a href="events.php">Back to Events</a>
        <br><br>
        <a href="dashboard.php">Student Dashboard</a>
    </div>

</div>

</body>
</html>

<?php
$conn->close();
?>