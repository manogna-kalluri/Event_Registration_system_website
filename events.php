<?php
include 'connection.php';

$sql = "SELECT * FROM events ORDER BY event_date ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>College Events</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f4f6fb;
        }

        header {
            background: #243b64;
            color: white;
            padding: 22px;
            text-align: center;
        }

        .container {
            max-width: 1100px;
            margin: 35px auto;
            padding: 20px;
        }

        h2 {
            color: #243b64;
            margin-bottom: 25px;
            text-align: center;
        }

        .event-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
            gap: 22px;
        }

        .event-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        .event-card h3 {
            color: #243b64;
            margin-bottom: 15px;
        }

        .event-card p {
            margin-bottom: 12px;
            color: #555;
        }

        .category {
            color: #243b64;
            font-weight: bold;
        }

        .register-btn {
            display: inline-block;
            background: #243b64;
            color: white;
            padding: 10px 16px;
            text-decoration: none;
            border-radius: 6px;
            margin-top: 10px;
        }

        .register-btn:hover {
            background: #172a49;
        }

        .back-btn {
            display: inline-block;
            margin-top: 30px;
            color: #243b64;
            text-decoration: none;
            font-weight: bold;
        }

        .empty-message {
            text-align: center;
            color: #666;
            grid-column: 1 / -1;
        }
    </style>
</head>

<body>

<header>
    <h1>College Event Registration System</h1>
</header>

<div class="container">

    <h2>Available College Events</h2>

    <div class="event-container">

        <?php
        if ($result && $result->num_rows > 0) {

            while ($event = $result->fetch_assoc()) {
        ?>

            <div class="event-card">

                <h3>
                    <?php echo htmlspecialchars($event['event_name']); ?>
                </h3>

                <p>
                    <span class="category">Category:</span>
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

                <p>
                    <strong>Description:</strong>
                    <?php echo htmlspecialchars($event['description']); ?>
                </p>

                <p>
                    <strong>Maximum Participants:</strong>
                    <?php echo htmlspecialchars($event['max_participants']); ?>
                </p>

                <a href="event_register.php?event_id=<?php echo $event['event_id']; ?>"
                   class="register-btn">
                    Register Now
                </a>

            </div>

        <?php
            }

        } else {
            echo "<p class='empty-message'>No events available.</p>";
        }
        ?>

    </div>

    <a href="dashboard.php" class="back-btn">
        ← Back to Dashboard
    </a>

</div>

</body>
</html>

<?php
$conn->close();
?>