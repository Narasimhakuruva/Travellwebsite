<?php
$insertconf = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $server = 'localhost';
    $user = 'root';
    $pass = '';
    $dbname = 'responsive';

    $conn = new mysqli($server, $user, $pass, $dbname);

    if ($conn->connect_error) {
        die("Connection with database failed: " . $conn->connect_error);
    }

    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $tickets = $_POST['tickets'];
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("INSERT INTO details (name, mobile, email, tickets, startdate, enddate, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sisssss", $name, $mobile, $email, $tickets, $startdate, $enddate, $password);

    if ($stmt->execute()) {
        $insertconf = true;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form</title>
    <link rel="stylesheet" href="forms.css">
    <style>
        body {
            background-image: url("https://www.wns.co.za/Portals/0/Images/HeaderBanner/desktop/1087/53/travel_HD.jpg");
            color: white;
            text-align: center;
        }

        label {
            display: inline-block;
            width: 120px;
            font-size: 20px;
            font-weight: 500;
        }

        input {
            display: inline-block;
            width: 120px;
            font-size: 20px;
            font-weight: 500;
            margin-left: 20px;
            margin: 5px;
        }

        .nr {
            text-align: center;
            background-color: black;
            padding: 5px;
        }

        .rk {
            text-align: left;
            background-color: white;
            color: black;
        }

        #submit {
            background-color: blueviolet;
            color: antiquewhite;
            padding: 3px;
            border-width: 0px;
            width: 100px;
            font-size: medium;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="register-bg">
        <h1 style="text-decoration: underline">Register</h1>

        <?php
        if ($insertconf) {
            echo "<h1>Your tickets were booked</h1>";
        }
        ?>

        <form action="" method="post">
            <div>
                <label for="name">Name:</label>
                <input type="text" name="name" required>
            </div><br>
            <div>
                <label for="mobile">Mobile:</label>
                <input type="tel" name="mobile" required>
            </div><br>
            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" required>
            </div><br>
            <div>
                <label for="tickets">Tickets:</label>
                <input type="text" id="tickets" name="tickets" required>
            </div><br>
            <div>
                <label for="startdate">Start date:</label>
                <input type="text" name="startdate">
            </div><br>
            <div>
                <label for="enddate">End date:</label>
                <input type="text" name="enddate">
            </div><br>
            <div>
                <label for="password">Password:</label>
                <input type="password" name="password">
            </div><br>
            <input id="submit" type="submit" value="Book">
        </form>
    </div>
</body>
</html>
