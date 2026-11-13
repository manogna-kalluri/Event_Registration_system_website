<?php
include 'connection.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $department = trim($_POST['department']);
    $year = trim($_POST['year']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (
        $full_name == "" || $email == "" ||
        $phone == "" || $department == "" ||
        $year == "" || $password == ""
    ) {
        $message = "Please fill in all fields.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Please enter a valid email address.";

    } elseif ($password !== $confirm_password) {
        $message = "Passwords do not match.";

    } else {

        $check = $conn->prepare(
            "SELECT student_id FROM students WHERE email = ?"
        );
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $message = "This email is already registered.";

        } else {

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare(
                "INSERT INTO students
                (full_name, email, phone, department, year, password)
                VALUES (?, ?, ?, ?, ?, ?)"
            );

            $stmt->bind_param(
                "ssssss",
                $full_name,
                $email,
                $phone,
                $department,
                $year,
                $hashed_password
            );

            if ($stmt->execute()) {
                $message = "Registration successful! You can now login.";
            } else {
                $message = "Registration failed. Please try again.";
            }

            $stmt->close();
        }

        $check->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Registration</title>

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

        label {
            display: block;
            margin-top: 12px;
            color: #333;
        }

        input, select {
            width: 100%;
            padding: 11px;
            margin-top: 7px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            width: 100%;
            padding: 12px;
            margin-top: 22px;
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
            color: #243b64;
            margin-bottom: 12px;
        }

        .links {
            text-align: center;
            margin-top: 18px;
        }

        a {
            color: #243b64;
            text-decoration: none;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Student Registration</h2>

    <?php if ($message != "") { ?>
        <p class="message">
            <?php echo htmlspecialchars($message); ?>
        </p>
    <?php } ?>

    <form method="POST" action="">

        <label>Full Name</label>
        <input type="text" name="full_name" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Phone Number</label>
        <input type="tel" name="phone" required>

        <label>Department</label>
        <input type="text" name="department" required>

        <label>Year</label>
        <select name="year" required>
            <option value="">Select Year</option>
            <option value="1st Year">1st Year</option>
            <option value="2nd Year">2nd Year</option>
            <option value="3rd Year">3rd Year</option>
            <option value="4th Year">4th Year</option>
        </select>

        <label>Password</label>
        <input type="password" name="password" required>

        <label>Confirm Password</label>
        <input type="password" name="confirm_password" required>

        <button type="submit">Register</button>

    </form>

    <div class="links">
        Already registered? <a href="login.php">Login Here</a>
        <br><br>
        <a href="index.php">Back to Home</a>
    </div>

</div>

</body>
</html>

<?php
$conn->close();
?>