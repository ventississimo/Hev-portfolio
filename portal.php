<?php
// Start a session
session_start();
require_once "config.php";

// Check if the user is not logged in
if (!isset($_SESSION['loggedin'])) {
    // Redirect the user to the login page
    header('Location: login.php');
    exit;
}

// Check if the user has the "admin" account type
if ($_SESSION['acc_type'] !== 'admin') {
    // Redirect to an error page or display an error message
    header('Location: error.php');
    exit();
}

// Connect to the database
$servername = "localhost"; 
$username = "root"; 
$password = "";
$dbname = "ledres_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: ".$conn->connect_error);
}

// Delete table rows if requested
if (isset($_POST['delete'])) {
    $deleteIDs = $_POST['delete'];

    foreach ($deleteIDs as $id) {
        $sql = "DELETE FROM contact_submissions WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}

// Retrieve data from the database
$sql = "SELECT id, name, email, message FROM contact_submissions";
$result = $conn->query($sql);

// Display the data
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact Requests</title>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('images/bg.jpg');
            background-repeat: none;
        }
       title {
             color: white;
        }
        .message-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 75px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th,
        .table td {
            padding: 20px;
            margin: 100%;
            text-align: left;
            border-bottom: 1px solid #ddd;
            color: white; /* Set the color to white */
        }
        .table th {
            background-color: #00CBA8;
        }
        .heading{
            color:#48C9B0;
        }
        .no-requests {
            margin-top: 20px;
            font-size: 1.2rem;
            color: #00CBA8;
        }
         .back-button {
            position: absolute;
            bottom: 20px;
            right: 2px;
        }
        .delete-button {
            font-size: 0.85rem;
            color: #F8FEFC;
            background: #48C9B0;
            display: inline-flex;
            padding: 10px 13px;
            border-radius: 0.3rem;
            margin-right: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <section class="head-cont" id="contact">
        <h2 class="heading">Contact Requests</h2>

        <!-- Logout -->
        <div class="logout-cont">
            <form method="post" action="logout.php">
                <input type="hidden" name="action" value="logout">
                <button type="submit" style="font-size: 0.85rem;
                    color: #F8FEFC;
                    background: #48C9B0;
                    display: inline-flex;
                    padding: 10px 13px;
                    border-radius: 0.3rem;
                    margin-right: 50px;
                    cursor: pointer;
                    float: right;">Logout</button>
            </form>
        </div>
         <!-- Back button -->
        <div class="back-button">
            <button onclick="goBack()" style="font-size: 0.85rem;
                    color: #F8FEFC;
                    background: #48C9B0;
                    display: inline-flex;
                    padding: 10px 13px;
                    border-radius: 0.3rem;
                    margin-right: 50px;
                    cursor: pointer;
                    float: right;">Back</button>
        </div>
    </div>
    </section>

    <div class="message-container">
        <?php
        if ($result->num_rows > 0) {
            echo "<form method='post' action=''>";
            echo "<table class='table'>";
            echo "<tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Action</th>
                </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['message'] . "</td>"; 
                echo "<td><input type='checkbox' name='delete[]' value='" . $row['id'] . "'></td>";
                echo "</tr>";
            }
            echo "</table>";
            echo "<button type='submit' style='font-size: 0.85rem;
                    color: #F8FEFC;
                    background: #48C9B0;
                    display: inline-flex;
                    padding: 10px 13px;
                    border-radius: 0.3rem;
                    margin-top: 10px;
                    cursor: pointer;'>Delete</button>";
            echo "</form>";
        } else {
            echo "<p class='no-requests'>There are no contact requests.</p>";
        }
        ?>
    </div>
     <script>
       function goBack() {
            window.location.href = "admin_form.php";
        }
    </script>
</body>
</html>

<?php
// Close the database connection 
$conn->close();
?>
