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
    <title>Laragon</title>
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            font-weight: 100;
            background-color: #f9f9f9;
            color: #333;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            text-align: center;
        }

        .content {
            width: 30%;
            max-width: 800px;
            padding: 100px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        .title {
            font-size: 60px;
            margin: 0;

        }

        .info {
            margin-top: 20px;
            line-height: 1.6;
        }

        .info a {
            color: #007bff;
            text-decoration: none;
        }

        .info a:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        .list {
            padding-inline-start: 0% !important;
        }

        .list-item {
            width: 100%;
            list-style: none;
            text-align: center;
            font-weight: bold;
        }

        .list-item span {
            font-weight: normal;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="content">
            <h1 class="title" title="Laragon">Users</h1>
            <?php
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

            $sql = "SELECT * FROM User";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
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
            } else {
                echo "0 results";
            }
            $conn->close();
            ?>
        </div>
    </div>
</body>

</html>