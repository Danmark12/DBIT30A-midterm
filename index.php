<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Login</title>
</head>
<body>
    <div class="card-container">
        <div class="card">
            <h3 class="text-primary">DonMarco</h3>
            <hr class="border-line"/>
            <?php if(isset($_SESSION['message'])): ?>
                <div class="alert alert-<?php echo $_SESSION['message']['alert'] ?> msg">
                    <?php echo $_SESSION['message']['text'] ?>
                </div>
                <script>
                    (function() {
                        setTimeout(function(){
                            document.querySelector('.msg').remove();
                        }, 3000)
                    })();
                </script>
                <?php unset($_SESSION['message']); ?>
            <?php endif; ?>
            <form action="login/login_query.php" method="POST">  
                <h4 class="text-success">Login here!</h4>
                <hr class="border-line">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" required />
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" required />
                </div>
                <button class="btn btn-primary form-control" name="login">Login</button>
                <p class="register-link"><a href="login/register.php">Register</a></p>
            </form>
        </div>
    </div>
</body>
</html>
