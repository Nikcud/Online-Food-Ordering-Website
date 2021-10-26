<?php
    session_start();
    if(isset($_POST['submit'])){
        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'food_delivery';

        $user = $_POST['uname'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $pswd = $_POST['password'];
    
        $conn = mysqli_connect($servername,$username,$password,$database);
        if(!$conn){
            die("Connection Failed");
            echo mysqli_connect_error();
        }

        $str = "SELECT * FROM User where Name = '$user';";
        $query = mysqli_query($conn,$str);
        $count = mysqli_num_rows($query);

        if($count == 1){
            echo "<script> 
            alert('User Already Exist....');
                window.location.href = 'signup.php';
            </script>";
            
        }
        else{
            $str = "INSERT INTO USER(Name, Gender, Email, Phone, Password) VALUES('$user','$gender','$email','$phone','$pswd');";
            $query = mysqli_query($conn,$str);
            echo "<script> 
                    alert('Account created Successfully');
                        window.location.href = 'signin.php';
                    </script>";
        }
        mysqli_close($conn);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Delivery</title>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/signup.css">

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
                " <li class='items'><a href='signin.php'>Sign In</a></li>  
                 <li class='items'><a class='active' href='signup.php'>Sign Up</a></li>"; ?>
           <?php echo $x; ?> 
        
        </ul>
      
    </nav>

    <br>
    <br>

    <section>
        <form action="" method="POST">
            <h2>Create an Account</h2>
            <br>
            <div>
                <label>Your Name</label>
                <input type='text' id="name" name = 'uname' placeholder='Name'
                        onfocus="focusMe(this);" onblur="blurMe(this);"
                        oninput="checkBorder(this);"
                        onkeypress="return checkInput(this);">
            </div>
            <div>
                <label id='gen-label'>Gender</label>
                <input type='radio' id="gender" name = 'gender' value='Male'> Male
                <input type='radio' id="gender" name = 'gender' value='Female'> Female
            </div>
            <div>
                <label>User Email</label>
                <input type='email' id="email" name='email' placeholder='Email'
                    onfocus="focusMe(this);" onblur="blurMe(this); checkEmailAndPassword(this);"
                    oninput="checkBorder(this);">
            </div>
            <div>
                <label>Phone Number</label>
                <input type='tel' id="number" name='phone' placeholder='Phone'
                    onfocus="focusMe(this);" onblur="blurMe(this);" maxlength=10
                    onkeypress="return checkInput(this);"
                    oninput="checkBorder(this);">
            </div>
            <div>
                <label>Password</label>
                <input type='password' id="password" name='password' placeholder='Password'
                    onfocus="focusMe(this);" onblur="blurMe(this); checkEmailAndPassword(this);"
                    oninput="checkBorder(this);" 
                    title=' The password is at least 8 characters long 
                            The password has at least one uppercase letter 
                            The password has at least one lowercase letter 
                            The password has at least one digit
                            The password has at least one special character'>
            </div>
            <div>
                <label>Confirm Password</label>
                <input type='password' id="cnfrm_password" name='cnfrm_password' placeholder='Confirm Password'
                    onfocus="focusMe(this);" onblur="blurMe(this);"
                    oninput="checkBorder(this);">
            </div>
            <br>

            <button type='submit' id='submit' name="submit" onclick="return validateForm(this.form);">
            Create an Account</button>
            
        </form>
    </section>

</body>
<script src='js/signup'> </script>
</html>