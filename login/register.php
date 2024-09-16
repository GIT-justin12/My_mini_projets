<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Register</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">
        <?php
            include("config.php");

            if(isset($_POST['submit'])){
                $username = $_POST['username'];
                $psw = $_POST['password'];
                $age = $_POST['age'];
                $email = $_POST['email'];

                //Verify unique email
                $verifyQuery = mysqli_query($connect, "SELECT email From user WHERE email = '$email'") or die("Error occured");
                if(mysqli_num_rows($verifyQuery) != 0){
                    echo "
                        <div class='message'>
                            <p>Email is already use, try another one please !</p>
                        </div></br>
                    ";
                    echo "<a href='javascript:self.history.back()'><button class='btn'>Go back</button></a>";
                }
                else{
                    mysqli_query($connect, "INSERT INTO user(username, email, age, password) VALUES('$username', '$email', '$age', '$psw')");
                    echo "
                        <div class='message'>
                            <p>Register successfully !</p>
                        </div></br>
                    ";
                    echo "<a href='index.php'><button class='btn'>Login now</button></a>";
                }
            }
            else{
        ?>
            <header>Sign up</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="age">Age</label>
                    <input type="number" name="age" id="age" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="text" name="password" id="password" autocomplete="off" required>
                </div>
                <div class=" field">
                    <input class="btn" type="submit" name="submit" value="Login" autocomplete="off" required>
                </div>
                <div class="link">
                    Already a member ? <a href="index.php">Sign in</a>
                </div>
            </form>
        </div>
        <?php } ?>
    </div>
</body>
</html>