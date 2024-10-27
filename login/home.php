<!DOCTYPE html>
<?php
require '../db/config.php';
session_start();

if (!ISSET($_SESSION['user'])) {
    header('location:../index.php');
}

// Fetch employee details
$id = $_SESSION['user'];
$sql = $conn->prepare("SELECT * FROM `employee` WHERE `employee_id`='$id'");
$sql->execute();
$fetch = $sql->fetch();

// Queries for different types of joins
$innerJoinSql = "
    SELECT  
        employee.firstname,  
        employee.lastname,  
        products.Product_id,   
        order_details.Quantity,  
        order_details.Unit_price  
    FROM 
        order_details 
    INNER JOIN 
        employee ON order_details.employee_id = employee.employee_id 
    INNER JOIN 
        products ON order_details.Product_id = products.Product_id";

$leftJoinSql = "
    SELECT  
        employee.firstname,  
        employee.lastname,  
        products.Product_id,   
        order_details.Quantity,  
        order_details.Unit_price  
    FROM 
        employee 
    LEFT JOIN 
        order_details ON employee.employee_id = order_details.employee_id 
    LEFT JOIN 
        products ON order_details.Product_id = products.Product_id";

$rightJoinSql = "
    SELECT  
        employee.firstname,  
        employee.lastname,  
        products.Product_id,   
        order_details.Quantity,  
        order_details.Unit_price  
    FROM 
        products 
    RIGHT JOIN 
        order_details ON products.Product_id = order_details.Product_id 
    RIGHT JOIN 
        employee ON order_details.employee_id = employee.employee_id";

$outerJoinSql = "
    SELECT 
        employee.firstname, 
        employee.lastname, 
        products.Product_id, 
        order_details.Quantity, 
        order_details.Unit_price  
    FROM 
        employee 
    LEFT JOIN 
        order_details ON employee.employee_id = order_details.employee_id 
    LEFT JOIN 
        products ON order_details.Product_id = products.Product_id

    UNION

    SELECT 
        employee.firstname, 
        employee.lastname, 
        products.Product_id, 
        order_details.Quantity, 
        order_details.Unit_price  
    FROM 
        products 
    RIGHT JOIN 
        order_details ON products.Product_id = order_details.Product_id 
    RIGHT JOIN 
        employee ON order_details.employee_id = employee.employee_id";

?>

