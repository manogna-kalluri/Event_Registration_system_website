<!DOCTYPE html>
<html>
<head>
    <title>College Event Registration System</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
        }

        header {
            background-color: #243b64;
            color: white;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h2 {
            font-size: 23px;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
        }

        .hero {
            text-align: center;
            padding: 100px 20px;
            background-color: #e4ecfa;
        }

        .hero h1 {
            color: #243b64;
            font-size: 38px;
            margin-bottom: 20px;
        }

        .hero p {
            color: #444;
            font-size: 17px;
            margin-bottom: 30px;
        }

        .btn {
            display: inline-block;
            background-color: #243b64;
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 5px;
            margin: 5px;
        }

        .btn:hover {
            background-color: #385b91;
        }

        .events {
            padding: 50px 20px;
            text-align: center;
        }

        .events h2 {
            color: #243b64;
            margin-bottom: 30px;
        }

        .event-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 25px;
        }

        .event-card {
            background-color: white;
            width: 280px;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        .event-card h3 {
            color: #243b64;
            margin-bottom: 15px;
        }

        .event-card p {
            color: #555;
            line-height: 1.6;
        }

        footer {
            background-color: #243b64;
            color: white;
            text-align: center;
            padding: 18px;
            margin-top: 30px;
        }

        @media (max-width: 600px) {
            header {
                flex-direction: column;
                gap: 15px;
            }

            nav a {
                margin: 5px;
            }

            .hero h1 {
                font-size: 28px;
            }
        }
    </style>
</head>

<body>

<header>
    <h2>College Events</h2>

    <nav>
        <a href="index.php">Home</a>
        <a href="register.php">Register</a>
        <a href="login.php">Login</a>
        <a href="admin_login.php">Admin</a>
    </nav>
</header>

<section class="hero">
    <h1>Welcome to College Event Registration</h1>

    <p>
        Discover exciting events, participate in activities
        and showcase your talents.
    </p>

    <a href="register.php" class="btn">Get Started</a>
    <a href="login.php" class="btn">Student Login</a>
</section>

<section class="events">
    <h2>Our Events</h2>

    <div class="event-container">

        <div class="event-card">
            <h3>Technical Events</h3>
            <p>
                Participate in coding competitions,
                technical quizzes and workshops.
            </p>
        </div>

        <div class="event-card">
            <h3>Cultural Events</h3>
            <p>
                Enjoy singing, dancing, music
                and other cultural activities.
            </p>
        </div>

        <div class="event-card">
            <h3>Sports Events</h3>
            <p>
                Participate in sports competitions
                and showcase your athletic skills.
            </p>
        </div>

    </div>
</section>

<footer>
    <p>&copy; 2026 College Event Registration System</p>
</footer>

</body>
</html>