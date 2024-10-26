<?php
        session_start();
       
        require_once '../db/config.php';
       
        if(ISSET($_POST['login'])){
                if($_POST['username'] != "" || $_POST['password'] != ""){
                        $username = $_POST['username'];
                        $password = $_POST['password'];
                        $sql = "SELECT * FROM `employee` WHERE `username`=? AND `password`=? ";
                        $query = $conn->prepare($sql);
                        $query->execute(array($username,$password));
                        $row = $query->rowCount();
                        $fetch = $query->fetch();
                        if($row > 0) {
                                $_SESSION['user'] = $fetch['employee_id'];
                                header("location: ../login/home.php");
                        } else{
                                echo "
                                <script>alert('Invalid username or password')</script>
                                <script>window.location = '../index.php'</script>
                                ";
                        }
                }else{
                        echo "
                                <script>alert('Please complete the required field!')</script>
                                <script>window.location = '../index.php'</script>
                        ";
                }
        }
?>