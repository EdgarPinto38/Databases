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
            <h1 class="title" title="Laragon">Users</h1>
            <?php

            if (!empty($_POST['id'])) {
                $u_id = $_POST['id'];

                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "ecomercedb";

                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "DELETE FROM user WHERE id = $u_id;";
                $result = $conn->query($sql);

                if ($result === TRUE) {
                    ?>
                    <div class="info">
                        <p>User eliminado correctamente...</p><br />
                    </div><br />
                    <?php
                } else {
                    echo "Error al eliminar usuario";
                }
                $conn->close();
            } else {
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "ecomercedb";

                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT *,  CONCAT(name, ' ', lastname) AS fullName FROM user";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
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
                            <form action="" method="post">
                                <input type="hidden" name="id" value="<?php echo $row["id"]; ?>" />
                                <input type="submit" value="Borrar" />
                            </form>
                        </div>
                        <?php
                    }
                } else {
                    echo "0 results";
                }
                $conn->close();
            }

            ?>
        </div>
    </div>
</body>

</html>