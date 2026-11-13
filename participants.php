<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include 'connection.php';

$sql = "SELECT
            r.registration_id,
            s.full_name,
            s.email,
            s.phone,
            s.department,
            s.year,
            e.event_name,
            r.registration_date,
            r.status
        FROM registrations r
        INNER JOIN students s
            ON r.student_id = s.student_id
        INNER JOIN events e
            ON r.event_id = e.event_id
        ORDER BY r.registration_date DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registered Participants</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 30px;
        }

        h1 {
            text-align: center;
            color: #243b55;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #243b55;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .back {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 18px;
            background-color: #243b55;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>

<body>

<h1>Registered Participants</h1>

<table>

    <tr>
        <th>Registration ID</th>
        <th>Student Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Department</th>
        <th>Year</th>
        <th>Event Name</th>
        <th>Registration Date</th>
        <th>Status</th>
    </tr>

    <?php if ($result && $result->num_rows > 0) { ?>

        <?php while ($participant = $result->fetch_assoc()) { ?>

            <tr>
                <td>
                    <?php echo (int)$participant['registration_id']; ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($participant['full_name']); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($participant['email']); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($participant['phone']); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($participant['department']); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($participant['year']); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($participant['event_name']); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($participant['registration_date']); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($participant['status']); ?>
                </td>
            </tr>

        <?php } ?>

    <?php } else { ?>

        <tr>
            <td colspan="9">No participants registered yet.</td>
        </tr>

    <?php } ?>

</table>

<a href="admin_dashboard.php" class="back">
    Back to Dashboard
</a>

</body>
</html>