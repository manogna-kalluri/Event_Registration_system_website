C
<?php
session_start();

if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

$student_name = $_SESSION['student_name'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>

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
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-left: 18px;
        }

        .welcome {
            padding: 40px;
            text-align: center;
        }

        .welcome h2 {
            color: #243b64;
            margin-bottom: 10px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            padding: 20px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 22px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        .card h3 {
            color: #243b64;
            margin-bottom: 12px;
        }

        .card p {
            color: #666;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            background: #243b64;
            color: white;
            padding: 10px 18px;
            border-radius: 6px;
            text-decoration: none;
        }

        .btn:hover {
            background: #172a49;
        }
    </style>
</head>

<body>

<header>
    <h2>Student Dashboard</h2>

    <nav>
        <a href="index.php">Home</a>
        <a href="events.php">Events</a>
        <a href="my_registrations.php">My Registrations</a>
        <a href="logout.php">Logout</a>
    </nav>
</header>

<section class="welcome">

    <h2>
        Welcome, <?php echo htmlspecialchars($student_name); ?>!
    </h2>

    <p>Explore college events and register for your favourite activities.</p>

</section>

<div class="container">

    <div class="cards">

        <div class="card">
            <h3>Technical Events</h3>
            <p>Explore workshops and coding competitions.</p>
            <a href="events.php" class="btn">View Events</a>
        </div>

        <div class="card">
            <h3>Cultural Events</h3>
            <p>Participate in dance and singing competitions.</p>
            <a href="events.php" class="btn">View Events</a>
        </div>

        <div class="card">
            <h3>Sports Events</h3>
            <p>Join exciting sports activities.</p>
            <a href="events.php" class="btn">View Events</a>
        </div>

    </div>

</div>

</body>
</html>