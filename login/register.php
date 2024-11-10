<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
    <style>
        /* Center the card on the page */
        body, html {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            margin: 0;
            background-color: #f7f9fc;
            font-family: Arial, sans-serif;
        }

        /* Card styling */
        .card {
            width: 100%;
            max-width: 400px;
            padding: 30px;
            background-color: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border-radius: 8px;
            text-align: left;
        }

        .card h3 {
            color: #333333;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .card h4 {
            color: #555555;
            font-size: 18px;
            margin-bottom: 20px;
            font-weight: normal;
        }

        .form-group label {
            color: #333333;
            font-weight: bold;
        }

        .form-control {
            border: 1px solid #d1d5db;
            background-color: #f7f9fc;
            color: #333333;
            font-size: 16px;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
        }

        /* Button design inspired by GitHub */
        .btn-dark {
            background-color: #24292e;
            color: #ffffff;
            padding: 10px;
            border: none;
            border-radius: 6px;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-weight: bold;
        }

        .btn-dark:hover {
            background-color: #3a3d42;
        }

        /* Link styling */
        .card a {
            color: #0366d6;
            text-decoration: none;
            font-size: 14px;
            display: inline-block;
            margin-top: 10px;
        }
        
        .card a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="card">
        <h3>PHP - PDO Login and Registration</h3>
        <h4>Register here...</h4>
        <form action="register_query.php" method="POST">       
            <div class="form-group">
                <label>Firstname</label>
                <input type="text" class="form-control" name="firstname" required />
            </div>
            <div class="form-group">
                <label>Lastname</label>
                <input type="text" class="form-control" name="lastname" required />
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="username" required />
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" required />
            </div>
            <br />
            <div class="form-group">
                <button class="btn-dark" name="register">Register</button>
            </div>
            <a href="../index.php">Login</a>
        </form>
    </div>
</body>
</html>
