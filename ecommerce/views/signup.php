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
    <link rel="stylesheet" href="../style.css">
    <title>Sign Up</title>
</head>

<body>
    <div>
        <div>
            <?php
            if(!empty($_POST['username']))
            {
                $u_user = $_POST["username"];
                $u_pass = $_POST["password"];
                $u_mail = $_POST["email"];
                $u_name = $_POST["name"];
                $u_lastname = $_POST["lastname"];
                $u_birthday = $_POST["birthday"];

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

                $sql = "INSERT INTO user (username, passwrd, email, name, lastname, birthday) value ('$u_user', '$u_pass', '$u_mail', '$u_name', '$u_lastname', '$u_birthday');";

                $result = $conn->query($sql);

                if ($result === true) {
                        ?>
                        <div style="width: 100%; height: 100% ; display: flex; justify-content: center; align-items: center; font-size: 2rem; color: white;">
                            <p>Username: <span><?php echo $u_user; ?></span> creado con exito... </p><br>
                        </div><br>
                        <?php

                } 
                else {
                    echo "Error al crear usuario";
                }
                $conn->close();
            }
            
            else{
                ?>
                <div class="full-screen-container">
                    <div class="login-container">
                        <h1 class="login-title">Sign Up</h1>
                        <form class="form" action="" method="post">
                            <div class="input-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username">
                            </div>

                            <div class="input-group">
                                <label for="password">Password</label>
                                <input type="text" name="password" id="password">
                            </div>
                            <div class="input-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email">
                            </div>
                            <div class="input-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name">
                            </div>
                            <div class="input-group">
                                <label for="lastname">Last Name</label>
                                <input type="text" name="lastname" id="lastname">
                            </div>
                            <div class="input-group">
                                <label for="birthday">Birthday</label>
                                <input type="date" name="birthday" id="birthday">
                            </div>

                            <button type="submit" class="login-button">Sign Up</button>
                        </form>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</body>

</html>