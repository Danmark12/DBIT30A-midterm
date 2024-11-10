<!DOCTYPE html>
<?php
require '../db/config.php';
session_start();

if (!isset($_SESSION['user'])) {
    header('location:../index.php');
}

// Fetch employee details
$id = $_SESSION['user'];
$sql = $conn->prepare("SELECT * FROM `employee` WHERE `employee_id`='$id'");
$sql->execute();
$fetch = $sql->fetch();

// Inner Join Query
$innerJoinSql = "
    SELECT 
        employee.firstname, 
        employee.lastname, 
        order_details.product_id, 
        order_details.Quantity, 
        order_details.Unit_price 
    FROM 
        order_details 
    JOIN 
        employee ON order_details.employee_id = employee.employee_id";

// Right Join Query
$rightJoinSql = "
    SELECT 
        employee.employee_id, 
        employee.firstname, 
        employee.lastname, 
        employee.username, 
        employee.password, 
        order_details.Product_id, 
        order_details.Quantity, 
        order_details.Unit_price 
    FROM 
        employee 
    RIGHT JOIN 
        order_details ON employee.employee_id = order_details.employee_id";

// Left Join Query
$leftJoinSql = "
    SELECT 
        employee.employee_id, 
        employee.firstname, 
        employee.lastname, 
        employee.username, 
        employee.password, 
        order_details.Product_id, 
        order_details.Quantity, 
        order_details.Unit_price 
    FROM 
        employee 
    LEFT JOIN 
        order_details ON employee.employee_id = order_details.employee_id";

// Outer Join Query
$outerJoinSql = "
    SELECT 
        employee.employee_id, 
        employee.firstname, 
        employee.lastname, 
        employee.username, 
        employee.password, 
        order_details.Product_id, 
        order_details.Quantity, 
        order_details.Unit_price 
    FROM 
        employee 
    RIGHT JOIN 
        order_details ON employee.employee_id = order_details.employee_id
    UNION
    SELECT 
        employee.employee_id, 
        employee.firstname, 
        employee.lastname, 
        employee.username, 
        employee.password, 
        order_details.Product_id, 
        order_details.Quantity, 
        order_details.Unit_price 
    FROM 
        employee 
    LEFT JOIN 
        order_details ON employee.employee_id = order_details.employee_id";
?>

<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Employee Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: white;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: #1E1E1E;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
            position: relative;
        }
        h3 {
            color: #FF6F20;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #e0e0e0;
        }
        th {
            background-color: #1E1E1E;
        }
        .header {
            background: #FF6F20;
            color: white;
            padding: 10px;
            text-align: center;
        }
        a.logout {
            background-color: #FF6F20;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            position: absolute;
            top: 20px;
            right: 20px;
        }
        .button {
            display: inline-block;
            padding: 10px;
            background-color: #FF6F20;
            color: white;
            margin: 5px 0;
            text-align: center;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .results {
            display: none;
        }
    </style>
    <script>
        function toggleResults(id) {
            document.querySelectorAll('.results').forEach(div => div.style.display = 'none');
            document.getElementById(id).style.display = 'block';
        }
    </script>
</head>
<body>
    <div class="container">
        <h3>DonMarco</h3>
        <hr/>
        <h3>Welcome!</h3>
        <center>
            <h4><?php echo htmlspecialchars($fetch['firstname'] . " " . $fetch['lastname']); ?></h4>
        </center>
        
        <a href="logout.php" class="logout">Logout</a>

        <p>Joins Samples of my dbs</p>

        <!-- Buttons for Each Join Type -->
        <button class="button" onclick="toggleResults('innerJoin')">Show Inner Join Results</button>
        <button class="button" onclick="toggleResults('rightJoin')">Show Right Join Results</button>
        <button class="button" onclick="toggleResults('leftJoin')">Show Left Join Results</button>
        <button class="button" onclick="toggleResults('outerJoin')">Show Outer Join Results</button>

        <!-- Inner Join Results -->
        <div id="innerJoin" class="results">
            <div class="header">Inner Join Results</div>
            <table>
                <thead>
                    <tr>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Product ID</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($conn->query($innerJoinSql) as $row) {
                        echo "<tr>
                            <td>" . htmlspecialchars($row['firstname']) . "</td>
                            <td>" . htmlspecialchars($row['lastname']) . "</td>
                            <td>" . htmlspecialchars($row['product_id']) . "</td>
                            <td>" . htmlspecialchars($row['Quantity']) . "</td>
                            <td>" . htmlspecialchars($row['Unit_price']) . "</td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Right Join Results -->
        <div id="rightJoin" class="results">
            <div class="header">Right Join Results</div>
            <table>
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Product ID</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($conn->query($rightJoinSql) as $row) {
                        echo "<tr>
                            <td>" . htmlspecialchars($row['employee_id']) . "</td>
                            <td>" . htmlspecialchars($row['firstname']) . "</td>
                            <td>" . htmlspecialchars($row['lastname']) . "</td>
                            <td>" . htmlspecialchars($row['username']) . "</td>
                            <td>" . htmlspecialchars($row['password']) . "</td>
                            <td>" . htmlspecialchars($row['Product_id']) . "</td>
                            <td>" . htmlspecialchars($row['Quantity']) . "</td>
                            <td>" . htmlspecialchars($row['Unit_price']) . "</td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Left Join Results -->
        <div id="leftJoin" class="results">
            <div class="header">Left Join Results</div>
            <table>
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Product ID</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($conn->query($leftJoinSql) as $row) {
                        echo "<tr>
                            <td>" . htmlspecialchars($row['employee_id']) . "</td>
                            <td>" . htmlspecialchars($row['firstname']) . "</td>
                            <td>" . htmlspecialchars($row['lastname']) . "</td>
                            <td>" . htmlspecialchars($row['username']) . "</td>
                            <td>" . htmlspecialchars($row['password']) . "</td>
                            <td>" . htmlspecialchars($row['Product_id']) . "</td>
                            <td>" . htmlspecialchars($row['Quantity']) . "</td>
                            <td>" . htmlspecialchars($row['Unit_price']) . "</td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Outer Join Results -->
        <div id="outerJoin" class="results">
            <div class="header">Outer Join Results</div>
            <table>
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Product ID</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($conn->query($outerJoinSql) as $row) {
                        echo "<tr>
                            <td>" . htmlspecialchars($row['employee_id']) . "</td>
                            <td>" . htmlspecialchars($row['firstname']) . "</td>
                            <td>" . htmlspecialchars($row['lastname']) . "</td>
                            <td>" . htmlspecialchars($row['username']) . "</td>
                            <td>" . htmlspecialchars($row['password']) . "</td>
                            <td>" . htmlspecialchars($row['Product_id']) . "</td>
                            <td>" . htmlspecialchars($row['Quantity']) . "</td>
                            <td>" . htmlspecialchars($row['Unit_price']) . "</td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