<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body style="font-family: Arial, sans-serif; background-color: #121212; margin: 0; padding: 20px; color: white;">
    <div style="max-width: 800px; margin: auto; background: #1E1E1E; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5); position: relative;">
        <h3 style="color: #FF6F20;">DonMarco</h3>
        <hr style="border-top: 1px dotted #ccc;"/>
        <h3>Welcome!</h3>
        <center>
            <h4><?php echo $fetch['firstname'] . " " . $fetch['lastname'] ?></h4>
        </center>
        
        <!-- Logout button positioned in the upper right corner -->
        <a href="logout.php" style="background-color: #FF6F20; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px; position: absolute; top: 20px; right: 20px;">Logout</a>

        <div style="margin-top: 20px;">
            <!-- Inner Join Results -->
            <div style="margin-bottom: 20px; border: 1px solid #e0e0e0; border-radius: 5px; overflow: hidden;">
                <div style="background: #FF6F20; color: white; padding: 10px; text-align: center;">Inner Join Results</div>
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background-color: #1E1E1E;">
                            <th style="padding: 10px; border: 1px solid #e0e0e0;">Firstname</th>
                            <th style="padding: 10px; border: 1px solid #e0e0e0;">Lastname</th>
                            <th style="padding: 10px; border: 1px solid #e0e0e0;">Product ID</th>
                            <th style="padding: 10px; border: 1px solid #e0e0e0;">Quantity</th>
                            <th style="padding: 10px; border: 1px solid #e0e0e0;">Unit Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($conn->query($innerJoinSql) as $row) {
                            echo "<tr>
                                <td style='padding: 10px; border: 1px solid #e0e0e0;'>{$row['firstname']}</td>
                                <td style='padding: 10px; border: 1px solid #e0e0e0;'>{$row['lastname']}</td>
                                <td style='padding: 10px; border: 1px solid #e0e0e0;'>{$row['Product_id']}</td>
                                <td style='padding: 10px; border: 1px solid #e0e0e0;'>{$row['Quantity']}</td>
                                <td style='padding: 10px; border: 1px solid #e0e0e0;'>{$row['Unit_price']}</td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Left Join Results -->
            <div style="margin-bottom: 20px; border: 1px solid #e0e0e0; border-radius: 5px; overflow: hidden;">
                <div style="background: #FF6F20; color: white; padding: 10px; text-align: center;">Left Join Results</div>
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background-color: #1E1E1E;">
                            <th style="padding: 10px; border: 1px solid #e0e0e0;">Firstname</th>
                            <th style="padding: 10px; border: 1px solid #e0e0e0;">Lastname</th>
                            <th style="padding: 10px; border: 1px solid #e0e0e0;">Product ID</th>
                            <th style="padding: 10px; border: 1px solid #e0e0e0;">Quantity</th>
                            <th style="padding: 10px; border: 1px solid #e0e0e0;">Unit Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($conn->query($leftJoinSql) as $row) {
                            echo "<tr>
                                <td style='padding: 10px; border: 1px solid #e0e0e0;'>{$row['firstname']}</td>
                                <td style='padding: 10px; border: 1px solid #e0e0e0;'>{$row['lastname']}</td>
                                <td style='padding: 10px; border: 1px solid #e0e0e0;'>{$row['Product_id']}</td>
                                <td style='padding: 10px; border: 1px solid #e0e0e0;'>{$row['Quantity']}</td>
                                <td style='padding: 10px; border: 1px solid #e0e0e0;'>{$row['Unit_price']}</td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Right Join Results -->
            <div style="margin-bottom: 20px; border: 1px solid #e0e0e0; border-radius: 5px; overflow: hidden;">
                <div style="background: #FF6F20; color: white; padding: 10px; text-align: center;">Right Join Results</div>
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background-color: #1E1E1E;">
                            <th style="padding: 10px; border: 1px solid #e0e0e0;">Firstname</th>
                            <th style="padding: 10px; border: 1px solid #e0e0e0;">Lastname</th>
                            <th style="padding: 10px; border: 1px solid #e0e0e0;">Product ID</th>
                            <th style="padding: 10px; border: 1px solid #e0e0e0;">Quantity</th>
                            <th style="padding: 10px; border: 1px solid #e0e0e0;">Unit Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($conn->query($rightJoinSql) as $row) {
                            echo "<tr>
                                <td style='padding: 10px; border: 1px solid #e0e0e0;'>{$row['firstname']}</td>
                                <td style='padding: 10px; border: 1px solid #e0e0e0;'>{$row['lastname']}</td>
                                <td style='padding: 10px; border: 1px solid #e0e0e0;'>{$row['Product_id']}</td>
                                <td style='padding: 10px; border: 1px solid #e0e0e0;'>{$row['Quantity']}</td>
                                <td style='padding: 10px; border: 1px solid #e0e0e0;'>{$row['Unit_price']}</td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Outer Join Results -->
            <div style="margin-bottom: 20px; border: 1px solid #e0e0e0; border-radius: 5px; overflow: hidden;">
                <div style="background: #FF6F20; color: white; padding: 10px; text-align: center;">Outer Join Results</div>
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background-color: #1E1E1E;">
                            <th style="padding: 10px; border: 1px solid #e0e0e0;">Firstname</th>
                            <th style="padding: 10px; border: 1px solid #e0e0e0;">Lastname</th>
                            <th style="padding: 10px; border: 1px solid #e0e0e0;">Product ID</th>
                            <th style="padding: 10px; border: 1px solid #e0e0e0;">Quantity</th>
                            <th style="padding: 10px; border: 1px solid #e0e0e0;">Unit Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($conn->query($outerJoinSql) as $row) {
                            echo "<tr>
                                <td style='padding: 10px; border: 1px solid #e0e0e0;'>{$row['firstname']}</td>
                                <td style='padding: 10px; border: 1px solid #e0e0e0;'>{$row['lastname']}</td>
                                <td style='padding: 10px; border: 1px solid #e0e0e0;'>{$row['Product_id']}</td>
                                <td style='padding: 10px; border: 1px solid #e0e0e0;'>{$row['Quantity']}</td>
                                <td style='padding: 10px; border: 1px solid #e0e0e0;'>{$row['Unit_price']}</td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</body>
</html>
