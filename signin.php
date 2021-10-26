<?php
        session_start();

        if(isset($_POST['submit'])){
            $servername = 'localhost';
            $username = 'root';
            $password = '';
            $database = 'food_delivery';

            $user = $_POST['uname'];
            $pswd = $_POST['password'];
        
            $conn = mysqli_connect($servername,$username,$password,$database);
            if(!$conn){
                die("Connection Failed");
                echo mysqli_connect_error();
            }

            $str = "SELECT * FROM USER WHERE Name = '$user' and Password  = '$pswd';";

            $query = mysqli_query($conn,$str);
            $count = mysqli_num_rows($query);
            if($count == 1){
               
                for(; $row = mysqli_fetch_row($query);){
                    // echo $row[1]." ".$row[2]." ".$row[3]." ".$row[4]." "."<br>";

                    $_SESSION['isLogin'] = true;
                    $_SESSION['userID'] = $row[0];
                    $_SESSION['username'] = $row[1];
                    $_SESSION['gender'] = $row[2];
                    $_SESSION['email'] = $row[3];
                    $_SESSION['phone'] = $row[4];
                }

                echo "<script> 
                alert('SignIn Successfully');
                    window.location.href = 'index.php';
                </script>";


            // header('location:index.php');
            }

            mysqli_close($conn);
            

        }





        // if(isset($_POST['submit'])){
        //     if($_COOKIE['username'] == $_POST['uname'] && 
        //             $_COOKIE['password'] == $_POST['password']){
        //                 $_SESSION['isLogin'] = true;
        //                 $_SESSION['username'] = $_POST['uname'];
        //                 // echo "<script>
        //                 // alert('visit deleted successfully');
        //                 // window.location.href='index.php';
        //                 // </script>";

        //                 // echo "<script> alert('Login Successfully'); window.location.href='same page'; </script>";
        //                 header("location:index.php");

        //     }
        //     else{
        //         echo "<script>";
        //         echo "alert('Invalid Credentials');";
        //         echo "</script>";
        //     }
        // }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Delivery</title>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
   
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/signin.css">

</head>
<body>
<nav id="navbar">
        <div id="logo">
            <p>Foodyfly</p>
        </div>
        <ul>
        <li class="items"><a href="index.php">Home</a></li>
            <li class="items"><a href="foods.php">Food Items</a></li>
            <?php $x =  isset($_SESSION['isLogin'])  ? 
                "<li class='items'><a href='account.php'>Account</a></li>
                <li class='items'><a href='cart.php'>Cart</a></li>
                <li class='items'><a href='signout.php'>Sign out</a></li>": 
                " <li class='items'><a  class='active' href='signin.php'>Sign In</a></li>  
                 <li class='items'><a href='signup.php'>Sign Up</a></li>"; ?>
           <?php echo $x; ?>
        
        </ul>
    </nav>

    <br>
    <br>

    <section>
        <form method="POST">
            <h2>Login Here</h2>
            <br>
            <div>
                <label>User Name</label>
                <input type='text' id="name" name="uname" placeholder="User Name"
                    onfocus="focusMe(this);" onblur="blurMe(this);"
                        oninput="checkBorder(this);">
            </div>
            
                <label>Password</label>
                <input type='password' id="password" name="password" placeholder="Password"
                    onfocus="focusMe(this);" onblur="blurMe(this);"
                        oninput="checkBorder(this);">
            </div>
    
         <br>
         <br>
            <button type="submit"  name="submit" onclick="return login(this.form);">Sign In</button>
            
        </form>
    </section>

</body>
<script src='js/signin'> </script>
</html>