<?php
session_start();

if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

include 'connection.php';

$student_id = $_SESSION['student_id'];

$sql = "SELECT
            registrations.registration_id,
            events.event_name,
            events.category,
            events.event_date,
            events.venue,
            registrations.status
        FROM registrations
        INNER JOIN events
        ON registrations.event_id = events.event_id
        WHERE registrations.student_id = ?
        ORDER BY registrations.registration_date DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $student_id);
$stmt->execute();

$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Registrations</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f4f6fb;
            padding: 30px;
        }

        .container {
            max-width: 1100px;
            margin: 30px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        h1 {
            color: #243b64;
            margin-bottom: 12px;
        }

        .description {
            color: #666;
            margin-bottom: 25px;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 700px;
        }

        th, td {
            padding: 14px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #243b64;
            color: white;
        }

        tr:hover {
            background: #f5f7fc;
        }

        .status {
            color: #16834a;
            font-weight: bold;
        }

        .empty {
            text-align: center;
            padding: 25px;
            color: #666;
        }

        .btn {
            display: inline-block;
            margin-top: 25px;
            padding: 11px 18px;
            background: #243b64;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }

        .btn:hover {
            background: #172a49;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>My Registrations</h1>

    <p class="description">
        View all the college events you have registered for.
    </p>

    <div class="table-container">

        <table>

            <tr>
                <th>ID</th>
                <th>Event Name</th>
                <th>Category</th>
                <th>Date</th>
                <th>Venue</th>
                <th>Status</th>
            </tr>

            <?php if ($result->num_rows > 0) { ?>

                <?php while ($row = $result->fetch_assoc()) { ?>

                    <tr>
                        <td>
                            <?php echo $row['registration_id']; ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($row['event_name']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($row['category']); ?>
                        </td>

                        <td>
                            <?php echo date("d M Y", strtotime($row['event_date'])); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($row['venue']); ?>
                        </td>

                        <td class="status">
                            <?php echo htmlspecialchars($row['status']); ?>
                        </td>
                    </tr>

                <?php } ?>

            <?php } else { ?>

                <tr>
                    <td colspan="6" class="empty">
                        You have not registered for any events yet.
                    </td>
                </tr>

            <?php } ?>

        </table>

    </div>

    <a href="events.php" class="btn">Register for More Events</a>

    <a href="dashboard.php" class="btn">Back to Dashboard</a>

</div>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>