<?php
if (!empty($_GET['q'])) {
    $query = htmlspecialchars($_GET['q'], ENT_QUOTES, 'UTF-8');

    switch ($query) {
        case 'info':
            phpinfo();
            exit;
        default:
            header("HTTP/1.0 404 Not Found");
            echo "Invalid query parameter.";
            exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Laragon</title>
</head>

<body>
    <div class="container">
        <div class="content">
            <h1 class="title" title="Laragon">Login</h1>
            <?php
            if(!empty($_POST['username']))
            {
                $u_user = $_POST["username"];
                $p_user = $_POST["password"];

                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "ecomercedb";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT *,  CONCAT(name, ' ', lastname) AS fullName FROM user WHERE username = '$u_user' AND passwrd = '$p_user' ";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc()
                        ?>
                        <div class="info">
                            <ul class="list">
                                <li class="list-item">Username: <span><?php echo $row["username"] ?></span> </li>
                                <li class="list-item">Password: <span><?php echo $row["passwrd"] ?></span> </li>
                                <li class="list-item">Email: <span><?php echo $row["email"] ?></span> </li>
                                <li class="list-item">Birthday: <span><?php echo $row["birthday"] ?></span> </li>
                                <li class="list-item">Name: <span><?php echo $row["name"] ?></span> </li>
                                <li class="list-item">Last Name: <span><?php echo $row["lastname"] ?></span> </li>
                            </ul>
                        </div>

                        <?php

                } 
                else {
                    echo "User not found";
                }
                $conn->close();
            }
            
            else{
                ?>
                <form action="" method="POST">
                    <div class="input-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" >
                    </div>
                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" >
                    </div>
                    <button type="submit" class="button">Log In</button>
                </form>
                <?php
            }
            ?>
        </div>
    </div>
</body>

</html>