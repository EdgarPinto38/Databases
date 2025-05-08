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
    <title>Admin Users View</title>
</head>

<body>
    <div class="grid-container">
        <nav class="navbar">
            <div class="logo-wrapper"></div>
            <ul class="list-wrapper">
                <li><a href="users_view.php" class="list-item" aria-current="page">
                        <img src="../images/icons/users.svg" alt="Users icon" class="list-logo">
                        <span class="list-text">Users</span>
                    </a></li>
                <li><a href="login.php" class="list-item" aria-current="page">
                        <img src="" alt="Users icon" class="list-logo">
                        <span class="list-text">Login</span>
                    </a></li>
                <li><a href="insert.php" class="list-item" aria-current="page">
                        <img src="" alt="Users icon" class="list-logo">
                        <span class="list-text">Sign Up</span>
                    </a></li>
            </ul>
        </nav>

        <main class="content">
            <h2 class="content-header">Users List:</h2>
            <section class="users-wrapper">
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
                    $result = $conn->query( $sql);

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
                            <article class="user-card">
                                <div class="user-image"></div>
                                <div class="user-info">
                                    <div class="row">
                                        <div class="user-username">Username: <span
                                                class="user-value"><?php echo $row["username"] ?></span></div>
                                        <div class="user-password">Password: <span
                                                class="user-value"><?php echo $row["passwrd"] ?></span></div>
                                    </div>
                                    <div class="row">
                                        <div class="user-mail">Email: <span class="user-value"><?php echo $row["email"] ?></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="user-name">Name: <span class="user-value"><?php echo $row["name"] ?></span>
                                        </div>
                                        <div class="user-last">Last Name: <span
                                                class="user-value"><?php echo $row["lastname"] ?></span></div>
                                        <div class="user-birthday">Birthday: <span
                                                class="user-value"><?php echo $row["birthday"] ?></span></div>
                                    </div>
                                </div>
                                <div class="user-button-wrapper">
                                    <form action="" method="post">
                                        <input type="hidden" name="id" value="<?php echo $row["id"]; ?>" />
                                        <input type="submit" value="Delete" class="user-button" />
                                    </form>
                                    <form action="update.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $row["id"]; ?>" />
                                        <input type="submit" value="Modify" class="user-button" />
                                    </form>
                                </div>
                            </article>
                            <?php
                        }
                    } else {
                        echo "0 results";
                    }
                    $conn->close();
                }

                ?>
            </section>
        </main>
    </div>
</body>

</html>