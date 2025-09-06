<?php
include '../php/registrationDB.php';
$query = "SELECT ID, fullname, username FROM registration WHERE role='Teacher'";
$result = $conn->query($query);

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM registration WHERE ID=$id AND role='Teacher'";
    mysqli_query($conn, $sql);
    header("Location:" . $_SERVER['PHP_SELF']);
    exit();
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $sql = "UPDATE registration SET fullname='$fullname', username='$username' 
            WHERE id=$id AND role='Teacher'";
    mysqli_query($conn, $sql);
    header("Location:" . $_SERVER['PHP_SELF']);
    exit();
}

if (isset($_POST['add'])) {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $sql = "INSERT INTO registration(fullname, username, role) 
            VALUES('$fullname', '$username','Teacher')";
    mysqli_query($conn, $sql);
    header("Location:" . $_SERVER['PHP_SELF']);
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        .container {
            display: flex;   /* side by side layout */
            align-items: flex-start;
        }
        .forms {
            width: 30%;
            padding: 10px;
            background: #f2f2f2;
            border-right: 2px solid #ccc;
        }
        .table-section {
            width: 70%;
            padding: 10px;
        }
        form {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            background: #fff;
        }
        button {
            margin-top: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- LEFT SIDE (Forms) -->
    <div class="forms">
        <h3>Add Teacher</h3>
        <form method="post">
            Full Name: <input type="text" name="fullname"><br><br>
            User Name: <input type="text" name="username"><br><br>
            <button type="submit" name="add">Add</button>
        </form>

        <h3>Update Teacher</h3>
        <form method="post">
            Enter Teacher ID: <input type="number" name="id"><br><br>
            New Full Name: <input type="text" name="fullname"><br><br>
            New User Name: <input type="text" name="username"><br><br>
            <button type="submit" name="update">Update</button>
        </form>

        <h3>Delete Teacher</h3>
        <form method="post" onsubmit="return confirm('Are you sure to delete this teacher?');">
            Enter Teacher ID: <input type="number" name="id"><br><br>
            <button type="submit" name="delete" style="background:red;color:white;">Delete</button>
        </form>
    </div>

    <!-- RIGHT SIDE (Table) -->
    <div class="table-section">
        <h3>Teacher List</h3>
        <table border="1" cellpadding="10">
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>User Name</th>
            </tr>
            <?php
            // Example PHP table loop
            include "config.php";
            $result = mysqli_query($conn, "SELECT * FROM registration WHERE role='Teacher'");
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>".$row['id']."</td>
                        <td>".$row['fullname']."</td>
                        <td>".$row['username']."</td>
                      </tr>";
            }
            ?>
        </table>
    </div>
</div>

</body>
</html>
